<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Str;

class FileController extends Controller {
    public function index($id)
    {

        $materials = File::where('teacher_course_id', $id)->whereNull('removed')->get();

        return response()->json($materials);
    }

    public function show($id)
    {
        $material = File::find($id);

        return response()->json($material, 200);
    }

    public function store(Request $request)
    {
        $material = new File();
        if ($request->hasFile('material')) {
            $file = $request->file('material');
            $file->move('files', $file->getClientOriginalName());
            $material->route = $file->getClientOriginalName();
        }

        $material->teacher_course_id = $request->teacher_course_id;
        $material->module_id = $request->module_id;
        $material->title = $request->title;
        $material->description = $request->description;
        $material->type = $request->type;
        $material->link = $request->link;
        $material->save();

        return response()->json($material, 201);
    }

    public function update(Request $request, $id)
    {
        $material = File::find($id);

        $material->title = $request->title;
        $material->description = $request->description;
        $material->type = $request->type;
        $material->link = $request->link;

        if ($request->hasFile('material')) {
            $file = $request->file('material');
            $file->move('wiki', $file->getClientOriginalName());
            $material->route = $file->getClientOriginalName();
        }

        $material->save();

        return response()->json($material, 200);
    }

    public function delete($id)
    {
        $material = File::find($id);
        $material->removed = Str::uuid()->toString();
        $material->save();

        return response()->json($material, 200);
    }
}
