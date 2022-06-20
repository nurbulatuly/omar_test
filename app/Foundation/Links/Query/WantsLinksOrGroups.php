<?php

namespace App\Foundation\Links\Query;

trait WantsLinksOrGroups
{
    private string $wants = 'links';

    public function links(): self
    {
        $this->wants = 'links';

        return $this;
    }

    public function groups(): self
    {
        $this->wants = 'groups';

        return $this;
    }
}
