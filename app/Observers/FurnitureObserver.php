<?php

namespace App\Observers;

use App\Models\Furniture;
use Illuminate\Support\Str;

class FurnitureObserver
{
    /**
     * Handle the Furniture "created" event.
     *
     * @param  \App\Models\Furniture  $furniture
     * @return void
     */
    public function created(Furniture $furniture)
    {
        $furniture->slug = Str::slug($furniture->title. now()->timestamp);
        $furniture->save();
    }

    /**
     * Handle the Furniture "updated" event.
     *
     * @param  \App\Models\Furniture  $furniture
     * @return void
     */
    public function updated(Furniture $furniture)
    {
        //
    }

    /**
     * Handle the Furniture "deleted" event.
     *
     * @param  \App\Models\Furniture  $furniture
     * @return void
     */
    public function deleted(Furniture $furniture)
    {
        //
    }

    /**
     * Handle the Furniture "restored" event.
     *
     * @param  \App\Models\Furniture  $furniture
     * @return void
     */
    public function restored(Furniture $furniture)
    {
        //
    }

    /**
     * Handle the Furniture "force deleted" event.
     *
     * @param  \App\Models\Furniture  $furniture
     * @return void
     */
    public function forceDeleted(Furniture $furniture)
    {
        //
    }
}
