<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class WorksStudents extends Model{
    protected $table = "works_students";

    /** @var string[] */
    protected $fillable = [
        'work_id',
        'user_id',
        'file'
    ];

    public function works()
    {
        return $this->belongsTo(Work::class, 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
