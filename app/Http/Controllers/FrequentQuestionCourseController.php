<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\FrequentQuestionCourse;
use Illuminate\Support\Str;

class FrequentQuestionCourseController extends Controller {
    public function index($id) // get
    {
        $questions = FrequentQuestionCourse::whereNull('removed')->where('course_id', $id)->get(); // SELECT * FROM courses

        return response()->json($questions);
    }

    public function show($id)
    {
        $question = FrequentQuestionCourse::find($id); // SELEC * WHERE id = $id FROM courses;

        return response()->json($question, 200);
    }

    public function store(Request $request)
    {
        $question = new FrequentQuestionCourse();
        $question->fill($request->all()); // INSERT INTO courses VALUES (1,2,3)
        $question->save();

        return response()->json($question, 201);
    }

    public function update(Request $request, $id)
    {
        $question = FrequentQuestionCourse::find($id);
        $question->fill($request->all()); // UPDATE courses SET (1,2,3)
        $question->save();

        return response()->json($question, 200);
    }

    public function delete($id)
    {
        $question = FrequentQuestionCourse::find($id);
        $question->removed = Str::uuid()->toString();
        $question->save();

        return response()->json($question, 200);
    }
}
