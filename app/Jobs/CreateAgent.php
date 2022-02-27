<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Agent;
use App\Models\Status;
use Illuminate\Bus\Queueable;
use App\Events\AgentWasCreated;
use App\Services\SaveCodeService;
use App\Services\SaveImageService;
use App\Http\Requests\AgentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateAgent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $name;
    private $phone;
    private $email;
    private $address;
    private $instagram;
    private $facebook;
    private $twitter;
    private $linkedin;
    private $areaCovered;
    private $website;
    private $language;
    private $description;
    private $image;
    private $author;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        string $name,
        string $phone,
        string $email,
        string $address,
        string $instagram,
        string $facebook,
        string $twitter,
        string $linkedin,
        string $areaCovered,
        string $website,
        string $language,
        string $description,
        string $image,
        User $author
    )
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->instagram = $instagram;
        $this->facebook = $facebook;
        $this->twitter = $twitter;
        $this->linkedin = $linkedin;
        $this->areaCovered = $areaCovered;
        $this->website = $website;
        $this->language = $language;
        $this->description = $description;
        $this->image = $image;
        $this->author = $author;
    }

    public static function fromRequest(AgentRequest $request): self
    {
        return new static(
            $request->name(),
            $request->phone(),
            $request->email(),
            $request->address(),
            $request->instagram(),
            $request->facebook(),
            $request->twitter(),
            $request->linkedin(),
            $request->areaCovered(),
            $request->website(),
            $request->language(),
            $request->description(),
            $request->image(),
            $request->author(),
        );
    }

    public function handle(): Agent
    {
        $agent = new Agent([
            'name'                  =>  $this->name,
            'phone'                 =>  $this->phone,
            'email'                 =>  $this->email,
            'address'               =>  $this->address,
            'instagram'             =>  $this->instagram,
            'facebook'              =>  $this->facebook,
            'twitter'               =>  $this->twitter,
            'linkedin'              =>  $this->linkedin,
            'area_covered'          =>  $this->areaCovered,
            'website'               =>  $this->website,
            'language'              =>  $this->language,
            'description'           =>  $this->description,
        ]);

        $status = Status::whereName('Pending')->first();
        $agent->status()->associate($status);
        $agent->useredBy($this->author);
        // SaveCodeService::IDGenerator(new Agent, $agent, 'code', 4, 'agt');
        SaveImageService::UploadImage($this->image, $agent, Agent::TABLE);

        event(new AgentWasCreated($agent));
        
        return $agent;
    }
}
