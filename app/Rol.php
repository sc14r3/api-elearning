<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model{
    protected $table = "roles";

    /** @var string[] */
    protected $fillable = [
        'description',
        'removed'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id');
    }
}
