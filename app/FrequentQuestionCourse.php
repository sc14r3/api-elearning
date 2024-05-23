<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class FrequentQuestionCourse extends Model{
    protected $table = "frequent_questions_course";

    /** @var string[] */
    protected $fillable = [
        'course_id',
        'question',
        'answer',
        'removed'
    ];

    public function courses()
    {
        return $this->belongsTo(Course::class, 'id');
    }
}
