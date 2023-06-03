<?php

namespace App\Http\Controllers;

use App\Models\Learner;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LearnerController extends Controller
{
    public function index(){
        $learners = Learner::with('user', 'cohort.course')->paginate(20);
        // dd($data);
        return Inertia::render('Admin/Learners/Learners', compact('learners'));
    }
}
