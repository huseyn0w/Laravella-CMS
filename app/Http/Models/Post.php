<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Category;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'author_id',
        'status',
        'created_at',
        'likes',
        'dislikes',
        'preview',
        'content'
    ];

    public function author()
    {
        return $this->hasOne('App\Http\Models\User','id', 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
