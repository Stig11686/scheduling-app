<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\InstanceSession;
use App\Models\Trainer;
use App\Models\ZoomRoom;
use App\Models\Session;
use Carbon\Carbon;

class InstanceSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session = InstanceSession::where('id', $id)->with('trainer', 'zoomRoom', 'session', 'cohort')->get();
        $sessions = Session::all();
        $trainers = Trainer::with('user')->get();
        $zoom_rooms = ZoomRoom::all();

        return Inertia::render('Admin/CurrentCourses/SessionEdit', compact('session', 'sessions', 'trainers', 'zoom_rooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $session = InstanceSession::find($id);
        $session->update([
            'date' => $request->input('date'),
            'trainer_id' => $request->input('trainerId'),
            'session_id' => $request->input('sessionId'),
            'zoom_room_id' => $request->input('zoomRoomId')
        ]);

        return redirect()->route('currentcourses');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $session = InstanceSession::find($id);

        $session->delete();

        return redirect()->route('currentcourses');
    }
}
