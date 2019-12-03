<?php

namespace App\Observers;

use App\Http\Models\User;

class UserObserver extends LaravellaObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Http\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }



    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Http\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Http\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Http\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Http\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
