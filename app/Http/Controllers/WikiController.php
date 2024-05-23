<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wiki;
use Illuminate\Support\Str;

class WikiController extends Controller {
    public function index($id)
    {

        $materials = Wiki::where('course_id', $id)->whereNull('removed')->get();

        return response()->json($materials);
    }

    public function show($id)
    {
        $material = Wiki::find($id);

        return response()->json($material, 200);
    }

    public function store(Request $request)
    {
        $material = new Wiki();
        if ($request->hasFile('material')) {
            $file = $request->file('material');
            $file->move('wiki', $file->getClientOriginalName());
            $material->route = $file->getClientOriginalName();
        }

        $material->course_id = $request->course_id;
        $material->title = $request->title;
        $material->description = $request->description;
        $material->type = $request->type;
        $material->link = $request->link;
        $material->save();

        return response()->json($material, 201);
    }

    public function update(Request $request, $id)
    {
        $material = Wiki::find($id);

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
        $material = Wiki::find($id);
        $material->removed = Str::uuid()->toString();
        $material->save();

        return response()->json($material, 200);
    }
}
