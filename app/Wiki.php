<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Wiki extends Model{
    protected $table = "wiki";

    /** @var string[] */
    protected $fillable = [
        'course_id',
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
