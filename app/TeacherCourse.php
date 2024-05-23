<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeacherCourse extends Model{
    protected $table = "teacher_course";

    /** @var string[] */
    protected $fillable = [
        'user_id',
        'course_id',
        'date',
        'removed'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function courses()
    {
        return $this->belongsTo(Course::class, 'id');
    }

    public function material()
    {
        return $this->hasMany(File::class, 'teacher_course_id');
    }

    public function students()
    {
        return $this->hasMany(StudentCourse::class, 'teacher_course_id');
    }

    public function works()
    {
        return $this->hasMany(Work::class, 'teacher_course_id');
    }
}
