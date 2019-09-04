<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'parent_category',
        'description'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
