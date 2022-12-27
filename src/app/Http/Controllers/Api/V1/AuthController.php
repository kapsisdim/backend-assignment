<?php

namespace App\Http\Controllers\Api\V1;

use App\Cores\ApiResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Resources\Api\V1\UserResource;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(User $user, LoginRequest $request)
    {
        $findUser = $user->firstWhere('email', $request->email);

        if (!$findUser) {
            return $this->responseJson('error', 'Unauthorized. Email not found', '', 401);
        }

        if (!Auth::attempt($request->validated())) {
            return $this->responseJson('error', 'Unauthorized.', '', 401);
        }

        $token = $findUser->createToken('authToken');
        $data = [
            'accessToken' => $token->plainTextToken,
            'user' => new UserResource($findUser)
        ];
        return $this->responseJson('success', 'Login success', $data);
    }

    public function logout()
    {
        if (auth()->user()) {
            // FIXME : Fixing Revoke the token that was used to authenticate the current request
            $revoke = auth()->user()->currentAccessToken()->delete();

            /**Use below code if you want to log current user out in all devices */
            // $revoke = auth()->user()->tokens()->delete();
            if ($revoke) {
                return $this->responseJson('success', 'Logout');
            }
            return $this->responseJson('error', 'Logout');
        }
        return $this->responseJson('error', 'Unauthorized.', '', 401);
    }
}
