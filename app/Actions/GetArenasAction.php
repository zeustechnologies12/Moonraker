<?php

namespace App\Actions;

use App\Models\Arena;
use Lorisleiva\Actions\Concerns\AsAction;

class GetArenasAction
{
    use AsAction;

    public function handle()
    {
        return Arena::with('location.city')
            ->paginate();
    }
}
