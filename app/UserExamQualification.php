<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExamQualification extends Model{
    protected $table = "user_exam_qualification";

    /** @var string[] */
    protected $fillable = [
        'exam_id',
        'user_id',
        'qualification'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'id');
    }
}
