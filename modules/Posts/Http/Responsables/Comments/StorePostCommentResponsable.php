<?php

namespace Modules\Posts\Http\Responsables\Comments;

use App\Traits\ApiResponses;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Posts\Http\Requests\StorePostCommentRequest;
use Modules\Posts\Http\Resources\PostCommentResource;
use Modules\Posts\Models\Comment;

class StorePostCommentResponsable implements Responsable
{
    use ApiResponses;

    public function __construct(private readonly StorePostCommentRequest $request)
    {
    }

    /**
     * Store post comment.
     */
    public function store(): Comment
    {
        return DB::transaction(function () {
            $comment = new Comment();
            $comment->post_id = $this->request->post_id;
            $comment->user_id = $this->request->user_id;
            $comment->comment = $this->request->comment;
            $comment->save();

            return $comment->load('user:id,name');
        });
    }

    /**
     * {@inheritDoc}
     */
    public function toResponse($request): JsonResponse
    {
        return $this->okResponse(new PostCommentResource($this->store()));
    }
}
