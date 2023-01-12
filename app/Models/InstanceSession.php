<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;

class InstanceSession extends Pivot
{
    use HasFactory;

//     SELECT courses.name AS 'Course Name',
// 		sessions.name AS 'Session Title',
//         date AS 'Date',
//         trainers.name AS 'Lead Trainer Name',
//         zoom_rooms.link AS 'Zoom Link'
// FROM `instance_session`
// JOIN instances
// ON instances.id = instance_session.instance_id
// JOIN courses
// ON courses.id = instances.course_id
// JOIN sessions
// ON sessions.id = instance_session.session_id
// JOIN trainers
// ON trainers.id = instance_session.trainer_id
// JOIN zoom_rooms
// ON zoom_rooms.id = instance_session.zoom_room_id

    protected $table = 'instance_session';

    protected $fillable = ['instance_id', 'session_id', 'date', 'trainer_id', 'zoom_room_id', 'cohort_id' ];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function session(){
        return $this->belongsTo(Session::class);
    }

    public function zoomRoom(){
        return $this->belongsTo(ZoomRoom::class);
    }

    public function trainer(){
        return $this->hasOne(Trainer::class);
    }
}
