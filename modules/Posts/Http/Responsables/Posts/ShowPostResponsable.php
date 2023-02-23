<?php

namespace Modules\Posts\Http\Responsables\Posts;

use App\Traits\ApiResponses;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Modules\Posts\Http\Resources\PostResource;
use Modules\Posts\Models\Post;

class ShowPostResponsable implements Responsable
{
    use ApiResponses;

    public function __construct(private readonly int $id)
    {
    }

    /*
     * Show post.
     */
    public function show(): Post
    {
        return Post::with('user:id,name')->findOrFail($this->id);
    }

    /**
     * {@inheritDoc}
     */
    public function toResponse($request): JsonResponse
    {
        return $this->okResponse(new PostResource($this->show()));
    }
}
