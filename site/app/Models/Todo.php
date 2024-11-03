<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Todo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'completed',
    ];

    /**
     * Get the category that owns the todo.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}