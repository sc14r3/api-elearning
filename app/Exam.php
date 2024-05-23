<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model{
    protected $table = "exams";

    /** @var string[] */
    protected $fillable = [
        'teacher_course_id',
        'type',
        'module_id',
        'description',
        'application_date',
        'removed'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class, 'id');
    }

    public function qualification()
    {
        return $this->hasOne(UserExamQualification::class, 'exam_id');
    }
}
