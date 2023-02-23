<?php

namespace Modules\Posts\Http\Resources;

use App\Services\HashIdService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'name' => $this->title,
            'content' => $this->post,
            'author' => $this->when(! $request->routeIs('api.users.posts'), $this->user->name),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
