<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\InstanceSession;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        //the dashboard will display different data dependant on the users role(s) - we'll also need the user id to use in
        // DB queries
       $user = auth()->user();
       $user_id = $user->id;
       $user_roles = array_values($user->getRoleNames()->toArray());

       //dd($user_roles);

       if(in_array('tcg-trainer', $user_roles)){
        $next_session = $user->get_next_session();
        return Inertia::render('Dashboard', compact('next_session'));
       } elseif(in_array('tcg-admin', $user_roles)){
        $weeks_sessions = $user->seven_days_sessions();
        return Inertia::render('Dashboard', compact('weeks_sessions'));
       }

       return abort(403);
    }
}
