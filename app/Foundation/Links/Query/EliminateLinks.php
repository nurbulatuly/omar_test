<?php

namespace App\Foundation\Links\Query;

final class EliminateLinks
{
    use HasBaseModel;
    use FindsDesiredLinkGroups;

    public function __construct(
        private LinkType $type
    ) {
    }

    public function and(Model ...$models): void
    {
        $toRemove = collect($models);
        /** @var LinkGroup $group */
        foreach ($this->linkGroupsOfModel($this->baseModel) as $group) {
            $itemsToDelete = $group
                ->items
                ->filter(fn ($item) => $toRemove->contains(function ($modelToRemove) use ($item) {
                    return $modelToRemove->id == $item->linkable_id &&
                        $modelToRemove::class === $item->linkable_type;
                }));
            LinkGroupItemProxy::destroy($itemsToDelete->map->id);
        }
    }
}
