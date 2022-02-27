<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostRequest;
use App\Services\SaveImageService;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdatePost implements ShouldQueue
{
    use Dispatchable;
    private $post;
    private $title;
    private $body;
    private $author;
    private $photoCreditText;
    private $photoCreditLink;
    private $type;
    private $isCommentable;
    private $image;
    private $publishedAt;
    private $tags;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        Post $post,
        string $title,
        string $body,
        User $author,
        ?string $photoCreditText,
        ?string $photoCreditLink,
        string $type,
        bool $isCommentable,
        ?string $image,
        string $publishedAt,
        array $tags = []
    )
    {
        $this->post = $post;
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
        $this->photoCreditText = $photoCreditText;
        $this->photoCreditLink = $photoCreditLink;
        $this->type = $type;
        $this->isCommentable = $isCommentable;  
        $this->image = $image;
        $this->publishedAt = $publishedAt;
        $this->tags = $tags;
    }

    public static function fromRequest(Post $post, PostRequest $request): self
    {
        return new static(
            $post,
            $request->title(),
            $request->body(),
            $request->author(),
            $request->photoCreditText(),
            $request->photoCreditLink(),
            $request->type(),
            $request->isCommentable(),
            $request->image(),
            $request->publishedAt(),
            $request->tags(),
        );
    }

    public function handle(): Post
    {
        $this->post->update([
            'title'                 => $this->title,
            'body'                  => $this->body,
            'published_at'          => $this->publishedAt,
            'photo_credit_text'     => $this->photoCreditText,
            'photo_credit_link'     => $this->photoCreditLink,
            'type'                  => $this->type,
            'is_commentable'        => $this->isCommentable ? false : true,
        ]);

        $this->post->syncTags($this->tags);

        if (!is_null($this->image)) {

            File::delete(storage_path('app/' .$this->post->image));
            SaveImageService::UploadImage($this->image, $this->post, Post::TABLE);
            
        }
        return $this->post;
    }
}
