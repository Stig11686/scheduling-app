<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CohortSession;
use App\Models\Cohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\InstanceSessionController;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(Request $request){
        // Get the authenticated user
        $user = Auth::user();

        if ($user->hasRole('trainer')) {
            $trainerSessions = DB::table('instance_session')
                ->where('trainer_id', $user->id)
                ->get();
        }

        if ($user->hasRole('learner')) {

            $learnerCohort = $user->learner->cohort()->get();

            $learnerSessions = CohortSession::whereIn('cohort_id', $learnerCohort->pluck('id')->toArray())
                    ->with(['trainer', 'session', 'cohort', 'zoom_room'])
                    ->orderBy('date')
                    ->get()
                    ->map(function ($session) {
                        return [
                            'id' => $session->id,
                            'date' => $session->date,
                            'zoom' => $session->zoom_room ? $session->zoom_room->link : 'No Zoom Room Assigned',
                            'cohort' => $session->cohort->name,
                            'course' => $session->cohort->course->name,
                            'trainer' => $session->trainer ? $session->trainer->user->name : '',
                            'name' => $session->session ? $session->session->name : 'Session name not available',
                        ];
                    });

            }

            if ($user->hasRole('learner') && $user->hasRole('trainer')) {
                $sessions = $learnerSessions->merge($trainerSessions);
            } else {
                $nextMonth = Carbon::now()->addMonth();
                $sessions = $learnerSessions ?? $trainerSessions ?? CohortSession::whereBetween('date', [Carbon::now(), $nextMonth])->with(['trainer', 'session', 'cohort', 'cohort.course'])->orderBy('date')->get()->map(function ($session) {
                    return [
                        'id' => $session->id,
                        'date' => $session->date,
                        'zoom' => $session->zoom_room ? $session->zoom_room->link : 'No Room Assigned',
                        'cohort' => $session->cohort->name,
                        'course' => $session->cohort->course->name,
                        'trainer' => $session->trainer ? $session->trainer->user->name : 'No trainer assigned',
                        'name' => $session->session ? $session->session->name : 'Session name not available',
                    ];
                });;
            }



            return Inertia::render('Schedule', compact('sessions'));
        }

}
