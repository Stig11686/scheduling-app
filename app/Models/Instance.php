<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'cohort_id'];

    public function sessions(){

        return $this->belongsToMany(Session::class)->using(InstanceSession::class)->withPivot(['date', 'zoom_room_id', 'trainer_id']);

    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    function cohort(){
        return $this->hasOne(Cohort::class, 'id', 'cohort_id');
    }

}
