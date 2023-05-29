<?php

namespace App\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class PriceRangeFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        $priceRange = explode('-', $value);
        $minPrice = $priceRange[0] ?? null;
        $maxPrice = $priceRange[1] ?? null;

        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }

        return $query;
    }
}
