<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::paginate(20);

        return Inertia::render('Admin/Sessions/Sessions', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Sessions/Edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'review_date' => 'required',
            'review_status' => 'required'
        ]);

        Session::create([
            'name' => $request->input('name'),
            'review_due' => $request->input('review_due'),
            'review_status' => $request->input('review_status'),
            'trainer_notes' => $request->input('trainer_notes'),
            'slides' => $request->input('slides')
        ]);

        return redirect()->route('sessions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)

    {
        $session = $session;
        return Inertia::render('Admin/Sessions/Edit', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session = Session::find($id);
        dd($session);
        return view(Inertia::render('Admin/Sessions/EditSession'), compact('session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        $request->validate([
            'name' => 'required',
            'review_status' => 'required',
            'review_date' => 'required'
        ]);

        $session->update([
            'name' => $request->name,
            'review_status' => $request->review_status,
            'review_date' => $request->review_date,
            'slides' => $request->slides,
            'trainer_notes' => $request->trainer_notes
        ]);

        return redirect()->route('sessions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        $session->delete();

        return redirect()->route('sessions');
    }
}
