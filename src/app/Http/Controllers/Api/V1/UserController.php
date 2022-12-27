<?php

namespace App\Http\Controllers\Api\V1;

use App\Cores\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UserResource;

class UserController extends Controller
{
    use ApiResponse;

    public function profile()
    {
        $user = auth()->user();
        if (!$user) {
            return $this->responseJson('error', 'Unauthorized.', '', 401);
        }
        return $this->responseJson('success', 'Get profile successfully', new UserResource($user));
    }
}
