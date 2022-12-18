<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'places', 'start_date', 'end_date'];

    function instance(){
        return $this->belongsTo(Instance::class);
    }
}
