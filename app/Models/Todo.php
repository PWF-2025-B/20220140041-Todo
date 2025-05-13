<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
    'title',
    'category_id',
    'is_complete',
    'user_id',
];

    /**
     * Get the category that owns the todo.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
