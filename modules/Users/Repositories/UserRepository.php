<?php

namespace Modules\Users\Repositories;

use App\Models\User;
use App\Traits\RequestSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Modules\Users\Http\Requests\StoreUserRequest;
use Modules\Users\Http\Requests\UpdateUserRequest;
use Modules\Users\Traits\CallMethod;

class UserRepository
{
    use CallMethod, RequestSearchable;

    /**
     * columns to order in pagination.
     *
     * @var array<int, string>
     */
    protected array $sortable = ['name'];

    /**
     * Columns to search in pagination.
     *
     * @var array<int, string>
     */
    protected array $searchable = ['name'];

    public function __construct(private readonly User $model)
    {
    }

    /**
     * Paginate users.
     */
    public function paginate(): LengthAwarePaginator
    {
        $itemsPerPage = (int) request()->query('items', '15');
        $sortBy = request()->sortBy($this->sortable, 'name');
        $sortDir = request()->sortDir();
        $search = request()->query('search');

        return $this->model->query()
            ->when($search, fn (Builder $q) => $q->where($this->bindWheres($search)))
            ->orderBy($sortBy, $sortDir)
            ->paginate($itemsPerPage);
    }

    /**
     * Store user.
     */
    public function store(StoreUserRequest $request): User
    {
        return DB::transaction(function () use ($request) {
            return $this->model->create($request->validated());
        });
    }

    /**
     * Update user.
     */
    public function update(UpdateUserRequest $request, int $id): User
    {
        return DB::transaction(function () use ($request, $id) {
            $user = $this->model->findOrFail($id);
            $user->fill($request->validated());
            $user->save();

            return $user;
        });
    }

    /**
     * Delete user.
     */
    public function delete(int $id): void
    {
        DB::transaction(function () use ($id) {
            $user = $this->model->findOrFail($id);
            $user->delete();
        });
    }
}
