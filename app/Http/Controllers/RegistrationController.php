<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Registration;
use App\Models\Document;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    /**
     * Display the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        // Load states and districts from JSON files
        $states = json_decode(file_get_contents(public_path('json/india_states.json')), true);
        $districts = json_decode(file_get_contents(public_path('json/india_districts.json')), true);
        // $optionalSubjects = json_decode(file_get_contents(public_path('json/optional_subjects.json')), true);
        $optionalSubjects = [
            'Agriculture', 'Animal Husbandry and Veterinary Science', 'Anthropology', 'Botany',
            'Chemistry', 'Civil Engineering', 'Commerce and Accountancy', 'Economics',
            'Electrical Engineering', 'Geography', 'Geology', 'History', 'Law',
            'Management', 'Mathematics', 'Mechanical Engineering', 'Medical Science',
            'Philosophy', 'Physics', 'Political Science and International Relations',
            'Psychology', 'Public Administration', 'Sociology', 'Statistics', 'Zoology'
        ];

        return view('registration.form', compact('states', 'districts', 'optionalSubjects'));
    }

    /**
     * Handle document upload.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadDocument(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpeg,png,pdf|max:2048', // 2MB max
            'type' => 'required|string|in:Photo,Identity Document,Secondary (10th) Admit Card,UPSC Prelims Admit Card,UPSC DAF(Mains),Others Documents',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $file = $request->file('file');
        $type = $request->input('type');
        $extension = $file->getClientOriginalExtension();
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        // Temporary filename: type_temp_random.extension
        $tempFilename = str_replace(' ', '_', $type) . '_temp_' . Str::random(20) . '.' . $extension;
        $path = $file->storeAs('documents', $tempFilename, 'public');

        // Calculate file size in KB
        $size = number_format($file->getSize() / 1024, 2) . ' KB';

        return response()->json([
            'type' => $type,
            'path' => $path,
            'url' => Storage::url($path),
            'name' => $originalName . '.' . $extension,
            'size' => $size,
            'temp_filename' => $tempFilename,
        ]);
    }

    /**
     * Store the registration form data and generate PDF.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate form data
        $validator = Validator::make($request->all(), [
            'programme_enrolled' => 'required|string|in:Composite Course,Mains Guidance Programme,Prelims Crash Course',
            'batch' => 'required|integer|min:2020|max:2025',
            'sntcssc_roll_no' => 'nullable|string|regex:/^[a-zA-Z0-9\-\/]+$/',
            'secondary_level_roll_no' => 'nullable|string|regex:/^[a-zA-Z0-9\-\/]+$/',
            'cse_prelims_roll_no' => 'nullable|string|regex:/^[a-zA-Z0-9\-\/]+$/',
            'first_name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email',
            'alternate_email' => 'nullable|email',
            'mobile_no' => 'required|string|regex:/^[6-9]\d{9}$/',
            'alternate_mobile_no' => 'nullable|string|regex:/^[6-9]\d{9}$/',
            'whatsapp_no' => 'nullable|string|regex:/^[6-9]\d{9}$/',
            'dob' => 'required|date|before:today',
            'gender' => 'required|string|in:Male,Female,Other',
            'category' => 'required|string|in:UR,SC,ST,OBC',
            'pwbd_status' => 'required|in:yes,no',
            'pwbd_description' => 'nullable|required_if:pwbd_status,yes|string',
            'fathers_name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'mothers_name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'students_occupation' => 'nullable|string|regex:/^[\w\s,.()-]+$/',
            'fathers_occupation' => 'nullable|string|regex:/^[\w\s,.()-]+$/',
            'mothers_occupation' => 'nullable|string|regex:/^[\w\s,.()-]+$/',
            'medium_instruction' => 'required|string|regex:/^[\w\s,.()-]+$/',
            'optional_subject' => 'nullable|string',
            'subject_graduation' => 'nullable|string|regex:/^[\w\s,.()-]+$/',
            'institution_graduation' => 'nullable|string|regex:/^[\w\s,.()-]+$/',
            'subject_post_graduation' => 'nullable|string|regex:/^[\w\s,.()-]+$/',
            'institution_post_graduation' => 'nullable|string|regex:/^[\w\s,.()-]+$/',
            'appeared_upsc_cse' => 'required|in:yes,no',
            'upsc_cse_years' => 'nullable|required_if:appeared_upsc_cse,yes|string|regex:/^\d{4}(,\s*\d{4})*$/',
            'hostel_accommodation' => 'required|in:yes,no',
            'test_series' => 'required|in:yes,no',
            'currently_employed' => 'required|in:yes,no',
            'employment_details' => 'nullable|required_if:currently_employed,yes|string',
            'present_address' => 'required|string',
            'present_state' => 'required|string',
            'present_district' => 'required|string',
            'present_pincode' => 'required|string|regex:/^\d{6}$/',
            'permanent_address' => 'required|string',
            'permanent_state' => 'required|string',
            'permanent_district' => 'required|string',
            'permanent_pincode' => 'required|string|regex:/^\d{6}$/',
            'documents' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        // Decode documents JSON string
        $documents = json_decode($request->input('documents'), true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($documents)) {
            return response()->json(['message' => 'Invalid documents format.'], 422);
        }

        // Validate mandatory documents
        $mandatoryDocs = ['Photo', 'Identity Document', 'Secondary (10th) Admit Card', 'UPSC Prelims Admit Card', 'UPSC DAF(Mains)'];
        $uploadedDocs = array_column($documents, 'type');
        $missingDocs = array_diff($mandatoryDocs, $uploadedDocs);

        if (!empty($missingDocs)) {
            return response()->json(['message' => 'Missing required documents: ' . implode(', ', $missingDocs)], 422);
        }

        // Store registration data
        $registration = Registration::create([
            'registration_no' => 'REG-' . Str::random(10),
            'programme_enrolled' => $request->programme_enrolled,
            'batch' => $request->batch,
            'sntcssc_roll_no' => $request->sntcssc_roll_no,
            'secondary_level_roll_no' => $request->secondary_level_roll_no,
            'cse_prelims_roll_no' => $request->cse_prelims_roll_no,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'alternate_email' => $request->alternate_email,
            'mobile_no' => $request->mobile_no,
            'alternate_mobile_no' => $request->alternate_mobile_no,
            'whatsapp_no' => $request->whatsapp_no,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'category' => $request->category,
            'pwbd_status' => $request->pwbd_status,
            'pwbd_description' => $request->pwbd_description,
            'fathers_name' => $request->fathers_name,
            'mothers_name' => $request->mothers_name,
            'students_occupation' => $request->students_occupation,
            'fathers_occupation' => $request->fathers_occupation,
            'mothers_occupation' => $request->mothers_occupation,
            'medium_instruction' => $request->medium_instruction,
            'optional_subject' => $request->optional_subject,
            'subject_graduation' => $request->subject_graduation,
            'institution_graduation' => $request->institution_graduation,
            'subject_post_graduation' => $request->subject_post_graduation,
            'institution_post_graduation' => $request->institution_post_graduation,
            'appeared_upsc_cse' => $request->appeared_upsc_cse,
            'upsc_cse_years' => $request->upsc_cse_years,
            'hostel_accommodation' => $request->hostel_accommodation,
            'test_series' => $request->test_series,
            'currently_employed' => $request->currently_employed,
            'employment_details' => $request->employment_details,
            'present_address' => $request->present_address,
            'present_state' => $request->present_state,
            'present_district' => $request->present_district,
            'present_pincode' => $request->present_pincode,
            'permanent_address' => $request->permanent_address,
            'permanent_state' => $request->permanent_state,
            'permanent_district' => $request->permanent_district,
            'permanent_pincode' => $request->permanent_pincode,
        ]);

        Log::info($registration);
        // dd('Log Added');

        // Rename documents and store in documents table
        $timestamp = Carbon::now()->format('YmdHis');
        $updatedDocuments = [];
        foreach ($documents as &$doc) {
            if (!Storage::disk('public')->exists($doc['path'])) {
                return response()->json(['message' => "Document file not found: {$doc['name']}"], 422);
            }

            // Sanitize document type and original name for filename
            $docType = str_replace(' ', '_', $doc['type']);
            $originalName = pathinfo($doc['name'], PATHINFO_FILENAME);
            $sanitizedName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalName);
            $extension = pathinfo($doc['path'], PATHINFO_EXTENSION);
            $newFilename = "{$docType}_{$registration->id}_{$sanitizedName}_{$timestamp}.{$extension}";
            $newPath = "documents/{$newFilename}";

            // Rename the file
            Storage::disk('public')->move($doc['path'], $newPath);

            // Update document metadata
            $doc['path'] = $newPath;
            $doc['url'] = Storage::url($newPath);
            $updatedDocuments[] = $doc;

            // Store in documents table
            Document::create([
                'registration_id' => $registration->id,
                'type' => $doc['type'],
                'path' => $newPath,
                'url' => Storage::url($newPath),
                'name' => $doc['name'],
            ]);
        }

        // Generate PDF
        // $pdf = Pdf::loadView('pdf.registration', [
        //     'registration' => $registration,
        //     'documents' => $updatedDocuments,
        // ]);
        
        $pdf = $this->generateRegistrationPdf($registration, $updatedDocuments);

        // Save or output the PDF
        // $pdf->save(storage_path('app/public/registration.pdf'));  // Save to storage
        // $pdf->stream('registration.pdf');  // Stream to the browser


        $pdfPath = 'pdfs/registration_' . $registration->id . '.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());

        // return $pdf->stream('registration.pdf');

        return response()->json([
            'message' => 'Registration successful!',
            'pdf_url' => Storage::url($pdfPath),
        ]);
    }


    // A function that processes registration and updatedDocuments data, handles image file conversion to Base64, and then generates a PDF using the Pdf::loadView method.

    function generateRegistrationPdf($registration, $updatedDocuments)
    {
        // Convert logo to Base64
        $logoPath = public_path('images/logo.png');
        
        $logoBase64 = '';
        if (file_exists($logoPath)) {
            $logoData = file_get_contents($logoPath);
            $logoBase64 = 'data:image/png;base64,' . base64_encode($logoData);
        }

        // Check if the first document is a photo (assuming $updatedDocuments is an array of associative arrays)
        $photoBase64 = '';
        if (isset($updatedDocuments[0]) && isset($updatedDocuments[0]['type']) && $updatedDocuments[0]['type'] === 'Photo') {
            $photoPath = $updatedDocuments[0]['path'];

            // Convert photo to Base64
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                $photoData = Storage::disk('public')->get($photoPath);
                $mimeType = mime_content_type(storage_path('app/public/' . $photoPath));
                $photoBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($photoData);
            }
        }

        // Generate the PDF
        $pdf = Pdf::loadView('pdf.registration', [
            'registration' => $registration,
            'documents' => $updatedDocuments,
            'logoBase64' => $logoBase64,
            'photoBase64' => $photoBase64,
        ])->setOptions([
            'isPhpEnabled' => true,
            'dpi' => 96,
            'default_paper_size' => 'A4',
            'pdf_title' => 'SNTCSSC Registration 2025',
            'pdf_author' => 'Satyendra Nath Tagore Civil Services Study Centre (SNTCSSC)',
        ])->setPaper('A4', 'portrait');

        return $pdf;
    }


    public function download($id)
    {
        // Fetch the registration record by ID
        $registration = Registration::findOrFail($id);

        // If you want to load related documents or other relations, you can eager load them:
        $updatedDocuments = $registration->documents; // Assuming 'documents' is a relationship on Registration model

        // Convert logo to Base64
        $logoPath = public_path('images/logo.png');
        
        $logoBase64 = '';
        if (file_exists($logoPath)) {
            $logoData = file_get_contents($logoPath);
            $logoBase64 = 'data:image/png;base64,' . base64_encode($logoData);
        }

        if($updatedDocuments[0]->type === 'Photo'){
            $photoPath = $updatedDocuments[0]->path;
        }
        // dd($photoPath);

        // Convert photo to Base64
        $photoBase64 = '';
        
        if ($photoPath && Storage::disk('public')->exists($photoPath)) {
            $photoData = Storage::disk('public')->get($photoPath);
            $mimeType = mime_content_type(storage_path('app/public/' . $photoPath));
            $photoBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($photoData);
        }

        // Generate the PDF
        // $pdf = Pdf::loadView('pdf.registration', [
        //     'registration' => $registration,
        //     'documents' => $updatedDocuments,
        //     'logoBase64' => $logoBase64,
        //     'photoBase64' => $photoBase64,
        // ])->setOptions(['isPhpEnabled' => true, 'dpi' => 96, 'pdf_title' => 'SNTCSSC Registration 2025', 'pdf_author' => 'SNTCSSC Institute']);

        $pdf = Pdf::loadView('pdf.registration', [
            'registration' => $registration,
            'documents' => $updatedDocuments,
            'logoBase64' => $logoBase64,
            'photoBase64' => $photoBase64,
        ])->setOptions([
            'isPhpEnabled' => true,
            'dpi' => 96,
            'default_paper_size' => 'A4',
            'pdf_title' => 'SNTCSSC Registration 2025',
            'pdf_author' => 'Satyendra Nath Tagore Civil Services Study Centre (SNTCSSC)',
        ])->setPaper('A4', 'portrait');

        // Define the path for saving the PDF file
        $pdfPath = 'pdfs/registration_' . $registration->id . '.pdf';

        // Store the generated PDF on disk (ensure 'public' disk is configured)
        Storage::disk('public')->put($pdfPath, $pdf->output());

        // Optionally, you can return the path or a success message
        return response()->json([
            'message' => 'PDF successfully generated and saved.',
            'pdf_path' => $pdfPath,
            'pdf_url' => Storage::url($pdfPath),
        ]);
    }

}