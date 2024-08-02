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
            $table->string('student_grade_level')->nullable();
            $table->string('student_lrn')->nullable();
            $table->string('student_age');
            $table->timestamp('date_of_checkup')->nullable();
           
            $table->string('adviser_name')->nullable();

            $table->string('temperature')->nullable();
            $table->string('systolic')->nullable();
            $table->string('diastolic')->nullable();
            $table->string('heart_rate')->nullable();
            $table->string('pulse_rate')->nullable();
            $table->string('respiratory_rate')->nullable();
            $table->string('height')->nullable(); // Adding height column
            $table->string('weight')->nullable(); // Adding weight column
            $table->string('bmi_weight')->nullable();
            $table->string('bmi_height')->nullable();
            $table->string('vision_screening')->nullable();
            $table->string('auditory_screening')->nullable();
            $table->string('skin')->nullable();
            $table->string('scalp')->nullable();
            $table->string('eyes')->nullable();
            $table->string('ears')->nullable();
            $table->string('nose')->nullable();
            $table->string('mouth')->nullable();
            // $table->string('throat')->nullable();
            // $table->string('neck')->nullable();
            $table->string('lungs')->nullable();
            $table->string('heart')->nullable();
            $table->string('abdomen')->nullable();
            $table->string('deformities')->nullable();
            $table->string('iron_supplementation')->nullable();
            $table->string('deworming')->nullable();
            $table->string('immunization')->nullable();
            $table->string('sbfp_beneficiary')->nullable();
            $table->string('four_p_beneficiary')->nullable();
            $table->string('menarche')->nullable();
            // $table->string('others')->nullable();
            $table->string('remarks')->nullable();
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
