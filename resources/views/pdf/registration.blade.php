<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration for SNTCSSC Mains Guidance Programme (MGP) 2025 Batch</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            margin: 20px;
            padding: 0;
            color: #333;
        }
        .page {
            width: 100%;
            position: relative;
            background-color: #fff;
        }
        .header {
            /* background-color: #003087; */
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 4px;
        }
        .header .logo {
            width: 80px;
            height: auto;
            border: 1px solid #fff;
            border-radius: 2px;
            position: absolute;
        }
        .header h1 {
            font-size: 16px;
            /* color: #fff; */
            margin: 0;
            font-weight: bold;
            text-align: right;
        }
        .header-bottom {
            /* background-color: #e9ecef; */
            padding: 2px;
            text-align: right;
            /* border-top: 1px solid #004aad; */
            border-radius: 0 0 4px 4px;
        }
        .header-bottom p {
            font-size: 13px;
            color: #333;
            margin: 2px 0;
            line-height: right;
        }
        .header a {
            color: #004aad;
            text-decoration: none;
            font-weight: 500;
        }
        .header a:hover {
            text-decoration: underline;
        }
        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #003087;
            background-color: #f5f6f5;
            padding: 8px;
            margin: 8px 0;
            border-bottom: 2px solid #004aad;
            border-radius: 4px;
        }
        h2 {
            font-size: 14px;
            color: #004aad;
            margin: 8px 0 4px;
            padding-left: 10px;
            border-left: 4px solid #004aad;
            font-weight: bold;
        }
        .main-section {
            display: table;
            width: 100%;
            margin-bottom: 8px;
            /* margin-top: 10px; */
        }
        .photo-column {
            display: table-cell;
            width: 20%;
            vertical-align: top;
            padding-right: 10px;
        }
        .photo-column img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border: 2px solid #004aad;
            border-radius: 4px;
            box-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }
        .photo-column p {
            font-size: 10px;
            color: #555;
            text-align: center;
            margin-top: 5px;
        }
        .personal-info-column {
            display: table-cell;
            width: 80%;
            vertical-align: top;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 8px;
            border-radius: 4px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
            font-size: 11px;
            word-break: break-word;
        }
        th {
            background-color: #e9ecef;
            color: #003087;
            font-weight: bold;
            font-size: 12px;
            width: 35%;
        }
        td {
            background-color: #fff;
        }
        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }
        a {
            color: #004aad;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .highlight {
            background-color: #e6f0fa;
        }
        .address-table th, .address-table td {
            width: 25%;
        }
        .footer {
            position: fixed;
            bottom: 10px;
            width: calc(100% - 40px);
            text-align: center;
            font-size: 10px;
            color: #555;
            border-top: 1px solid #004aad;
            padding-top: 5px;
        }
        @page {
            margin: 30px;
            footer: html_footer;
        }

            .footer::after {
                content: "Page " counter(page) " of 2 | SNTCSSC";
            }

        /* Capitalize the first letter of each field */
        .capitalize {
            text-transform: capitalize;
        }
    </style>

    <script type="text/php">
        if (isset($pdf)) {
            $page_count = $pdf->get_page_count();
            $page_number = $pdf->get_page_number();
            $font = $pdf->get_font_metrics()->getFont('Arial', 'normal');
            $pdf->page_text(0, 0, "Page {PAGE_NUM} of {PAGE_COUNT} | SNTCSSC Institute", $font, 10, array(0.333, 0.333, 0.333));
        }
    </script>
</head>
<body>
    <html footer>
        <div class="footer">
            {{-- Page {PAGE_NUM} of {PAGE_COUNT} | SNTCSSC Institute --}}
        </div>
    </html footer>
    <div class="page">
        <!-- Header -->
        <div class="header">
            <div class="header-top">
                <img class="logo" src="{{ $logoBase64 }}" alt="SNTCSSC Logo">
                <h1>Satyendra Nath Tagore Civil Services Study Centre (SNTCSSC)</h1>
            </div>
            <div class="header-bottom">
                <p>NSATI Campus, FC Block, Sector - 3, Salt Lake, Kolkata - 700106</p>
                <p>Email: <a href="mailto:iascoaching.sntcssc@gmail.com">iascoaching.sntcssc@gmail.com</a> | Phone: +91 123-456-7890</p>
            </div>
        </div>

        <!-- Title -->
        <div class="title">Registration for SNTCSSC Mains Guidance Programme (MGP) 2025 Batch</div>

        <!-- Main Section: Photo and Personal Info -->
        <div class="main-section">
            <!-- Photo Column -->
            <div class="photo-column">
                @if($photoBase64)
                    <img src="{{ $photoBase64 }}" alt="Student Photo">
                @else
                    <p>No Photo Available</p>
                @endif
            </div>

            <!-- Personal Information Column -->
            <div class="personal-info-column">
                <h2>Personal Information</h2>
                <table>
                    <tr class="highlight"><th>Full Name</th><td><strong class="capitalize">{{ $registration->first_name }} {{ $registration->last_name }}</strong></td></tr>
                    <tr class="highlight"><th>Email Address</th><td><a href="mailto:{{ $registration->email }}">{{ $registration->email }}</a></td></tr>
                    @if($registration->alternate_email)
                        <tr><th>Alternate Email Address</th><td class="capitalize">{{ $registration->alternate_email }}</td></tr>
                    @endif
                    <tr class="highlight"><th>Mobile Number</th><td><strong>{{ $registration->mobile_no }}</strong></td></tr>
                    @if($registration->alternate_mobile_no)
                        <tr><th>Alternate Mobile Number</th><td>{{ $registration->alternate_mobile_no }}</td></tr>
                    @endif
                    @if($registration->whatsapp_no)
                        <tr><th>WhatsApp Number</th><td>{{ $registration->whatsapp_no }}</td></tr>
                    @endif
                    <tr><th>Date of Birth</th><td>{{ $registration->dob }}</td></tr>
                    <tr><th>Gender</th><td class="capitalize">{{ $registration->gender }}</td></tr>
                    <tr><th>Category</th><td>{{ $registration->category }}</td></tr>
                    <tr><th>PwBD Status</th><td class="capitalize">{{ $registration->pwbd_status }}</td></tr>
                    @if($registration->pwbd_description)
                        <tr><th>PwBD Description</th><td>{{ $registration->pwbd_description }}</td></tr>
                    @endif
                </table>
            </div>
        </div>

        <!-- Programme Details -->
        <h2>Programme Details</h2>
        <table>
            <tr class="highlight"><th>Programme Enrolled</th><td><strong>{{ $registration->programme_enrolled }}</strong></td></tr>
            <tr><th>Batch</th><td>{{ $registration->batch }}</td></tr>
            @if($registration->sntcssc_roll_no)
                <tr><th>SNTCSSC Roll Number</th><td>{{ $registration->sntcssc_roll_no }}</td></tr>
            @endif
            @if($registration->secondary_level_roll_no)
                <tr><th>Roll No. of Secondary (10th) Level</th><td>{{ $registration->secondary_level_roll_no }}</td></tr>
            @endif
            @if($registration->cse_prelims_roll_no)
                <tr><th>Roll No. UPSC CSE 2025 (Prelims)</th><td>{{ $registration->cse_prelims_roll_no }}</td></tr>
            @endif
            <tr><th>Medium of Instruction at School Level</th><td class="capitalize">{{ $registration->medium_instruction }}</td></tr>
            @if($registration->optional_subject)
                <tr><th>Optional Subject</th><td class="capitalize">{{ $registration->optional_subject }}</td></tr>
            @endif
            <tr><th>Do you need hostel accommodation?</th><td class="capitalize">{{ $registration->hostel_accommodation }}</td></tr>
            <tr><th>Do you wish to take Test Series?</th><td class="capitalize">{{ $registration->test_series }}</td></tr>
        </table>

        <!-- Family Details -->
        <h2>Family Details</h2>
        <table>
            <tr><th>Father's Name</th><td class="capitalize">{{ $registration->fathers_name }}</td></tr>
            <tr><th>Mother's Name</th><td class="capitalize">{{ $registration->mothers_name }}</td></tr>
            @if($registration->fathers_occupation)
                <tr><th>Father's Occupation</th><td class="capitalize">{{ $registration->fathers_occupation }}</td></tr>
            @endif
            @if($registration->mothers_occupation)
                <tr><th>Mother's Occupation</th><td class="capitalize">{{ $registration->mothers_occupation }}</td></tr>
            @endif
        </table>

        <!-- Academic Details -->
        <h2>Academic Details</h2>
        <table>
            @if($registration->subject_graduation)
                <tr><th>Graduation Subject</th><td class="capitalize">{{ $registration->subject_graduation }}</td></tr>
            @endif
            @if($registration->institution_graduation)
                <tr><th>Institution (Graduation)</th><td class="capitalize">{{ $registration->institution_graduation }}</td></tr>
            @endif
            @if($registration->subject_post_graduation)
                <tr><th>Post Graduation Subject</th><td class="capitalize">{{ $registration->subject_post_graduation }}</td></tr>
            @endif
            @if($registration->institution_post_graduation)
                <tr><th>Institution (Post Graduation)</th><td class="capitalize">{{ $registration->institution_post_graduation }}</td></tr>
            @endif
            <tr><th>Have you appeared in UPSC CSE earlier?</th><td class="capitalize">{{ $registration->appeared_upsc_cse }}</td></tr>
            @if($registration->upsc_cse_years)
                <tr><th>UPSC CSE Years</th><td class="capitalize">{{ $registration->upsc_cse_years }}</td></tr>
            @endif
        </table>

        <!-- Employment Details -->
        <h2>Employment Details</h2>
        <table>
            @if($registration->students_occupation)
                <tr><th>Student's Occupation</th><td class="capitalize">{{ $registration->students_occupation }}</td></tr>
            @endif
            <tr><th>Currently Employed</th><td class="capitalize">{{ $registration->currently_employed }}</td></tr>
            @if($registration->employment_details)
                <tr><th>Employment Details</th><td>{{ $registration->employment_details }}</td></tr>
            @endif
        </table>

        <!-- Address Details -->
        <h2>Address Details</h2>
        <table class="address-table">
            <tr>
                <th>Present Address</th><td class="capitalize">{{ $registration->present_address }}</td>
                <th>Permanent Address</th><td class="capitalize">{{ $registration->permanent_address }}</td>
            </tr>
            <tr>
                <th>Present State</th><td class="capitalize">{{ $registration->present_state }}</td>
                <th>Permanent State</th><td class="capitalize">{{ $registration->permanent_state }}</td>
            </tr>
            <tr>
                <th>Present District</th><td class="capitalize">{{ $registration->present_district }}</td>
                <th>Permanent District</th><td class="capitalize">{{ $registration->permanent_district }}</td>
            </tr>
            <tr>
                <th>Present Pincode</th><td>{{ $registration->present_pincode }}</td>
                <th>Permanent Pincode</th><td>{{ $registration->permanent_pincode }}</td>
            </tr>
        </table>

        <!-- Documents Table -->
        <h2>Uploaded Documents</h2>
        <table>
            <tr>
                <th style="width: 25%;">Document Type</th>
                <th style="width: 50%;">File Name</th>
                <th style="width: 25%;">Link</th>
            </tr>
            @foreach($documents as $doc)
                <tr>
                    <td>{{ $doc['type'] }}</td>
                    <td>{{ $doc['name'] }}</td>
                    @if(app()->environment('local'))
                    <td><a href="{{ $doc['url'] }}" target="_blank">View</a></td>
                    @else
                    <td><a href="{{ url('public' . $doc['url']) }}" target="_blank">View</a></td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>