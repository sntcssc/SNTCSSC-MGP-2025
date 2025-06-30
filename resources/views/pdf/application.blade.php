<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        font-size: 12px;
        color: #333;
    }
    .header {
        background-color: #1a4971;
        color: white;
        padding: 15px;
        text-align: center;
        position: relative;
    }
    .header img {
        position: absolute;
        left: 15px;
        top: 15px;
        height: 60px;
        width: 60px;
    }
    .header-content {
        margin-left: 80px;
    }
    .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        padding: 10px 0;
        background-color: #f8f8f8;
        border-top: 1px solid #ddd;
    }
    .container {
        padding: 20px;
    }
    h1 {
        text-align: center;
        color: #1a4971;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    table, th, td {
        border: 1px solid #ddd;
    }
    th {
        background-color: #f4f4f4;
        padding: 8px;
        text-align: left;
        font-weight: bold;
    }
    td {
        padding: 8px;
    }
    .section-title {
        font-size: 14px;
        font-weight: bold;
        margin: 15px 0 10px;
        color: #1a4971;
    }
</style>

<div class="header">
    <img src="https://via.placeholder.com/100" alt="SNTCSSC Logo">
    <div class="header-content">
        <h2>SNTCSSC</h2>
        <p>123 Education Lane, Academic City, India</p>
        <p>Email: info@sntcssc.org | Phone: +91 123 456 7890</p>
    </div>
</div>

<div class="container">
    <h1>Registration Information Sheet for SNTCSSC MGP 2025 Batch</h1>

    <!-- Personal Details -->
    <div class="section-title">Personal Details</div>
    <table>
        <tr>
            <th>Registration No.</th>
            <td>{{ $registration->registration_no }}</td>
        </tr>
        <tr>
            <th>SNTCSSC Roll No.</th>
            <td>{{ $registration->sntcssc_roll_no }}</td>
        </tr>
        <tr>
            <th>Programme Enrolled</th>
            <td>{{ $registration->programme_enrolled }}</td>
        </tr>
        <tr>
            <th>Batch</th>
            <td>{{ $registration->batch }}</td>
        </tr>
        <tr>
            <th>Secondary Level Roll No.</th>
            <td>{{ $registration->secondary_level_roll_no }}</td>
        </tr>
        <tr>
            <th>CSE Prelims Roll No.</th>
            <td>{{ $registration->cse_prelims_roll_no }}</td>
        </tr>
        <tr>
            <th>First Name</th>
            <td>{{ $registration->first_name }}</td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td>{{ $registration->last_name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $registration->email }}</td>
        </tr>
        <tr>
            <th>Alternate Email</th>
            <td>{{ $registration->alternate_email ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Mobile No.</th>
            <td>{{ $registration->mobile_no }}</td>
        </tr>
        <tr>
            <th>Alternate Mobile No.</th>
            <td>{{ $registration->alternate_mobile_no ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>WhatsApp No.</th>
            <td>{{ $registration->whatsapp_no }}</td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td>{{ $registration->dob }}</td>
        </tr>
        <tr>
            <th>Gender</th>
            <td>{{ $registration->gender }}</td>
        </tr>
        <tr>
            <th>Category</th>
            <td>{{ $registration->category }}</td>
        </tr>
        <tr>
            <th>PwBD Status</th>
            <td>{{ $registration->pwbd_status ? 'Yes' : 'No' }}</td>
        </tr>
        @if ($registration->pwbd_status)
            <tr>
                <th>PwBD Description</th>
                <td>{{ $registration->pwbd_description }}</td>
            </tr>
        @endif
        <tr>
            <th>Father's Name</th>
            <td>{{ $registration->fathers_name }}</td>
        </tr>
        <tr>
            <th>Mother's Name</th>
            <td>{{ $registration->mothers_name }}</td>
        </tr>
        <tr>
            <th>Student's Occupation</th>
            <td>{{ $registration->students_occupation }}</td>
        </tr>
        <tr>
            <th>Father's Occupation</th>
            <td>{{ $registration->fathers_occupation }}</td>
        </tr>
        <tr>
            <th>Mother's Occupation</th>
            <td>{{ $registration->mothers_occupation }}</td>
        </tr>
        <tr>
            <th>Medium of Instruction</th>
            <td>{{ $registration->medium_of_instruction }}</td>
        </tr>
        <tr>
            <th>Optional Subject</th>
            <td>{{ $registration->optional_subject }}</td>
        </tr>
        <tr>
            <th>Subject in Graduation</th>
            <td>{{ $registration->subject_in_graduation }}</td>
        </tr>
        <tr>
            <th>Institution (Graduation)</th>
            <td>{{ $registration->institution_graduation }}</td>
        </tr>
        <tr>
            <th>Subject in Post-Graduation</th>
            <td>{{ $registration->subject_in_post_graduation ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Institution (Post-Graduation)</th>
            <td>{{ $registration->institution_post_graduation ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Appeared in UPSC CSE</th>
            <td>{{ $registration->appeared_in_upsc_cse ? 'Yes' : 'No' }}</td>
        </tr>
        @if ($registration->appeared_in_upsc_cse)
            <tr>
                <th>UPSC CSE Years</th>
                <td>{{ $registration->upsc_cse_years }}</td>
            </tr>
        @endif
        <tr>
            <th>Need Hostel</th>
            <td>{{ $registration->need_hostel ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <th>Take Test Series</th>
            <td>{{ $registration->take_test_series ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <th>Currently Employed</th>
            <td>{{ $registration->currently_employed ? 'Yes' : 'No' }}</td>
        </tr>
        @if ($registration->currently_employed)
            <tr>
                <th>Employment Details</th>
                <td>{{ $registration->employment_details }}</td>
            </tr>
        @endif
    </table>

    <!-- Addresses -->
    <div class="section-title">Addresses</div>
    <table>
        @foreach ($registration->addresses as $address)
            <tr>
                <th>{{ $address->type }} Address</th>
                <td>{{ $address->full_address }}, {{ $address->district }}, {{ $address->state }}, {{ $address->pincode }}</td>
            </tr>
        @endforeach
    </table>

    <!-- Documents -->
    <div class="section-title">Documents</div>
    <table>
        @foreach ($registration->documents as $document)
            <tr>
                <th>{{ $document->type }}</th>
                <td>{{ basename($document->file_path) }}</td>
            </tr>
        @endforeach
    </table>
</div>

<div class="footer">
    <p>Page <span class="page"></span></p>
</div>