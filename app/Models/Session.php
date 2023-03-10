<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'review_due', 'review_status', 'slides', 'trainer_notes'];

    function instances(){
        return $this->belongsToMany(Instance::class);
    }

    function trainers(){
        return $this->hasManyThrough(Trainer::class, InstanceSession::class);
    }
}
