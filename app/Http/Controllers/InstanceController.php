<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\Course;
use App\Models\Instance;
use App\Models\Trainer;
use App\Models\ZoomRoom;
use App\Models\InstanceSession;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\GoogleCalendar\Event;

class InstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
       $instances = Instance::with(['course', 'cohort', 'instanceSessions.trainer', 'instanceSessions.zoomRoom', 'instanceSessions.session'])->paginate(10);
       $zoom_rooms = ZoomRoom::get();
       $trainers = Trainer::with('user')->get();

       return Inertia::render('Admin/CurrentCourses/CurrentCourses', compact('instances', 'zoom_rooms', 'trainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        $cohorts = Cohort::all();
        $sessions = Session::all();

        return Inertia::render('Admin/CurrentCourses/CurrentCourseCreate', compact('courses', 'cohorts', 'sessions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if($request->input('newCohort') || $request->input('newCohortPlaces')){
            $request->validate([
                'newCohort' => 'required',
                'newCohortPlaces' => 'required'
            ]);

            Cohort::create([
                'name' => $request->input('newCohort'),
                'places' => $request->input('newCohortPlaces')
            ]);

            return redirect()->back();
       }


         $instance = Instance::create([
            'course_id' => $request->input('courseId'),
            'cohort_id' => $request->input('cohortId')
        ]);

        foreach($request->input('sessions') as $session){
            InstanceSession::create([
                'instance_id' => $instance->id,
                'session_id' => $session,
                'cohort_id' => $request->input('cohortId')
            ]);
        }

        return redirect()->route('currentcourses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instance = Instance::with('instanceSessions', 'course', 'cohort')->where('id', $id)->get();
        $existing_sessions = InstanceSession::where('instance_id', $id)->get();
        $sessions = Session::all();
        return Inertia::render('Admin/CurrentCourses/InstanceEdit', compact('instance', 'sessions', 'existing_sessions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //check what sessions currently belong to the instance
        $current_sessions = InstanceSession::where('instance_id', $id)->get()->toArray();
        //check what sessions were submitted through our form
        $submitted_sessions = $request->input('sessions');

        //grab the ids of the sessions that already belong to our course instance to compare them to the ids of the sessions submitted in our request
        $current_session_ids = array_map(function($item){
            return $item['session_id'];
            }, $current_sessions);

        //compare the two arrays
        $removed_sessions = array_diff($current_session_ids, $submitted_sessions);

        //if there are differences, a session has been removed, so remove it from the database.
        if($removed_sessions){
            foreach($removed_sessions as $session){
                //remove session from instance_session table by session id and instance_id
                $sqlDelete = "delete from instance_session where session_id=$session and instance_id = $id";
                DB::select($sqlDelete);
            }
        }

        //now we check if any sessions were added

        foreach($current_sessions as $key => $current_session){
            foreach($submitted_sessions as $key => $submitted_session){
                //remove checkbox that's already checked - validation for the creating the instance sessions
                if(intval($submitted_session) === intval($current_session['session_id'])){
                    unset($submitted_sessions[$key]);
                    $sessions = array_values($submitted_sessions);
                }
            }
        }

        if($sessions){
            foreach($sessions as $session){
                // $event = new Event();
                InstanceSession::create([
                    'instance_id' => $id,
                    'session_id' => $session,
                    'cohort_id' => $request->cohort[0]
                ]);

            //     $event->name = 'Session' . $session;
            //     $event->startDateTime = Carbon::now()->addHour();
            //     $event->endDateTime = Carbon::now()->addHour();

            //     $event->save();
            // }
            }
        }

            return redirect()->route('currentcourses');
    }

       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instance $instance)
    {
        //TODO
        //https://stackoverflow.com/questions/53553686/laravel-archiving-data-delete-and-insert-to-another-table
        //find out how to archive this instead of deleting
        $instance->delete();

        return redirect()->route('instances.index');
    }
}
