<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthUserController extends Controller
{
    public function loginUser(Request $request)
    {
        $auth = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($auth->fails()) {
            return response()->json($auth->messages(), 422);
        }

        $auth = User::where('email', $request->email)
            ->where('password', $request->password)
            ->first();

        if (!$auth || !$request->email || !$request->password) {
            return response()->json([
                'message' => 'email or password is incorrect'
            ], 401);
        }

        $token = md5($auth->email);
        $auth->token_login = $token;
        $auth->save();
        $auth->token = $token;

        return response()->json($auth);
    }

    public function logout(Request $request)
    {
        $auth = User::where('token_login', $request->token)->first();

        if (!$auth || !$request->token) {
            return response()->json([
                'message' => 'invalid Token'
            ], 401);
        }

        $auth->token_login = null;
        $auth->save();

        return response()->json([
            'message' => 'logout success'
        ]);
    }

    public function isAuth(Request $request)
    {
        $auth = User::where('token_login', $request->token)->first();

        if (!$auth || !$request->token) {
            return response()->json([
                'is-auth' => false,
                'user' => $auth
            ]);
        }
        return response()->json([
            'is-auth' => true,
            'user' => $auth
        ]);
    }
}
