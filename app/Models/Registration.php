<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use SoftDeletes;

    // The table associated with the model.
    // protected $table = 'registrations';

    // The attributes that are mass assignable.
    protected $fillable = [
        'registration_no',
        'sntcssc_roll_no',
        'programme_enrolled',
        'batch',
        'secondary_level_roll_no',
        'cse_prelims_roll_no',
        'first_name',
        'last_name',
        'email',
        'alternate_email',
        'mobile_no',
        'alternate_mobile_no',
        'whatsapp_no',
        'dob',
        'gender',
        'category',
        'pwbd_status',
        'pwbd_description',
        'fathers_name',
        'mothers_name',
        'students_occupation',
        'fathers_occupation',
        'mothers_occupation',
        'medium_instruction',
        'optional_subject',
        'subject_graduation',
        'institution_graduation',
        'subject_post_graduation',
        'institution_post_graduation',
        'appeared_upsc_cse',
        'upsc_cse_years',
        'hostel_accommodation',
        'test_series',
        'currently_employed',
        'employment_details',
        'present_address',
        'present_state',
        'present_district',
        'present_pincode',
        'permanent_address',
        'permanent_state',
        'permanent_district',
        'permanent_pincode',
    ];


    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // If you want to enable SoftDeletes, we use the 'SoftDeletes' trait.
    // This will allow you to delete records without removing them from the database,
    // and you can restore them later.

    protected $dates = ['deleted_at'];

    // Optionally, you can add mutators, accessors, or relationships here if needed

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}