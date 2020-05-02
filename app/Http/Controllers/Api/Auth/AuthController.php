<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $socialUserId = $request->get('social_user_id');

        if (empty($socialUserId)) {
            throw new \Exception("Parameter social_user_id can't be empty");
        }

        $user = User::where(['social_user_id' => $socialUserId])->first();

        if (empty($user)) {
            $uniqId = uniqid();
            $newUser = new User();
            $newUser->name = "MOBILE APP CLIENT " . $uniqId;
            $newUser->email = md5($uniqId) . '@' . md5($uniqId) . '.com';
            $newUser->social_user_id = $socialUserId;
            $newUser->password = md5($uniqId);
            $newUser->save();
            $newUser->refresh();
            $user = $newUser;
        }

        if (!Auth::loginUsingId($user->id)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }

        $token = Auth::user()->createToken(config('app.name'));
        $token->token->expires_at = Carbon::now()->addMonth();
        $token->token->save();

        return response()->json([
            'status' => 'success',
            'id' => $user->id,
            'auth_token' => $token->accessToken
        ]);
    }
}
