<div class="relative max-w-4xl mx-auto" id="app">
    <!-- Header -->
    <header class="bg-blue-600 text-white p-6 rounded-t-lg shadow-md flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <img src="https://via.placeholder.com/100" alt="SNTCSSC Logo" class="h-16 w-16 rounded-full">
            <div>
                <h1 class="text-2xl font-bold">SNTCSSC</h1>
                <p class="text-sm">123 Education Lane, Academic City, India</p>
                <p class="text-sm">Email: info@sntcssc.org | Phone: +91 123 456 7890</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="bg-white p-6 rounded-b-lg shadow-lg">
        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                {{ session('message') }}
            </div>
        @endif

        @if ($showPreview)
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Preview Your Registration</h2>
            <div class="space-y-6">
                <!-- Personal Details -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Personal Details</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <tbody>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Registration No.</td>
                                    <td class="py-2 px-4">{{ $registration_no }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">SNTCSSC Roll No.</td>
                                    <td class="py-2 px-4">{{ $sntcssc_roll_no }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Programme Enrolled</td>
                                    <td class="py-2 px-4">{{ $programme_enrolled }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Batch</td>
                                    <td class="py-2 px-4">{{ $batch }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Secondary Level Roll No.</td>
                                    <td class="py-2 px-4">{{ $secondary_level_roll_no }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">CSE Prelims Roll No.</td>
                                    <td class="py-2 px-4">{{ $cse_prelims_roll_no }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">First Name</td>
                                    <td class="py-2 px-4">{{ $first_name }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Last Name</td>
                                    <td class="py-2 px-4">{{ $last_name }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Email</td>
                                    <td class="py-2 px-4">{{ $email }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Alternate Email</td>
                                    <td class="py-2 px-4">{{ $alternate_email ?? 'N/A' }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Mobile No.</td>
                                    <td class="py-2 px-4">{{ $mobile_no }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Alternate Mobile No.</td>
                                    <td class="py-2 px-4">{{ $alternate_mobile_no ?? 'N/A' }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">WhatsApp No.</td>
                                    <td class="py-2 px-4">{{ $whatsapp_no }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Date of Birth</td>
                                    <td class="py-2 px-4">{{ $dob }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Gender</td>
                                    <td class="py-2 px-4">{{ $gender }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Category</td>
                                    <td class="py-2 px-4">{{ $category }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">PwBD Status</td>
                                    <td class="py-2 px-4">{{ $pwbd_status ? 'Yes' : 'No' }}</td>
                                </tr>
                                @if ($pwbd_status)
                                    <tr class="border-b">
                                        <td class="py-2 px-4 font-medium text-gray-600">PwBD Description</td>
                                        <td class="py-2 px-4">{{ $pwbd_description }}</td>
                                    </tr>
                                @endif
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Father's Name</td>
                                    <td class="py-2 px-4">{{ $fathers_name }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Mother's Name</td>
                                    <td class="py-2 px-4">{{ $mothers_name }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Student's Occupation</td>
                                    <td class="py-2 px-4">{{ $students_occupation }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Father's Occupation</td>
                                    <td class="py-2 px-4">{{ $fathers_occupation }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Mother's Occupation</td>
                                    <td class="py-2 px-4">{{ $mothers_occupation }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Medium of Instruction</td>
                                    <td class="py-2 px-4">{{ $medium_of_instruction }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Optional Subject</td>
                                    <td class="py-2 px-4">{{ $optional_subject }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Subject in Graduation</td>
                                    <td class="py-2 px-4">{{ $subject_in_graduation }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Institution (Graduation)</td>
                                    <td class="py-2 px-4">{{ $institution_graduation }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Subject in Post-Graduation</td>
                                    <td class="py-2 px-4">{{ $subject_in_post_graduation ?? 'N/A' }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Institution (Post-Graduation)</td>
                                    <td class="py-2 px-4">{{ $institution_post_graduation ?? 'N/A' }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Appeared in UPSC CSE</td>
                                    <td class="py-2 px-4">{{ $appeared_in_upsc_cse ? 'Yes' : 'No' }}</td>
                                </tr>
                                @if ($appeared_in_upsc_cse)
                                    <tr class="border-b">
                                        <td class="py-2 px-4 font-medium text-gray-600">UPSC CSE Years</td>
                                        <td class="py-2 px-4">{{ $upsc_cse_years }}</td>
                                    </tr>
                                @endif
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Need Hostel</td>
                                    <td class="py-2 px-4">{{ $need_hostel ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Take Test Series</td>
                                    <td class="py-2 px-4">{{ $take_test_series ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Currently Employed</td>
                                    <td class="py-2 px-4">{{ $currently_employed ? 'Yes' : 'No' }}</td>
                                </tr>
                                @if ($currently_employed)
                                    <tr class="border-b">
                                        <td class="py-2 px-4 font-medium text-gray-600">Employment Details</td>
                                        <td class="py-2 px-4">{{ $employment_details }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Addresses -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Addresses</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <tbody>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Present Address</td>
                                    <td class="py-2 px-4">{{ $present_address['full_address'] }}, {{ $present_address['district'] }}, {{ $present_address['state'] }}, {{ $present_address['pincode'] }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 px-4 font-medium text-gray-600">Permanent Address</td>
                                    <td class="py-2 px-4">{{ $permanent_address['full_address'] }}, {{ $permanent_address['district'] }}, {{ $permanent_address['state'] }}, {{ $permanent_address['pincode'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Documents -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Uploaded Documents</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @if ($photo)
                            <div class="bg-gray-50 p-4 rounded-lg shadow">
                                <p class="text-sm text-gray-600 font-medium">Photo</p>
                                <img src="{{ $photo->temporaryUrl() }}" class="mt-2 max-w-full h-32 object-cover rounded" alt="Photo">
                            </div>
                        @endif
                        @if ($identity_document)
                            <div class="bg-gray-50 p-4 rounded-lg shadow">
                                <p class="text-sm text-gray-600 font-medium">Identity Document</p>
                                @if (in_array($identity_document->getClientOriginalExtension(), ['jpg', 'png']))
                                    <img src="{{ $identity_document->temporaryUrl() }}" class="mt-2 max-w-full h-32 object-cover rounded" alt="Identity Document">
                                @else
                                    <p class="mt-2 text-gray-500"><i class="fas fa-file-pdf"></i> {{ $identity_document->getClientOriginalName() }}</p>
                                @endif
                            </div>
                        @endif
                        @if ($secondary_admit_card)
                            <div class="bg-gray-50 p-4 rounded-lg shadow">
                                <p class="text-sm text-gray-600 font-medium">Secondary Admit Card</p>
                                @if (in_array($secondary_admit_card->getClientOriginalExtension(), ['jpg', 'png']))
                                    <img src="{{ $secondary_admit_card->temporaryUrl() }}" class="mt-2 max-w-full h-32 object-cover rounded" alt="Secondary Admit Card">
                                @else
                                    <p class="mt-2 text-gray-500"><i class="fas fa-file-pdf"></i> {{ $secondary_admit_card->getClientOriginalName() }}</p>
                                @endif
                            </div>
                        @endif
                        @if ($upsc_prelims_admit_card)
                            <div class="bg-gray-50 p-4 rounded-lg shadow">
                                <p class="text-sm text-gray-600 font-medium">UPSC Prelims Admit Card</p>
                                @if (in_array($upsc_prelims_admit_card->getClientOriginalExtension(), ['jpg', 'png']))
                                    <img src="{{ $upsc_prelims_admit_card->temporaryUrl() }}" class="mt-2 max-w-full h-32 object-cover rounded" alt="UPSC Prelims Admit Card">
                                @else
                                    <p class="mt-2 text-gray-500"><i class="fas fa-file-pdf"></i> {{ $upsc_prelims_admit_card->getClientOriginalName() }}</p>
                                @endif
                            </div>
                        @endif
                        @if ($upsc_daf_mains)
                            <div class="bg-gray-50 p-4 rounded-lg shadow">
                                <p class="text-sm text-gray-600 font-medium">UPSC DAF (Mains)</p>
                                @if (in_array($upsc_daf_mains->getClientOriginalExtension(), ['jpg', 'png']))
                                    <img src="{{ $upsc_daf_mains->temporaryUrl() }}" class="mt-2 max-w-full h-32 object-cover rounded" alt="UPSC DAF (Mains)">
                                @else
                                    <p class="mt-2 text-gray-500"><i class="fas fa-file-pdf"></i> {{ $upsc_daf_mains->getClientOriginalName() }}</p>
                                @endif
                            </div>
                        @endif
                        @foreach ($others_documents as $index => $file)
                            @if ($file)
                                <div class="bg-gray-50 p-4 rounded-lg shadow">
                                    <p class="text-sm text-gray-600 font-medium">Other Document {{ $index + 1 }}</p>
                                    @if (in_array($file->getClientOriginalExtension(), ['jpg', 'png']))
                                        <img src="{{ $file->temporaryUrl() }}" class="mt-2 max-w-full h-32 object-cover rounded" alt="Other Document {{ $index + 1 }}">
                                    @else
                                        <p class="mt-2 text-gray-500"><i class="fas fa-file-pdf"></i> {{ $file->getClientOriginalName() }}</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            @if ($confirmSubmission)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mt-6 rounded">
                    <p class="text-center font-medium">Are you sure you want to submit this registration?</p>
                    <div class="mt-6 flex justify-center space-x-4">
                        <button wire:click="edit" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 transition duration-200">Cancel</button>
                        <button wire:click="submit" wire:loading.attr="disabled" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition duration-200">Confirm</button>
                    </div>
                </div>
            @else
                <div class="flex justify-center space-x-4 mt-6">
                    <button wire:click="edit" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 transition duration-200">Edit</button>
                    <button wire:click="confirm" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition duration-200">Submit</button>
                </div>
            @endif
        @else
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Registration Form</h2>
            <div class="space-y-8">
                <!-- Personal Details -->
                <fieldset class="border p-6 rounded-lg shadow-sm bg-white">
                    <legend class="text-lg font-semibold text-gray-700 px-2">Personal Details</legend>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Registration No.</label>
                            <input type="text" wire:model.live="registration_no" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('registration_no') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">SNTCSSC Roll No.</label>
                            <input type="text" wire:model.live="sntcssc_roll_no" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('sntcssc_roll_no') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Programme Enrolled</label>
                            <select wire:model.live="programme_enrolled" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select Programme</option>
                                <option value="Composite Course">Composite Course</option>
                                <option value="Mains Guidance Programme">Mains Guidance Programme</option>
                                <option value="Prelims Crash Course">Prelims Crash Course</option>
                            </select>
                            @error('programme_enrolled') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Batch</label>
                            <select wire:model.live="batch" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select Batch</option>
                                @foreach (range(2020, 2025) as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                            @error('batch') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Secondary Level Roll No.</label>
                            <input type="text" wire:model.live="secondary_level_roll_no" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('secondary_level_roll_no') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">CSE Prelims Roll No.</label>
                            <input type="text" wire:model.live="cse_prelims_roll_no" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('cse_prelims_roll_no') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">First Name</label>
                            <input type="text" wire:model.live="first_name" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('first_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Last Name</label>
                            <input type="text" wire:model.live="last_name" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('last_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                            <input type="email" wire:model.live="email" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Alternate Email</label>
                            <input type="email" wire:model.live="alternate_email" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('alternate_email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Mobile No.</label>
                            <input type="text" wire:model.live="mobile_no" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('mobile_no') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Alternate Mobile No.</label>
                            <input type="text" wire:model.live="alternate_mobile_no" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('alternate_mobile_no') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">WhatsApp No.</label>
                            <input type="text" wire:model.live="whatsapp_no" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('whatsapp_no') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Date of Birth</label>
                            <input type="date" wire:model.live="dob" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('dob') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Gender</label>
                            <select wire:model.live="gender" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('gender') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Category</label>
                            <select wire:model.live="category" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select Category</option>
                                <option value="UR">UR</option>
                                <option value="SC">SC</option>
                                <option value="ST">ST</option>
                                <option value="OBC">OBC</option>
                            </select>
                            @error('category') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">PwBD Status</label>
                            <select wire:model.live="pwbd_status" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select PwBD Status</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('pwbd_status') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        @if ($pwbd_status)
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">PwBD Description</label>
                                <input type="text" wire:model.live="pwbd_description" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                @error('pwbd_description') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        @endif
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Father's Name</label>
                            <input type="text" wire:model.live="fathers_name" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('fathers_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Mother's Name</label>
                            <input type="text" wire:model.live="mothers_name" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('mothers_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Student's Occupation</label>
                            <input type="text" wire:model.live="students_occupation" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('students_occupation') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Father's Occupation</label>
                            <input type="text" wire:model.live="fathers_occupation" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('fathers_occupation') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Mother's Occupation</label>
                            <input type="text" wire:model.live="mothers_occupation" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('mothers_occupation') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Medium of Instruction</label>
                            <input type="text" wire:model.live="medium_of_instruction" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('medium_of_instruction') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Optional Subject</label>
                            <select wire:model.live="optional_subject" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select Optional Subject</option>
                                <option value="Agriculture">Agriculture</option>
                                <option value="Animal Husbandry and Veterinary Science">Animal Husbandry and Veterinary Science</option>
                                <option value="Anthropology">Anthropology</option>
                                <option value="Botany">Botany</option>
                                <option value="Chemistry">Chemistry</option>
                                <option value="Civil Engineering">Civil Engineering</option>
                                <option value="Commerce and Accountancy">Commerce and Accountancy</option>
                                <option value="Economics">Economics</option>
                                <option value="Electrical Engineering">Electrical Engineering</option>
                                <option value="Geography">Geography</option>
                                <option value="Geology">Geology</option>
                                <option value="History">History</option>
                                <option value="Law">Law</option>
                                <option value="Management">Management</option>
                                <option value="Mathematics">Mathematics</option>
                                <option value="Mechanical Engineering">Mechanical Engineering</option>
                                <option value="Medical Science">Medical Science</option>
                                <option value="Philosophy">Philosophy</option>
                                <option value="Physics">Physics</option>
                                <option value="Political Science and International Relations">Political Science and International Relations</option>
                                <option value="Psychology">Psychology</option>
                                <option value="Public Administration">Public Administration</option>
                                <option value="Sociology">Sociology</option>
                                <option value="Statistics">Statistics</option>
                                <option value="Zoology">Zoology</option>
                                <option value="Literature of any one of the following languages">Literature of any one of the following languages</option>
                            </select>
                            @error('optional_subject') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Subject in Graduation</label>
                            <input type="text" wire:model.live="subject_in_graduation" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('subject_in_graduation') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Institution (Graduation)</label>
                            <input type="text" wire:model.live="institution_graduation" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('institution_graduation') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Subject in Post-Graduation</label>
                            <input type="text" wire:model.live="subject_in_post_graduation" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('subject_in_post_graduation') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Institution (Post-Graduation)</label>
                            <input type="text" wire:model.live="institution_post_graduation" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('institution_post_graduation') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Appeared in UPSC CSE?</label>
                            <select wire:model.live="appeared_in_upsc_cse" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select UPSC CSE Status</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('appeared_in_upsc_cse') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        @if ($appeared_in_upsc_cse)
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">UPSC CSE Years</label>
                                <input type="text" wire:model.live="upsc_cse_years" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                @error('upsc_cse_years') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        @endif
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Need Hostel?</label>
                            <select wire:model.live="need_hostel" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select Hostel Requirement</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('need_hostel') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Take Test Series?</label>
                            <select wire:model.live="take_test_series" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select Test Series Requirement</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('take_test_series') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Currently Employed?</label>
                            <select wire:model.live="currently_employed" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select Employment Status</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('currently_employed') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        @if ($currently_employed)
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Employment Details</label>
                                <input type="text" wire:model.live="employment_details" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                @error('employment_details') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    </div>
                </fieldset>

                <!-- Present Address -->
                <fieldset class="border p-6 rounded-lg shadow-sm mt-6 bg-white">
                    <legend class="text-lg font-semibold text-gray-700 px-2">Present Address</legend>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Full Address</label>
                            <input type="text" wire:model.live="present_address.full_address" id="present_full_address" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('present_address.full_address') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">State</label>
                            <select wire:model.live="present_address.state" id="present_state" wire:change="updatePresentDistricts" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state }}">{{ $state }}</option>
                                @endforeach
                            </select>
                            @error('present_address.state') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">District</label>
                            <select wire:model.live="present_address.district" id="present_district" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select District</option>
                                @foreach ($present_districts as $district)
                                    <option value="{{ $district }}">{{ $district }}</option>
                                @endforeach
                            </select>
                            @error('present_address.district') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Pincode</label>
                            <input type="text" wire:model.live="present_address.pincode" id="present_pincode" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('present_address.pincode') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </fieldset>

                <!-- Same Address Checkbox -->
                <div class="mt-4 flex items-center">
                    <input type="checkbox" wire:model.live="same_address" id="same_address" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="same_address" class="ml-2 text-sm text-gray-600">Same as Present Address</label>
                </div>

                <!-- Permanent Address -->
                <fieldset class="border p-6 rounded-lg shadow-sm mt-6 bg-white">
                    <legend class="text-lg font-semibold text-gray-700 px-2">Permanent Address</legend>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Full Address</label>
                            <input type="text" wire:model.live="permanent_address.full_address" id="permanent_full_address" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('permanent_address.full_address') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">State</label>
                            <select wire:model.live="permanent_address.state" id="permanent_state" wire:change="updatePermanentDistricts" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state }}">{{ $state }}</option>
                                @endforeach
                            </select>
                            @error('permanent_address.state') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">District</label>
                            <select wire:model.live="permanent_address.district" id="permanent_district" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select District</option>
                                @foreach ($permanent_districts as $district)
                                    <option value="{{ $district }}">{{ $district }}</option>
                                @endforeach
                            </select>
                            @error('permanent_address.district') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Pincode</label>
                            <input type="text" wire:model.live="permanent_address.pincode" id="permanent_pincode" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('permanent_address.pincode') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </fieldset>

                <!-- Documents -->
                <fieldset class="border p-6 rounded-lg shadow-sm mt-6 bg-white">
                    <legend class="text-lg font-semibold text-gray-700 px-2">Documents</legend>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Photo (Max 1MB)</label>
                            <input type="file" wire:model="photo" class="w-full p-2 border border-gray-300 rounded-lg">
                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}" class="mt-2 max-w-full h-32 object-cover rounded shadow" alt="Photo Preview">
                            @endif
                            @error('photo') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Identity Document (PDF/JPG/PNG, Max 2MB)</label>
                            <input type="file" wire:model="identity_document" class="w-full p-2 border border-gray-300 rounded-lg">
                            @if ($identity_document)
                                @if (in_array($identity_document->getClientOriginalExtension(), ['jpg', 'png']))
                                    <img src="{{ $identity_document->temporaryUrl() }}" class="mt-2 max-w-full h-32 object-cover rounded shadow" alt="Identity Document Preview">
                                @else
                                    <p class="mt-2 text-gray-500 text-sm"><i class="fas fa-file-alt"></i> {{ $identity_document->getClientOriginalName() }}</p>
                                @endif
                            @endif
                            @error('identity_document') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Secondary Admit Card (PDF/JPG/PNG, Max 2MB)</label>
                            <input type="file" wire:model="secondary_admit_card" class="w-full p-2 border border-gray-300 rounded-lg">
                            @if ($secondary_admit_card)
                                @if (in_array($secondary_admit_card->getClientOriginalExtension(), ['jpg', 'png']))
                                    <img src="{{ $secondary_admit_card->temporaryUrl() }}" class="mt-2 max-w-full h-32 object-cover rounded shadow" alt="Secondary Admit Card Preview">
                                @else
                                    <p class="mt-2 text-gray-500 text-sm"><i class="fas fa-file-alt"></i> {{ $secondary_admit_card->getClientOriginalName() }}</p>
                                @endif
                            @endif
                            @error('secondary_admit_card') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">UPSC Prelims Admit Card (PDF/JPG/PNG, Max 2MB, Optional)</label>
                            <input type="file" wire:model="upsc_prelims_admit_card" class="w-full p-2 border border-gray-300 rounded-lg">
                            @if ($upsc_prelims_admit_card)
                                @if (in_array($upsc_prelims_admit_card->getClientOriginalExtension(), ['jpg', 'png']))
                                    <img src="{{ $upsc_prelims_admit_card->temporaryUrl() }}" class="mt-2 max-w-full h-32 object-cover rounded shadow" alt="UPSC Prelims Admit Card Preview">
                                @else
                                    <p class="mt-2 text-gray-500 text-sm"><i class="fas fa-file-alt"></i> {{ $upsc_prelims_admit_card->getClientOriginalName() }}</p>
                                @endif
                            @endif
                            @error('upsc_prelims_admit_card') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">UPSC DAF (Mains) (PDF/JPG/PNG, Max 2MB, Optional)</label>
                            <input type="file" wire:model="upsc_daf_mains" class="w-full p-2 border border-gray-300 rounded-lg">
                            @if ($upsc_daf_mains)
                                @if (in_array($upsc_daf_mains->getClientOriginalExtension(), ['jpg', 'png']))
                                    <img src="{{ $upsc_daf_mains->temporaryUrl() }}" class="mt-2 max-w-full h-32 object-cover rounded shadow" alt="UPSC DAF Preview">
                                @else
                                    <p class="mt-2 text-gray-500 text-sm"><i class="fas fa-file-alt"></i> {{ $upsc_daf_mains->getClientOriginalName() }}</p>
                                @endif
                            @endif
                            @error('upsc_daf_mains') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Other Documents (PDF/JPG/PNG, Max 2MB each, Optional)</label>
                            <input type="file" wire:model="others_documents" multiple class="w-full p-2 border border-gray-300 rounded-lg">
                            @if ($others_documents)
                                @foreach ($others_documents as $index => $file)
                                    @if ($file)
                                        <div class="mt-2">
                                            @if (in_array($file->getClientOriginalExtension(), ['jpg', 'png']))
                                                <img src="{{ $file->temporaryUrl() }}" class="max-w-full h-32 object-cover rounded shadow" alt="Other Document {{ $index + 1 }} Preview">
                                            @else
                                                <p class="text-gray-500 text-sm"><i class="fas fa-file-alt"></i> {{ $file->getClientOriginalName() }}</p>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            @error('others_documents.*') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </fieldset>

                <div class="flex justify-center mt-6">
                    <button wire:click="preview" wire:loading.attr="disabled" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-200 shadow-md">
                        Preview
                    </button>
                </div>
            </div>
        @endif

        <!-- Loader -->
        <div wire:loading class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="relative flex items-center justify-center">
                <div class="animate-spin h-12 w-12 border-4 border-blue-500 border-t-transparent rounded-full"></div>
                <span class="absolute text-white text-sm font-medium">Loading...</span>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            // Handle same address checkbox
            const sameAddressCheckbox = document.getElementById('same_address');
            sameAddressCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    const presentFullAddress = document.getElementById('present_full_address').value;
                    const presentState = document.getElementById('present_state').value;
                    const presentDistrict = document.getElementById('present_district').value;
                    const presentPincode = document.getElementById('present_pincode').value;

                    // Update DOM immediately
                    document.getElementById('permanent_full_address').value = presentFullAddress;
                    document.getElementById('permanent_state').value = presentState;
                    document.getElementById('permanent_district').value = presentDistrict;
                    document.getElementById('permanent_pincode').value = presentPincode;

                    // Update Livewire properties
                    @this.set('permanent_address.full_address', presentFullAddress);
                    @this.set('permanent_address.state', presentState);
                    @this.set('permanent_address.district', presentDistrict);
                    @this.set('permanent_address.pincode', presentPincode);
                    @this.call('updatePermanentDistricts'); // Ensure districts are updated for the selected state
                }
            });
        });
    </script>