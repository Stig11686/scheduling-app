<?php

namespace App\Http\Controllers;

use App\Models\Funder;
use Illuminate\Http\Request;

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

        return view('funder.index', compact('funders'));
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
        return view('funder.edit', compact('funder'));
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
        $funder->update([
            'name' => $request->name,
            'code' => $request->code
        ]);

        return redirect()->route('funders.index');
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

        return redirect()->route('funders.index');
    }
}
