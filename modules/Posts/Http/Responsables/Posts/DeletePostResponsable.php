<?php

namespace Modules\Posts\Http\Responsables\Posts;

use App\Traits\ApiResponses;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Posts\Models\Post;

class DeletePostResponsable implements Responsable
{
    use ApiResponses;

    public function __construct(private readonly int $id)
    {
    }

    /**
     * Delete post.
     */
    public function delete()
    {
        DB::transaction(function () {
            $post = Post::findOrFail($this->id);
            $post->delete();
        });
    }

    /**
     *{@inheritDoc}
     */
    public function toResponse($request): JsonResponse
    {
        $this->delete();

        return $this->noContentResponse();
    }
}
