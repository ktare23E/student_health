<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'student_lrn',
        'first_name',
        'last_name',
        'address',
        'status',
        'grade_level',
        'date_of_birth',
        'birth_place',
        'parent_name',
        'cellphone_number',
        'region',
        'student_profile'
    ];


    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function checkups()
    {
        return $this->hasMany(Checkup::class);
    }
}
