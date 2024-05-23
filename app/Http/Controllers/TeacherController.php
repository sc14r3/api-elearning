<?php
namespace App\Http\Controllers;

use App\StudentCourse;
use Illuminate\Http\Request;
use App\User;
use App\TeacherCourse;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TeacherController extends Controller {

    public function index()
    {
        $teachers = User::where('rol_id', '=', 2)->whereNull('removed')->get();

        return response()->json($teachers);
    }

    public function list()
    {
        $courses = TeacherCourse::whereNull('removed')->with('users', 'courses')->get();

        return response()->json($courses);
    }

    public function assignmentCourse(Request $request)
    {
        $course = new TeacherCourse();
        $course->fill($request->all());
        $course->save();

        return response()->json($course, 201);
    }

    public function delete($id)
    {
        $course = TeacherCourse::find($id);
        $course->removed = Str::uuid()->toString();
        $course->save();

        return response()->json($course, 200);
    }

    public function invite(Request $request)
    {
        StudentCourse::create([
            'user_id' => $request->student,
            'teacher_course_id' => $request->course,
            'date_of_inscription' => Carbon::now()->format('Y-m-d'),
            'status' => 'PENDING_STUDENT'
        ]);

        return response()->json([
            'message' => 'El estudiante ha sido invitado con éxito'
        ], 200);
    }

    public function students($id)
    {
        $students = StudentCourse::where('teacher_course_id', $id)
            ->with('user')
            ->get();

        return response()->json($students, 200);
    }

    public function acceptRequest($id)
    {
        $student = StudentCourse::find($id);
        $student->status = 'ACTIVE';
        $student->save();

        return response()->json($student, 200);
    }

    public function myCourses($id)
    {
        $courses = TeacherCourse::where('user_id', $id)->with('courses')->get();

        return $courses;
    }
}
