<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use Illuminate\Support\Str;

class RolController extends Controller {
    public function index()
    {
        
        $roles = Rol::whereNull('removed')->get();

        return response()->json($roles);
    }

    public function show($id)
    {
        $rol = Rol::find($id);

        return response()->json($rol, 200);
    }

    public function store(Request $request)
    {
        $rol = new Rol();
        $rol->fill($request->all());
        $rol->save();

        return response()->json($rol, 201);
    }

    public function update(Request $request, $id)
    {
        $rol = Rol::find($id);
        $rol->fill($request->all());
        $rol->save();

        return response()->json($rol, 200);
    }

    public function delete($id)
    {
        $rol = Rol::find($id);
        $rol->removed = Str::uuid()->toString();
        $rol->save();

        return response()->json($rol, 200);
    }
}