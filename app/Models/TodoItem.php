<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $appends = ['owner_id'];

    public function list(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TodoList::class);
    }

    /**
     * Get the readable created_at attribute.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function ownerId(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->list()->first()->user()->first()->id
        );
    }
}
