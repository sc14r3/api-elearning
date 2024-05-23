<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Illuminate\Support\Str;

class QuestionController extends Controller {
    public function index($id, $module)
    {

        $questions = Question::where('course_id', $id)->where('module_id', $module)->whereNull('removed')->get();

        return response()->json($questions);
    }

    public function specialIndex($id)
    {

        $questions = Question::where('course_id', $id)->whereNull('removed')->get();

        return response()->json($questions);
    }

    public function show($id)
    {
        $question = Question::find($id);

        return response()->json($question, 200);
    }

    public function store(Request $request)
    {
        $question = new Question();
        $question->fill($request->all());
        $question->save();

        return response()->json($question, 201);
    }

    public function update(Request $request, $id)
    {
        $question = Question::find($id);
        $question->fill($request->all());
        $question->save();

        return response()->json($question, 200);
    }

    public function delete($id)
    {
        $question = Question::find($id);
        $question->removed = Str::uuid()->toString();
        $question->save();

        return response()->json($question, 200);
    }

    public function all()
    {
        $questions = Question::whereNull('removed')->get();
        return response()->json($questions);
    }
}
