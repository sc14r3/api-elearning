<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentCourse extends Model{
    protected $table = "student_course";

    /** @var string[] */
    protected $fillable = [
        'user_id',
        'teacher_course_id',
        'date_of_inscription',
        'status',
        'removed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teacherCourses()
    {
        return $this->belongsTo(TeacherCourse::class, 'teacher_course_id');
    }
}
