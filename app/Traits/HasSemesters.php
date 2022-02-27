<?php

namespace App\Traits;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasSemesters
{
    public function semesters()
    {
        return $this->semestersRelation;
    }

    public function syncSemesters(array $semesters)
    {
        $this->save();
        $this->semestersRelation()->sync($semesters);
        $this->unsetRelation('semestersRelation');
    }

    public function removeSemesters()
    {
        $this->semestersRelation()->detach();
        $this->unsetRelation('semestersRelation');
    }

    public function semestersRelation(): MorphToMany
    {
        return $this->morphToMany(Semester::class, 'semesterable')->withTimestamps();
    }
}
