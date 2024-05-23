<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model{
    protected $table = "courses";

    /** @var string[] */
    protected $fillable = [
        'description',
        'level',
        'area_id',
        'removed'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function teacherCourse()
    {
        return $this->hasMany(TeacherCourse::class, 'curso_id');
    }

    public function modules()
    {
        return $this->hasMany(Module::class, 'course_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'course_id');
    }

    public function material()
    {
        return $this->hasMany(File::class, 'course_id');
    }

    public function frequentQuestions()
    {
        return $this->hasMany(FrequentQuestionCourse::class, 'course_id');
    }

    public function posts()
    {
        return $this->hasMany(BlogCourse::class, 'course_id');
    }
}
