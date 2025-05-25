<?php

namespace App\Infra\Controller\Read;

use App\Infra\Controller\Controller;
use App\Infra\Enum\GatesAbilityEnum;
use App\Infra\Request\Enum\RequestQueryParamsEnum;
use App\Infra\Response\Api\ResponseApi;
use App\Infra\Response\Exceptions\ForbiddenException;
use App\Infra\UseCase\Read\IListUseCase;
use Illuminate\Http\JsonResponse;

abstract class BaseListController extends Controller
{
    private const int DEFAULT_PAGE = 1;
    private const int DEFAULT_PER_PAGE = 100;
    private const string DEFAULT_SEARCH = '';
    protected const string DEFAULT_ORDER_BY = 'id';
    protected const string DEFAULT_ORDER_BY_DIRECTION = 'desc';

    abstract protected function getUseCase(): IListUseCase;
    abstract protected function getModelName(): string;

    public function __invoke(): JsonResponse
    {
        ForbiddenException::validatePolicy(GatesAbilityEnum::List, $this->getModelName());
        $list = $this->getUseCase()->execute(
            $this->getPerPage(),
            $this->getPage(),
            $this->getSearch(),
            $this->getOrderBy(),
            $this->getOrderDirection(),
            $this->getQueryParams()
        );
        return ResponseApi::renderOkList($list);
    }

    protected function getPerPage(): int
    {
        return request()->get(RequestQueryParamsEnum::PerPage->value) ?? self::DEFAULT_PER_PAGE;
    }

    public function getPage(): int
    {
        return request()->get(RequestQueryParamsEnum::Page->value) ?? self::DEFAULT_PAGE;
    }

    public function getSearch(): string
    {
        return request()->get(RequestQueryParamsEnum::Search->value) ?? self::DEFAULT_SEARCH;
    }

    public function getOrderBy(): string
    {
        return request()->get(RequestQueryParamsEnum::OrderBy->value) ?? self::DEFAULT_ORDER_BY;
    }

    public function getOrderDirection(): string
    {
        return request()->get(RequestQueryParamsEnum::OrderDirection->value) ?? self::DEFAULT_ORDER_BY_DIRECTION;
    }

    public function getQueryParams(): array
    {
        return request()->query();
    }
}
