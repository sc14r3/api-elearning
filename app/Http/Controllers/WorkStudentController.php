<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\WorksStudents;
use Illuminate\Support\Str;

class WorkStudentController extends Controller {
    public function index($id)
    {
        $works = WorksStudents::where('user_id', $id)->with('works')->get();

        return response()->json($works);
    }

    public function show($id)
    {
        $work = WorksStudents::where('id', $id)->with('works')->first();

        return response()->json($work, 200);
    }

    public function store(Request $request)
    {
        $work = new WorksStudents();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file->move('works', $file->getClientOriginalName());
            $work->file = $file->getClientOriginalName();
        }

        $work->work_id = $request->work_id;
        $work->user_id = $request->user_id;
        $work->qualification = 0.0;
        $work->save();

        return response()->json($work, 201);
    }

    public function qualify(Request $request, $id)
    {
        $work = WorksStudents::find($id);

        $work->qualification = $request->qualification;

        $work->save();

        return response()->json($work, 200);
    }

    public function students($id)
    {
        $works = WorksStudents::where('work_id', $id)->with('users')->get();

        return response()->json($works, 200);
    }
}
