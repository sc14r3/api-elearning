<?php
namespace App\Http\Controllers;

use App\ExamQuestion;
use App\UserExamAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamQuestionController extends Controller {

    public function index($id)
    {
        $exam = ExamQuestion::where('exam_id', $id)->with('exam', 'question')->whereNull('removed')->get();

        return response()->json($exam);
    }

    public function show($id)
    {
        $exam = ExamQuestion::find($id);

        return response()->json($exam, 200);
    }

    public function store(Request $request)
    {
        $questions = $request->questions;

        foreach ($questions as $question) {
            ExamQuestion::create([
                'exam_id' => $request->exam_id,
                'question_id' => $question['id'],
                'value' => $question['value']
            ]);
        }

        return response()->json([
            'message' => 'Preguntas agregadas al examen correctamente'
        ], 201);
    }

    public function one(Request $request)
    {
        ExamQuestion::create([
            'exam_id' => $request->exam_id,
            'question_id' => $request->question_id,
            'value' => $request->value
        ]);

        return response()->json([
            'message' => 'Pregunta agregada al examen correctamente'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $exam = ExamQuestion::find($id);
        $exam->fill($request->all());
        $exam->save();

        return response()->json($exam, 200);
    }

    public function delete($id)
    {
        $exam = ExamQuestion::find($id);
        $exam->removed = Str::uuid()->toString();
        $exam->save();

        return response()->json($exam, 200);
    }

    public function exam($id)
    {
        $exam = ExamQuestion::where('exam_id', $id)->with('exam', 'question')->whereNull('removed')->get();

    }

    // Obtener preguntas de examen contestadas por usuario
    public function questionsAnswered($userId, $examId)
    {
        $questions = UserExamAnswer::where('user_id', $userId)->where('exam_id', $examId)->with('questions', 'questions.question')->get();

        return response()->json($questions, 200);
    }

    public function getOpenQuestion($id)
    {
        $question = UserExamAnswer::where('id', $id)->with('questions.question')->first();

        return response()->json($question, 200);
    }
}
