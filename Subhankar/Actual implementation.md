I want to create an a laravel application using livewire for registration.
A form with fields and uploaded fields - 

A table for Applications 
    Registration ID
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
A tables for Address:
        Type: Present / Permanent
        Full Address
        State
        District
        Pincode
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

A table Applications Documents:
    All documents should be uploaded in documents name table with different type as given below.
    Photo
    Identity Document
    Secondary Admit Card
    UPSC Prelims Admit Card
    UPSC DAF(Mains)
    Others Documents (Should be able to upload multiple documents at once)




==================================================================================

I want to create an a laravel application using livewire for registration.
A form with fields and uploaded fields - 


Actual Application would be Applicants(candidate's/students) Authentication - 
A table for Applications 
    Studens Id : foreign key
    Registration ID
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
A tables for Address:
        Type: Present / Permanent
        Full Address
        State
        District
        Pincode
    Students Occupation
    Father's Occupation
    Mother's Occupation
    Medium of Instruction at School Level
    optional subject,

    // Subject In Graduation
    // Name of Academic Institution attended for Graduation
    // Subject in Post Graduation
    // Name of Academic Institution attended for Post Graduation


    Have you appeared in UPSC CSE earlier? - YES/No
        If yes, please mention the year / years

    Do you need hostel accommodation? - Yes / No
    Do you wish to take Test Series? Yes / No

    Are you currently employed? - Yes / No
    Employement Details (if yes then this fields should be filled)

A table for Application Academic Qualifications:
    Exams Type - Secondary/Higher Secondary / Graduation
    Institute Name
    Board/University Name
    Year Passed
    Total Marks
    Marks Obtained
    CGPA/SGPA
    Grade
A table Applications Documents:
    Documents need to be Uploaded 
    All documents should be uploaded in documents name table with different type as given below.
    Photo
    Identity Document
    Secondary Admit Card
    UPSC Prelims Admit Card
    UPSC DAF(Mains)
    Others Documents (Should be able to upload multiple documents at once)

    A table for students or candidates

