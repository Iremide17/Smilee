<?php

namespace App\Traits;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasCategories
{
    public function categories()
    {
        return $this->categoriesRelation;
    }

    public function syncCategories(array $categories)
    {
        $this->save();
        $this->categoriesRelation()->sync($categories);
        $this->unsetRelation('categoriesRelation');
    }

    public function removeCategories()
    {
        $this->categoriesRelation()->detach();
        $this->unsetRelation('categoriesRelation');
    }

    public function categoriesRelation(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categoriable')->withTimestamps();
    }
}
