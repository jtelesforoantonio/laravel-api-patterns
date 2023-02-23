<?php

namespace Modules\Posts\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Posts\Http\Requests\StorePostCommentRequest;
use Modules\Posts\Http\Responsables\Comments\ShowPostCommentsResponsable;
use Modules\Posts\Http\Responsables\Comments\StorePostCommentResponsable;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(int $id): ShowPostCommentsResponsable
    {
        return new ShowPostCommentsResponsable($id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostCommentRequest $request): StorePostCommentResponsable
    {
        return new StorePostCommentResponsable($request);
    }
}
