<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Users\Http\Requests\StoreUserRequest;
use Modules\Users\Http\Requests\UpdateUserRequest;
use Modules\Users\Http\Resources\UserCollection;
use Modules\Users\Http\Resources\UserResource;
use Modules\Users\Repositories\UserRepository as RepositoriesUserRepository;

class UserController extends Controller
{
    public function __construct(public RepositoriesUserRepository $repository)
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->okResponse(new UserCollection($this->repository->paginate()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->repository->store($request);

        return $this->createdResponse(new UserResource($user));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return $this->okResponse(new UserResource($this->repository->findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        return $this->okResponse(new UserResource($this->repository->update($request, $id)));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $this->repository->delete($id);

        return $this->noContentResponse();
    }
}
