<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'district_id',
        'status',
        'principal'
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function nurses()
    {
        return $this->hasMany(Nurse::class,'entity_id')->where('type',Nurse::TYPE_SCHOOL);
    }
}
