<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use Illuminate\Support\Str;

class ModuleController extends Controller {
    public function index($id)
    {

        $modules = Module::where('course_id', $id)->whereNull('removed')->get();

        return response()->json($modules);
    }

    public function show($id)
    {
        $module = Module::find($id);

        return response()->json($module, 200);
    }

    public function store(Request $request)
    {
        $module = new Module();
        $module->fill($request->all());
        $module->save();

        return response()->json($module, 201);
    }

    public function update(Request $request, $id)
    {
        $module = Module::find($id);
        $module->fill($request->all());
        $module->save();

        return response()->json($module, 200);
    }

    public function delete($id)
    {
        $module = Module::find($id);
        $module->removed = Str::uuid()->toString();
        $module->save();

        return response()->json($module, 200);
    }
}
