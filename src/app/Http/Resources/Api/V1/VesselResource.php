<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class VesselResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'mmsi' => $this->mmsi,
            'status' => $this->status,
            'stationId' => $this->stationId,
            'speed' => $this->speed,
            'lon' => $this->lon,
            'lat' => $this->lat,
            'course' => $this->course,
            'heading' => $this->heading,
            'rot' => $this->rot,
            'timestamp' => $this->timestamp,
        ];
    }
}
