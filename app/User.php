<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'last_name',
        'phone_number',
        'date_of_birth',
        'curp',
        'password',
        // 'coordinator_id',
        'api_token',
        'rol_id',
        'status',
        'removed'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    public function teacherCourse()
    {
        return $this->hasMany(TeacherCourse::class, 'user_id');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'id');
    }

    public function studentCourse()
    {
        return $this->hasMany(StudentCourse::class, 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(BlogCourse::class, 'user_id');
    }

    public function studentWork()
    {
        return $this->hasOne(WorksStudents::class, 'user_id');
    }
}
