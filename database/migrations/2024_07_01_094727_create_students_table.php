<?php

use App\Models\School;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(School::class)->constrained()->onDelete('cascade');
            $table->string('student_lrn')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->date('date_of_birth')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('cellphone_number')->nullable();
            $table->string('region')->nullable();
            $table->string('status');
            $table->string('grade_level');
            $table->string('student_profile')->nullable();
            $table->timestamps();

            // $table->string('school_id')->nullable();
            // $table->string('region')->nullable();
            // $table->string('division')->nullable();
            // $table->string('telephone_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
