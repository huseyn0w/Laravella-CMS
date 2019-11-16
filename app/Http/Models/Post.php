<?php

namespace App\Http\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use Cachable;

    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'author_id',
        'status',
        'created_at',
        'likes',
        'preview',
        'content',
        'thumbnail',
    ];

    public function author()
    {
        return $this->hasOne('App\Http\Models\User','id', 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_post');
    }


    public function likes()
    {
        return $this->belongsTo(Likes::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class)->whereNull('parent_id')->where('status', 1)->with('user')->with('replies');
    }

    public function allComments()
    {
        return $this->hasMany(Comments::class)->where('status', 1);
    }


}
