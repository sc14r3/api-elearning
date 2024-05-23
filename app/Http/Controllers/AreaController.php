<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use Illuminate\Support\Str;

class AreaController extends Controller {
    public function index()
    {
        
        $areas = Area::whereNull('removed')->get();

        return response()->json($areas);
    }

    public function show($id)
    {
        $area = Area::find($id);

        return response()->json($area, 200);
    }

    public function store(Request $request)
    {
        $area = new Area();
        $area->fill($request->all());
        $area->save();

        return response()->json($area, 201);
    }

    public function update(Request $request, $id)
    {
        $area = Area::find($id);
        $area->fill($request->all());
        $area->save();

        return response()->json($area, 200);
    }

    public function delete($id)
    {
        $area = Area::find($id);
        $area->removed = Str::uuid()->toString();
        $area->save();

        return response()->json($area, 200);
    }
}