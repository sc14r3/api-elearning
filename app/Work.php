<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model{
    protected $table = "works";

    /** @var string[] */
    protected $fillable = [
        'teacher_course_id',
        'module_id',
        'description',
        'date',
        'removed'
    ];

    public function teacherCourses()
    {
        return $this->belongsTo(TeacherCourse::class, 'id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function studentWorks()
    {
        return $this->hasOne(WorksStudents::class, 'work_id');
    }
}
