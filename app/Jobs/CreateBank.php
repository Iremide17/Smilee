<?php

namespace App\Jobs;

use App\Http\Requests\BankRequest;
use App\Models\Bank;
use App\Models\User;
use App\Services\SaveFileService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateBank implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $name;
    private $description;
    private $content;
    private $author;
    private $semesters;
    private $levels;

    public function __construct(
        string $name,
        string $description,
        string $content,
        User $author,
        array $semesters = [],
        array $levels = []
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->content = $content;
        $this->author = $author;
        $this->semesters = $semesters;
        $this->levels = $levels;

    }

    public static function fromRequest(BankRequest $request): self
    {
        return new static(
            $request->name(),
            $request->description(),
            $request->content(),
            $request->author(),
            $request->semesters(),
            $request->levels(),

        );
    }

    public function handle(): Bank
    {
        $bank = new Bank([
            'name'                 => $this->name,
            'description'          => $this->description,
        ]);

        $bank->authoredBy($this->author);
        SaveFileService::uploadFile('content', $this->content, $bank, Bank::TABLE);
        $bank->syncSemesters($this->semesters);
        $bank->syncLevels($this->levels);
        return $bank;
    }
}
