<?php

namespace App\Http\Requests;

use App\Models\Post;
use App\Models\User;
use App\Models\Product;
use App\Models\Property;
use App\Contracts\CommentAble;
use App\Models\Thread;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body'              => ['required', 'max:250'],
            'parent_id'         => ['nullable'],
            'depth'             => ['nullable'],
            'commentable_id'    => ['required'],
            'commentable_type'  => ['required', Rule::in(Post::TABLE, Product::TABLE, Thread::TABLE, Property::TABLE)],
        ];
    }

    public function author(): User
    {
        return $this->user();
    }

    public function body(): string
    {
        return $this->get('body');
    }

    public function parentId(): ?int
    {
        return $this->get('parent_id');
    }

    public function depth(): ?int
    {
        return $this->get('depth');
    }

    public function commentAble(): CommentAble
    {
        return $this->findCommentAble($this->get('commentable_id'), $this->get('commentable_type'));
    }

    public function findCommentAble(int $id, string $type): CommentAble
    {
        switch ($type) {
            case Post::TABLE:
                return Post::find($id);
            case Property::TABLE:
                return Property::find($id);
            case Product::TABLE:
                return Product::find($id);
        }
        abort(404, 'NOT FOUND');
    }
}
