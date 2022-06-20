<?php

namespace App\Models;

use App\Contracts\Links\LinkGroupItem as LinkGroupItemContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class LinkGroupItem extends Model implements LinkGroupItemContract
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(LinkGroup::class, 'link_group_id');
    }

    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }
}
