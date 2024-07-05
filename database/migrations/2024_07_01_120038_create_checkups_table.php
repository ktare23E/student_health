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
            $table->string('school_id');
            $table->string('region');
            $table->string('division');
            $table->string('telephone_no');
            $table->decimal('temperature', 5, 2)->nullable();
            $table->integer('systolic')->nullable();
            $table->integer('diastolic')->nullable();
            $table->integer('heart_rate')->nullable();
            $table->integer('pulse_rate')->nullable();
            $table->integer('respiratory_rate')->nullable();
            $table->decimal('height', 5, 2)->nullable(); // Adding height column
            $table->decimal('weight', 5, 2)->nullable(); // Adding weight column
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
            $table->string('throat')->nullable();
            $table->string('neck')->nullable();
            $table->string('lungs')->nullable();
            $table->string('heart')->nullable();
            $table->string('abdomen')->nullable();
            $table->string('deformities')->nullable();
            $table->string('iron_supplementation')->nullable();
            $table->string('deworming')->nullable();
            $table->string('immunization')->nullable();
            $table->string('sbfp_beneficiary')->nullable();
            $table->string('4ps_beneficiary')->nullable();
            $table->string('menarche')->nullable();
            $table->string('others')->nullable();
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
