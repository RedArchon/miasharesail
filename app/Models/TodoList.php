<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoList extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    protected $appends = [
        'ago',
        'path'
    ];

    public function items()
    {
        return $this->hasMany(TodoItem::class, 'list_id', 'id');
    }

    public function itemsWithTrashed()
    {
        return $this->hasMany(TodoItem::class, 'list_id', 'id')->withTrashed();
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithTrashedItems($query)
    {
        return $query->items()->withTrashed();
    }

    /**
     * Get the readable created_at attribute.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function ago(): Attribute
    {
        return Attribute::make(
            get: fn() => ($this->created_at)->ago(['parts' => 3])
        );
    }

    /**
     * Get the path to this.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function path(): Attribute
    {
        return new Attribute(fn() => route('todo-list.show', $this));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
