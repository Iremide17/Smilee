<?php

namespace App\Traits;

use App\Models\Category;
use App\Models\Level;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasLevels
{
    public function levels()
    {
        return $this->levelsRelation;
    }

    public function syncLevels(array $levels)
    {
        $this->save();
        $this->levelsRelation()->sync($levels);
        $this->unsetRelation('levelsRelation');
    }

    public function removeLevels()
    {
        $this->levelsRelation()->detach();
        $this->unsetRelation('levelsRelation');
    }

    public function levelsRelation(): MorphToMany
    {
        return $this->morphToMany(Level::class, 'levelable')->withTimestamps();
    }
}
