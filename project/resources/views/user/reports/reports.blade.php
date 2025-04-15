<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RescueSpot - Report an Animal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle mobile menu
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
            
            // Toggle profile dropdown
            const profileBtn = document.getElementById('profile-btn');
            const profileDropdown = document.getElementById('profile-dropdown');
            
            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function() {
                profileDropdown.classList.add('hidden');
            });

            // Photo preview functionality
            const photoInput = document.getElementById('photo');
            const photoPreview = document.getElementById('photo-preview');
            const photoPreviewContainer = document.getElementById('photo-preview-container');
            
            photoInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        photoPreview.src = e.target.result;
                        photoPreviewContainer.classList.remove('hidden');
                    };
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });
            
            // Current location button
            const locationBtn = document.getElementById('get-location-btn');
            
            locationBtn.addEventListener('click', function() {
                if (navigator.geolocation) {
                    locationBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Detecting...';
                    
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        
                        document.getElementById('location').value = `Lat: ${latitude.toFixed(6)}, Long: ${longitude.toFixed(6)}`;
                        
                        locationBtn.innerHTML = '<i class="fas fa-map-marker-alt mr-2"></i>Get My Location';
                        
                        // Show success message
                        const successMsg = document.createElement('p');
                        successMsg.className = 'text-green-500 text-xs mt-1';
                        successMsg.innerText = 'Location detected successfully!';
                        
                        const existingMsg = document.querySelector('.location-message');
                        if (existingMsg) {
                            existingMsg.remove();
                        }
                        
                        successMsg.classList.add('location-message');
                        document.getElementById('location-field').appendChild(successMsg);
                        
                        setTimeout(function() {
                            successMsg.remove();
                        }, 3000);
                    }, function(error) {
                        console.error("Error getting location:", error);
                        
                        locationBtn.innerHTML = '<i class="fas fa-map-marker-alt mr-2"></i>Get My Location';
                        
                        // Show error message
                        const errorMsg = document.createElement('p');
                        errorMsg.className = 'text-red-500 text-xs mt-1';
                        errorMsg.innerText = "Couldn't get your location. Please enter it manually.";
                        
                        const existingMsg = document.querySelector('.location-message');
                        if (existingMsg) {
                            existingMsg.remove();
                        }
                        
                        errorMsg.classList.add('location-message');
                        document.getElementById('location-field').appendChild(errorMsg);
                        
                        setTimeout(function() {
                            errorMsg.remove();
                        }, 3000);
                    });
                } else {
                    console.error("Geolocation is not supported by this browser.");
                    
                    const errorMsg = document.createElement('p');
                    errorMsg.className = 'text-red-500 text-xs mt-1';
                    errorMsg.innerText = "Geolocation is not supported by your browser.";
                    
                    const existingMsg = document.querySelector('.location-message');
                    if (existingMsg) {
                        existingMsg.remove();
                    }
                    
                    errorMsg.classList.add('location-message');
                    document.getElementById('location-field').appendChild(errorMsg);
                    
                    setTimeout(function() {
                        errorMsg.remove();
                    }, 3000);
                }
            });

            // Set current date as default for reportDate
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            document.getElementById('reportDate').value = `${year}-${month}-${day}`;
        });
    </script>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Toast Notification -->
    <div id="toast" class="hidden fixed top-5 right-5 z-50 flex items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow-lg" role="alert">
        <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <i class="fas fa-check"></i>
        </div>
        <div id="toast-message" class="ml-3 text-sm font-normal">Report submitted successfully!</div>
        <button id="close-toast" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 hover:bg-gray-100 inline-flex h-8 w-8">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Top Navigation -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="#" class="flex items-center space-x-2">
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-2 rounded-lg">
                            <i class="fas fa-paw text-xl"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-800">RescueSpot</span>
                    </a>
                </div>

                <!-- Main Navigation - Desktop -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="HomeUser" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Home</a>
                    <a href="{{ route('user.UserAdoptions.index') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Adoption</a>
                    <a href="{{ route('user.UserReports.index') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gradient-to-r from-yellow-500 to-orange-500">Reports</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Messages</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Contact</a>
                </div>

                <!-- Right Side Menu -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <button class="relative p-1 rounded-full text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none">
                        <i class="far fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs w-4 h-4 flex items-center justify-center rounded-full">3</span>
                    </button>
                    
                    <!-- Messages -->
                    <button class="relative p-1 rounded-full text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none">
                        <i class="far fa-envelope text-xl"></i>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs w-4 h-4 flex items-center justify-center rounded-full">5</span>
                    </button>
                    
                    <!-- Profile Dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <button type="button" id="profile-btn" class="flex text-sm bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" aria-expanded="false" aria-haspopup="true">
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-blue-500" 
                                     src="{{ $userInfo->profilePhoto ? asset('storage/' . $userInfo->profilePhoto) : asset('images/defaultImageProfile.jpg') }}" 
                                     alt="Profile">
                            </button>
                        </div>
                        <div id="profile-dropdown"
     class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
     role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">

    <a href="Profile"
       class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150"
       role="menuitem">
        <i class="far fa-user text-gray-500"></i> My profile
    </a>

    <a href="#"
       class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150"
       role="menuitem">
        <i class="fas fa-cog text-gray-500"></i> Settings
    </a>

    <a href="#"
       class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150"
       role="menuitem">
        <i class="fas fa-heart text-gray-500"></i> My favorites
    </a>

    <a href="#"
       class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150"
       role="menuitem">
        <i class="fas fa-history text-gray-500"></i> History
    </a>

    <div class="border-t border-gray-100 my-1"></div>

    <form method="POST" action="{{ route('user.logout') }}">
        @csrf
        <button type="submit"
                class="w-full text-left flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150"
                role="menuitem">
            <i class="fas fa-sign-out-alt text-gray-500"></i> Logout
        </button>
    </form>
</div>
                    </div>
                    
                    <!-- Mobile menu button -->
                    <button type="button" id="mobile-menu-btn" class="md:hidden bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" aria-controls="mobile-menu" aria-expanded="false">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white shadow-md">
                <a href="HomeUser" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Home</a>
                <a href="{{ route('user.UserAdoptions.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Adoption</a>
                <a href="{{ route('user.UserReports.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-yellow-500 to-orange-500">Reports</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Messages</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20 pb-12">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <!-- Page Header -->
                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Report an Animal in Need</h1>
                    <p class="text-gray-600">Help us locate and rescue animals in distress by submitting a report</p>
                </div>

                <!-- Report Form -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                    <div class="p-6">
                        <form id="report-form" action="{{ route('user.UserReports.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Animal Photo -->
                            <div class="mb-6">
                                <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-camera mr-2 text-blue-500"></i>Animal Photo
                                </label>
                                <div class="flex items-center">
                                    <label for="photo" class="cursor-pointer bg-blue-50 border-2 border-dashed border-blue-300 rounded-lg p-4 w-full flex flex-col items-center justify-center">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-blue-500 mb-2"></i>
                                        <span class="text-sm text-gray-600">Click to upload a photo of the animal</span>
                                        <span class="text-xs text-gray-500 mt-1">JPG, PNG or GIF (Max. 2MB)</span>
                                        <input type="file" id="photo" name="photo" class="hidden" accept="image/*">
                                    </label>
                                </div>
                                <div id="photo-preview-container" class="hidden mt-3">
                                    <img id="photo-preview" src="#" alt="Photo preview" class="h-40 object-cover rounded-lg border border-gray-200">
                                </div>
                                @error('photo')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Location -->
                            <div class="mb-6" id="location-field">
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>Location
                                </label>
                                <div class="flex space-x-2">
                                    <div class="flex-grow">
                                        <input type="text" id="location" name="location" placeholder="Enter the location where you found the animal" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    </div>
                                    <button type="button" id="get-location-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                                        <i class="fas fa-map-marker-alt mr-2"></i>Get My Location
                                    </button>
                                </div>
                                @error('location')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Report Date -->
                            <div class="mb-6">
                                <label for="reportDate" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar-alt mr-2 text-blue-500"></i>Date Reported
                                </label>
                                <input type="date" id="reportDate" name="reportDate" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                @error('reportDate')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-6">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-align-left mr-2 text-blue-500"></i>Description
                                </label>
                                <textarea id="description" name="description" rows="5" placeholder="Provide detailed information about the animal's condition, appearance, behavior, etc." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                                <p class="text-xs text-gray-500 mt-1">Please include details such as the animal's species, breed (if known), color, size, injuries (if any), and any other relevant information.</p>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-heartbeat mr-2 text-blue-500"></i>Animal Condition
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <label class="flex items-center bg-white border border-gray-300 rounded-lg p-3 cursor-pointer hover:bg-gray-50 transition">
                                        <input type="radio" name="status" value="okay" class="mr-3 focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300" required>
                                        <div class="flex items-center">
                                            <i class="fas fa-smile text-green-500 mr-2"></i>
                                            <span class="text-gray-700">Animal Appears Okay</span>
                                        </div>
                                    </label>
                                    <label class="flex items-center bg-white border border-gray-300 rounded-lg p-3 cursor-pointer hover:bg-gray-50 transition">
                                        <input type="radio" name="status" value="injured" class="mr-3 focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                        <div class="flex items-center">
                                            <i class="fas fa-band-aid text-yellow-500 mr-2"></i>
                                            <span class="text-gray-700">Animal Appears Injured</span>
                                        </div>
                                    </label>
                                    <label class="flex items-center bg-white border border-gray-300 rounded-lg p-3 cursor-pointer hover:bg-gray-50 transition">
                                        <input type="radio" name="status" value="critical" class="mr-3 focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                        <div class="flex items-center">
                                            <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                                            <span class="text-gray-700">Animal in Critical Condition</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-center">
                                <button type="submit" id="submit-report-btn" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-3 px-8 rounded-lg shadow-md flex items-center text-lg font-medium transition transform hover:scale-105">
                                    <i class="fas fa-paper-plane mr-2"></i>Submit Report
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Information Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- What Happens Next Card -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                        <div class="p-5">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-clipboard-list text-blue-600"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">What Happens Next</h3>
                            </div>
                            <ol class="text-sm text-gray-600 space-y-2 pl-6 list-decimal">
                                <li>Our team reviews your report</li>
                                <li>A rescue team is dispatched to the location</li>
                                <li>The animal is rescued and brought to a shelter</li>
                                <li>You'll receive updates on the rescue status</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Tips Card -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                        <div class="p-5">
                            <div class="flex items-center mb-4">
                                <div class="bg-yellow-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-lightbulb text-yellow-600"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Helpful Tips</h3>
                            </div>
                            <ul class="text-sm text-gray-600 space-y-2 pl-6 list-disc">
                                <li>Include clear photos when possible</li>
                                <li>Be as specific as possible with location details</li>
                                <li>Describe any immediate dangers to the animal</li>
                                <li>Note if the animal appears injured or sick</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Contact Card -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                        <div class="p-5">
                            <div class="flex items-center mb-4">
                                <div class="bg-green-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-phone-alt text-green-600"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Emergency Contact</h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">For urgent animal rescues that require immediate attention:</p>
                            <div class="flex items-center space-x-2 text-green-600 font-medium">
                                <i class="fas fa-phone"></i>
                                <span>(555) 123-4567</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Available 24/7 for animal emergencies</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="container mx-auto px-4 pt-12 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-2 rounded-lg">
                            <i class="fas fa-paw text-xl"></i>
                        </div>
                        <span class="text-xl font-bold">RescueSpot</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">Platform dedicated to rescuing and adopting abandoned animals.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick links</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Home</a></li>
                        <li><a href="#" class="hover:text-white transition">Report an animal</a></li>
                        <li><a href="#" class="hover:text-white transition">Adoption</a></li>
                        <li><a href="#" class="hover:text-white transition">Messages</a></li>
                        <li><a href="#" class="hover:text-white transition">About us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact us</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-blue-500"></i>
                            contact@rescuespot.com
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-2 text-blue-500"></i>
                            (123) 456-7890
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                            75 Hope Street, New York
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                    <p class="text-gray-400 text-sm mb-4">Receive our news and advice for animals.</p>
                    <form>
                        <div class="flex">
                            <input type="email" placeholder="Your email" class="px-4 py-2 w-full rounded-l-lg focus:outline-none text-gray-800">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-lg transition">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-400">
                <p>&copy; 2024 RescueSpot. All rights reserved. | <a href="#" class="text-blue-400 hover:text-white">Privacy Policy</a> | <a href="#" class="text-blue-400 hover:text-white">Terms of Use</a></p>
            </div>
        </div>
    </footer>
</body>
</html>