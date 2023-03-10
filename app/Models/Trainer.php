<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'status', 'has_dbs', 'dbs_date', 'dbs_cert_path', 'mandatory_training_cert_1', 'has_completed_mandatory_training'];

    function session(){
        return $this->belongsTo(Session::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }
}
