<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($registration) ? 'Edit Registration - SNTCSSC' : 'Registration Form - SNTCSSC' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .header {
            background: #0d6efd;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .header img {
            max-width: 80px;
            border-radius: 50%;
        }
        .form-container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            animation: fadeIn 1s ease-in-out;
        }
        .section-title {
            background-color: #0d6efd;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 500;
        }
        .form-control, .form-select {
            border-radius: 4px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 8px rgba(0,74,173,0.3);
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            border-radius: 4px;
            padding: 4px 20px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0d6efd;
        }
        .btn-success:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }
        .spinner-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .spinner-overlay.show {
            display: flex;
        }
        .preview-table th, .preview-table td, .document-table th, .document-table td {
            border: 1px solid #dee2e6;
            padding: 10px;
            vertical-align: middle;
        }
        .preview-table th, .document-table th {
            background-color: #e9ecef;
            font-weight: bold;
            cursor: pointer;
        }
        .document-preview {
            max-width: 100px;
            height: auto;
            border-radius: 4px;
        }
        .invalid-feedback {
            display: none;
            font-size: 0.875rem;
            color: #dc3545;
        }
        .is-invalid ~ .invalid-feedback {
            display: block;
        }
        .progress {
            height: 8px;
            margin-top: 10px;
            display: none;
        }
        .progress.show {
            display: block;
        }
        .mandatory-status .badge {
            margin-right: 10px;
        }
        .tooltip-inner {
            max-width: 200px;
            background-color: #0d6efd;
        }
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 768px) {
            .form-container {
                margin: 15px;
                padding: 15px;
            }
            .header {
                padding: 15px;
            }
            .section-title {
                font-size: 1.25rem;
            }
        }
        .disabled-select {
            pointer-events: none;
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <div class="header">
        @if (app()->environment('local'))
            <img src="{{ asset('images/logo.png') }}" alt="SNTCSSC Logo">
        @else
            <img src="{{ url('public/images/logo.png') }}" alt="SNTCSSC Logo">
        @endif
        <h1 class="mt-2">Satyendra Nath Tagore Civil Services Study Centre (SNTCSSC)</h1>
        <p>NSATI Campus, FC Block, Sector - 3, Salt Lake, Kolkata - 700106</p>
    </div>
    <div class="form-container">
        <h2 class="text-center mb-4">{{ isset($registration) ? 'Edit Registration for SNTCSSC Mains Guidance Programme (MGP) 2025 Batch' : 'Registration Form for SNTCSSC Mains Guidance Programme (MGP) 2025 Batch' }}</h2>
        <form id="registrationForm" action="{{ isset($registration) ? route('register.update', $registration->id) : route('register.store') }}" method="POST">
            @csrf
            <input type="hidden" id="documents" name="documents" value="{{ isset($registration) ? json_encode($registration->documents->map(function($doc) { return ['type' => $doc->type, 'path' => $doc->path, 'url' => $doc->url, 'name' => $doc->name]; })->toArray()) : '[]' }}">
            <!-- Programme Details -->
            <div class="section-title">Enrollment Programme Details</div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="programme_enrolled" class="form-label">Programme Enrolled <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Select the programme you are enrolling in."></i>
                    </label>
                    @php
                        $programmes = [
                            'Composite Course',
                            'Mains Guidance Programme',
                            'Prelims Crash Course'
                        ];
                    @endphp
                    <select class="form-select disabled-select" id="programme_enrolled" name="programme_enrolled" required aria-label="Programme Enrolled">
                        <option value="">Select Programme</option>
                        @foreach($programmes as $programme)
                            <option value="{{ $programme }}" {{ isset($registration) && $registration->programme_enrolled == $programme ? 'selected' : ($programme == 'Mains Guidance Programme' && !isset($registration) ? 'selected' : '') }}>{{ $programme }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select a programme.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="batch" class="form-label">Batch <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Select the batch year."></i>
                    </label>
                    <select class="form-select disabled-select" id="batch" name="batch" required aria-label="Batch">
                        <option value="">Select Batch</option>
                        @foreach(range(2020, 2025) as $year)
                            <option value="{{ $year }}" {{ isset($registration) && $registration->batch == $year ? 'selected' : ($year == 2025 && !isset($registration) ? 'selected' : '') }}>{{ $year }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select a batch.</div>
                </div>
                <div class="col-md-6 mb-3 d-none">
                    <label for="sntcssc_roll_no" class="form-label">SNTCSSC Roll No.
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your SNTCSSC roll number, if applicable."></i>
                    </label>
                    <input type="text" class="form-control" id="sntcssc_roll_no" name="sntcssc_roll_no" value="{{ isset($registration) ? $registration->sntcssc_roll_no : '' }}" placeholder="Enter Roll No." aria-label="SNTCSSC Roll No.">
                    <div class="invalid-feedback">Invalid roll number.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="secondary_level_roll_no" class="form-label">Roll No. of Secondary (10th) Level
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your secondary level roll number, if applicable."></i>
                    </label>
                    <input type="text" class="form-control" id="secondary_level_roll_no" name="secondary_level_roll_no" value="{{ isset($registration) ? $registration->secondary_level_roll_no : '' }}" placeholder="Enter Roll No." aria-label="Secondary Level Roll No." pattern="[A-Za-z0-9]+" oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '')" required>
                    <div class="invalid-feedback">Invalid roll number.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cse_prelims_roll_no" class="form-label">Roll No. UPSC CSE 2025 (Prelims)
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your CSE Prelims roll number, if applicable."></i>
                    </label>
                    <input type="text" class="form-control" id="cse_prelims_roll_no" name="cse_prelims_roll_no" value="{{ isset($registration) ? $registration->cse_prelims_roll_no : '' }}" placeholder="Enter Roll No." aria-label="CSE Prelims Roll No." required>
                    <div class="invalid-feedback">Invalid roll number.</div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="section-title">Personal Information</div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label">First Name <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your first name."></i>
                    </label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ isset($registration) ? $registration->first_name : '' }}" placeholder="Enter First Name" required aria-label="First Name">
                    <div class="invalid-feedback">Please enter a valid first name (letters only).</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your last name."></i>
                    </label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ isset($registration) ? $registration->last_name : '' }}" placeholder="Enter Last Name" required aria-label="Last Name">
                    <div class="invalid-feedback">Please enter a valid last name (letters only).</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your primary email address."></i>
                    </label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ isset($registration) ? $registration->email : '' }}" placeholder="Enter Email" required aria-label="Email">
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="alternate_email" class="form-label">Alternate Email
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter an alternate email, if any."></i>
                    </label>
                    <input type="email" class="form-control" id="alternate_email" name="alternate_email" value="{{ isset($registration) ? $registration->alternate_email : '' }}" placeholder="Enter Alternate Email" aria-label="Alternate Email">
                    <div class="invalid-feedback">Please enter a valid alternate email address.</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="mobile_no" class="form-label">Mobile No. <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your 10-digit mobile number."></i>
                    </label>
                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ isset($registration) ? $registration->mobile_no : '' }}" placeholder="Enter 10-digit Mobile No." required aria-label="Mobile No.">
                    <div class="invalid-feedback">Please enter a valid 10-digit mobile number starting with 6-9.</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="alternate_mobile_no" class="form-label">Alternate Mobile No.
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter an alternate mobile number, if any."></i>
                    </label>
                    <input type="text" class="form-control" id="alternate_mobile_no" name="alternate_mobile_no" value="{{ isset($registration) ? $registration->alternate_mobile_no : '' }}" placeholder="Enter Alternate Mobile No." aria-label="Alternate Mobile No.">
                    <div class="invalid-feedback">Please enter a valid 10-digit alternate mobile number starting with 6-9.</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="whatsapp_no" class="form-label">WhatsApp No.
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your WhatsApp number, if different."></i>
                    </label>
                    <input type="text" class="form-control" id="whatsapp_no" name="whatsapp_no" value="{{ isset($registration) ? $registration->whatsapp_no : '' }}" placeholder="Enter WhatsApp No." aria-label="WhatsApp No.">
                    <div class="invalid-feedback">Please enter a valid 10-digit WhatsApp number starting with 6-9.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Select your date of birth."></i>
                    </label>
                    <input type="date" class="form-control" id="dob" name="dob" value="{{ isset($registration) ? $registration->dob : '' }}" required aria-label="Date of Birth">
                    <div class="invalid-feedback">Please select a valid date of birth before today.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="gender" class="form-label">Gender <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Select your gender."></i>
                    </label>
                    <select class="form-select" id="gender" name="gender" required aria-label="Gender">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ isset($registration) && $registration->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ isset($registration) && $registration->gender == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ isset($registration) && $registration->gender == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    <div class="invalid-feedback">Please select a gender.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="category" class="form-label">Category <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Select your category."></i>
                    </label>
                    <select class="form-select" id="category" name="category" required aria-label="Category">
                        <option value="">Select Category</option>
                        <option value="UR" {{ isset($registration) && $registration->category == 'UR' ? 'selected' : '' }}>UR</option>
                        <option value="SC" {{ isset($registration) && $registration->category == 'SC' ? 'selected' : '' }}>SC</option>
                        <option value="ST" {{ isset($registration) && $registration->category == 'ST' ? 'selected' : '' }}>ST</option>
                        <option value="OBC" {{ isset($registration) && $registration->category == 'OBC' ? 'selected' : '' }}>OBC</option>
                    </select>
                    <div class="invalid-feedback">Please select a category.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pwbd_status" class="form-label">PwBD Status <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Indicate if you are a Person with Benchmark Disability."></i>
                    </label>
                    <select class="form-select" id="pwbd_status" name="pwbd_status" required aria-label="PwBD Status">
                        <option value="">Select Status</option>
                        <option value="yes" {{ isset($registration) && $registration->pwbd_status == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ isset($registration) && $registration->pwbd_status == 'no' ? 'selected' : '' }}>No</option>
                    </select>
                    <div class="invalid-feedback">Please select PwBD status.</div>
                </div>
                <div class="col-md-12 mb-3" id="pwbd_description_div" style="{{ isset($registration) && $registration->pwbd_status == 'yes' ? '' : 'display: none;' }}">
                    <label for="pwbd_description" class="form-label">PwBD Description <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Provide details of your disability."></i>
                    </label>
                    <textarea class="form-control" id="pwbd_description" name="pwbd_description" placeholder="Describe PwBD details" aria-label="PwBD Description">{{ isset($registration) ? $registration->pwbd_description : '' }}</textarea>
                    <div class="invalid-feedback">Please provide PwBD description.</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="students_occupation" class="form-label">Student's Occupation
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your current occupation, if any."></i>
                    </label>
                    <input type="text" class="form-control" id="students_occupation" name="students_occupation" value="{{ isset($registration) ? $registration->students_occupation : '' }}" placeholder="Enter Occupation" aria-label="Student's Occupation">
                    <div class="invalid-feedback">Invalid occupation.</div>
                </div>
            </div>

            <!-- Parents Information -->
            <div class="section-title">Parents Information</div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fathers_name" class="form-label">Father's Name <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your father's full name."></i>
                    </label>
                    <input type="text" class="form-control" id="fathers_name" name="fathers_name" value="{{ isset($registration) ? $registration->fathers_name : '' }}" placeholder="Enter Father's Name" required aria-label="Father's Name">
                    <div class="invalid-feedback">Please enter a valid father's name (letters only).</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mothers_name" class="form-label">Mother's Name <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your mother's full name."></i>
                    </label>
                    <input type="text" class="form-control" id="mothers_name" name="mothers_name" value="{{ isset($registration) ? $registration->mothers_name : '' }}" placeholder="Enter Mother's Name" required aria-label="Mother's Name">
                    <div class="invalid-feedback">Please enter a valid mother's name (letters only).</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fathers_occupation" class="form-label">Father's Occupation
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your father's occupation."></i>
                    </label>
                    <input type="text" class="form-control" id="fathers_occupation" name="fathers_occupation" value="{{ isset($registration) ? $registration->fathers_occupation : '' }}" placeholder="Enter Occupation" aria-label="Father's Occupation" required>
                    <div class="invalid-feedback">Invalid occupation.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mothers_occupation" class="form-label">Mother's Occupation
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your mother's occupation."></i>
                    </label>
                    <input type="text" class="form-control" id="mothers_occupation" name="mothers_occupation" value="{{ isset($registration) ? $registration->mothers_occupation : '' }}" placeholder="Enter Occupation" aria-label="Mother's Occupation" required>
                    <div class="invalid-feedback">Invalid occupation.</div>
                </div>
            </div>

            <!-- Academic Information -->
            <div class="section-title">Academic Information</div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="medium_instruction" class="form-label">Medium of Instruction at School Level <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter the medium of instruction at school for your studies."></i>
                    </label>
                    <input type="text" class="form-control" id="medium_instruction" name="medium_instruction" value="{{ isset($registration) ? $registration->medium_instruction : '' }}" placeholder="e.g., English" required aria-label="Medium of Instruction">
                    <div class="invalid-feedback">Please enter medium of instruction at School.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="optional_subject" class="form-label">Optional Subject
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Select your optional subject for UPSC, if any."></i>
                    </label>
                    <select class="form-select" id="optional_subject" name="optional_subject" aria-label="Optional Subject" required>
                        <option value="">Select Subject</option>
                        @foreach($optionalSubjects as $subject)
                            <option value="{{ $subject }}" {{ isset($registration) && $registration->optional_subject == $subject ? 'selected' : '' }}>{{ $subject }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Invalid subject.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="subject_graduation" class="form-label">Subject in Graduation
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your graduation subject."></i>
                    </label>
                    <input type="text" class="form-control" id="subject_graduation" name="subject_graduation" value="{{ isset($registration) ? $registration->subject_graduation : '' }}" placeholder="e.g., History" aria-label="Subject in Graduation" required>
                    <div class="invalid-feedback">Invalid subject.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="institution_graduation" class="form-label">Institution (Graduation)
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your graduation institution."></i>
                    </label>
                    <input type="text" class="form-control" id="institution_graduation" name="institution_graduation" value="{{ isset($registration) ? $registration->institution_graduation : '' }}" placeholder="e.g., Delhi University" aria-label="Institution (Graduation)" required>
                    <div class="invalid-feedback">Invalid institution name.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="subject_post_graduation" class="form-label">Subject in Post Graduation
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your post-graduation subject, if any."></i>
                    </label>
                    <input type="text" class="form-control" id="subject_post_graduation" name="subject_post_graduation" value="{{ isset($registration) ? $registration->subject_post_graduation : '' }}" placeholder="e.g., Public Administration" aria-label="Subject in Post Graduation">
                    <div class="invalid-feedback">Invalid subject.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="institution_post_graduation" class="form-label">Institution (Post Graduation)
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your post-graduation institution, if any."></i>
                    </label>
                    <input type="text" class="form-control" id="institution_post_graduation" name="institution_post_graduation" value="{{ isset($registration) ? $registration->institution_post_graduation : '' }}" placeholder="e.g., University of Calcutta" aria-label="Institution (Post Graduation)">
                    <div class="invalid-feedback">Invalid institution name.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="appeared_upsc_cse" class="form-label">Have you appeared in UPSC CSE earlier?<span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Indicate if you have appeared in UPSC CSE earlier."></i>
                    </label>
                    <select class="form-select" id="appeared_upsc_cse" name="appeared_upsc_cse" required aria-label="Have you appeared in UPSC CSE earlier?">
                        <option value="">Select Status</option>
                        <option value="yes" {{ isset($registration) && $registration->appeared_upsc_cse == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ isset($registration) && $registration->appeared_upsc_cse == 'no' ? 'selected' : '' }}>No</option>
                    </select>
                    <div class="invalid-feedback">Please select UPSC CSE status.</div>
                </div>
                <div class="col-md-6 mb-3" id="upsc_cse_years_div" style="{{ isset($registration) && $registration->appeared_upsc_cse == 'yes' ? '' : 'display: none;' }}">
                    <label for="upsc_cse_years" class="form-label">If yes, please mention the year / years <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter the years you appeared in UPSC CSE."></i>
                    </label>
                    <input type="text" class="form-control" id="upsc_cse_years" name="upsc_cse_years" value="{{ isset($registration) ? $registration->upsc_cse_years : '' }}" placeholder="e.g., 2020, 2021" aria-label="UPSC CSE Years">
                    <div class="invalid-feedback">Please enter valid years (e.g., 2020, 2021).</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="hostel_accommodation" class="form-label">Do you need hostel accommodation? <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Indicate if you need hostel accommodation."></i>
                    </label>
                    <select class="form-select" id="hostel_accommodation" name="hostel_accommodation" required aria-label="Hostel Accommodation">
                        <option value="">Select Status</option>
                        <option value="yes" {{ isset($registration) && $registration->hostel_accommodation == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ isset($registration) && $registration->hostel_accommodation == 'no' ? 'selected' : '' }}>No</option>
                    </select>
                    <div class="invalid-feedback">Please select hostel accommodation status.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="test_series" class="form-label">Do you wish to take Test Series? <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Indicate if you are enrolled in the test series."></i>
                    </label>
                    <select class="form-select" id="test_series" name="test_series" required aria-label="Test Series">
                        <option value="">Select Status</option>
                        <option value="yes" {{ isset($registration) && $registration->test_series == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ isset($registration) && $registration->test_series == 'no' ? 'selected' : '' }}>No</option>
                    </select>
                    <div class="invalid-feedback">Please select test series status.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="currently_employed" class="form-label">Currently Employed <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Indicate if you are currently employed."></i>
                    </label>
                    <select class="form-select" id="currently_employed" name="currently_employed" required aria-label="Currently Employed">
                        <option value="">Select Status</option>
                        <option value="yes" {{ isset($registration) && $registration->currently_employed == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ isset($registration) && $registration->currently_employed == 'no' ? 'selected' : '' }}>No</option>
                    </select>
                    <div class="invalid-feedback">Please select employment status.</div>
                </div>
                <div class="col-md-6 mb-3" id="employment_details_div" style="{{ isset($registration) && $registration->currently_employed == 'yes' ? '' : 'display: none;' }}">
                    <label for="employment_details" class="form-label">Employment Details <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Provide details of your current employment."></i>
                    </label>
                    <textarea class="form-control" id="employment_details" name="employment_details" placeholder="Describe employment details" aria-label="Employment Details">{{ isset($registration) ? $registration->employment_details : '' }}</textarea>
                    <div class="invalid-feedback">Please provide employment details.</div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="section-title">Address Information</div>
            <h5>Present Address</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="present_state" class="form-label">State <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Select your current state."></i>
                    </label>
                    <select class="form-select" id="present_state" name="present_state" required aria-label="Present State">
                        <option value="">Select State</option>
                        @foreach($states as $state)
                            <option value="{{ $state }}" {{ isset($registration) && $registration->present_state == $state ? 'selected' : '' }}>{{ $state }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select a state.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="present_district" class="form-label">District <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Select your current district."></i>
                    </label>
                    <select class="form-select" id="present_district" name="present_district" required aria-label="Present District">
                        <option value="">Select District</option>
                        @if(isset($registration))
                            @foreach($districts[$registration->present_state] ?? [] as $district)
                                <option value="{{ $district }}" {{ $registration->present_district == $district ? 'selected' : '' }}>{{ $district }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="invalid-feedback">Please select a district.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="present_address" class="form-label">Full Address <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your current full address."></i>
                    </label>
                    <textarea class="form-control" id="present_address" name="present_address" placeholder="Enter Full Address" required aria-label="Present Address">{{ isset($registration) ? $registration->present_address : '' }}</textarea>
                    <div class="invalid-feedback">Please enter a valid address.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="present_pincode" class="form-label">Pincode <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your 6-digit pincode."></i>
                    </label>
                    <input type="text" class="form-control" id="present_pincode" name="present_pincode" value="{{ isset($registration) ? $registration->present_pincode : '' }}" placeholder="Enter 6-digit Pincode" required aria-label="Present Pincode">
                    <div class="invalid-feedback">Please enter a valid 6-digit pincode.</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="same_address" aria-label="Same as Present Address" {{ isset($registration) && $registration->present_address == $registration->permanent_address && $registration->present_state == $registration->permanent_state && $registration->present_district == $registration->permanent_district && $registration->present_pincode == $registration->permanent_pincode ? 'checked' : '' }}>
                    <label class="form-check-label" for="same_address">Permanent address same as present
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Check if your permanent address is the same as your present address."></i>
                    </label>
                </div>
            </div>
            <h5>Permanent Address</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="permanent_state" class="form-label">State <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Select your permanent state."></i>
                    </label>
                    <select class="form-select" id="permanent_state" name="permanent_state" required aria-label="Permanent State">
                        <option value="">Select State</option>
                        @foreach($states as $state)
                            <option value="{{ $state }}" {{ isset($registration) && $registration->permanent_state == $state ? 'selected' : '' }}>{{ $state }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select a state.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="permanent_district" class="form-label">District <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Select your permanent district."></i>
                    </label>
                    <select class="form-select" id="permanent_district" name="permanent_district" required aria-label="Permanent District">
                        <option value="">Select District</option>
                        @if(isset($registration))
                            @foreach($districts[$registration->permanent_state] ?? [] as $district)
                                <option value="{{ $district }}" {{ $registration->permanent_district == $district ? 'selected' : '' }}>{{ $district }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="invalid-feedback">Please select a district.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="permanent_address" class="form-label">Full Address <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your permanent full address."></i>
                    </label>
                    <textarea class="form-control" id="permanent_address" name="permanent_address" placeholder="Enter Full Address" required aria-label="Permanent Address">{{ isset($registration) ? $registration->permanent_address : '' }}</textarea>
                    <div class="invalid-feedback">Please enter a valid address.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="permanent_pincode" class="form-label">Pincode <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your 6-digit permanent pincode."></i>
                    </label>
                    <input type="text" class="form-control" id="permanent_pincode" name="permanent_pincode" value="{{ isset($registration) ? $registration->permanent_pincode : '' }}" placeholder="Enter 6-digit Pincode" required aria-label="Permanent Pincode">
                    <div class="invalid-feedback">Please enter a valid 6-digit pincode.</div>
                </div>
            </div>

            <!-- Document Upload -->
            <div class="section-title">Document Upload</div>
            <div class="mandatory-status mb-4">
                <h5>Mandatory Documents Uploading Status</h5>
                <div id="docStatus">
                    @foreach(['Photo', 'Identity Document', 'Secondary (10th) Admit Card', 'UPSC Prelims Admit Card', 'UPSC DAF(Mains)'] as $docType)
                        @php
                            $isUploaded = isset($registration) && $registration->documents->contains('type', $docType);
                        @endphp
                        <span class="badge {{ $isUploaded ? 'bg-success' : 'bg-danger' }}" data-type="{{ $docType }}">{{ $docType }}: {{ $isUploaded ? 'Uploaded' : 'Pending' }}</span>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <table class="table table-bordered document-table">
                        <thead>
                            <tr>
                                <th data-sort="type">Type <i class="fas fa-sort"></i></th>
                                <th data-sort="name">Name <i class="fas fa-sort"></i></th>
                                <th data-sort="size">Size <i class="fas fa-sort"></i></th>
                                <th>Preview</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="documentTableBody">
                            @if(isset($registration))
                                @foreach($registration->documents as $doc)
                                    @php
                                        $size = Storage::disk('public')->exists($doc->path) ? number_format(Storage::disk('public')->size($doc->path) / 1024, 2) . ' KB' : 'Unknown';
                                        $fileUrl = app()->environment('local') ? $doc->url : "https://admission.sntcssc.in/mgp-2025/public" . $doc->url;
                                        $fileImgUrl = $doc->type === 'Photo' ? $fileUrl : (app()->environment('local') ? '/images/pdf-icon.png' : 'https://admission.sntcssc.in/mgp-2025/public/images/pdf-icon.png');
                                    @endphp
                                    <tr data-path="{{ $doc->path }}" data-type="{{ $doc->type }}">
                                        <td>{{ $doc->type }}</td>
                                        <td>{{ $doc->name }}</td>
                                        <td>{{ $size }}</td>
                                        <td>
                                            <a href="{{ $fileUrl }}" target="_blank">
                                                <img src="{{ $fileImgUrl }}" class="document-preview" alt="{{ $doc->type }} Preview">
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger remove-document" data-path="{{ $doc->path }}" data-type="{{ $doc->type }}" aria-label="Remove {{ $doc->type }}">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                @foreach(['Photo', 'Identity Document', 'Secondary (10th) Admit Card', 'UPSC Prelims Admit Card', 'UPSC DAF(Mains)'] as $docType)
                    @php
                        $sanitizedId = str_replace([' ', '(', ')'], ['_', '_', '_'], $docType);
                        $isUploaded = isset($registration) && $registration->documents->contains('type', $docType);
                    @endphp
                    <div class="col-md-6 mb-3 document-upload {{ $isUploaded ? 'd-none' : '' }}" id="upload_{{ $sanitizedId }}">
                        <label for="document_{{ $sanitizedId }}" class="form-label">{{ $docType === 'Photo' ? 'Your Photograph (Passport size)' : ($docType === 'Secondary (10th) Admit Card' ? 'Secondary (10th) Admit Card or Marksheet' : $docType) }} <span class="text-danger">*</span>
                            <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Upload {{ $docType === 'Photo' ? 'a JPG/PNG image' : 'a PDF document' }} (max 2MB)."></i>
                        </label>
                        <input type="file" class="form-control" id="document_{{ $sanitizedId }}" data-type="{{ $docType }}"
                               accept="{{ $docType === 'Photo' ? 'image/jpeg,image/png' : 'application/pdf' }}" {{ $isUploaded ? '' : 'required' }} aria-label="{{ $docType }} Upload">
                        <div class="invalid-feedback"></div>
                        <div class="progress mt-2">
                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-6 mb-3 document-upload" id="upload_Others_Documents">
                    <label for="document_Others_Documents" class="form-label">Others Documents (Optional)
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Upload additional PDF documents (max 2MB each)."></i>
                    </label>
                    <input type="file" class="form-control" id="document_Others_Documents" data-type="Others Documents" accept="application/pdf" aria-label="Others Documents Upload">
                    <div class="invalid-feedback"></div>
                    <div class="progress mt-2">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            <!-- Preview Section -->
            <div class="section-title">Preview Your Details</div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered preview-table">
                        <thead>
                            <tr>
                                <th data-sort="field">Field <i class="fas fa-sort"></i></th>
                                <th data-sort="value">Value <i class="fas fa-sort"></i></th>
                            </tr>
                        </thead>
                        <tbody id="previewTableBody">
                            <!-- Populated dynamically via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="button" class="btn btn-primary" id="previewBtn" aria-label="Preview Form">Preview</button>
                <button type="submit" class="btn btn-success" id="submitBtn" disabled aria-label="{{ isset($registration) ? 'Update Registration' : 'Submit Registration' }}">{{ isset($registration) ? 'Update' : 'Submit' }}</button>
            </div>
        </form>
    </div>

    <!-- Spinner Overlay -->
    <div class="spinner-overlay" id="spinnerOverlay">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container">
        <div class="toast" id="formToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            // CSRF Token Setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Initialize Tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Form Fields
            const fields = {
                programme_enrolled: 'Programme Enrolled',
                batch: 'Batch',
                sntcssc_roll_no: 'SNTCSSC Roll No.',
                secondary_level_roll_no: 'Secondary (10th) Roll No.',
                cse_prelims_roll_no: 'UPSC CSE Prelims Roll No.',
                first_name: 'First Name',
                last_name: 'Last Name',
                email: 'Email',
                alternate_email: 'Alternate Email',
                mobile_no: 'Mobile No.',
                alternate_mobile_no: 'Alternate Mobile No.',
                whatsapp_no: 'WhatsApp No.',
                dob: 'Date of Birth',
                gender: 'Gender',
                category: 'Category',
                pwbd_status: 'PwBD Status',
                pwbd_description: 'PwBD Description',
                fathers_name: 'Father\'s Name',
                mothers_name: 'Mother\'s Name',
                students_occupation: 'Student\'s Occupation',
                fathers_occupation: 'Father\'s Occupation',
                mothers_occupation: 'Mother\'s Occupation',
                medium_instruction: 'Medium of Instruction',
                optional_subject: 'Optional Subject',
                subject_graduation: 'Subject in Graduation',
                institution_graduation: 'Institution (Graduation)',
                subject_post_graduation: 'Subject in Post Graduation',
                institution_post_graduation: 'Institution (Post Graduation)',
                appeared_upsc_cse: 'Appeared in UPSC CSE',
                upsc_cse_years: 'UPSC CSE Years',
                hostel_accommodation: 'Hostel Accommodation',
                test_series: 'Test Series',
                currently_employed: 'Currently Employed',
                employment_details: 'Employment Details',
                present_address: 'Present Address',
                present_state: 'Present State',
                present_district: 'Present District',
                present_pincode: 'Present Pincode',
                permanent_address: 'Permanent Address',
                permanent_state: 'Permanent State',
                permanent_district: 'Permanent District',
                permanent_pincode: 'Permanent Pincode'
            };

            // District Population Function
            function populateDistricts(stateSelect, districtSelect, selectedDistrict = '') {
                const state = $(stateSelect).val();
                const districtOptions = @json($districts);
                $(districtSelect).empty().append('<option value="">Select District</option>');
                if (state && districtOptions[state]) {
                    districtOptions[state].forEach(district => {
                        const selected = district === selectedDistrict ? 'selected' : '';
                        $(districtSelect).append(`<option value="${district}" ${selected}>${district}</option>`);
                    });
                }
            }

            // Populate Districts on State Change
            $('#present_state').change(function () {
                populateDistricts('#present_state', '#present_district');
            });

            $('#permanent_state').change(function () {
                populateDistricts('#permanent_state', '#permanent_district');
            });

            // Same Address Checkbox
            $('#same_address').change(function () {
                if ($(this).is(':checked')) {
                    $('#permanent_address').val($('#present_address').val());
                    $('#permanent_state').val($('#present_state').val()).trigger('change');
                    $('#permanent_district').val($('#present_district').val());
                    $('#permanent_pincode').val($('#present_pincode').val());
                } else {
                    $('#permanent_address, #permanent_state, #permanent_district, #permanent_pincode').val('');
                    $('#permanent_state').trigger('change');
                }
            });

            // Conditional Fields Visibility
            $('#pwbd_status').change(function () {
                $('#pwbd_description_div').toggle($(this).val() === 'yes');
                $('#pwbd_description').prop('required', $(this).val() === 'yes');
            });

            $('#appeared_upsc_cse').change(function () {
                $('#upsc_cse_years_div').toggle($(this).val() === 'yes');
                $('#upsc_cse_years').prop('required', $(this).val() === 'yes');
            });

            $('#currently_employed').change(function () {
                $('#employment_details_div').toggle($(this).val() === 'yes');
                $('#employment_details').prop('required', $(this).val() === 'yes');
            });

            // Document Upload Handling
            const mandatoryDocs = ['Photo', 'Identity Document', 'Secondary (10th) Admit Card', 'UPSC Prelims Admit Card', 'UPSC DAF(Mains)'];
            let documents = JSON.parse($('#documents').val() || '[]');

            function updateDocStatus() {
                mandatoryDocs.forEach(docType => {
                    const isUploaded = documents.some(doc => doc.type === docType);
                    $(`#docStatus .badge[data-type="${docType}"]`)
                        .text(`${docType}: ${isUploaded ? 'Uploaded' : 'Pending'}`)
                        .removeClass('bg-success bg-danger')
                        .addClass(isUploaded ? 'bg-success' : 'bg-danger');
                    $(`#upload_${docType.replace(/[\s()]/g, '_')}`).toggleClass('d-none', isUploaded);
                    $(`#document_${docType.replace(/[\s()]/g, '_')}`).prop('required', !isUploaded);
                });
                checkFormValidity();
            }

            function checkFormValidity() {
                const allMandatoryUploaded = mandatoryDocs.every(docType => documents.some(doc => doc.type === docType));
                const isFormValid = $('#registrationForm')[0].checkValidity() && allMandatoryUploaded;
                $('#submitBtn').prop('disabled', !isFormValid);
            }

            $('.document-upload input[type="file"]').change(function () {
                const file = this.files[0];
                const type = $(this).data('type');
                if (!file) return;

                const formData = new FormData();
                formData.append('file', file);
                formData.append('type', type);

                const $progressBar = $(this).siblings('.progress').find('.progress-bar');
                $progressBar.parent().addClass('show');
                $progressBar.css('width', '0%').attr('aria-valuenow', 0);

                $.ajax({
                    url: '{{ route('register.upload') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function () {
                        const xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function (e) {
                            if (e.lengthComputable) {
                                const percent = Math.round((e.loaded / e.total) * 100);
                                $progressBar.css('width', `${percent}%`).attr('aria-valuenow', percent);
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (response) {
                        documents.push(response);
                        $('#documents').val(JSON.stringify(documents));
                        const fileUrl = response.type === 'Photo' ? response.url : (window.location.hostname === 'localhost' ? '/images/pdf-icon.png' : 'https://admission.sntcssc.in/mgp-2025/public/images/pdf-icon.png');
                        $('#documentTableBody').append(`
                            <tr data-path="${response.path}" data-type="${response.type}">
                                <td>${response.type}</td>
                                <td>${response.name}</td>
                                <td>${response.size}</td>
                                <td><a href="${response.url}" target="_blank"><img src="${fileUrl}" class="document-preview" alt="${response.type} Preview"></a></td>
                                <td><button type="button" class="btn btn-sm btn-danger remove-document" data-path="${response.path}" data-type="${response.type}" aria-label="Remove ${response.type}">Remove</button></td>
                            </tr>
                        `);
                        updateDocStatus();
                        $progressBar.parent().removeClass('show');
                        showToast('Document uploaded successfully!');
                    },
                    error: function (xhr) {
                        const errorMsg = xhr.responseJSON?.message || 'Failed to upload document.';
                        $(`#document_${type.replace(/[\s()]/g, '_')} ~ .invalid-feedback`).text(errorMsg).show();
                        $progressBar.parent().removeClass('show');
                        showToast(errorMsg, 'error');
                    }
                });
            });

            // Remove Document
            $(document).on('click', '.remove-document', function () {
                const path = $(this).data('path');
                const type = $(this).data('type');
                documents = documents.filter(doc => doc.path !== path);
                $('#documents').val(JSON.stringify(documents));
                $(`tr[data-path="${path}"]`).remove();
                updateDocStatus();
                showToast('Document removed successfully!');
            });

            // Form Preview
            $('#previewBtn').click(function () {
                $('#previewTableBody').empty();
                Object.keys(fields).forEach(field => {
                    let value = $(`#${field}`).val() || 'N/A';
                    if (field.includes('state') || field.includes('district')) {
                        value = $(`#${field} option:selected`).text() || 'N/A';
                    }
                    $('#previewTableBody').append(`
                        <tr>
                            <td>${fields[field]}</td>
                            <td>${value}</td>
                        </tr>
                    `);
                });
                checkFormValidity();
            });

            // Table Sorting
            $('.preview-table th, .document-table th').click(function () {
                const table = $(this).closest('table');
                const rows = table.find('tbody tr').toArray();
                const index = $(this).index();
                const sortKey = $(this).data('sort');
                const isAsc = !$(this).hasClass('sort-asc');
                
                rows.sort((a, b) => {
                    const aValue = $(a).find('td').eq(index).text();
                    const bValue = $(b).find('td').eq(index).text();
                    return isAsc ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
                });

                table.find('tbody').empty().append(rows);
                table.find('th').removeClass('sort-asc sort-desc');
                $(this).addClass(isAsc ? 'sort-asc' : 'sort-desc');
            });

            // Form Submission
            $('#registrationForm').submit(function (e) {
                e.preventDefault();
                if (!$(this)[0].checkValidity()) {
                    $(this).addClass('was-validated');
                    showToast('Please fill all required fields correctly.', 'error');
                    return;
                }

                $('#spinnerOverlay').addClass('show');
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#spinnerOverlay').removeClass('show');
                        showToast(response.message);
                        window.location.href = response.pdf_url;
                    },
                    error: function (xhr) {
                        $('#spinnerOverlay').removeClass('show');
                        const errorMsg = xhr.responseJSON?.message || 'An error occurred while submitting the form.';
                        showToast(errorMsg, 'error');
                    }
                });
            });

            // Show Toast
            function showToast(message, type = 'success') {
                const toast = $('#formToast');
                toast.find('.toast-body').text(message);
                toast.removeClass('bg-success bg-danger').addClass(type === 'success' ? 'bg-success' : 'bg-danger');
                toast.toast({ delay: 3000 });
                toast.toast('show');
            }

            // Input Validation
            $('#first_name, #last_name, #fathers_name, #mothers_name').on('input', function () {
                this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            });

            $('#mobile_no, #alternate_mobile_no, #whatsapp_no').on('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length > 10) this.value = this.value.slice(0, 10);
            });

            $('#present_pincode, #permanent_pincode').on('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length > 6) this.value = this.value.slice(0, 6);
            });

            $('#upsc_cse_years').on('input', function () {
                this.value = this.value.replace(/[^0-9,\s]/g, '');
            });

            // Initial Setup
            @if(isset($registration))
                $('#present_state').trigger('change');
                $('#permanent_state').trigger('change');
            @endif
            updateDocStatus();
            checkFormValidity();
        });
    </script>
</body>
</html>