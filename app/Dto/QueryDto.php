<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Http\Request;

class QueryDto implements DtoInterface
{
    /**
     * @var string|null
     */
    protected $search;

    /**
     * @var string|null
     */
    protected $orderBy;

    /**
     * @var string
     */
    protected $order;

    /**
     * @var int
     */
    protected $page;

    /**
     * @var int
     */
    protected $perPage;

    /**
     * QueryDto constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $order = strtolower($request->get('order', ''));

        $this->search = $request->get('search');
        $this->orderBy = $request->get('order-by');
        $this->order = $order === 'asc' || $order === 'desc' ? $order : 'desc';
        $this->page = $request->get('page', 1);
        $this->perPage = $request->get('per-page', config('per-page', 10));
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'search' => $this->getSearch(),
            'order-by' => $this->getOrderBy(),
            'order' => $this->getOrder(),
            'page' => $this->getPage(),
            'per-page' => $this->getPerPage(),
        ];
    }

    /**
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * @param string|null $search
     * @return QueryDto
     */
    public function setSearch(?string $search): QueryDto
    {
        $this->search = $search;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    /**
     * @param string|null $orderBy
     * @return QueryDto
     */
    public function setOrderBy(?string $orderBy): QueryDto
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrder(): ?string
    {
        return $this->order;
    }

    /**
     * @param string|null $order
     * @return QueryDto
     */
    public function setOrder(?string $order): QueryDto
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * @param int|null $page
     * @return QueryDto
     */
    public function setPage(?int $page): QueryDto
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param int|null $perPage
     * @return QueryDto
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }


}
