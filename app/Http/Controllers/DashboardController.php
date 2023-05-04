<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
       $user = auth()->user();
       $user_roles = array_values($user->getRoleNames()->toArray());

       $data = array();

       $data['next_session'] = array(
        "title" => 'Next Session',
        "data" => $user->get_next_session()
       );

       if(in_array('admin', $user_roles) || in_array('super-admin', $user_roles)){
            $data['weeks_sessions'] = array(
                "title" => "This Weeks Sessions",
                "data" => $user->seven_days_sessions()
            );
       }

       return Inertia::render('Dashboard', compact('data'));

    }
}
