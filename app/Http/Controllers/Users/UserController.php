<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\User;
use App\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'date_of_birth' => $request->date_of_birth,
            'curp' => $request->curp,
            'password' => Hash::make($request->password),
            // 'coordinator_id' => $request->coordinator_id,
            'rol_id' => $request->rol,
            'status' => 'ACTIVE'
        ]);

        return response()->json([
            'message' => 'Usuario registrado exitosamente'
        ], 200);
    }

    public function index()
    {
        $users = User::whereNull('removed')->with('rol')->get();

        return $users;
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->removed = Str::uuid()->toString();
        $user->save();

        return response()->json($user, 200);
    }

    public function show($id)
    {
        $user = User::find($id);

        return response()->json($user, 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->curp = $request->input('curp');
        $user->password = Hash::make($request->input('password'));
        $user->rol_id = $request->input('rol');
        $user->status = 'ACTIVE';
        $user->save();

        return response()->json($user, 200);
    }

    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'date_of_birth' => $request->date_of_birth,
            'curp' => $request->curp,
            'password' => Hash::make($request->password),
            // 'coordinator_id' => $request->coordinator_id,
            'rol_id' => $request->rol,
            'status' => 'ACTIVE'
        ]);

        return response()->json([
            'message' => 'Usuario registrado exitosamente'
        ], 200);
    }

    public function acceptRequest($id)
    {
        $user = User::find($id);
        $user->status = 'ACTIVE';
        $user->save();

        return response()->json($user, 200);
    }

    public function import(Request $request){
        Excel::import(new ImportUser,
                      $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function importUsers(Request $request)
    {
        if ($request->hasFile('file')) {
            if (Excel::import(new UsersImport, $request->file('file'))){
                $data = [ 'message' => 'Exitoso' ];
                return response()->json($data, 200);    
            }

            $data = [ 'message' => 'Error' ];
            return response()->json($data, 412);
        }
    }
}
