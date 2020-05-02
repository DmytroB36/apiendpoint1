<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    private function checkAuthToken(Request $request) {
        $authToken = $request->get('auth-token');

        if (empty($authToken)) {
            throw new \Exception("Unauthorized");
        }

        $user = User::where(['auth_token' => $request->get('auth-token')])->first();

        if (empty($user)) {
            throw new \Exception("Unauthorized");
        }
    }

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function __invoke(Request $request)
    {
        $this->checkAuthToken($request);

        $users = User::where(['auth_token' => $request->get('auth-token')])->get();

        foreach ($users as $user) {
            $user->auth_token = null;
            $user->save();
        }

        return response()->json([
            'message' => 'You are successfully logged out',
        ]);
    }
}
