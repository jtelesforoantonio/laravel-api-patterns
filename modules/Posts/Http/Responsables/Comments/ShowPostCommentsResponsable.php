<?php

namespace Modules\Posts\Http\Responsables\Comments;

use App\Traits\ApiResponses;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Modules\Posts\Http\Resources\PostCommentResource;
use Modules\Posts\Models\Comment;
use Modules\Posts\Models\Post;

class ShowPostCommentsResponsable implements Responsable
{
    use ApiResponses;

    public function __construct(private readonly int $id)
    {
    }

    public function show()
    {
        Post::findOrFail($this->id);

        return Comment::with('user:id,name')->where('post_id', $this->id)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function toResponse($request): JsonResponse
    {
        return $this->okResponse(PostCommentResource::collection($this->show()));
    }
}
