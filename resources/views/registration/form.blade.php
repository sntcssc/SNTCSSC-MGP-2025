<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registration Form - SNTCSSC</title>
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
            /* font-size: 0.9rem; */
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
        background-color: #e9ecef; /* Light gray background for disabled look */
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
        <h2 class="text-center mb-4">Registration Form for SNTCSSC Mains Guidance Programme (MGP) 2025 Batch</h2>
        <form id="registrationForm" action="{{ route('register.store') }}" method="POST">
            @csrf
            <input type="hidden" id="documents" name="documents" value="[]">
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
                            <option value="{{ $programme }}" @if($programme == "Mains Guidance Programme") selected @endif>{{ $programme }}</option>
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
                            <option value="{{ $year }}" @if($year == 2025) selected @endif>{{ $year }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select a batch.</div>
                </div>
                <div class="col-md-6 mb-3 d-none">
                    <label for="sntcssc_roll_no" class="form-label">SNTCSSC Roll No.
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your SNTCSSC roll number, if applicable."></i>
                    </label>
                    <input type="text" class="form-control" id="sntcssc_roll_no" name="sntcssc_roll_no" placeholder="Enter Roll No." aria-label="SNTCSSC Roll No.">
                    <div class="invalid-feedback">Invalid roll number.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="secondary_level_roll_no" class="form-label">Roll No. of Secondary (10th) Level
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your secondary level roll number, if applicable."></i>
                    </label>
                    <input type="text" class="form-control" id="secondary_level_roll_no" name="secondary_level_roll_no" placeholder="Enter Roll No." aria-label="Secondary Level Roll No." pattern="[A-Za-z0-9]+" oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '')" required>
                    <div class="invalid-feedback">Invalid roll number.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cse_prelims_roll_no" class="form-label">Roll No. UPSC CSE 2025 (Prelims)
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your CSE Prelims roll number, if applicable."></i>
                    </label>
                    <input type="text" class="form-control" id="cse_prelims_roll_no" name="cse_prelims_roll_no" placeholder="Enter Roll No." aria-label="CSE Prelims Roll No." required>
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
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required aria-label="First Name">
                    <div class="invalid-feedback">Please enter a valid first name (letters only).</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your last name."></i>
                    </label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required aria-label="Last Name">
                    <div class="invalid-feedback">Please enter a valid last name (letters only).</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your primary email address."></i>
                    </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required aria-label="Email">
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="alternate_email" class="form-label">Alternate Email
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter an alternate email, if any."></i>
                    </label>
                    <input type="email" class="form-control" id="alternate_email" name="alternate_email" placeholder="Enter Alternate Email" aria-label="Alternate Email">
                    <div class="invalid-feedback">Please enter a valid alternate email address.</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="mobile_no" class="form-label">Mobile No. <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your 10-digit mobile number."></i>
                    </label>
                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter 10-digit Mobile No." required aria-label="Mobile No.">
                    <div class="invalid-feedback">Please enter a valid 10-digit mobile number starting with 6-9.</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="alternate_mobile_no" class="form-label">Alternate Mobile No.
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter an alternate mobile number, if any."></i>
                    </label>
                    <input type="text" class="form-control" id="alternate_mobile_no" name="alternate_mobile_no" placeholder="Enter Alternate Mobile No." aria-label="Alternate Mobile No.">
                    <div class="invalid-feedback">Please enter a valid 10-digit alternate mobile number starting with 6-9.</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="whatsapp_no" class="form-label">WhatsApp No.
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your WhatsApp number, if different."></i>
                    </label>
                    <input type="text" class="form-control" id="whatsapp_no" name="whatsapp_no" placeholder="Enter WhatsApp No." aria-label="WhatsApp No.">
                    <div class="invalid-feedback">Please enter a valid 10-digit WhatsApp number starting with 6-9.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Select your date of birth."></i>
                    </label>
                    <input type="date" class="form-control" id="dob" name="dob" required aria-label="Date of Birth">
                    <div class="invalid-feedback">Please select a valid date of birth before today.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="gender" class="form-label">Gender <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Select your gender."></i>
                    </label>
                    <select class="form-select" id="gender" name="gender" required aria-label="Gender">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <div class="invalid-feedback">Please select a gender.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="category" class="form-label">Category <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Select your category."></i>
                    </label>
                    <select class="form-select" id="category" name="category" required aria-label="Category">
                        <option value="">Select Category</option>
                        <option value="UR">UR</option>
                        <option value="SC">SC</option>
                        <option value="ST">ST</option>
                        <option value="OBC">OBC</option>
                    </select>
                    <div class="invalid-feedback">Please select a category.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pwbd_status" class="form-label">PwBD Status <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Indicate if you are a Person with Benchmark Disability."></i>
                    </label>
                    <select class="form-select" id="pwbd_status" name="pwbd_status" required aria-label="PwBD Status">
                        <option value="">Select Status</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                    <div class="invalid-feedback">Please select PwBD status.</div>
                </div>
                <div class="col-md-12 mb-3" id="pwbd_description_div" style="display: none;">
                    <label for="pwbd_description" class="form-label">PwBD Description <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Provide details of your disability."></i>
                    </label>
                    <textarea class="form-control" id="pwbd_description" name="pwbd_description" placeholder="Describe PwBD details" aria-label="PwBD Description"></textarea>
                    <div class="invalid-feedback">Please provide PwBD description.</div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <label for="students_occupation" class="form-label">Student's Occupation
                    <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your current occupation, if any."></i>
                </label>
                <input type="text" class="form-control" id="students_occupation" name="students_occupation" placeholder="Enter Occupation" aria-label="Student's Occupation">
                <div class="invalid-feedback">Invalid occupation.</div>
            </div>

            <!-- Parents Information -->
            <div class="section-title">Parents Information</div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fathers_name" class="form-label">Father's Name <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your father's full name."></i>
                    </label>
                    <input type="text" class="form-control" id="fathers_name" name="fathers_name" placeholder="Enter Father's Name" required aria-label="Father's Name">
                    <div class="invalid-feedback">Please enter a valid father's name (letters only).</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mothers_name" class="form-label">Mother's Name <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your mother's full name."></i>
                    </label>
                    <input type="text" class="form-control" id="mothers_name" name="mothers_name" placeholder="Enter Mother's Name" required aria-label="Mother's Name">
                    <div class="invalid-feedback">Please enter a valid mother's name (letters only).</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fathers_occupation" class="form-label">Father's Occupation
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your father's occupation."></i>
                    </label>
                    <input type="text" class="form-control" id="fathers_occupation" name="fathers_occupation" placeholder="Enter Occupation" aria-label="Father's Occupation">
                    <div class="invalid-feedback">Invalid occupation.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mothers_occupation" class="form-label">Mother's Occupation
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your mother's occupation."></i>
                    </label>
                    <input type="text" class="form-control" id="mothers_occupation" name="mothers_occupation" placeholder="Enter Occupation" aria-label="Mother's Occupation">
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
                    <input type="text" class="form-control" id="medium_instruction" name="medium_instruction" placeholder="e.g., English" required aria-label="Medium of Instruction">
                    <div class="invalid-feedback">Please enter medium of instruction at School.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="optional_subject" class="form-label">Optional Subject
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Select your optional subject for UPSC, if any."></i>
                    </label>
                    <select class="form-select" id="optional_subject" name="optional_subject" aria-label="Optional Subject">
                        <option value="">Select Subject</option>
                        @foreach($optionalSubjects as $subject)
                            <option value="{{ $subject }}">{{ $subject }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Invalid subject.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="subject_graduation" class="form-label">Subject in Graduation
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your graduation subject."></i>
                    </label>
                    <input type="text" class="form-control" id="subject_graduation" name="subject_graduation" placeholder="e.g., History" aria-label="Subject in Graduation">
                    <div class="invalid-feedback">Invalid subject.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="institution_graduation" class="form-label">Institution (Graduation)
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your graduation institution."></i>
                    </label>
                    <input type="text" class="form-control" id="institution_graduation" name="institution_graduation" placeholder="e.g., Delhi University" aria-label="Institution (Graduation)">
                    <div class="invalid-feedback">Invalid institution name.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="subject_post_graduation" class="form-label">Subject in Post Graduation
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your post-graduation subject, if any."></i>
                    </label>
                    <input type="text" class="form-control" id="subject_post_graduation" name="subject_post_graduation" placeholder="e.g., Public Administration" aria-label="Subject in Post Graduation">
                    <div class="invalid-feedback">Invalid subject.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="institution_post_graduation" class="form-label">Institution (Post Graduation)
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your post-graduation institution, if any."></i>
                    </label>
                    <input type="text" class="form-control" id="institution_post_graduation" name="institution_post_graduation" placeholder="e.g., University of Calcutta" aria-label="Institution (Post Graduation)">
                    <div class="invalid-feedback">Invalid institution name.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="appeared_upsc_cse" class="form-label">Have you appeared in UPSC CSE earlier?<span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Indicate if you have appeared in UPSC CSE earlier."></i>
                    </label>
                    <select class="form-select" id="appeared_upsc_cse" name="appeared_upsc_cse" required aria-label="Have you appeared in UPSC CSE earlier?">
                        <option value="">Select Status</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                    <div class="invalid-feedback">Please select UPSC CSE status.</div>
                </div>
                <div class="col-md-6 mb-3" id="upsc_cse_years_div" style="display: none;">
                    <label for="upsc_cse_years" class="form-label">If yes, please mention the year / years <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter the years you appeared in UPSC CSE."></i>
                    </label>
                    <input type="text" class="form-control" id="upsc_cse_years" name="upsc_cse_years" placeholder="e.g., 2020, 2021" aria-label="UPSC CSE Years">
                    <div class="invalid-feedback">Please enter valid years (e.g., 2020, 2021).</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="hostel_accommodation" class="form-label">Do you need hostel accommodation? <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Indicate if you need hostel accommodation."></i>
                    </label>
                    <select class="form-select" id="hostel_accommodation" name="hostel_accommodation" required aria-label="Hostel Accommodation">
                        <option value="">Select Status</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                    <div class="invalid-feedback">Please select hostel accommodation status.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="test_series" class="form-label">Do you wish to take Test Series? <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Indicate if you are enrolled in the test series."></i>
                    </label>
                    <select class="form-select" id="test_series" name="test_series" required aria-label="Test Series">
                        <option value="">Select Status</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                    <div class="invalid-feedback">Please select test series status.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="currently_employed" class="form-label">Currently Employed <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Indicate if you are currently employed."></i>
                    </label>
                    <select class="form-select" id="currently_employed" name="currently_employed" required aria-label="Currently Employed">
                        <option value="">Select Status</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                    <div class="invalid-feedback">Please select employment status.</div>
                </div>
                <div class="col-md-6 mb-3" id="employment_details_div" style="display: none;">
                    <label for="employment_details" class="form-label">Employment Details <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Provide details of your current employment."></i>
                    </label>
                    <textarea class="form-control" id="employment_details" name="employment_details" placeholder="Describe employment details" aria-label="Employment Details"></textarea>
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
                            <option value="{{ $state }}">{{ $state }}</option>
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
                    </select>
                    <div class="invalid-feedback">Please select a district.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="present_address" class="form-label">Full Address <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your current full address."></i>
                    </label>
                    <textarea class="form-control" id="present_address" name="present_address" placeholder="Enter Full Address" required aria-label="Present Address"></textarea>
                    <div class="invalid-feedback">Please enter a valid address.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="present_pincode" class="form-label">Pincode <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your 6-digit pincode."></i>
                    </label>
                    <input type="text" class="form-control" id="present_pincode" name="present_pincode" placeholder="Enter 6-digit Pincode" required aria-label="Present Pincode">
                    <div class="invalid-feedback">Please enter a valid 6-digit pincode.</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="same_address" aria-label="Same as Present Address">
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
                            <option value="{{ $state }}">{{ $state }}</option>
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
                    </select>
                    <div class="invalid-feedback">Please select a district.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="permanent_address" class="form-label">Full Address <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your permanent full address."></i>
                    </label>
                    <textarea class="form-control" id="permanent_address" name="permanent_address" placeholder="Enter Full Address" required aria-label="Permanent Address"></textarea>
                    <div class="invalid-feedback">Please enter a valid address.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="permanent_pincode" class="form-label">Pincode <span class="text-danger">*</span>
                        <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Enter your 6-digit permanent pincode."></i>
                    </label>
                    <input type="text" class="form-control" id="permanent_pincode" name="permanent_pincode" placeholder="Enter 6-digit Pincode" required aria-label="Permanent Pincode">
                    <div class="invalid-feedback">Please enter a valid 6-digit pincode.</div>
                </div>
            </div>

            <!-- Document Upload -->
            <div class="section-title">Document Upload</div>
            <div class="mandatory-status mb-4">
                <h5>Mandatory Documents Uploading Status</h5>
                <div id="docStatus">
                    @foreach(['Photo', 'Identity Document', 'Secondary (10th) Admit Card', 'UPSC Prelims Admit Card', 'UPSC DAF(Mains)'] as $docType)
                        <span class="badge bg-danger" data-type="{{ $docType }}">{{ $docType }}: Pending</span>
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
                        <tbody id="documentTableBody"></tbody>
                    </table>
                </div>
                @foreach(['Photo', 'Identity Document', 'Secondary (10th) Admit Card', 'UPSC Prelims Admit Card', 'UPSC DAF(Mains)'] as $docType)
                    @php
                        $sanitizedId = str_replace([' ', '(', ')'], ['_', '_', '_'], $docType);
                    @endphp
                    <div class="col-md-6 mb-3 document-upload" id="upload_{{ $sanitizedId }}">
                        <label for="document_{{ $sanitizedId }}" class="form-label">{{ $docType === 'Photo' ? 'Your Photograph (Passport size)' : ($docType === 'Secondary (10th) Admit Card' ? 'Secondary (10th) Admit Card or Marksheet' : $docType) }} <span class="text-danger">*</span>
                            <i class="fas fa-info-circle ms-1" data-bs-toggle="tooltip" title="Upload {{ $docType === 'Photo' ? 'a JPG/PNG image' : 'a PDF document' }} (max 2MB)."></i>
                        </label>
                        <input type="file" class="form-control" id="document_{{ $sanitizedId }}" data-type="{{ $docType }}"
                               accept="{{ $docType === 'Photo' ? 'image/jpeg,image/png' : 'application/pdf' }}" required aria-label="{{ $docType }} Upload">
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
                    <input type="file" class="form-control" id="document_Others_Documents" data-type="Others Documents" accept="application/pdf" multiple aria-label="Others Documents Upload">
                    <div class="invalid-feedback"></div>
                    <div class="progress mt-2">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="text-center mt-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#previewModal" aria-label="Preview Form">
                    <i class="fas fa-eye"></i> Preview
                </button>
                <button type="submit" class="btn btn-success" id="submitButton" disabled aria-label="Submit Form">
                    <i class="fas fa-check"></i> Submit
                </button>
            </div>
        </form>
    </div>

    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Preview Registration Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered preview-table">
                        <thead>
                            <tr>
                                <th scope="col">Field</th>
                                <th scope="col">Value</th>
                            </tr>
                        </thead>
                        <tbody id="previewTableBody"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close Modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmit" aria-label="Confirm Submission">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Spinner Overlay -->
    <div class="spinner-overlay">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container">
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto" id="toastTitle"></strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastMessage"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            const districtsData = @json($districts);
            const mandatoryDocs = ['Photo', 'Identity Document', 'Secondary (10th) Admit Card', 'UPSC Prelims Admit Card', 'UPSC DAF(Mains)'];

            // Function to sanitize document type for IDs
            function sanitizeDocType(docType) {
                return docType.replace(/[\s()]/g, '_');
            }

            // Toast Notification
            function showToast(title, message, type = 'info') {
                $('#toastTitle').text(title).removeClass().addClass(type === 'error' ? 'text-danger' : 'text-success');
                $('#toastMessage').text(message);
                const toast = new bootstrap.Toast($('#toast'));
                toast.show();
            }

            // Debounce Utility
            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            // Validation Patterns
            const patterns = {
                name: /^[a-zA-Z\s]+$/,
                email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                mobile: /^[6-9]\d{9}$/,
                pincode: /^\d{6}$/,
                rollNo: /^[a-zA-Z0-9\-\/]+$/,
                text: /^[\w\s,.()-]+$/,
                years: /^\d{4}(,\s*\d{4})*$/
            };

            // Real-time Validation
            function validateField(field) {
                const $field = $(field);
                const value = $field.val().trim();
                const id = $field.attr('id');
                let isValid = true;
                let message = '';

                if ($field.prop('required') && !value) {
                    isValid = false;
                    message = 'This field is required.';
                } else {
                    switch (id) {
                        case 'first_name':
                        case 'last_name':
                        case 'fathers_name':
                        case 'mothers_name':
                            isValid = patterns.name.test(value);
                            message = 'Please enter a valid name (letters only).';
                            break;
                        case 'email':
                        case 'alternate_email':
                            isValid = !value || patterns.email.test(value);
                            message = 'Please enter a valid email address.';
                            break;
                        case 'mobile_no':
                            isValid = patterns.mobile.test(value);
                            message = 'Please enter a valid 10-digit mobile number starting with 6-9.';
                            break;
                        case 'alternate_mobile_no':
                        case 'whatsapp_no':
                            isValid = !value || patterns.mobile.test(value);
                            message = 'Please enter a valid 10-digit mobile number starting with 6-9.';
                            break;
                        case 'dob':
                            const today = new Date();
                            const dob = new Date(value);
                            isValid = dob < today;
                            message = 'Please select a valid date of birth before today.';
                            break;
                        case 'present_pincode':
                        case 'permanent_pincode':
                            isValid = patterns.pincode.test(value);
                            message = 'Please enter a valid 6-digit pincode.';
                            break;
                        case 'sntcssc_roll_no':
                        case 'secondary_level_roll_no':
                        case 'cse_prelims_roll_no':
                            isValid = !value || patterns.rollNo.test(value);
                            message = 'Invalid roll number.';
                            break;
                        case 'medium_instruction':
                        case 'subject_graduation':
                        case 'institution_graduation':
                        case 'subject_post_graduation':
                        case 'institution_post_graduation':
                        case 'students_occupation':
                        case 'fathers_occupation':
                        case 'mothers_occupation':
                            isValid = !value || patterns.text.test(value);
                            message = 'Invalid input.';
                            break;
                        case 'upsc_cse_years':
                            isValid = !value || patterns.years.test(value);
                            message = 'Please enter valid years (e.g., 2020, 2021).';
                            break;
                        case 'pwbd_description':
                        case 'employment_details':
                            isValid = !$field.prop('required') || value.length > 0;
                            message = 'Please provide details.';
                            break;
                        case 'programme_enrolled':
                        case 'batch':
                        case 'gender':
                        case 'category':
                        case 'pwbd_status':
                        case 'appeared_upsc_cse':
                        case 'hostel_accommodation':
                        case 'test_series':
                        case 'currently_employed':
                        case 'present_state':
                        case 'present_district':
                        case 'permanent_state':
                        case 'permanent_district':
                            isValid = !!value;
                            message = `Please select a ${$field.prev('label').text().replace('*', '').trim().toLowerCase()}.`;
                            break;
                    }
                }

                $field.toggleClass('is-invalid', !isValid);
                $field.next('.invalid-feedback').text(message);
                return isValid;
            }

            // Attach Validation Listeners
            const validateDebounced = debounce(validateField, 300);
            $('input, select, textarea').on('input change blur', function() {
                validateDebounced(this);
            });

            // Initialize Tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Populate Districts
            function populateDistricts(stateId, districtId) {
                const state = $(stateId).val();
                const districts = districtsData[state] || [];
                $(districtId).empty().append('<option value="">Select District</option>');
                districts.forEach(district => {
                    $(districtId).append(`<option value="${district}">${district}</option>`);
                });
                validateField($(districtId));
            }

            $('#present_state').change(function() {
                populateDistricts('#present_state', '#present_district');
                validateField(this);
            });

            $('#permanent_state').change(function() {
                populateDistricts('#permanent_state', '#permanent_district');
                validateField(this);
            });

            // Same as Present Address
            $('#same_address').change(function() {
                if ($(this).is(':checked')) {
                    $('#permanent_address').val($('#present_address').val());
                    $('#permanent_state').val($('#present_state').val()).trigger('change');
                    setTimeout(() => {
                        $('#permanent_district').val($('#present_district').val());
                        validateField('#permanent_district');
                    }, 100);
                    $('#permanent_pincode').val($('#present_pincode').val());
                    validateField('#permanent_address');
                    validateField('#permanent_state');
                    validateField('#permanent_pincode');
                } else {
                    $('#permanent_address, #permanent_pincode').val('');
                    $('#permanent_state').val('').trigger('change');
                    $('#permanent_district').empty().append('<option value="">Select District</option>');
                    validateField('#permanent_address');
                    validateField('#permanent_state');
                    validateField('#permanent_district');
                    validateField('#permanent_pincode');
                }
            });

            // Conditional Fields
            function toggleConditionalFields() {
                const pwbdStatus = $('#pwbd_status').val() === 'yes';
                $('#pwbd_description_div').toggle(pwbdStatus);
                $('#pwbd_description').prop('required', pwbdStatus);
                validateField('#pwbd_description');

                const upscStatus = $('#appeared_upsc_cse').val() === 'yes';
                $('#upsc_cse_years_div').toggle(upscStatus);
                $('#upsc_cse_years').prop('required', upscStatus);
                validateField('#upsc_cse_years');

                const employedStatus = $('#currently_employed').val() === 'yes';
                $('#employment_details_div').toggle(employedStatus);
                $('#employment_details').prop('required', employedStatus);
                validateField('#employment_details');
            }

            $('#pwbd_status, #appeared_upsc_cse, #currently_employed').change(toggleConditionalFields);
            toggleConditionalFields();

            // Document Upload
            $('input[type="file"]').change(function(e) {
                const $input = $(this);
                const files = e.target.files;
                const type = $input.data('type');
                const maxSize = 2 * 1024 * 1024; // 2MB
                let valid = true;

                // Check if document type already uploaded
                const documents = JSON.parse($('#documents').val() || '[]');
                if (type !== 'Others Documents' && documents.some(doc => doc.type === type)) {
                    showToast('Error', `${type} is already uploaded.`, 'error');
                    $input.val('');
                    return;
                }

                // Validate files
                for (let file of files) {
                    const isImage = type === 'Photo';
                    const validTypes = isImage ? ['image/jpeg', 'image/png'] : ['application/pdf'];
                    if (!validTypes.includes(file.type)) {
                        $input.addClass('is-invalid');
                        $input.next('.invalid-feedback').text(`Please upload ${isImage ? 'a JPG/PNG image' : 'a PDF document'}.`);
                        valid = false;
                        alert(`Please upload valid document type ${validTypes}`);
                        break;
                    }
                    if (file.size > maxSize) {
                        $input.addClass('is-invalid');
                        $input.next('.invalid-feedback').text('File size must be less than 2MB.');
                        valid = false;
                        break;
                    }
                }

                if (valid) {
                    const formData = new FormData();
                    for (let file of files) {
                        formData.append('file', file);
                        formData.append('type', type);
                    }

                    const $progressBar = $input.parent().find('.progress-bar');
                    $input.parent().find('.progress').addClass('show');

                    $.ajax({
                        url: '{{ route('register.upload') }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        xhr: function() {
                            const xhr = new XMLHttpRequest();
                            xhr.upload.addEventListener('progress', function(e) {
                                if (e.lengthComputable) {
                                    const percent = Math.round((e.loaded / e.total) * 100);
                                    $progressBar.css('width', percent + '%').attr('aria-valuenow', percent).text(`${percent}%`);
                                }
                            });
                            return xhr;
                        },
                        beforeSend: function() {
                            $('.spinner-overlay').addClass('show');
                        },
                        success: function(response) {
                            $('.spinner-overlay').removeClass('show');
                            $progressBar.css('width', '0%').parent().removeClass('show');
                            
                            // Set the correct URL based on environment
                            let fileUrl;
                            let fileImgUrl;

                            @if (app()->environment('local'))
                                fileUrl = response.url;
                                fileImgUrl = response.type === 'Photo' ? response.url : '/images/pdf-icon.png';
                            @else
                                fileUrl = "https://admission.sntcssc.in/mgp-2025/public" + response.url;
                                fileImgUrl = response.type === 'Photo' ? 'https://admission.sntcssc.in/mgp-2025/public' + response.url : 'https://admission.sntcssc.in/mgp-2025/public/images/pdf-icon.png';
                            @endif

                            const row = `
                                <tr data-path="${response.path}" data-type="${response.type}">
                                    <td>${response.type}</td>
                                    <td>${response.name}</td>
                                    <td>${response.size}</td>
                                    <td>
                                        <a href="${fileUrl}" target="_blank">
                                            <img src="${fileImgUrl}" class="document-preview" alt="${response.type} Preview">
                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger remove-document" data-path="${response.path}" data-type="${response.type}" aria-label="Remove ${response.type}">Remove</button>
                                    </td>
                                </tr>`;
                            
                            $('#documentTableBody').append(row);
                            documents.push({
                                type: response.type,
                                path: response.path,
                                url: response.url,
                                name: response.name
                            });
                            $('#documents').val(JSON.stringify(documents));

                            // Hide input field
                            $(`#upload_${sanitizeDocType(type)}`).addClass('d-none');
                            $input.val('').removeClass('is-invalid');
                            if (mandatoryDocs.includes(type)) {
                                $(`#docStatus .badge[data-type="${type}"]`).removeClass('bg-danger').addClass('bg-success').text(`${type}: Uploaded`);
                                $(`#document_${sanitizeDocType(type)}`).prop('required', false);
                            }
                            showToast('Success', `${type} uploaded successfully!`);
                        },
                        error: function(xhr) {
                            $('.spinner-overlay').removeClass('show');
                            $progressBar.css('width', '0%').parent().removeClass('show');
                            showToast('Error', 'File upload failed: ' + (xhr.responseJSON?.message || 'Unknown error'), 'error');
                        }
                    });

                }
            });

            // Remove Document
            $(document).on('click', '.remove-document', function() {
                const path = $(this).data('path');
                const type = $(this).data('type');
                $(this).closest('tr').remove();
                const documents = JSON.parse($('#documents').val() || '[]').filter(doc => doc.path !== path);
                $('#documents').val(JSON.stringify(documents));

                // Show input field again
                $(`#upload_${sanitizeDocType(type)}`).removeClass('d-none');
                if (mandatoryDocs.includes(type)) {
                    $(`#docStatus .badge[data-type="${type}"]`).removeClass('bg-success').addClass('bg-danger').text(`${type}: Pending`);
                    $(`#document_${sanitizeDocType(type)}`).prop('required', true);
                }
                showToast('Success', `${type} removed successfully.`);
            });

            // Table Sorting
            $('.document-table th[data-sort]').click(function() {
                const key = $(this).data('sort');
                const rows = $('#documentTableBody tr').get();
                const isNumeric = key === 'size';
                const order = $(this).data('order') === 'asc' ? 1 : -1;
                $(this).data('order', order === 1 ? 'desc' : 'asc');

                rows.sort((a, b) => {
                    let valA = $(a).find('td').eq(key === 'type' ? 0 : key === 'name' ? 1 : 2).text().trim();
                    let valB = $(b).find('td').eq(key === 'type' ? 0 : key === 'name' ? 1 : 2).text().trim();
                    if (isNumeric) {
                        valA = parseFloat(valA);
                        valB = parseFloat(valB);
                    }
                    return valA > valB ? order : -order;
                });

                $('#documentTableBody').empty().append(rows);
            });

            // Preview Modal and Enable Submit Button
            $('#previewModal').on('show.bs.modal', function() {
                const formData = $('#registrationForm').serializeArray();
                const documents = JSON.parse($('#documents').val() || '[]');
                const previewTableBody = $('#previewTableBody').empty();
                const conditionalFields = ['pwbd_description', 'upsc_cse_years', 'employment_details'];

                formData.forEach(item => {
                    if (item.name !== '_token' && item.name !== 'documents' && !conditionalFields.includes(item.name)) {
                        const label = $('label[for="' + item.name + '"]').text().replace('*', '').trim() || item.name.replace(/_/g, ' ').toTitleCase();
                        previewTableBody.append(`<tr><th scope="row">${label}</th><td>${item.value || '-'}</td></tr>`);
                    }
                });

                conditionalFields.forEach(field => {
                    const value = $(`#${field}`).val();
                    if (value) {
                        const label = $('label[for="' + field + '"]').text().replace('*', '').trim() || field.replace(/_/g, ' ').toTitleCase();
                        previewTableBody.append(`<tr><th scope="row">${label}</th><td>${value}</td></tr>`);
                    }
                });

                if (documents.length > 0) {
                    let docHtml = '<tr><th scope="row">Documents</th><td>';
                    documents.forEach(doc => {
                        docHtml += `<div><strong>${doc.type}</strong>: ${doc.name} (<a href="${doc.url}" target="_blank">View</a>)</div>`;
                    });
                    docHtml += '</td></tr>';
                    previewTableBody.append(docHtml);
                }

                // Enable submit button if form is valid
                const invalidFields = $('input:invalid, select:invalid, textarea:invalid');
                const uploadedDocs = documents.map(doc => doc.type);
                const missingDocs = mandatoryDocs.filter(doc => !uploadedDocs.includes(doc));
                if (invalidFields.length === 0 && missingDocs.length === 0) {
                    $('#submitButton').prop('disabled', false);
                } else {
                    $('#submitButton').prop('disabled', true);
                }
            });

            // Confirm Submit
            $('#confirmSubmit').click(function() {
                const documents = JSON.parse($('#documents').val() || '[]');
                const uploadedDocs = documents.map(doc => doc.type);
                const missingDocs = mandatoryDocs.filter(doc => !uploadedDocs.includes(doc));

                if (missingDocs.length > 0) {
                    showToast('Error', 'Please upload all required documents: ' + missingDocs.join(', '), 'error');
                    $('#previewModal').modal('hide');
                    return;
                }

                const invalidFields = $('input:invalid, select:invalid, textarea:invalid');
                if (invalidFields.length > 0) {
                    invalidFields.each(function() {
                        validateField(this);
                    });
                    showToast('Error', 'Please correct the invalid fields.', 'error');
                    $('#previewModal').modal('hide');
                    return;
                }

                if (confirm('Are you sure you want to submit the form?')) {
                    $('#registrationForm').submit();
                }
            });

            // Form Submission
            $('#registrationForm').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append('documents', $('#documents').val());

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    beforeSend: function() {
                        $('.spinner-overlay').addClass('show');
                    },
                    success: function(response) {
                        $('.spinner-overlay').removeClass('show');
                        showToast('Success', 'Registration successful! Downloading your application form.');
                        // window.location.href = response.pdf_url;

                        setTimeout(function () {
                            @if (app()->environment('local'))
                                window.location.href = response.pdf_url;
                            @else
                                window.location.href = "https://admission.sntcssc.in/mgp-2025/public" + response.pdf_url;
                            @endif
                        }, 2000); // 2000 milliseconds = 2 seconds

                    },
                    error: function(xhr) {
                        $('.spinner-overlay').removeClass('show');
                        showToast('Error', 'Submission failed: ' + (xhr.responseJSON?.message || 'Please try again.'), 'error');
                    }
                });
            });

            // Utility Function for Title Case
            String.prototype.toTitleCase = function() {
                return this.replace(/\w\S*/g, txt => txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase());
            };
        });
    </script>
</body>
</html>