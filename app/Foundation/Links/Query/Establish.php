<?php

namespace App\Foundation\Links\Query;

final class Establish
{
    use HasPrivateLinkTypeBasedConstructor;
    use FindsDesiredLinkGroups;
    use HasBaseModel;

    private string $wants = 'link';

    public static function a(LinkType|string $type): self
    {
        return new self($type);
    }

    public static function an(LinkType|string $type): self
    {
        return self::a($type);
    }

    public function link(): self
    {
        $this->wants = 'link';

        return $this;
    }

    public function group(): self
    {
        $this->wants = 'group';

        return $this;
    }

    public function and(Model ...$models): void
    {
        $groups = $this->linkGroupsOfModel($this->baseModel);
        $destinationGroup = $groups->first();
        if (null === $destinationGroup) {
            $destinationGroup = $this->createNewLinkGroup();
            LinkGroupItemProxy::create([
                'link_group_id' => $destinationGroup->id,
                'linkable_id' => $this->baseModel->id,
                'linkable_type' => $this->baseModel::class,
            ]);
        }

        foreach ($models as $model) {
            LinkGroupItemProxy::create([
                'link_group_id' => $destinationGroup->id,
                'linkable_id' => $model->id,
                'linkable_type' => $model::class,
            ]);
        }
    }

    private function createNewLinkGroup(): LinkGroup
    {
        return LinkGroupProxy::create([
            'link_type_id' => $this->type->id,
            'property_id' => $this->hasPropertyFilter() ? $this->propertyId() : null,
        ])->fresh();
    }
}
