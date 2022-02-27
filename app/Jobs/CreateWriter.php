<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Status;
use App\Models\Writer;
use Illuminate\Bus\Queueable;
use App\Events\WriterWasCreated;
use App\Http\Requests\WriterRequest;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateWriter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $bio;
    private $facebook;
    private $twitter;
    private $instagram;
    private $linkedin;
    private $author;

    public function __construct(
        string $bio,
        ?string $facebook,
        ?string $twitter,
        ?string $instagram,
        ?string $linkedin,
        User $author
    )
    {
        $this->bio = $bio;
        $this->facebook = $facebook;
        $this->twitter = $twitter;
        $this->instagram = $instagram;
        $this->linkedin = $linkedin;
        $this->author = $author;
    }


    public static function fromRequest(WriterRequest $request): self
    {
        return new static(
            $request->bio(),
            $request->facebook(),
            $request->twitter(),
            $request->instagram(),
            $request->linkedin(),
            $request->author(),
        );
    }

    public function handle(): Writer
    {
        $writer = new Writer([
            'bio'                   => $this->bio,
            'facebook'                  => $this->facebook,
            'twitter'                  => $this->twitter,
            'instagram'                => $this->instagram,
            'linkedin'              => $this->linkedin,
        ]);

        $status = Status::whereName('Pending')->first();
        $writer->status()->associate($status);
        $writer->writer()->associate($this->author->writer);
        $writer->save();

        event(new WriterWasCreated($writer));

        return $writer;
    }
}
