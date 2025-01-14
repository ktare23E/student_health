<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'student_lrn',
        'nurse_id',
        'student_grade_level',
        'adviser_name',
        'student_age',
        'temperature',
        'systolic',
        'diastolic',
        'heart_rate',
        'pulse_rate',
        'respiratory_rate',
        'weight',
        'height',
        'bmi_weight',
        'bmi_height',
        'vision_screening',
        'auditory_screening',
        'skin',
        'scalp',
        'ears',
        'eyes',
        'nose',
        'mouth',
        'lungs',
        'heart',
        'abdomen',
        'deformities',
        'iron_supplementation',
        'deworming',
        'immunization',
        'sbfp_beneficiary',
        'four_p_beneficiary',
        'menarche',
        'remarks',
        'date_of_checkup'
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
