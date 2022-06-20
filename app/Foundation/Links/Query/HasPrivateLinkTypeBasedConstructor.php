<?php

namespace App\Foundation\Links\Query;

use App\Contracts\Links\LinkType;

trait HasPrivateLinkTypeBasedConstructor
{
    use NormalizesLinkType;

    protected LinkType $type;

    private function __construct(LinkType|string $type)
    {
        $this->type = $this->normalizeLinkTypeModel($type);
    }
}
