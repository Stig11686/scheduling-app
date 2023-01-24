<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ZoomRoom;
use App\Models\Trainer;

class InstanceSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       return $this->whenPivotLoaded('instance_session', function(){
        $zoom_room = implode(ZoomRoom::where('id', $this->pivot->zoom_room_id)->pluck('link')->toArray());
        $trainer = implode(Trainer::where('id', $this->pivot->trainer_id)->pluck('name')->toArray());

                     return [
                        'date' => $this->pivot->date,
                        'name' => $this->name,
                        'zoomRoomLink' => $zoom_room, // ZoomRoomResource::make($this->pivot->zoom_room_id),
                        'trainer' => $trainer
                     ];
                });
    }
}
