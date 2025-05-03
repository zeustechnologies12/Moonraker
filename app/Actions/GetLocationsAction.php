<?php

namespace App\Actions;

use App\Models\Location;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetLocationsAction
{
    use AsAction;

    public function handle()
    {
        $locations = QueryBuilder::for(Location::class)
            ->with('city')
            ->allowedFilters([
                AllowedFilter::partial('city.name')
            ]);
        return $locations->paginate();
    }
}
