<?php

namespace App\Foundation\Links\Query;

use App\Contracts\Links\LinkType;

final class Eliminate
{
    use HasPrivateLinkTypeBasedConstructor;

    public static function the(LinkType|string $type): self
    {
        return new self($type);
    }

    public function link(): EliminateLinks
    {
        return new EliminateLinks($this->type);
    }

    public function group(): EliminateLinkGroup
    {
        return new EliminateLinkGroup($this->type);
    }
}
