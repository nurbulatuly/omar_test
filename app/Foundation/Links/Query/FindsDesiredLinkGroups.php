<?php

namespace App\Foundation\Links\Query;

trait FindsDesiredLinkGroups
{
    use HasPropertyFilter;

    protected function linkGroupsOfModel(Model $model): Collection
    {
        $groups = $model
            ->morphMany(LinkGroupItemProxy::modelClass(), 'linkable')
            ->get()
            ->transform(fn ($item) => $item->group)
            ->filter(fn ($group) => $group?->type->id === $this->type->id);

        if ($this->hasPropertyFilter()) {
            $groups = $groups->filter(fn ($group) => $group->property_id == $this->propertyId());
        }

        return $groups;
    }
}
