<?php

namespace Modules\Posts\Http\Responsables\Posts;

use App\Traits\ApiResponses;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Posts\Http\Requests\StorePostRequest;
use Modules\Posts\Http\Resources\PostResource;
use Modules\Posts\Models\Post;

class StorePostResponsable implements Responsable
{
    use ApiResponses;

    public function __construct(private readonly StorePostRequest $request)
    {
    }

    /**
     * Store post.
     */
    public function store(): Post
    {
        return DB::transaction(function () {
            $post = new Post();
            $post->title = $this->request->title;
            $post->post = $this->request->post;
            $post->user_id = $this->request->user_id;
            $post->save();

            return $post->load('user:id,name');
        });
    }

    /**
     * {@inheritDoc}
     */
    public function toResponse($request): JsonResponse
    {
        return $this->createdResponse(new PostResource($this->store()));
    }
}
