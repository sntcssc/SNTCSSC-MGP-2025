\documentclass[a4paper,12pt]{article}
\usepackage{geometry}
\geometry{top=2cm,bottom=2cm,left=2cm,right=2cm}
\usepackage{graphicx}
\usepackage{array}
\usepackage{longtable}
\usepackage{fancyhdr}
\pagestyle{fancy}
\fancyhf{}
\fancyhead[C]{\includegraphics[width=2cm]{logo.png}\\SNTCSSC Institute\\1234, Academic Avenue, New Delhi, India}
\fancyfoot[C]{\thepage}
\begin{document}
\begin{center}
    \textbf{Registration Information Sheet for SNTCSSC MGP 2025 Batch}
\end{center}
\begin{longtable}{|p{5cm}|p{10cm}|}
    \hline
    \textbf{Field} & \textbf{Details} \\ \hline
    Registration No. & {{$registration->registration_no}} \\ \hline
    SNTCSSC Roll No. & {{$registration->sntcssc_roll_no}} \\ \hline
    Programme Enrolled & {{$registration->programme_enrolled}} \\ \hline
    Batch & {{$registration->batch}} \\ \hline
    First Name & {{$registration->first_name}} \\ \hline
    Last Name & {{$registration->last_name}} \\ \hline
    Email & {{$registration->email}} \\ \hline
    Alternate Email & {{$registration->alternate_email}} \\ \hline
    Mobile No. & {{$registration->mobile_no}} \\ \hline
    Alternate Mobile No. & {{$registration->alternate_mobile_no}} \\ \hline
    Whatsapp No. & {{$registration->whatsapp_no}} \\ \hline
    DOB & {{$registration->dob}} \\ \hline
    Gender & {{$registration->gender}} \\ \hline
    Category & {{$registration->category}} \\ \hline
    PwBD Status & {{$registration->pwbd_status ? 'Yes' : 'No'}} \\ \hline
    PwBD Description & {{$registration->pwbd_description}} \\ \hline
    Father's Name & {{$registration->fathers_name}} \\ \hline
    Mother's Name & {{$registration->mothers_name}} \\ \hline
    Student's Occupation & {{$registration->students_occupation}} \\ \hline
    Father's Occupation & {{$registration->fathers_occupation}} \\ \hline
    Mother's Occupation & {{$registration->mothers_occupation}} \\ \hline
    Medium of Instruction & {{$registration->medium_instruction}} \\ \hline
    Optional Subject & {{$registration->optional_subject}} \\ \hline
    Subject in Graduation & {{$registration->subject_graduation}} \\ \hline
    Institution (Graduation) & {{$registration->institution_graduation}} \\ \hline
    Subject in Post Graduation & {{$registration->subject_post_graduation}} \\ \hline
    Institution (Post Graduation) & {{$registration->institution_post_graduation}} \\ \hline
    Appeared in UPSC CSE & {{$registration->appeared_upsc_cse ? 'Yes' : 'No'}} \\ \hline
    UPSC CSE Years & {{$registration->upsc_cse_years}} \\ \hline
    Hostel Accommodation & {{$registration->hostel_accommodation ? 'Yes' : 'No'}} \\ \hline
    Test Series & {{$registration->test_series ? 'Yes' : 'No'}} \\ \hline
    Currently Employed & {{$registration->currently_employed ? 'Yes' : 'No'}} \\ \hline
    Employment Details & {{$registration->employment_details}} \\ \hline
    \end{longtable}
    \textbf{Addresses} \\
    \begin{longtable}{|p{5cm}|p{10cm}|}
        \hline
        \textbf{Type} & \textbf{Details} \\ \hline
        @foreach($registration->addresses as $address)
            Type & {{$address->type}} \\ \hline
            Full Address & {{$address->full_address}} \\ \hline
            State & {{$address->state}} \\ \hline
            District & {{$address->district}} \\ \hline
            Pincode & {{$address->pincode}} \\ \hline
        @endforeach
    \end{longtable}
    \textbf{Documents} \\
    \begin{longtable}{|p{5cm}|p{10cm}|}
        \hline
        \textbf{Type} & \textbf{File Path} \\ \hline
        @foreach($registration->documents as $document)
            Type & {{$document->type}} \\ \hline
            File Path & {{$document->file_path}} \\ \hline
        @endforeach
    \end{longtable}
\end{document}