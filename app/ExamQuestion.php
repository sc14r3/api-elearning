<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model{
    protected $table = "exam_question";

    /** @var string[] */
    protected $fillable = [
        'exam_id',
        'question_id',
        'value',
        'removed'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
