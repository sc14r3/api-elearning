<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model{
    protected $table = "files";

    /** @var string[] */
    protected $fillable = [
        'teacher_course_id',
        'module_id',
        'title',
        'description',
        'type',
        'route',
        'link',
        'removed'
    ];

    public function courses()
    {
        return $this->belongsTo(Course::class, 'id');
    }
}
