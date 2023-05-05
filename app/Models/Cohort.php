<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'places', 'start_date', 'end_date'];

    public function instances()
    {
        return $this->hasMany(Instance::class)->with(['cohort', 'cohort.learners']);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function sessions()
    {
        return $this->belongsToMany(Session::class);
    }

    public function learners()
    {
        return $this->hasMany(Learner::class);
    }
}
