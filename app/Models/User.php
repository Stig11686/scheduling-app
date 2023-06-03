<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use SpatiePermissionVue\Traits\RolesPermissionsToVue;
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

    public function learner(){
        return $this->hasOne(Learner::class);
    }

    // public function sessions()
    // {
    //     if ($this->isTrainer()) {
    //         // return all sessions assigned to the trainer
    //         return $this->hasMany(CohortSession::class, 'trainer_id');
    //     } elseif ($this->isLearner()) {
    //         // return all sessions in the learner's cohort
    //         return $this->cohort->sessions();
    //     }
    //     // if the user is not a trainer or learner, return an empty relationship
    //     return $this->hasMany(CohortSession::class)->where('id', '=', null);
    // }

    // public function getSessions(){
    //     //trainer sessions
    //     //TODO - Implement learner functionality and return their sessions too!
    //     return DB::table('cohort_session')
    //     ->join('instances', 'instances.id', '=', 'instance_session.instance_id')
    //     ->join('sessions', 'sessions.id', '=', 'instance_session.session_id')
    //     ->join('courses', 'courses.id', '=', 'instances.course_id')
    //     ->join('cohorts', 'cohorts.id', '=', 'instance_session.cohort_id')
    //     ->join('zoom_rooms', 'zoom_rooms.id', '=', 'instance_session.zoom_room_id')
    //     ->select('date as date', 'sessions.name as sessionTitle', 'sessions.slides as sessionSlides', 'sessions.trainer_notes as sessionNotes', 'courses.name as courseName', 'cohorts.name as cohortName', 'zoom_rooms.link as zoom')
    //     ->where('trainer_id', $this->id)
    //     ->orderBy('date', 'asc')
    //     ->get();
    // }

    public function get_next_session(){
        $now = Carbon::now();
        $sessions = collect();

        // If the user is a learner
        if ($this->hasRole('learner')) {
            $learner = $this->learner;

            if ($learner) {
                // Get the cohort ID for the learner
                $cohortId = $learner->cohort_id;

                // Get all the sessions for the cohort
                $sessions = CohortSession::where('cohort_id', $cohortId)
                ->where('date', '>=', $now)
                ->with([
                    'session' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'trainer.user' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'zoom_room' => function ($query) {
                        $query->select('id', 'link');
                    }
                ])
                ->orderBy('date')
                ->first();

            if ($sessions) {
                $sessions = [
                    'date' => $sessions->date,
                    'trainer_name' => $sessions->trainer->name,
                    'session_name' => $sessions->session->name,
                    'zoom_link' => $sessions->zoom_room->link
                ];
            }
            }
        }

        // If the user is a teacher
        if ($this->hasRole('teacher')) {
            $teacher = $this->teacher;

            if ($teacher) {
                // Get all the sessions for the teacher
                $sessions = CohortSession::where('trainer_id', $teacher->id)
                    ->where('date', '>=', $now)
                    ->orderBy('date')
                    ->get();
            }
        }

        return [$sessions];
    }

    public function upcomingSessions()
    {
        $now = Carbon::now();
        $startDate = Carbon::now()->startOfDay();
        $endDate = Carbon::now()->addDays(7)->endOfDay();

        // Check if the user is a trainer or learner
        if ($this->hasRole('trainer')) {
            // If the user is a trainer, find the upcoming session they are assigned to
            return CohortSession::where('trainer_id', $this->trainer->id)
                ->where('date', '>', $now)
                ->orderBy('date', 'asc')
                ->get();
        } elseif ($this->hasRole('learner')) {
            // If the user is a learner, find the upcoming session for their cohort
            $cohort = $this->learner->cohort;
            if (!$cohort) {
                return null;
            }

            return $cohort->sessions()
                ->where('date', '>', $now)
                ->orderBy('date', 'asc')
                ->get();
        }

        return CohortSession::select('cohort_session.date', 'sessions.name as session title', 'users.name as trainer name', 'zoom_rooms.link as zoom link', 'cohorts.name as cohort name', 'courses.name as course name')
        ->join('sessions', 'cohort_session.session_id', '=', 'sessions.id')
        ->join('users', 'cohort_session.trainer_id', '=', 'users.id')
        ->join('zoom_rooms', 'cohort_session.zoom_room_id', '=', 'zoom_rooms.id')
        ->join('cohorts', 'cohort_session.cohort_id', '=', 'cohorts.id')
        ->join('courses', 'cohorts.course_id', '=', 'courses.id')
        ->whereBetween('cohort_session.date', [$startDate, $endDate])
        ->orderBy('cohort_session.date', 'ASC')
        ->get();
    }


}
