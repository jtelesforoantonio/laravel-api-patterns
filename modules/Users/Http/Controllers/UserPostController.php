<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Posts\Http\Resources\PostResource;
use Modules\Users\Repositories\UserPostRepository;

class UserPostController extends Controller
{
    public function __construct(private readonly UserPostRepository $repository)
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(int $id)
    {
        $userPosts = $this->repository->getUserPosts($id);

        return $this->okResponse(PostResource::collection($userPosts));
    }
}
