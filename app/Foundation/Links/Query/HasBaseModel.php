<?php

namespace App\Foundation\Links\Query;

use Illuminate\Database\Eloquent\Model;

trait HasBaseModel
{
    private Model $baseModel;

    public function between(Model $model): self
    {
        $this->baseModel = $model;

        return $this;
    }
}
