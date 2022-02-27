<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait MultiTenantModelTrait
{
    public static function bootMultiTenantModelTrait()
    {
        if (!app()->runningInConsole() && auth()->check()) {
            $isAdmin = auth()->user()->isAdmin();
            static::creating(function ($model) use ($isAdmin) {
                    // Prevent admin from setting his own id - admin entries are global.

                    // If required, remove the surrounding IF condition and admins will act as users
                if (!$isAdmin) {
                    $model->author_id = auth()->id();
                }
            });
            if (!$isAdmin) {
                static::addGlobalScope('author_id', function (Builder $builder) {
                    $builder->where('author_id', auth()->id())->orWhereNull('author_id');
                });
            }
        }
    }
}
