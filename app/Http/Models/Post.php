<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'author_id',
        'status',
        'created_at',
        'likes',
        'dislikes',
        'preview',
        'content',
        'thumbnail',
        'custom_fields'
    ];

    public function author()
    {
        return $this->hasOne('App\Http\Models\User','id', 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_post');
    }
}
