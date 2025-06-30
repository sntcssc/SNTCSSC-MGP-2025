<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;

class RegistrationForm extends Component
{
    use WithFileUploads;

    // Form fields
    public $registration_no = '';
    public $sntcssc_roll_no = '';
    public $programme_enrolled = '';
    public $batch = '';
    public $secondary_level_roll_no = '';
    public $cse_prelims_roll_no = '';
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $alternate_email = '';
    public $mobile_no = '';
    public $alternate_mobile_no = '';
    public $whatsapp_no = '';
    public $dob = '';
    public $gender = '';
    public $category = '';
    public $pwbd_status = '';
    public $pwbd_description = '';
    public $fathers_name = '';
    public $mothers_name = '';
    public $students_occupation = '';
    public $fathers_occupation = '';
    public $mothers_occupation = '';
    public $medium_of_instruction = '';
    public $optional_subject = '';
    public $subject_in_graduation = '';
    public $institution_graduation = '';
    public $subject_in_post_graduation = '';
    public $institution_post_graduation = '';
    public $appeared_in_upsc_cse = '';
    public $upsc_cse_years = '';
    public $need_hostel = '';
    public $take_test_series = '';
    public $currently_employed = '';
    public $employment_details = '';

    // Address fields
    public $present_address = [
        'full_address' => '',
        'state' => '',
        'district' => '',
        'pincode' => '',
    ];
    public $permanent_address = [
        'full_address' => '',
        'state' => '',
        'district' => '',
        'pincode' => '',
    ];
    public $same_address = false;

    // Document uploads
    public $photo;
    public $identity_document;
    public $secondary_admit_card;
    public $upsc_prelims_admit_card;
    public $upsc_daf_mains;
    public $others_documents = [];

    // Preview and submission
    public $showPreview = false;
    public $confirmSubmission = false;

    // States and districts
    public $states = [
        'Andhra Pradesh',
        'Arunachal Pradesh',
        'Assam',
        'Bihar',
        'Chhattisgarh',
        'Goa',
        'Gujarat',
        'Haryana',
        'Himachal Pradesh',
        'Jharkhand',
        'Karnataka',
        'Kerala',
        'Madhya Pradesh',
        'Maharashtra',
        'Manipur',
        'Meghalaya',
        'Mizoram',
        'Nagaland',
        'Odisha',
        'Punjab',
        'Rajasthan',
        'Sikkim',
        'Tamil Nadu',
        'Telangana',
        'Tripura',
        'Uttar Pradesh',
        'Uttarakhand',
        'West Bengal',
        'Andaman and Nicobar Islands',
        'Chandigarh',
        'Dadra and Nagar Haveli and Daman and Diu',
        'Delhi',
        'Jammu and Kashmir',
        'Ladakh',
        'Lakshadweep',
        'Puducherry'
    ];

    public $districts = [
        'Uttar Pradesh' => ['Lucknow', 'Kanpur', 'Varanasi', 'Agra', 'Ghaziabad'],
        'Maharashtra' => ['Mumbai', 'Pune', 'Nagpur', 'Thane', 'Nashik'],
        'Bihar' => ['Patna', 'Gaya', 'Muzaffarpur', 'Bhagalpur', 'Darbhanga'],
        // Add more states and districts as needed
        'default' => ['Other']
    ];

    public $present_districts = ['Select District'];
    public $permanent_districts = ['Select District'];

    protected $rules = [
        'registration_no' => 'required|string|max:255',
        'sntcssc_roll_no' => 'required|string|max:255',
        'programme_enrolled' => 'required|in:Composite Course,Mains Guidance Programme,Prelims Crash Course',
        'batch' => 'required|in:2020,2021,2022,2023,2024,2025',
        'secondary_level_roll_no' => 'required|string|max:255',
        'cse_prelims_roll_no' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'alternate_email' => 'nullable|email|max:255',
        'mobile_no' => 'required|string|regex:/^[0-9]{10}$/',
        'alternate_mobile_no' => 'nullable|string|regex:/^[0-9]{10}$/',
        'whatsapp_no' => 'required|string|regex:/^[0-9]{10}$/',
        'dob' => 'required|date',
        'gender' => 'required|in:Male,Female,Other',
        'category' => 'required|in:UR,SC,ST,OBC',
        'pwbd_status' => 'required|in:0,1',
        'pwbd_description' => 'required_if:pwbd_status,1|string|max:255|nullable',
        'fathers_name' => 'required|string|max:255',
        'mothers_name' => 'required|string|max:255',
        'students_occupation' => 'required|string|max:255',
        'fathers_occupation' => 'required|string|max:255',
        'mothers_occupation' => 'required|string|max:255',
        'medium_of_instruction' => 'required|string|max:255',
        'optional_subject' => 'required|string',
        'subject_in_graduation' => 'required|string|max:255',
        'institution_graduation' => 'required|string|max:255',
        'subject_in_post_graduation' => 'nullable|string|max:255',
        'institution_post_graduation' => 'nullable|string|max:255',
        'appeared_in_upsc_cse' => 'required|in:0,1',
        'upsc_cse_years' => 'required_if:appeared_in_upsc_cse,1|string|max:255|nullable',
        'need_hostel' => 'required|in:0,1',
        'take_test_series' => 'required|in:0,1',
        'currently_employed' => 'required|in:0,1',
        'employment_details' => 'required_if:currently_employed,1|string|max:255|nullable',
        'present_address.full_address' => 'required|string|max:255',
        'present_address.state' => 'required|string|max:255',
        'present_address.district' => 'required|string|max:255',
        'present_address.pincode' => 'required|string|regex:/^[0-9]{6}$/',
        'permanent_address.full_address' => 'required|string|max:255',
        'permanent_address.state' => 'required|string|max:255',
        'permanent_address.district' => 'required|string|max:255',
        'permanent_address.pincode' => 'required|string|regex:/^[0-9]{6}$/',
        'photo' => 'required|image|mimes:jpg,png|max:1024',
        'identity_document' => 'required|file|mimes:pdf,jpg,png|max:2048',
        'secondary_admit_card' => 'required|file|mimes:pdf,jpg,png|max:2048',
        'upsc_prelims_admit_card' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        'upsc_daf_mains' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        'others_documents.*' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    ];

    public function updated($propertyName)
    {
        // Validate only the updated field in real-time
        $this->validateOnly($propertyName);
    }

    public function updatedSameAddress()
    {
        if ($this->same_address) {
            $this->permanent_address = $this->present_address;
            $this->permanent_districts = $this->districts[$this->present_address['state']] ?? $this->districts['default'];
        }
    }

    public function updatedPresentAddressState()
    {
        $this->present_districts = $this->districts[$this->present_address['state']] ?? $this->districts['default'];
        $this->present_address['district'] = '';
        if ($this->same_address) {
            $this->permanent_address = $this->present_address;
            $this->permanent_districts = $this->present_districts;
        }
    }

    public function updatedPermanentAddressState()
    {
        $this->permanent_districts = $this->districts[$this->permanent_address['state']] ?? $this->districts['default'];
        $this->permanent_address['district'] = '';
    }

    public function updatePresentDistricts()
    {
        $this->updatedPresentAddressState();
    }

    public function updatePermanentDistricts()
    {
        $this->updatedPermanentAddressState();
    }

    public function validateForm()
    {
        $this->validate();
    }

    public function storeFile($file, $type)
    {
        if ($file) {
            $filename = $file->store('documents', 'public');
            return [
                'type' => $type,
                'file_path' => $filename,
            ];
        }
        return null;
    }

    public function preview()
    {
        $this->validateForm();
        $this->showPreview = true;
    }

    public function resetForm()
    {
        $this->reset([
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
            'medium_of_instruction',
            'optional_subject',
            'subject_in_graduation',
            'institution_graduation',
            'subject_in_post_graduation',
            'institution_post_graduation',
            'appeared_in_upsc_cse',
            'upsc_cse_years',
            'need_hostel',
            'take_test_series',
            'currently_employed',
            'employment_details',
            'present_address',
            'permanent_address',
            'same_address',
            'photo',
            'identity_document',
            'secondary_admit_card',
            'upsc_prelims_admit_card',
            'upsc_daf_mains',
            'others_documents',
            'showPreview',
            'confirmSubmission',
        ]);
        $this->present_districts = ['Select District'];
        $this->permanent_districts = ['Select District'];
    }

    public function edit()
    {
        $this->showPreview = false;
        $this->confirmSubmission = false;
    }

    public function confirm()
    {
        $this->validateForm();
        $this->confirmSubmission = true;
    }

    public function submit()
    {
        $this->validateForm();

        DB::transaction(function () {
            // Store registration
            $registration = \App\Models\Registration::create([
                'registration_no' => $this->registration_no,
                'sntcssc_roll_no' => $this->sntcssc_roll_no,
                'programme_enrolled' => $this->programme_enrolled,
                'batch' => $this->batch,
                'secondary_level_roll_no' => $this->secondary_level_roll_no,
                'cse_prelims_roll_no' => $this->cse_prelims_roll_no,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'alternate_email' => $this->alternate_email,
                'mobile_no' => $this->mobile_no,
                'alternate_mobile_no' => $this->alternate_mobile_no,
                'whatsapp_no' => $this->whatsapp_no,
                'dob' => $this->dob,
                'gender' => $this->gender,
                'category' => $this->category,
                'pwbd_status' => $this->pwbd_status,
                'pwbd_description' => $this->pwbd_description,
                'fathers_name' => $this->fathers_name,
                'mothers_name' => $this->mothers_name,
                'students_occupation' => $this->students_occupation,
                'fathers_occupation' => $this->fathers_occupation,
                'mothers_occupation' => $this->mothers_occupation,
                'medium_of_instruction' => $this->medium_of_instruction,
                'optional_subject' => $this->optional_subject,
                'subject_in_graduation' => $this->subject_in_graduation,
                'institution_graduation' => $this->institution_graduation,
                'subject_in_post_graduation' => $this->subject_in_post_graduation,
                'institution_post_graduation' => $this->institution_post_graduation,
                'appeared_in_upsc_cse' => $this->appeared_in_upsc_cse,
                'upsc_cse_years' => $this->upsc_cse_years,
                'need_hostel' => $this->need_hostel,
                'take_test_series' => $this->take_test_series,
                'currently_employed' => $this->currently_employed,
                'employment_details' => $this->employment_details,
            ]);

            // Store addresses
            \App\Models\Address::create([
                'registration_id' => $registration->id,
                'type' => 'Present',
                'full_address' => $this->present_address['full_address'],
                'state' => $this->present_address['state'],
                'district' => $this->present_address['district'],
                'pincode' => $this->present_address['pincode'],
            ]);

            \App\Models\Address::create([
                'registration_id' => $registration->id,
                'type' => 'Permanent',
                'full_address' => $this->permanent_address['full_address'],
                'state' => $this->permanent_address['state'],
                'district' => $this->permanent_address['district'],
                'pincode' => $this->permanent_address['pincode'],
            ]);

            // Store documents
            $documents = [];

            if ($this->photo) {
                $documents[] = $this->storeFile($this->photo, 'Photo');
            }
            if ($this->identity_document) {
                $documents[] = $this->storeFile($this->identity_document, 'Identity Document');
            }
            if ($this->secondary_admit_card) {
                $documents[] = $this->storeFile($this->secondary_admit_card, 'Secondary Admit Card');
            }
            if ($this->upsc_prelims_admit_card) {
                $documents[] = $this->storeFile($this->upsc_prelims_admit_card, 'UPSC Prelims Admit Card');
            }
            if ($this->upsc_daf_mains) {
                $documents[] = $this->storeFile($this->upsc_daf_mains, 'UPSC DAF Mains');
            }
            foreach ($this->others_documents as $index => $file) {
                if ($file) {
                    $documents[] = $this->storeFile($file, 'Other Document ' . ($index + 1));
                }
            }

            foreach ($documents as $document) {
                if ($document) {
                    \App\Models\Document::create([
                        'registration_id' => $registration->id,
                        'type' => $document['type'],
                        'file_path' => $document['file_path'],
                    ]);
                }
            }

            // Generate PDF
            $pdf = PDF::loadView('pdf.application', ['registration' => $registration]);
            $pdfPath = 'registrations/pdf/' . $registration->registration_no . '.pdf';
            Storage::disk('public')->put($pdfPath, $pdf->output());

            // Update registration with PDF path
            $registration->update(['pdf_path' => $pdfPath]);
        });

        // Mail::to($this->registration->email)->queue(new RegistrationConfirmation($this->registration));

        session()->flash('message', 'Registration submitted successfully!');

        $this->resetForm();
        // return redirect()->route('thank-you', ['registration_id' => $this->registration->id]);
    }

    public function render()
    {
        return view('livewire.registration-form');
    }
}