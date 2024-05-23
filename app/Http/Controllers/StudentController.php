<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TeacherCourse;
use App\StudentCourse;
use Carbon\Carbon;

class StudentController extends Controller {

    public function index()
    {
        $teachers = User::where('rol_id', '=', 3)->whereNull('removed')->get();

        return response()->json($teachers);
    }

    public function assignmentCourse(Request $request)
    {
        $course = new TeacherCourse();
        $course->fill($request->all());
        $course->save();

        return response()->json($course, 201);
    }

    public function subscribe(Request $request)
    {
        StudentCourse::create([
            'user_id' => $request->student,
            'teacher_course_id' => $request->course,
            'date_of_inscription' => Carbon::now()->format('Y-m-d'),
            'status' => 'PENDING_TEACHER'
        ]);

        return response()->json([
            'message' => 'El estudiante ha sido invitado con éxito'
        ], 200);
    }

    public function myCourses($id)
    {
        $courses = StudentCourse::where('user_id', $id)->with('teacherCourses.courses')->get();

        return response()->json($courses, 200);
    }

    public function course($id)
    {
        $course = TeacherCourse::where('id', $id)->with('material', 'courses.modules.works')->first();

        return response()->json($course, 200);
    }
}
