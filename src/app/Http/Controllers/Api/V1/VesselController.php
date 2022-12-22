<?php
namespace App\Http\Controllers\Api\V1;

use App\Cores\ApiResponse;
use App\Models\Vessel;
use App\Http\Repositories\Api\V1\VesselRepository;
use App\Http\Resources\Api\V1\VesselResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VesselController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        try {
            $vesselRepo = new VesselRepository();
            $data = $vesselRepo->searchVessels($request);

            return $this->responseJson('Get list vessels successfully.', $data, 200, []);
        } catch (\Throwable $th) {
            return $this->responseJson('error', 'Failed to get list vessels.', $th, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $vehicle = Vessel::find($id);
        if (!$vehicle) {
            return $this->responseJson('error', 'Not found.', '', 404);
        }
        return $this->responseJson('success', 'Get detail vehicle successfully', new VesselResource($vehicle));
    }

}
