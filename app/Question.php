<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model{
    protected $table = "questions";

    /** @var string[] */
    protected $fillable = [
        'course_id',
        'module_id',
        'type',
        'question',
        'option_1',
        'option_2',
        'option_3',
        'answer',
        'removed'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'id');
    }

    public function question()
    {
        return $this->hasMany(ExamQuestion::class, 'id');
    }
}
