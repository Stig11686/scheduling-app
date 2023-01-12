<?php

namespace App\Http\Resources;

use App\Models\Trainer;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainerResource extends JsonResource
{

    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       return parent::toArray($request);
    }
}
