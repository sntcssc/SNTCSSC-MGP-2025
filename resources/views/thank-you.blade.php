<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold">Thank You!</h1>
    <p>{{ session('message') }}</p>
    <a href="{{ route('download-application', $registration_id) }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded">Download Application Form</a>
</div>