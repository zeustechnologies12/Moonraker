<?php

namespace App\Actions;

use App\Models\Arena;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class GetArenasAction
{
    use AsAction;

    public function handle(Request $request)
    {
        $arenas = QueryBuilder::for(Arena::class)
            ->with('location.city')
            ->allowedFilters([
                AllowedFilter::operator('price', FilterOperator::DYNAMIC),
                AllowedFilter::partial('name'),
                AllowedFilter::partial('location.name'),
                AllowedFilter::partial('location.city.name'),

            ]);

        return $arenas->paginate();
    }

    public function userArenas(Request $request)
    {
        $arenas = QueryBuilder::for(Arena::class)
            ->with('location.city')
            ->allowedFilters([
                AllowedFilter::exact('users.id'),
            ]);

        return $arenas->paginate();
    }
}
