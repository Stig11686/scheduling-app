<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['name', 'review_due', 'review_status', 'slides', 'trainer_notes'];

    function instances(){
        return $this->belongsToMany(Instance::class);
    }

}
