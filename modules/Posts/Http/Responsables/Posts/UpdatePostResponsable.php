<?php

namespace Modules\Posts\Http\Responsables\Posts;

use App\Traits\ApiResponses;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Posts\Http\Requests\UpdatePostRequest;
use Modules\Posts\Http\Resources\PostResource;
use Modules\Posts\Models\Post;

class UpdatePostResponsable implements Responsable
{
    use ApiResponses;

    public function __construct(private readonly UpdatePostRequest $request, private readonly int $id)
    {
    }

    /**
     * Update post.
     */
    public function update(): Post
    {
        return DB::transaction(function () {
            $post = Post::with('user:id,name')->findOrFail($this->id);
            $post->fill($this->request->validated());
            $post->save();

            return $post;
        });
    }

    /**
     * {@inheritDoc}
     */
    public function toResponse($request): JsonResponse
    {
        return $this->okResponse(new PostResource($this->update()));
    }
}
