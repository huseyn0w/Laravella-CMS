<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'posts_comments';

    protected $fillable = ['user_id', 'post_id', 'parent_id', 'comment', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comments::class, 'parent_id')->with('user');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($comment) {
            $comment->replies()->delete();
        });
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }


}
