<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostRequest;
use App\Services\SaveImageService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreatePost implements ShouldQueue
{
    use Dispatchable;

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

    public static function fromRequest(PostRequest $request): self
    {
        return new static(
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
        $post = new Post([
            'title'                 => $this->title,
            'body'                  => $this->body,
            'published_at'          => $this->publishedAt,
            'photo_credit_text'     => $this->photoCreditText,
            'photo_credit_link'     => $this->photoCreditLink,
            'type'                  => $this->type,
            'is_commentable'        => $this->isCommentable ? false : true,
        ]);

        $post->authoredBy($this->author);
        $post->syncTags($this->tags);   
        SaveImageService::UploadImage($this->image, $post, Post::TABLE);
        return $post;
    }
}
