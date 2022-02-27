<?php

namespace App\Traits;

use App\Models\Period;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasPeriods
{
    public function periods()
    {
        return $this->periodsRelation;
    }

    public function syncPeriods(array $periods)
    {
        $this->save();
        $this->periodsRelation()->sync($periods);
        $this->unsetRelation('periodsRelation');
    }

    public function removePeriods()
    {
        $this->periodsRelation()->detach();
        $this->unsetRelation('periodsRelation');
    }

    public function periodsRelation(): MorphToMany
    {
        return $this->morphToMany(Period::class, 'periodable')->withTimestamps();
    }
}
