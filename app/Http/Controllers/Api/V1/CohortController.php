<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CohortCollection;
use App\Http\Resources\CohortResource;
use App\Models\Cohort;

class CohortController extends Controller {

    public function index(){
        return new CohortCollection( Cohort::all() );
    }

    public function show(Cohort $cohort){
        return new CohortResource( $cohort );
    }
}
