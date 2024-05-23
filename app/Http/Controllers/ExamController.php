<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use App\ExamQuestion;
use App\UserExamAnswer;
use App\UserExamQualification;
use Illuminate\Support\Str;

class ExamController extends Controller {
    // Obtener examenes por curso
    public function index($id)
    {
        $exams = Exam::where('teacher_course_id', $id)->whereNull('removed')->get();

        return response()->json($exams);
    }

    public function show($id)
    {
        $exam = Exam::find($id);

        return response()->json($exam, 200);
    }

    public function store(Request $request)
    {
        $exam = new Exam();
        $exam->fill($request->all());
        $exam->save();

        return response()->json($exam, 201);
    }

    public function update(Request $request, $id)
    {
        $exam = Exam::find($id);
        $exam->fill($request->all());
        $exam->save();

        return response()->json($exam, 200);
    }

    public function delete($id)
    {
        $exam = Exam::find($id);
        $exam->removed = Str::uuid()->toString();
        $exam->save();

        return response()->json($exam, 200);
    }

    private function _getQuestionValue($exam, $question)
    {
        $response = ExamQuestion::where('exam_id', $exam)->where('question_id', $question)->first();

        if ($response) {
            return $response;
        }

        return false;
    }

    // Obtener las preguntas del examen, cuanto vale cada una y su respuesta
    // public function getExamQuestions($exam)
    private function _getExamQuestions($exam)
    {
        $questions = ExamQuestion::where('exam_id', $exam)->with('question')->get();

        $response = $questions->map(function (ExamQuestion $question) {
            return [
                'questionId' => $question->question_id,
                'value' => $question->value,
                'answer' => $question->question->answer,
                'type' => $question->question->type
            ];
        })->toArray();

        // dd($response);

        return $response;

    }

    private function _getTotalQualification($questions)
    {
        $total = 0;
        foreach ($questions as $question) {
            $total = $total + $question['value'];
        }
        return $total;
    }

    public function qualify(Request $request, $id)
    {
        $answers = $request->exam;
        $user = $request->user;

        $questions = $this->_getExamQuestions($id);

        $total = $this->_getTotalQualification($questions);

        if (!$questions) {
            return false;
        }

        $userTotal = 0;
        foreach ($answers as $key => $answer) {
            foreach ($questions as $question) {
                $calif = 0;
                if ($question['questionId'] == $key) {
                    // Ahorita solo se detecta que el campo en preguntas abiertas este contestada
                    if ($question['type'] == 2) {
                        $calif = $question['value'];
                    } else {
                        $calif = $question['answer'] == $answer ? $question['value'] : 0;
                    }
                }
                $userTotal = $userTotal + $calif;
            }

            UserExamAnswer::create([
                'user_id' => $user,
                'exam_id' => $id,
                'exam_question_id' => $key,
                'answer' => $answer,
                'qualification' => $calif
            ]);
        }

        $finalQualification = ($userTotal * 10) / $total;

        UserExamQualification::create([
            'exam_id' => $id,
            'user_id' => $user,
            'qualification' => $finalQualification
        ]);

        return response()->json([
            'message' => 'El examen se ha calificado correctamente'
        ], 200);
    }

    public function rateOpenQuestion(Request $request, $id)
    {
        $question = UserExamAnswer::find($id);

        $question->qualification = $request->qualification;
        $question->save();

        return response()->json($question, 200);
    }

    public function getAllExams()
    {
        $exams = Exam::whereNull('removed')->get();

        return response()->json($exams);
    }

    // Obtener los examenes presentados por los usuarios
    public function getGradedExams($id)
    {
        $exams = UserExamQualification::Where('exam_id', $id)->with('exam', 'user')->get();

        return response()->json($exams);
    }

    public function getGradedUserExams($id)
    {
        $exams = UserExamQualification::Where('user_id', $id)->with('exam', 'user')->get();

        return response()->json($exams);
    }

    public function getUserExam($course, $user)
    {
        $exams = Exam::where('teacher_course_id', $course)->get();

        foreach($exams as $exam) {
            $qualification = UserExamQualification::where('exam_id', $exam->id)->where('user_id', $user)->first();

            $exam->qualification = $qualification ? $qualification->qualification : 'NA';
        }

        return response()->json($exams);
    }

    public function generateDiploma()
    {
        /* $pdf = Pdf::loadView('pdf.invoice', $data);
        return $pdf->download('invoice.pdf'); */
        /* $pdf = app('dompdf.wrapper');
        $pdf->loadHTML('<h1>Styde.net</h1>');

        return $pdf->download('mi-archivo.pdf'); */
        $pdf = \PDF::loadView('vista-pdf');

        return $pdf->download('archivo.pdf');
    }
}
