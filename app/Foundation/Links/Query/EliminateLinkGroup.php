<?php

namespace App\Foundation\Links\Query;

use App\Contracts\Links\LinkType;
use App\Models\LinkGroup;
use Illuminate\Database\Eloquent\Model;

class EliminateLinkGroup
{
    use FindsDesiredLinkGroups;

    public function __construct(
        private LinkType $type
    ) {
    }

    public function of(Model $model): void
    {
        LinkGroup::destroy($this->linkGroupsOfModel($model)->map->id);
    }
}
