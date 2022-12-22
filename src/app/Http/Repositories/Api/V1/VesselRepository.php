<?php

namespace App\Http\Repositories\Api\V1;

use App\Traits\ApiFilterTrait;
use App\Models\Vessel;
use App\Http\Resources\Api\V1\VesselResource;

class VesselRepository
{
    use ApiFilterTrait;

    /**
     * Search Vessels
     * @param Illuminate\Http\Request $request
     * @return App\Http\Resources\Api\V1\VesselResource
     */
    public function searchVessels($request)
    {
        $data = Vessel::get();
        $filters = [
            [
                'field' => 'mmsi',
                'value' => $request->mmsi,
                'query' => '=',
            ],
            [
                'field' => 'lon',
                'value' => $request->lon,
                'query' => '=',
            ],
            [
                'field' => 'lat',
                'value' => $request->lat,
                'query' => '=',
            ],
            [
                'field' => 'timestamp',
                'value' => $request->timestamp,
                'query' => '=',
            ],
        ];
        $data = $this->filterFields($data, $filters);
        return VesselResource::collection($data);
    }
}
