<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class HateoasDto implements DtoInterface
{
    /**
     * @var array
     */
    protected $items;

    /**
     * @var string[]
     */
    protected $links;

    /**
     * @var array
     */
    protected $pagination;

    public function __construct(LengthAwarePaginator $paginator)
    {
        $this->items = $paginator->items();

        $this->links = [
            'self' => url()->current(),
            'next' => $paginator->nextPageUrl(),
            'prev' => $paginator->previousPageUrl(),
        ];

        $this->pagination = [
            'current_page' => $paginator->currentPage(),
            'total' => $paginator->total(),
            'per_page' => $paginator->perPage(),
        ];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'items' => $this->items,
            'pagination' => $this->pagination,
            '_links' => $this->links
        ];
    }
}
