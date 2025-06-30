<?php

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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_no')->unique();
            $table->string('sntcssc_roll_no')->nullable();
            $table->string('programme_enrolled');
            $table->string('batch');
            $table->string('secondary_level_roll_no')->nullable();
            $table->string('cse_prelims_roll_no')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('alternate_email')->nullable();
            $table->string('mobile_no');
            $table->string('alternate_mobile_no')->nullable();
            $table->string('whatsapp_no')->nullable();
            $table->date('dob');
            $table->string('gender');
            $table->string('category');
            $table->enum('pwbd_status', ['yes', 'no'])->default('no');
            $table->text('pwbd_description')->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('students_occupation')->nullable();
            $table->string('fathers_occupation')->nullable();
            $table->string('mothers_occupation')->nullable();
            $table->string('medium_instruction')->nullable();
            $table->string('optional_subject')->nullable();
            $table->string('subject_graduation')->nullable();
            $table->string('institution_graduation')->nullable();
            $table->string('subject_post_graduation')->nullable();
            $table->string('institution_post_graduation')->nullable();
            $table->enum('appeared_upsc_cse', ['yes', 'no'])->default('no');
            $table->string('upsc_cse_years')->nullable();
            $table->enum('hostel_accommodation', ['yes', 'no'])->default('no');
            $table->enum('test_series', ['yes', 'no'])->default('no');
            $table->enum('currently_employed', ['yes', 'no'])->default('no');
            $table->text('employment_details')->nullable();
            $table->text('present_address')->nullable();
            $table->string('present_state')->nullable();
            $table->string('present_district')->nullable();
            $table->string('present_pincode')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('permanent_state')->nullable();
            $table->string('permanent_district')->nullable();
            $table->string('permanent_pincode')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
