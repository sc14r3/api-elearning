<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model{
    protected $table = "areas";

    /** @var string[] */
    protected $fillable = [
        'description',
        'removed'
    ];

    public function course()
    {
        return $this->hasMany(Course::class, 'id');
    }
}
