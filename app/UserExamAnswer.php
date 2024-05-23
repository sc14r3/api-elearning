<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExamAnswer extends Model{
    protected $table = "user_exam_answer";

    /** @var string[] */
    protected $fillable = [
        'exam_id',
        'exam_question_id',
        'user_id',
        'answer',
        'qualification'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function questions()
    {
        return $this->belongsTo(ExamQuestion::class, 'id');
    }
}
