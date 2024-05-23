<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCourse extends Model{
    protected $table = "blog_course";

    /** @var string[] */
    protected $fillable = [
        'course_id',
        'user_id',
        'title',
        'brief',
        'content',
        'removed'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
