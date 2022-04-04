<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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

    protected $with = ['items'];

    public function scopeByUserType($query)
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $query->withTrashed();
        } else {
            $query->where('user_id', $user->id);
        }
    }

    public function items()
    {
        return $this->hasMany(TodoItem::class, 'list_id', 'id');
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
