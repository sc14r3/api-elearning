<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginUserController extends Controller
{
    public function login(Request $request)
    {
        if (strpos($request->username, '@') !== false) {
            $user = User::whereEmail($request->username)->with('rol')->first();
        } else {
            $user = User::where('email', $request->username)->with('rol')->first();
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Hubo un problema con tus datos, por favor verificalos'
            ], 400);
        }

        $user->api_token = Str::random(150);
        $user->save();

        // return response()->json($user, 200);
        return response()->json([
            'token'=> $user->api_token,
            'user' => $user,
            'rol' => $user->rol
        ]);
    }
}
