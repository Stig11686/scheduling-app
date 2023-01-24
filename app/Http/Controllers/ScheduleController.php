<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index(Request $request){
        $user = auth()->user();
        $sessions = $user->getSessions();
        return Inertia::render('Schedule', compact('sessions'));
    }
}
