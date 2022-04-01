<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function list()
    {
        return $this->belongsTo(TodoList::class);
    }
}
