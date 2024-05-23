<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\UserExamQualification;
use App\StudentCourse;
use App\TeacherCourse;

class ReportController extends BaseController
{
    // Obtener examenes calificados
    public function getGradedExams($id)
    {
        $exams = UserExamQualification::Where('exam_id', $id)->with('exam', 'user')->get();

        return response()->json($exams);
    }

    public function getCourseStudent($id)
    {
        $students = StudentCourse::Where('teacher_course_id', $id)->with('user')->get();

        return response()->json($students);
    }

    public function getTeachersCourse($id)
    {
        $teachers = TeacherCourse::Where('course_id', $id)->with('users')->get();

        return response()->json($teachers);
    }
}
