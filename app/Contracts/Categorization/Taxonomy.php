<?php

namespace App\Contracts\Categorization;

use Illuminate\Support\Collection;

interface Taxonomy
{
    /**
     * Returns a taxonomy based on its name
     *
     * @param string $name
     *
     * @return Taxonomy|null
     */
    public static function findOneByName(string $name): ?Taxonomy;

    /**
     * Returns the root level taxons for the taxonomy
     *
     * @return Collection
     */
    public function rootLevelTaxons(): Collection;
}
