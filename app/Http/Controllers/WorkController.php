<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work;
use Illuminate\Support\Str;

class WorkController extends Controller {
    public function index($id)
    {
        $works = Work::where('teacher_course_id', $id)->with('studentWorks')->whereNull('removed')->with('module')->get();

        return response()->json($works);
    }

    public function show($id)
    {
        $work = Work::find($id);

        return response()->json($work, 200);
    }

    public function store(Request $request)
    {
        $work = new Work();
        $work->fill($request->all());
        $work->save();

        return response()->json($work, 201);
    }

    public function update(Request $request, $id)
    {
        $work = Work::find($id);
        $work->fill($request->all());
        $work->save();

        return response()->json($work, 200);
    }

    public function delete($id)
    {
        $work = Work::find($id);
        $work->removed = Str::uuid()->toString();
        $work->save();

        return response()->json($work, 200);
    }
}
