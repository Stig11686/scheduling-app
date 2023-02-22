<?php

namespace App\Http\Controllers;

use App\Models\Funder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FunderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funders = Funder::all();

        return Inertia::render('Admin/Funders/Funders', compact('funders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Funders/FunderCreate');
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
            'code' => 'required'
        ]);

        Funder::create([
            'name' =>$request->input('name'),
            'code' => $request->input('code')
        ]);

        return redirect()->route('funders');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funder  $funder
     * @return \Illuminate\Http\Response
     */
    public function show(Funder $funder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funder  $funder
     * @return \Illuminate\Http\Response
     */
    public function edit(Funder $funder)
    {
        return Inertia::render('Admin/Funders/FunderEdit', compact('funder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Funder  $funder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funder $funder)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required'
        ]);

        $funder->update([
            'name' => $request->name,
            'code' => $request->code
        ]);

        return redirect()->route('funders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funder  $funder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funder $funder)
    {
        $funder->delete();

        return redirect()->route('funders');
    }
}
