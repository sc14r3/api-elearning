<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Route;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/login', 'Users\LoginUserController@login');
$router->post('/logout', 'Users\LogoutUserController@logout');

$router->get('/users', ['uses' => 'Users\UserController@index', 'as' => 'users.index']);
$router->post('/users', 'Users\UserController@store');
$router->post('/register', 'Users\UserController@register');
$router->get('/users/{id}', 'Users\UserController@show');
$router->put('/users/{id}', 'Users\UserController@update');
$router->delete('/users/{id}', 'Users\UserController@delete');
$router->get('/users/{id}/accept', 'Users\UserController@acceptRequest');
$router->post('/users/file', 'Users\UserController@importUsers');

$router->get('/courses', 'CourseController@index');
$router->post('/courses', 'CourseController@store');
$router->get('/courses/{id}', 'CourseController@show');
$router->put('/courses/{id}', 'CourseController@update');
$router->delete('/courses/{id}', 'CourseController@delete');

$router->get('/teachers', 'TeacherController@index');
$router->post('/teachers/assignments', 'TeacherController@assignmentCourse');
$router->get('/teachers/assignments', 'TeacherController@list');
$router->get('/teachers/{id}/courses', 'TeacherController@myCourses');
$router->delete('/teachers/{id}', 'TeacherController@delete');
$router->post('/teachers/invite', 'TeacherController@invite');
$router->get('/courses/{id}/students', 'TeacherController@students');
$router->get('/teachers/{id}/accept', 'TeacherController@acceptRequest');

$router->get('/students', 'StudentController@index');
$router->get('/students/{id}/courses', 'StudentController@myCourses');
$router->post('/students/subscribe', 'StudentController@subscribe');

$router->get('/areas', 'AreaController@index');
$router->post('/areas', 'AreaController@store');
$router->get('/areas/{id}', 'AreaController@show');
$router->put('/areas/{id}', 'AreaController@update');
$router->delete('/areas/{id}', 'AreaController@delete');

$router->get('/roles', 'RolController@index');
$router->post('/roles', 'RolController@store');
$router->get('/roles/{id}', 'RolController@show');
$router->put('/roles/{id}', 'RolController@update');
$router->delete('/roles/{id}', 'RolController@delete');

$router->get('/wiki/{id}', 'WikiController@index');
$router->post('/wiki/create', 'WikiController@store');
$router->get('/wiki/material/{id}', 'WikiController@show');
$router->put('/wiki/{id}', 'WikiController@update');
$router->delete('/wiki/{id}', 'WikiController@delete');

$router->get('/courses/{id}/files', 'FileController@index');
$router->post('/file', 'FileController@store');
$router->get('/courses/file/{id}', 'FileController@show');
$router->put('/file/{id}', 'FileController@update');
$router->delete('/file/{id}', 'FileController@delete');

$router->get('/modules/{id}/index', 'ModuleController@index');
$router->post('/modules', 'ModuleController@store');
$router->get('/modules/{id}', 'ModuleController@show');
$router->put('/modules/{id}', 'ModuleController@update');
$router->delete('/modules/{id}', 'ModuleController@delete');

$router->get('/questions/{id}/course/{module}', 'QuestionController@index');
$router->get('/questions/course/{id}', 'QuestionController@specialIndex');
$router->post('/questions', 'QuestionController@store');
$router->get('/questions/{id}', 'QuestionController@show');
$router->put('/questions/{id}', 'QuestionController@update');
$router->delete('/questions/{id}', 'QuestionController@delete');
$router->get('/all-questions', 'QuestionController@all');

$router->get('/courses/{id}/exams', 'ExamController@index');
$router->post('/exams', 'ExamController@store');
$router->get('/exams/{id}', 'ExamController@show');
$router->put('/exams/{id}', 'ExamController@update');
$router->delete('/exams/{id}', 'ExamController@delete');

$router->get('/exams/questions/{id}', 'ExamQuestionController@index');
$router->post('/exams/questions', 'ExamQuestionController@store');
$router->post('/exams/questions/one', 'ExamQuestionController@one');
$router->get('/exams/questions/show/{id}', 'ExamQuestionController@show');
$router->put('/exams/questions/update/{id}', 'ExamQuestionController@update');
$router->delete('/exams/questions/{id}', 'ExamQuestionController@delete');

$router->get('/courses/{id}/works', 'WorkController@index');
$router->post('/teachers/homework', 'WorkController@store');
$router->get('/works/{id}', 'WorkController@show');
$router->put('/works/{id}', 'WorkController@update');
$router->delete('/works/{id}', 'WorkController@delete');

$router->get('/course/{id}', 'StudentController@course');

$router->get('/courses/{id}/frequent-questions', 'FrequentQuestionCourseController@index');
$router->post('/courses/frequent-questions', 'FrequentQuestionCourseController@store');
$router->get('/courses/frequent-questions/{id}', 'FrequentQuestionCourseController@show');
$router->put('/courses/frequent-questions/{id}', 'FrequentQuestionCourseController@update');
$router->delete('/courses/freuquent-questions/{id}', 'FrequentQuestionCourseController@delete');

$router->get('/courses/{id}/blog', 'BlogCourseController@index');
$router->post('/courses/blog', 'BlogCourseController@store');
$router->get('/courses/blog/{id}', 'BlogCourseController@show');
$router->put('/courses/blog/{id}', 'BlogCourseController@update');
$router->delete('/courses/blog/{id}', 'BlogCourseController@delete');

// Ruta de prueba para función que obtiene la información de los examenes
$router->get('exams/proof/{exam}', 'ExamController@getExamQuestions');

// Ruta para calificación de examen
$router->post('exams/{id}/qualify', 'ExamController@qualify');
$router->post('exam/question/{id}/qualify', 'ExamController@rateOpenQuestion');

// Obtener todos los examenes
$router->get('exams', 'ExamController@getAllExams');

// Obtener los examenes calificados
$router->get('exams/{id}/qualifications', 'ExamController@getGradedExams');

// Obtener examenes calificados por usuarios
$router->get('exams/user/{id}/qualifications', 'ExamController@getGradedUserExams');

// Obtener examenes por usuario y curso
$router->get('/courses/{course}/exams/user/{user}', 'ExamController@getUserExam');

// Generación de diploma
// $router->get('/courses/diploma', 'ExamController@generateDiploma');

// Trabajos
$router->get('/student/{id}/works', 'WorkStudentController@index');
$router->get('/student/work/{id}', 'WorkStudentController@show');
$router->post('/students/work', 'WorkStudentController@store');
$router->post('/students/work/{id}/qualify', 'WorkStudentController@qualify');
$router->get('/teachers/students/works/{id}', 'WorkStudentController@students');

// Obtener preguntas del examen respondidas por el usuario
$router->get('/student/{userId}/exam/{examId}', 'ExamQuestionController@questionsAnswered');

// Obtener pregunta abierta para calificar
$router->get('exam/question/open/{id}', 'ExamQuestionController@getOpenQuestion');

/**
 * Rutas para los reportes
 */
// Reporte de estudiantes por curso
$router->get('reports/students/{id}', 'ReportController@getCourseStudent');
// Reporte de profesores o entrenadores por curso
$router->get('reports/teachers/{id}', 'ReportController@getTeachersCourse');

// Dashboard
$router->get('dashboard/{type}/{id}', 'DashboardController@index');

