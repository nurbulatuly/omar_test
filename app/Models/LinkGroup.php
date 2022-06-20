<?php

namespace App\Models;

use App\Contracts\Links\LinkGroup as LinkGroupContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LinkGroup extends Model implements LinkGroupContract
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'property_id' => 'integer',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(LinkType::class, 'link_type_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(LinkGroup::class, 'link_group_id', 'id');
    }
}
