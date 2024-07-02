<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'name',
        'address',
        'status'
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
        return $this->hasMany(Nurse::class)->where('type',Nurse::TYPE_SCHOOL);
    }
}
