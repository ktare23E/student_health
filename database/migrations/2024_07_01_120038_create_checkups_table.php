<?php

use App\Models\Nurse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Student;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('checkups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Nurse::class)->constrained()->onDelete('cascade');
            $table->string('student_grade_level');
            $table->string('student_age');
            $table->timestamp('date_of_checkup');
            $table->date('date_of_birth');
            $table->string('birth_place');
            $table->string('parent_name');
            $table->string('adviser_name');
            $table->string('address');
            $table->string('student_lrn');
            $table->string('region');
            $table->string('division');
            $table->string('telephone_no');
            $table->decimal('temperature', 5, 2);
            $table->integer('systolic');
            $table->integer('diastolic');
            $table->integer('heart_rate');
            $table->integer('pulse_rate');
            $table->integer('respiratory_rate');
            $table->decimal('height', 5, 2); // Adding height column
            $table->decimal('weight', 5, 2); // Adding weight column
            $table->string('bmi_weight');
            $table->string('bmi_height');
            $table->string('vision_screening');
            $table->string('auditory_screening');
            $table->string('skin');
            $table->string('scalp');
            $table->string('eyes');
            $table->string('ears');
            $table->string('nose');
            $table->string('mouth');
            $table->string('throat');
            $table->string('neck');
            $table->string('lungs');
            $table->string('heart');
            $table->string('abdomen');
            $table->string('deformities');
            $table->string('iron_supplementation');
            $table->string('deworming');
            $table->string('immunization');
            $table->string('sbfp_beneficiary');
            $table->string('4ps_beneficiary');
            $table->string('menarche');
            $table->string('others');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkups');
    }
};
