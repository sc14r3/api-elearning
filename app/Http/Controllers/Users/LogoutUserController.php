<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutUserController extends Controller
{
    public function logout(Request $request)
    {
        $user = auth()->user();
        $user->api_token = null;
        $user->save();

        return response()->json([
            'message' => 'El usuario ha cerrado sesión exitosamente'
        ], 200);
    }
}