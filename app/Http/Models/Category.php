<?php

namespace App\Http\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Cachable;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
        'parent_category',
        'description'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class,'category_post')->with('comments');
    }
}
