<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseController extends Controller {

    public function index(){
        return new CourseCollection( Course::all() );
    }

    public function show(Course $course){
        return new CourseResource( $course );
    }
}
