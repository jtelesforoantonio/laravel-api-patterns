<?php

namespace Modules\Posts\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Posts\Http\Requests\StorePostRequest;
use Modules\Posts\Http\Requests\UpdatePostRequest;
use Modules\Posts\Http\Responsables\Posts\DeletePostResponsable;
use Modules\Posts\Http\Responsables\Posts\PaginatePostsResponsable;
use Modules\Posts\Http\Responsables\Posts\ShowPostResponsable;
use Modules\Posts\Http\Responsables\Posts\StorePostResponsable;
use Modules\Posts\Http\Responsables\Posts\UpdatePostResponsable;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): PaginatePostsResponsable
    {
        return new PaginatePostsResponsable();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): StorePostResponsable
    {
        return new StorePostResponsable($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): ShowPostResponsable
    {
        return new ShowPostResponsable($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, int $id): UpdatePostResponsable
    {
        return new UpdatePostResponsable($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): DeletePostResponsable
    {
        return new DeletePostResponsable($id);
    }
}
