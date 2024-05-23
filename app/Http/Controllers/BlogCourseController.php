<?php
namespace App\Http\Controllers;

use App\BlogCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCourseController extends Controller {
    public function index($id) // get
    {
        $posts = BlogCourse::whereNull('removed')->where('course_id', $id)->get(); // SELECT * FROM courses

        return response()->json($posts);
    }

    public function show($id)
    {
        $post = BlogCourse::find($id); // SELEC * WHERE id = $id FROM courses;

        return response()->json($post, 200);
    }

    public function store(Request $request)
    {
        $post = new BlogCourse();
        $post->fill($request->all()); // INSERT INTO courses VALUES (1,2,3)
        $post->save();

        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = BlogCourse::find($id);
        $post->fill($request->all()); // UPDATE courses SET (1,2,3)
        $post->save();

        return response()->json($post, 200);
    }

    public function delete($id)
    {
        $post = BlogCourse::find($id);
        $post->removed = Str::uuid()->toString();
        $post->save();

        return response()->json($post, 200);
    }
}
