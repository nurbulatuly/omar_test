<?php

namespace App\Traits;

use App\Models\Taxon;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTaxons
{
    public function taxons(): MorphToMany
    {
        return $this->morphToMany(
            Taxon::modelClass(),
            'model',
            'model_taxons',
            'model_id',
            'taxon_id'
        );
    }

    public function addTaxon(Taxon $taxon): void
    {
        $this->taxons()->attach($taxon);
    }

    public function addTaxons(iterable $taxons)
    {
        foreach ($taxons as $taxon) {
            if (! $taxon instanceof Taxon) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Every element passed to addTaxons must be a Taxon object. Given `%s`.',
                        is_object($taxon) ? get_class($taxon) : gettype($taxon)
                    )
                );
            }
        }

        return $this->taxons()->saveMany($taxons);
    }

    public function removeTaxon(Taxon $taxon)
    {
        return $this->taxons()->detach($taxon);
    }
}
