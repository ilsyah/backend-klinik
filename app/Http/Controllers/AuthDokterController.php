<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthDokterController extends Controller
{
    public function login(Request $request)
    {

        $auth = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($auth->fails()) {
            return response()->json($auth->messages(), 422);
        }

        $auth = Dokter::where('email', $request->email)
            ->where('password', $request->password)
            ->with('poliklinik')
            ->first();

        if (!$auth || !$request->email || !$request->password) {
            return response()->json([
                'message' => 'Email or Password incorrect'
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
        $auth = Dokter::where('token_login', $request->token)->first();

        if (!$auth || !$request->token) {
            return response()->json([
                'message' => 'Invalid token'
            ], 401);
        }

        $auth->token_login = null;
        $auth->save();

        return response()->json([
            'message' => 'Logout success'
        ]);
    }

    public function isAuth(Request $request)
    {
        $auth = Dokter::where('token_login', $request->token)->first();

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
