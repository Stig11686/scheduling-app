<?php

namespace App\Models;

use App\Http\Controllers\Api\V1\CourseController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    function instance(){
        return $this->hasMany(Instance::class);
    }

    public function getLinksAttribute()
    {
        return [
            'index' => action(
                [CourseController::class, 'index']
            ),
            'show' => action(
                [CourseController::class, 'show'],
                $this->id
            ),
        ];
    }
}
