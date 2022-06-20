<?php

namespace App\Traits;

use App\Contracts\Links\LinkType;
use App\Models\LinkGroupItem;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait Linkable
{
    use NormalizesLinkType;

    /**
     * Returns the models (other linkables) that are linked to this model with
     * the given link type. Since there can be multiple groups of the given
     * type, an optional property id can be passed, to further filter by
     */
    public function links(LinkType|string $type, $propertyId = null): Collection
    {
        $type = $this->normalizeLinkTypeModel($type);

        // @todo Optimize this to a single query
        $result = Collection::make();
        foreach ($this->linkGroups()->filter(fn ($group) => $group->type->id === $type->id) as $group) {
            $result->push(
                ...$group
                ->items
                ->map
                ->linkable
                ->reject(fn ($item) => $item->id === $this->id)
            );
        }

        return $result;
    }

    public function linkGroups(): Collection
    {
        return $this->includedInLinkGroupItems()->get()->transform(fn ($item) => $item->group);
    }

    public function includedInLinkGroupItems(): MorphMany
    {
        return $this->morphMany(LinkGroupItem::class, 'linkable');
    }
}
