<?php

namespace App\Observers;

use App\Http\Models\Category;
use App\Http\Models\Post;

class PostObserver extends LaravellaObserver
{

    /**
     * Handle the post "creating" event.
     *
     * @param  \App\Http\Models\Post $post
     * @return void
     */
    public function creating(Post $post)
    {
        $post->preview = clean($this->request->preview);
        $post->content = clean($this->request->content);

    }

    /**
     * Handle the post "created" event.
     *
     * @param  \App\Http\Models\Post $post
     * @return void
     */
    public function created(Post $post)
    {
        $this->attachCategory($post);
    }


    /**
     * Handle the post "saving" event.
     *
     * @param  \App\Http\Models\Post  $post
     * @return void
     */
    public function saving(Post $post)
    {
        $post->preview = clean($this->request->preview);
        $post->content = clean($this->request->content);
    }

    /**
     * Handle the post "saved" event.
     *
     * @param  \App\Http\Models\Post  $post
     * @return void
     */
    public function saved(Post $post)
    {
        $this->dettachCategory($post);
        $this->attachCategory($post);
    }


    /**
     * Handle the post "force deleted" event.
     *
     * @param  \App\Http\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        $this->dettachCategory($post);
    }

    private function attachCategory(Post $post)
    {
        $categories_list = $this->request->category;
        $category = Category::find($categories_list);
        $post->categories()->attach($category);
    }

    private function dettachCategory(Post $post)
    {
//        dd('salam');
        $post->categories()->detach();
    }

}
