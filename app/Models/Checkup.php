<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'nurse_id',
        'student_grade_level',
        'student_age',
        'date_of_checkup',
        'date_of_birth',
        'birth_place',
        'parent_name',
        'adviser_name',
        'school_id',
        'region',
        'division',
        'telephone_no',
        'temperature',
        'systolic',
        'diastolic',
        'heart_rate',
        'pulse_rate',
        'respiratory_rate',
        'height',
        'weight',
        'bmi_weight',
        'bmi_height',
        'vision_screening',
        'auditory_screening',
        'skin',
        'scalp',
        'eyes',
        'ears',
        'nose',
        'mouth',
        'heart',
        'lungs',
        'abdomen',
        'deformities',
        'iron_supplementation',
        'deworming',
        'immunization',
        'sbfp_beneficiary',
        '4ps_beneficiary',
        'menarche',
        'others',
        'remarks'
    ];
    
    public function student()
    {
        return $this->belongsTo(Student::class);
    }   

    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }
}
