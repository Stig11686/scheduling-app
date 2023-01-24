<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'courseName' => $this->course->name,
            'cohortName' => $this->cohort->name,
            'sessions' => InstanceSessionResource::collection($this->whenLoaded('sessions'))
        ];

    }
}
