<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CohortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cohorts = Cohort::withCount('learners')->paginate(10);

        return Inertia::render('Admin/Cohorts/Cohorts', compact('cohorts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Cohorts/CohortCreate');
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
            'name' => ['required'],
            'places' => ['required']
        ]);

        Cohort::create([
            'name' => $request->input('name'),
            'places' => $request->input('places'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date')
        ]);

        return redirect()->route('cohorts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cohort  $cohort
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cohort = Cohort::with('learners.user')->find($id);
        return Inertia::render('Admin/Cohorts/CohortShow', compact('cohort'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cohort  $cohort
     * @return \Illuminate\Http\Response
     */
    public function edit(Cohort $cohort)
    {
        return Inertia::render('Admin/Cohorts/CohortEdit', compact('cohort'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cohort  $cohort
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cohort $cohort)
    {
        $request->validate([
            'name' => ['required'],
            'places' => ['required']
        ]);

        $cohort->update([
            'name' => $request->name,
           'places' => $request->places,
           'start_date' => $request->startDate,
           'end_date' => $request->endDate
        ]);



        return redirect()->route('cohorts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cohort  $cohort
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cohort $cohort)
    {
        $cohort->delete();

        return redirect()->route('cohorts');
    }

    public function schedule($id){
        $cohort = Cohort::find($id);
        $sessions = $cohort->sessions;

        return Inertia::render('Admin/Cohorts/CohortSessions', compact('sessions','cohort'));
    }
}
