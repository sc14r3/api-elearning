<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Illuminate\Support\Str;

class CourseController extends Controller {
    public function index() // get
    {
        
        $courses = Course::whereNull('removed')->with('area')->get(); // SELECT * FROM courses

        return response()->json($courses);
    }

    public function show($id)
    {
        $course = Course::find($id); // SELEC * WHERE id = $id FROM courses;

        return response()->json($course, 200);
    }

    public function store(Request $request)
    {
        $course = new Course();
        $course->fill($request->all()); // INSERT INTO courses VALUES (1,2,3)
        $course->save();

        return response()->json($course, 201);
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        $course->fill($request->all()); // UPDATE courses SET (1,2,3)
        $course->save();

        return response()->json($course, 200);
    }

    public function delete($id)
    {
        $course = Course::find($id);
        $course->removed = Str::uuid()->toString();
        $course->save();

        return response()->json($course, 200);
    }
}