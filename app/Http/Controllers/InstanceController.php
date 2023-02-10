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

        return view('instances.create', compact('courses', 'cohorts', 'sessions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $instance = Instance::create([
            'course_id' => $request->input('course_id'),
            'cohort_id' => $request->input('cohort_id')
        ]);

        foreach($request->input('sessions') as $session){
            InstanceSession::create([
                'instance_id' => $instance->id,
                'session_id' => $session,
                'cohort_id' => $request->input('cohort_id')
            ]);
        }

        return redirect()->route('instances');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        dd($request);
        //return view('instances.edit', compact('instance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
    //     $instance = Instance::with(['course', 'cohort'])->where('id', $id)->get();
    //     $trainers = Trainer::all();
    //     $zoom_rooms = ZoomRoom::all();
    //     $session_data = DB::table('instance_session')
    //    ->selectRaw('courses.name as Course_Name,
    //             sessions.name as Session_Title,
    //            date as Date,
    //            instance_session.id as id,
    //            instance_session.instance_id as instance_id,
    //            instance_session.session_id as session_id
    //         ')
    //    ->join('instances', 'instances.id', '=', 'instance_session.instance_id')
    //    ->join('courses', 'courses.id', '=', 'instances.course_id')
    //    ->join('sessions', 'sessions.id', '=', 'instance_session.session_id')
    //    ->where('instance_id', $id)
    //    ->get();

    //     $sessions = Session::all();

    //     return view('instances.edit', compact('instance', 'sessions', 'session_data', 'trainers', 'zoom_rooms'));

        return Inertia::render('Admin/CurrentCourses/SessionEdit');
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
        //dd();
    //     $instance_id = $request->input('instance_id');
    //     //REFERS TO THE ADD SESSIONS PAGE
    //    if(isset($_POST['session_id'])){
    //         $sessions = $_POST['session_id'];
    //         $session_data = DB::table('instance_session')
    //         ->selectRaw('instance_session.session_id as session_id')
    //         ->where('instance_id', $id)
    //         ->get()->all();

    //         $exisiting_session_ids = array_map(function($item){
    //             return $item->session_id;
    //           }, $session_data);

    //         $session_ids = array_map(function($item){
    //             return intval($item);
    //         }, $sessions);

    //         $removed_sessions = array_diff($exisiting_session_ids, $session_ids);

    //         if($removed_sessions){
    //             foreach($removed_sessions as $session){
    //                 //remove session from instance_session table by session id and instance_id
    //                 $sqlDelete = "delete from instance_session where session_id=$session and instance_id = $instance_id";
    //                 DB::select($sqlDelete);
    //             }
    //         }

    //         foreach($session_data as $key => $existing_session){
    //             foreach($sessions as $key => $session){
    //                 //remove checkbox that's already checked - validation for the creating the instance sessions
    //                 if(intval($session) === intval($existing_session->session_id)){
    //                     unset($sessions[$key]);
    //                     $sessions = array_values($sessions);
    //                 }
    //             }
    //         }

    //         //create new sessions on the course instance
    //         foreach($sessions as $session){
    //             $event = new Event();
    //            $instance_id = $request->input('instance_id');
    //             InstanceSession::create([
    //                 'instance_id' => $instance_id,
    //                 'session_id' => $session,
    //                 'cohort_id' => $request->input('cohort_id')
    //             ]);

    //             $event->name = 'Session' . $session;
    //             $event->startDateTime = Carbon::now()->addHour();
    //             $event->endDateTime = Carbon::now()->addHour();

    //             $event->save();

    //         };

    //         //TODO - CREATE GOOGLE CALENDAR INVITE
    //     } else {
    //         //REFERS TO THE INDEX PAGE TO EDIT INDIVIDUAL SESSIONS
            $session_id = $request->input('sessionId');

            $instance_session = InstanceSession::where('instance_id', $id)->where('session_id', $session_id)->first();

            $instance_session->date = $request->input('date');
            $instance_session->trainer_id = $request->input('trainerId');
            $instance_session->zoom_room_id = $request->input('roomId');

            $instance_session->save();
    //         //TO DO - UPDATE GOOGLE CALENDAR INVITE
    //    }
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
