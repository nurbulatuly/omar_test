<?php

namespace App\Foundation\Search;


use App\Contracts\Categorization\Taxon;
use App\Models\Product;
use App\Models\PropertyValue;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProductFinder
{
    private Builder $queryBuilder;

    public function __construct()
    {
        $this->queryBuilder = Product::query()
            ->withGlobalScope('withoutInactiveProducts', function (Builder $queryBuilder) {
                return $queryBuilder->whereIn('state', ['active']);
            });
    }

    public function withinTaxon(Taxon $taxon): self
    {
        $this->queryBuilder->whereHas('taxons', function ($query) use ($taxon) {
            $query->where('id', $taxon->id);
        });

        return $this;
    }

    public function orWithinTaxon(Taxon $taxon): self
    {
        $this->queryBuilder->orWhereHas('taxons', function ($query) use ($taxon) {
            $query->where('id', $taxon->id);
        });

        return $this;
    }

    public function withinTaxons(array $taxons): self
    {
        $taxonIds = collect($taxons)->pluck('id');

        $this->queryBuilder->whereHas('taxons', function ($query) use ($taxonIds) {
            $query->whereIn('id', $taxonIds);
        });

        return $this;
    }

    public function orWithinTaxons(array $taxons): self
    {
        $taxonIds = collect($taxons)->pluck('id');

        $this->queryBuilder->orWhereHas('taxons', function ($query) use ($taxonIds) {
            $query->whereIn('id', $taxonIds);
        });

        return $this;
    }

    public function nameContains(string $term): self
    {
        $this->queryBuilder->where('name', 'like', "%$term%");

        return $this;
    }

    public function orNameContains(string $term): self
    {
        $this->queryBuilder->orWhere('name', 'like', "%$term%");

        return $this;
    }

    public function nameStartsWith(string $term): self
    {
        $this->queryBuilder->where('name', 'like', "$term%");

        return $this;
    }

    public function orNameStartsWith(string $term): self
    {
        $this->queryBuilder->orWhere('name', 'like', "$term%");

        return $this;
    }

    public function nameEndsWith(string $term): self
    {
        $this->queryBuilder->where('name', 'like', "%$term");

        return $this;
    }

    public function orNameEndsWith(string $term): self
    {
        $this->queryBuilder->orWhere('name', 'like', "%$term");

        return $this;
    }

    public function havingPropertyValue(PropertyValue $propertyValue): self
    {
        $this->queryBuilder->whereHas('propertyValues', function ($query) use ($propertyValue) {
            $query->where('id', $propertyValue->id);
        });

        return $this;
    }

    public function orHavingPropertyValue(PropertyValue $propertyValue): self
    {
        $this->queryBuilder->orWhereHas('propertyValues', function ($query) use ($propertyValue) {
            $query->where('id', $propertyValue->id);
        });

        return $this;
    }

    public function havingPropertyValues(array $propertyValues): self
    {
        $propertyValueIds = collect($propertyValues)->pluck('id');

        $this->queryBuilder->whereHas('propertyValues', function ($query) use ($propertyValueIds) {
            $query->whereIn('id', $propertyValueIds);
        });

        return $this;
    }

    public function havingPropertyValuesByName(string $property, array $values): self
    {
        return $this->havingPropertyValues(
            PropertyValue::query()
                ->select('property_values.*')
                ->join('properties', 'properties.id', '=', 'property_values.property_id')
                ->where('properties.slug', '=', $property)
                ->whereIn('value', $values)
                ->get()
                ->all()
        );
    }

    public function orHavingPropertyValues(array $propertyValues): self
    {
        $propertyValueIds = collect($propertyValues)->pluck('id');

        $this->queryBuilder->orWhereHas('propertyValues', function ($query) use ($propertyValueIds) {
            $query->whereIn('id', $propertyValueIds);
        });

        return $this;
    }

    public function withInactiveProducts(): self
    {
        $this->queryBuilder->withoutGlobalScope('withoutInactiveProducts');

        return $this;
    }

    public function getResults(): Collection
    {
        return $this->queryBuilder->get();
    }

    /** @see Builder::simplePaginate() */
    public function simplePaginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int $page = null): Paginator
    {
        return $this->queryBuilder->simplePaginate($perPage, $columns, $pageName, $page);
    }

    /** @see Builder::paginate() */
    public function paginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int $page = null): LengthAwarePaginator
    {
        return $this->queryBuilder->paginate($perPage, $columns, $pageName, $page);
    }

    public function getQueryBuilder(): Builder
    {
        return $this->queryBuilder;
    }
}
