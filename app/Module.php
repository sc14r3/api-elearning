<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model{
    protected $table = "modules";

    /** @var string[] */
    protected $fillable = [
        'number',
        'description',
        'course_id',
        'removed'
    ];

    public function courses()
    {
        return $this->belongsTo(Course::class, 'id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'id');
    }

    public function works()
    {
        return $this->hasMany(Work::class, 'id');
    }
}
