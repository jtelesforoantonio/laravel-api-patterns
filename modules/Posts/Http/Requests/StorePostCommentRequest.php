<?php

namespace Modules\Posts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Posts\Models\Post;

class StorePostCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $exists = Post::where('id', $this->route()->parameter('post'))->exists();

        return $exists;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'comment' => 'required|string|max:128',
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function passedValidation(): void
    {
        $this->merge([
            'post_id' => $this->route()->parameter('post'),
            'user_id' => $this->user()->id,
        ]);
    }
}
