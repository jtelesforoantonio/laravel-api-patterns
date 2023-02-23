<?php

namespace Modules\Users\Repositories;

use Modules\Posts\Models\Post;
use Modules\Users\Traits\CallMethod;

class UserPostRepository
{
    use CallMethod;

    public function __construct(private readonly Post $model)
    {
    }

    /**
     * User's posts.
     */
    public function getUserPosts(int $userId)
    {
        return $this->model->with('user:id,name')->where('user_id', $userId)->get();
    }
}
