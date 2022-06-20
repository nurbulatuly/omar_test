<?php

namespace App\Traits;

use App\Contracts\Links\LinkType;

trait NormalizesLinkType
{
    private array $linkTypeCache = [];

    private function normalizeLinkTypeModel(LinkType|string $type): LinkType
    {
        $slug = is_string($type) ? $type : $type->slug;

        if (!isset($this->linkTypeCache[$slug])) {
            $this->linkTypeCache[$slug] = is_string($type) ? LinkTypeProxy::findBySlug($type) : $type;
        }

        if (null === $this->linkTypeCache[$slug]) {
            throw new \InvalidArgumentException("There is no link type with `$slug` slug");
        }

        return $this->linkTypeCache[$slug];
    }
}
