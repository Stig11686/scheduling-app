<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use SpatiePermissionVue\Traits\RolesPermissionsToVue;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, RolesPermissionsToVue;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $primaryKey = 'id';

    public function trainer(){
        return $this->hasOne(Trainer::class);
    }

    public function getSessions(){
        //trainer sessions
        //TODO - Implement learner functionality and return their sessions too!
        return DB::table('instance_session')
        ->join('instances', 'instances.id', '=', 'instance_session.instance_id')
        ->join('sessions', 'sessions.id', '=', 'instance_session.session_id')
        ->join('courses', 'courses.id', '=', 'instances.course_id')
        ->join('cohorts', 'cohorts.id', '=', 'instance_session.cohort_id')
        ->join('zoom_rooms', 'zoom_rooms.id', '=', 'instance_session.zoom_room_id')
        ->select('date as date', 'sessions.name as sessionTitle', 'sessions.slides as sessionSlides', 'sessions.trainer_notes as sessionNotes', 'courses.name as courseName', 'cohorts.name as cohortName', 'zoom_rooms.link as zoom')
        ->where('trainer_id', $this->id)
        ->orderBy('date', 'asc')
        ->get();
    }

    public function get_next_session(){
        return DB::table('instance_session')
                ->selectRaw('courses.name as courseName,
                    sessions.name as sessionTitle,
                    sessions.slides as sessionSlides,
                    sessions.trainer_notes as trainerNotes,
                    date as date,
                    cohorts.name as cohortName,
                    zoom_rooms.link as zoom')
                    ->join('instances', 'instances.id', '=', 'instance_session.instance_id')
                    ->join('courses', 'courses.id', '=', 'instances.course_id')
                    ->join('cohorts', 'cohorts.id', '=', 'instances.cohort_id')
                    ->join('sessions', 'sessions.id', '=', 'instance_session.session_id')
                    ->join('trainers', 'trainers.id', '=', 'instance_session.trainer_id')
                    ->join('zoom_rooms', 'zoom_rooms.id', '=', 'instance_session.zoom_room_id')
                    ->where('trainer_id', $this->id)
                    ->orderBy('date', 'asc')
                    ->limit(1)
                    ->get();
    }

    public function seven_days_sessions(){
        $today = Carbon::today();
        $next_week = Carbon::today()->addDays(7);

        return DB::table('instance_session')
        ->selectRaw('courses.name as courseName,
            sessions.name as sessionTitle,
            sessions.slides as sessionSlides,
            sessions.trainer_notes as trainerNotes,
            users.name as trainer,
            date as date,
            cohorts.name as cohortName,
            zoom_rooms.link as zoom')
            ->join('instances', 'instances.id', '=', 'instance_session.instance_id')
            ->join('courses', 'courses.id', '=', 'instances.course_id')
            ->join('cohorts', 'cohorts.id', '=', 'instances.cohort_id')
            ->join('sessions', 'sessions.id', '=', 'instance_session.session_id')
            ->join('trainers', 'trainers.id', '=', 'instance_session.trainer_id')
            ->join('users', 'users.id', '=', 'trainers.user_id')
            ->join('zoom_rooms', 'zoom_rooms.id', '=', 'instance_session.zoom_room_id')
            ->whereBetween('date', [$today, $next_week])
            ->orderBy('date', 'asc')
            ->get();
    }

}
