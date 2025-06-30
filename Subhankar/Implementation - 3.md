I want to create an application using laravel 12  bootstrap 5 for registration form.
A form with fields and uploaded fields (files uploaded should be done using on selecting file by ajax request and there should be preview options after successful uploading files and need to realtime validate specific file type and file sizes) - Please use fully responsive with a mobile-first approach design with clean, modern professional looking which scalable and maintainable, optimized system. Also Display a loading spinner during form submission for better UX, and a confirmation before submission to prevent accidental submission. Validate file size and type before uploading to reduce server load. 

A table for Registration 
    ID
    Registration No.
    SNTCSSC Roll No.
    Programme Enrolled - Composite Course/Mains Guidance Programme/Prelims Crash Course etc.
    Batch - 2020/2021/2022/2023/2024/2025
    Secondary Level Roll no.
    CSE (Prelims.) Roll No.
    first name,
    last name,
    email id,
    alternate email id,
    mobile no.
    alternate mobile no.
    whatsapp no.
    DOB
    Gender
    Category - UR/SC/ST/OBC
    PwBD status - Yes / No
    PwBD Description (if yes then this field need to be filled)
    Fathers Name
    Mothers Name
    Students Occupation
    Father's Occupation
    Mother's Occupation
    Medium of Instruction at School Level
    optional subject,
    Subject In Graduation
    Name of Academic Institution attended for Graduation
    Subject in Post Graduation
    Name of Academic Institution attended for Post Graduation
    Have you appeared in UPSC CSE earlier? - YES/No
        If yes, please mention the year / years
    Do you need hostel accommodation? - Yes / No
    Do you wish to take Test Series? Yes / No
    Are you currently employed? - Yes / No
        Employement Details (if yes then this fields should be filled)

A tables for Address:
        Type: Present / Permanent
        Full Address
        State
        District
        Pincode

A table Documents:
    All documents should be uploaded in documents name table with different type as given below.
    Photo
    Identity Document
    Secondary Admit Card
    UPSC Prelims Admit Card
    UPSC DAF(Mains)
    Others Documents (Should be able to upload multiple documents at once)

Before Submission theres should be a preview of all entered data and After submission for there should be sent a confirmation email and an application form alongwith all input details should be downloaded.
Please provide migrations, models (use soft delete) and views, controllers, routes - complete implementation step by step.


Please design the UI more beautiful, currently not looking good please use logo and institute name and address in the header for the registration-form, the spinner or loader should be displayed correctly its not displaying correct and in preview all the information should be display table format so that it look nice, and there should be a checkbox in between present and permanent address so that if there is same address then just click and it will copy the address from present to permanent address also for the downloaded pdf document use table format design and also include image in the download pdf with  logo and institute name and address in header and in footer page no. of pdf and in that pdf heading like Registration Information sheet for SNTCSSC MGP 2025 Batch and then should be all information in table format similar like registration form preview.

Please include all states in india in the states fields in dropdown and state wise district dropdown in district fields, you may use json and similarly optional subject fields include all UPSC optional subject as dropdown list.

Currently in form.blade.php code not working properly like - on click PwBD Status yes its not showing PwBD Description in realtime, means when clicked on preview then its showing also same way for Appeared in UPSC CSE fields and Currently Employed?
and  onclicking Same as Present Address checkbox its not auto filled the present address to permanent address. and for documents uploaded sections there should be all type of documents need to be uploaded individually except others documents because its optional.






==================


I want to create an application using laravel 12  bootstrap 5 for Student Registration Collection using registration form.
A form with fields and uploaded fields (files uploaded should be done using on selecting file by ajax request and there should be preview options after successful uploading files and need to realtime validate specific file type and file sizes) - Please use fully responsive with a mobile-first approach design with clean, modern professional looking which scalable and maintainable, optimized system. Also Display a loading spinner during form submission for better UX, and a confirmation before submission to prevent accidental submission. Validate file size and type before uploading to reduce server load. 

A table for Registration 
    ID
    Registration No.
    SNTCSSC Roll No.
    Programme Enrolled - Composite Course/Mains Guidance Programme/Prelims Crash Course etc.
    Batch - 2020/2021/2022/2023/2024/2025
    Secondary Level Roll no.
    CSE (Prelims.) Roll No.
    first name,
    last name,
    email id,
    alternate email id,
    mobile no.
    alternate mobile no.
    whatsapp no.
    DOB
    Gender
    Category - UR/SC/ST/OBC
    PwBD status - Yes / No
    PwBD Description (if yes then this field need to be filled)
    Fathers Name
    Mothers Name
    Students Occupation
    Father's Occupation
    Mother's Occupation
    Medium of Instruction at School Level
    optional subject,
    Subject In Graduation
    Name of Academic Institution attended for Graduation
    Subject in Post Graduation
    Name of Academic Institution attended for Post Graduation
    Have you appeared in UPSC CSE earlier? - YES/No
        If yes, please mention the year / years
    Do you need hostel accommodation? - Yes / No
    Do you wish to take Test Series? Yes / No
    Are you currently employed? - Yes / No
        Employement Details (if yes then this fields should be filled)

A tables for Address:
        Type: Present / Permanent
        Full Address
        State
        District
        Pincode

A table Documents:
    All documents should be uploaded in documents name table with different type as given below.
    Photo
    Identity Document
    Secondary Admit Card
    UPSC Prelims Admit Card
    UPSC DAF(Mains)
    Others Documents (Should be able to upload multiple documents at once)

Before Submission theres should be a preview of all entered data and After submission for there should be sent a confirmation email and an application form alongwith all input details should be downloaded.
Please provide migrations, models (use soft delete) and views, controllers, routes - complete implementation step by step.


Please design the UI more beautiful, currently not looking good please use logo and institute name and address in the header for the registration-form, the spinner or loader should be displayed correctly its not displaying correct and in preview all the information should be display table format so that it look nice, and there should be a checkbox in between present and permanent address so that if there is same address then just click and it will copy the address from present to permanent address also for the downloaded pdf document use table format design and also include image in the download pdf with  logo and institute name and address in header and in footer page no. of pdf and in that pdf heading like Registration Information sheet for SNTCSSC MGP 2025 Batch and then should be all information in table format similar like registration form preview.

Please include all states in india in the states fields in dropdown and state wise district dropdown in district fields, you may use json and similarly optional subject fields include all UPSC optional subject as dropdown list.