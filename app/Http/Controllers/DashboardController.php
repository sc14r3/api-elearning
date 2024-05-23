<?php

namespace App\Http\Controllers;

use App\Course;
use App\TeacherCourse;
use App\User;
use App\Exam;
use App\StudentCourse;

class DashboardController extends Controller {
    private function _getAdminDashboard()
    {
        $data = [];

        $users = User::count();
        $data[] = array(
            'title' => 'Usuarios',
            'total' => $users,
            'icon' => 'groups'
        );

        $teachers = User::where('rol_id', '2')->count();
        $data[] = array(
            'title' => 'Trainers',
            'total' => $teachers,
            'icon' => 'groups'
        );

        $students = User::where('rol_id', '3')->count();
        $data[] = array(
            'title' => 'Estudiantes',
            'total' => $students,
            'icon' => 'groups'
        );

        $courses = Course::count();
        $data[] = array(
            'title' => 'Cursos',
            'total' => $courses,
            'icon' => 'book'
        );

        $exams = Exam::count();
        $data[] = array(
            'title' => 'Examenes',
            'total' => $exams,
            'icon' => 'pages'
        );

        return $data;
    }

    private function _getTrainerDashboard($id)
    {
        $data = [];
        $courses = Course::count();

        $myCourses = TeacherCourse::select(['id'])->where('user_id', $id)->get();
        $data[] = array(
            'title' => 'Mis cursos',
            'total' => $myCourses->count(),
            'icon' => 'book'
        );

        $exams = Exam::whereIn('teacher_course_id', $myCourses)->count();
        $data[] = array(
            'title' => 'Examenes',
            'total' => $exams,
            'icon' => 'pages'
        );

        $students = StudentCourse::whereIn('teacher_course_id', $myCourses)->count();
        $data[] = array(
            'title' => 'Estudiantes',
            'total' => $students,
            'icon' => 'groups'
        );

        return $data;
    }

    private function _getStudentDashboard()
    {
        $data = [];

        return $data;
    }

    public function index($type, $id)
    {
        switch ($type){
            case 'admin':
                $data = $this->_getAdminDashboard();
                break;
            case 'trainer':
                $data = $this->_getTrainerDashboard($id);
                break;
            case 'usuario':
                $data = $this->_getStudentDashboard();
                break;
            default:
                $data = '';
                break;
        }

        return response()->json($data, 200);
    }
}