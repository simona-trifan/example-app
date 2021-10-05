<?php

namespace App\Services;

use App\Dto\QueryDto;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Jenssegers\Mongodb\Eloquent\Builder;

class LogsService
{
    /**
     * @var string[]
     */
    protected $sortable = [
        'created_at',
        'user_agent',
        'ip',
        'url'
    ];

    /**
     * @param Request $request
     * @return Logs
     */
    public function create(Request $request): Logs
    {
        return Logs::create([
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url' => $request->url(),
        ]);
    }

    /**
     * @param Request $request
     * @return Logs[]|LengthAwarePaginator
     */
    public function getLogs(Request $request): LengthAwarePaginator
    {
        $dto = new QueryDto($request);

        $builder = Logs::query();

        $this->search($builder, $dto);

        $this->sort($builder, $dto);

        return $builder->paginate((int) $dto->getPerPage());
    }

    /**
     * @param Builder $builder
     * @param QueryDto $dto
     */
    protected function search(Builder $builder, QueryDto $dto): void
    {
        $search = $dto->getSearch();
        if (!$search) {
            return;
        }

        $builder->where(function ($builder) use ($search) {
            $builder->where('ip', 'like', "%$search%")
                ->orWhere('user_agent', 'like', "%$search%")
                ->orWhere('url', 'like', "%$search%");
        });
    }

    /**
     * @param Builder $builder
     * @param QueryDto $dto
     */
    protected function sort(Builder $builder, QueryDto $dto): void
    {
        $orderBy = $dto->getOrderBy();
        if (!$orderBy || !in_array($orderBy, $this->sortable)) {
            $orderBy = 'created_at';
        }

        $order = $dto->getOrder();

        $builder->orderBy($orderBy, $order);
    }
}
