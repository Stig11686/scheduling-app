<?php

namespace App\Http\Controllers;

use App\Models\ZoomRoom;
use Illuminate\Http\Request;

class ZoomRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = ZoomRoom::all();

        return view('zoom.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zoom.create');
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
            'link' => ['required']
        ]);

        ZoomRoom::create([
            'name' => $request->input('name'),
            'link' => $request->input('link')
        ]);

        return redirect()->route('zoomRooms');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ZoomRoom  $zoomRoom
     * @return \Illuminate\Http\Response
     */
    public function show(ZoomRoom $zoomRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ZoomRoom  $zoomRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ZoomRoom $zoomRoom)
    {
        return view('zoom.edit', compact('zoomRoom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ZoomRoom  $zoomRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ZoomRoom $zoomRoom)
    {
        $request->validate([
            'name' => ['required'],
            'link' => ['required']
        ]);

        $zoomRoom->update([
            'name' => $request->name,
            'link' => $request->link
        ]);

        return redirect()->route('zoomRooms');
    }

    public function destroy(Request $request, $id){
        $data = ZoomRoom::findOrFail($id);
        $data->delete();


        return redirect()->route('zoomRooms');
    }
}
