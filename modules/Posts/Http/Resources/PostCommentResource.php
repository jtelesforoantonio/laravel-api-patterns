<?php

namespace Modules\Posts\Http\Resources;

use App\Services\HashIdService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => HashIdService::encode($this->id),
            'comment' => $this->comment,
            'author' => $this->user->name,
            'created_at' => $this->created_at,
        ];
    }
}
