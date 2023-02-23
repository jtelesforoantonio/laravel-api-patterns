<?php

namespace Modules\Posts\Http\Responsables\Posts;

use App\Traits\ApiResponses;
use App\Traits\RequestSearchable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Posts\Http\Resources\PostCollection;
use Modules\Posts\Models\Post;

class PaginatePostsResponsable implements Responsable
{
    use ApiResponses, RequestSearchable;

    /**
     * columns to order in pagination.
     *
     * @var string[]
     */
    protected $sortable = ['title'];

    /**
     * Columns to search in pagination.
     *
     * @var string[]
     */
    protected $searchable = ['title'];

    /**
     * Paginate posts.
     */
    public function paginate(): LengthAwarePaginator
    {
        $itemsPerPage = (int) request()->query('items', '15');
        $sortBy = request()->sortBy($this->sortable, 'title');
        $sortDir = request()->sortDir();
        $search = request()->query('search');

        return Post::query()
            ->with('user:id,name')
            ->when($search, fn (Builder $q) => $q->when($this->bindWheres($search)))
            ->orderBy($sortBy, $sortDir)
            ->paginate($itemsPerPage);
    }

    /**
     * {@inheritDoc}
     */
    public function toResponse($request): JsonResponse
    {
        return $this->okResponse(new PostCollection($this->paginate()));
    }
}
