<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RescueSpot - Find Your Forever Friend</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
        }
        
        .animal-card {
            transition: all 0.3s ease-in-out;
        }
        
        .animal-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Modal styles */
        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            transition: opacity 0.3s ease;
        }
        
        .modal-container {
            max-height: 90vh;
            overflow-y: auto;
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }
        
        .modal-active .modal-container {
            transform: translateY(0);
        }
        
        body.modal-open {
            overflow: hidden;
        }
        
        /* Scrollable container styles */
        .scrollable-container {
            height: 600px; /* Fixed height for the container */
            overflow-y: auto;
            overflow-x: hidden;
            padding: 1.5rem;
            position: relative;
        }
        
        /* Custom scrollbar for the container */
        .scrollable-container::-webkit-scrollbar {
            width: 8px;
        }
        
        .scrollable-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .scrollable-container::-webkit-scrollbar-thumb {
            background: #c5c5c5;
            border-radius: 10px;
        }
        
        .scrollable-container::-webkit-scrollbar-thumb:hover {
            background: #a0a0a0;
        }
        
        /* Scroll indicator inside container */
        .scroll-indicator {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
            color: #3b82f6;
            z-index: 10;
            opacity: 0.8;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0) translateX(-50%);
            }
            40% {
                transform: translateY(-10px) translateX(-50%);
            }
            60% {
                transform: translateY(-5px) translateX(-50%);
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
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
                    <a href="{{ route('user.UserAdoptions.index') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600">Adoption</a>
                    <a href="{{ route('user.UserReports.index') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Reports</a>

                </div>

                <!-- Right Side Menu -->
                <div class="flex items-center space-x-4">
                    <button class="hidden md:block bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white py-2 px-4 rounded-lg shadow-md transition transform hover:scale-105">
                        <a href="{{ route('user.UserReports.index') }}" class="text-white text-sm font-medium">Report an animal</a>
                    </button>
                    
                    <!-- Notifications -->

                    
    
                    
                    <!-- Profile Dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <button type="button" id="profile-btn" class="flex text-sm bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" aria-expanded="false" aria-haspopup="true">
                            <img class="h-10 w-10 rounded-full object-cover border-2 border-blue-500" 
                            src="{{ $userinfo->profilePhoto ? asset('storage/' . $userinfo->profilePhoto) : asset('images/defaultImageProfile.jpg') }}" 
                            alt="Profile">                            </button>
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
                <a href="{{ route('user.UserAdoptions.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600">Adoption</a>
                <a href="{{ route('user.UserReports.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Reports</a>
                <button class="mt-2 w-full flex justify-center items-center bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white py-2 px-4 rounded-lg shadow-md">
                    <a href="{{ route('user.UserReports.index') }}" class="text-white text-sm font-medium">Report an animal</a>                    
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20 pb-12">
        <!-- Adoption Section -->
        <section class="py-8 md:py-12">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <div class="inline-block px-4 py-1 rounded-full bg-blue-100 text-blue-600 text-sm font-semibold mb-4">
                        Find Your Match
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Pets Available for Adoption</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        These rescued animals have been rehabilitated and are ready for their forever homes
                    </p>
                </div>

                <!-- Success Message - Only shown after form submission -->
                @if(session('success'))
                <div class="mb-8 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg" role="alert">
                    <p class="font-medium">Success!</p>
                    <p>{{ session('success') }}</p>
                </div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                <div class="mb-8 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
                    <p class="font-medium">Error!</p>
                    <p>{{ session('error') }}</p>
                </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                <div class="mb-8 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
                    <p class="font-medium">Please fix the following errors:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Animal Cards Grid with Scrollable Container -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-bold text-gray-800">Available for adoption</h2>
                        <div class="flex items-center">
                            <button class="p-1 rounded text-gray-700 hover:bg-gray-100 mr-2">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Scrollable container for animal cards -->
                    <div class="scrollable-container">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @forelse($animals->where('status', 'ready') as $animal)
                            <!-- Animal Card -->
                            <div class="animal-card bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 group transition transform hover:shadow-md hover:-translate-y-1 cursor-pointer" 
                                onclick="openAdoptionModal('modal-{{ $animal->id }}')">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $animal->photoAnimal) }}" alt="{{ $animal->name }}" class="w-full h-48 object-cover">
                                    <div class="absolute top-3 right-3 bg-green-500 text-white text-xs px-2 py-1 rounded-full">Available</div>
                                    <button class="absolute top-3 left-3 bg-white rounded-full p-2 text-red-500 shadow hover:bg-red-500 hover:text-white transition">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                                <div class="p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="font-semibold text-gray-800">{{ $animal->name }}</h3>
                                        <div class="flex space-x-1">
                                            <i class="fas fa-star text-yellow-400"></i>
                                            <i class="fas fa-star text-yellow-400"></i>
                                            <i class="fas fa-star text-yellow-400"></i>
                                            <i class="fas fa-star text-yellow-400"></i>
                                            <i class="fas fa-star text-gray-300"></i>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2 mb-2 text-xs">
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">{{ $animal->species }}</span>
                                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full">{{ $animal->age }} years</span>
                                        <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">{{ $animal->breed }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">{{ $animal->shelters ? $animal->shelters->description ?? 'Very affectionate and playful animal' : 'Very affectionate and playful animal' }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm">
                                            <i class="fas fa-map-marker-alt text-gray-500 mr-1"></i> 
                                            {{ $animal->shelters ? $animal->shelters->address : 'Unknown' }}
                                        </span>
                                        <button class="bg-blue-600 hover:bg-blue-700 text-white py-1.5 px-3 rounded-lg text-sm transition-colors">
                                            View profile
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Adoption Modal for this specific animal -->
                            <div id="modal-{{ $animal->id }}" class="fixed inset-0 z-50 overflow-y-auto hidden">
                                <div class="modal-overlay fixed inset-0"></div>
                                
                                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="modal-container bg-white rounded-2xl shadow-xl transform transition-all sm:max-w-4xl sm:w-full mx-auto">
                                        <div class="absolute top-4 right-4 z-10">
                                            <button onclick="closeAdoptionModal('modal-{{ $animal->id }}')" class="bg-white p-2 rounded-full shadow-md text-gray-500 hover:text-gray-700 focus:outline-none">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2">
                                            <!-- Animal Details -->
                                            <div class="p-8 bg-gradient-to-br from-blue-50 to-white">
                                                <div class="mb-6">
                                                    <img class="w-full h-64 object-cover rounded-2xl shadow-md" src="{{ asset('storage/' . $animal->photoAnimal) }}" alt="{{ $animal->name }}">
                                                </div>
                                                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $animal->name }}</h3>
                                                <div class="flex items-center mb-4">
                                                    <span class="text-gray-600">{{ $animal->breed }}</span>
                                                    <span class="mx-2">•</span>
                                                    <span class="text-gray-600">{{ $animal->age }} years</span>
                                                </div>
                                                
                                                <div class="mb-6">
                                                    <h4 class="text-lg font-semibold text-gray-900 mb-3">About</h4>
                                                    <p class="text-gray-600">
                                                        {{ $animal->species }}
                                                    </p>
                                                    <p class="text-gray-600 mt-2">
                                                        This loving animal is looking for a forever home. They've been rehabilitated and are ready to bring joy to your family.
                                                        Please fill out the form to start the adoption process.
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <!-- Adoption Form -->
                                            <div class="p-8 bg-white">
                                                <h3 class="text-2xl font-bold text-gray-900 mb-6">Adoption Application</h3>
                                                
                                                <form action="{{ route('user.UserAdoptions.store') }}" method="POST">
                                                    @csrf
                                                    <!-- Changed field name to match what the controller expects -->
                                                    <input type="hidden" name="animalId" value="{{ $animal->id }}">
                                                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-3 px-6 rounded-xl font-medium shadow-lg transition transform hover:scale-105">
                                                        <i class="fas fa-paper-plane mr-2"></i> Send Adoption Request
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <!-- Empty state - No animals available -->
                            <div class="col-span-full p-8 text-center">
                                <div class="inline-flex items-center justify-center bg-gray-100 rounded-full p-8 mb-6">
                                    <i class="fas fa-paw text-gray-400 text-5xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">There are no animals available</h3>
                                <p class="text-gray-600 mb-6 max-w-lg mx-auto">We currently don't have any animals ready for adoption. Please check back soon as we regularly update our listings with new animals looking for forever homes.</p>
                                <a href="#" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-bell mr-2"></i>
                                    Get notified when new animals arrive
                                </a>
                            </div>
                            @endforelse
                        </div>
                        
                        <!-- Scroll indicator - only show if there are animals -->
                        @if(count($animals->where('status', 'ready')) > 8)
                        <div class="scroll-indicator">
                            <i class="fas fa-chevron-down text-xl animate-bounce"></i>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
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
                <p>&copy; {{ date('Y') }} RescueSpot. All rights reserved. | <a href="#" class="text-blue-400 hover:text-white">Privacy Policy</a> | <a href="#" class="text-blue-400 hover:text-white">Terms of Use</a></p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for UI interactions -->
    <script>
        // JavaScript for UI interactions
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
            
            // Hide scroll indicator after scrolling
            const scrollContainer = document.querySelector('.scrollable-container');
            const scrollIndicator = document.querySelector('.scroll-indicator');
            
            if (scrollContainer && scrollIndicator) {
                scrollContainer.addEventListener('scroll', function() {
                    if (scrollContainer.scrollTop > 100) {
                        scrollIndicator.style.opacity = '0';
                        setTimeout(function() {
                            scrollIndicator.style.display = 'none';
                        }, 300);
                    }
                });
            }
        });

        // Modal functions
        function openAdoptionModal(modalId) {
            // Show the modal
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            modal.classList.add('modal-active');
            document.body.classList.add('modal-open'); // Prevent scrolling when modal is open
        }

        function closeAdoptionModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
            modal.classList.remove('modal-active');
            document.body.classList.remove('modal-open'); // Re-enable scrolling
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modals = document.querySelectorAll('[id^="modal-"]');
            
            modals.forEach(function(modal) {
                const modalContainer = modal.querySelector('.modal-container');
                
                if (!modal.classList.contains('hidden') && !modalContainer.contains(event.target) && 
                    !event.target.closest('.animal-card')) {
                    modal.classList.add('hidden');
                    modal.classList.remove('modal-active');
                    document.body.classList.remove('modal-open');
                }
            });
        });
    </script>
</body>
</html>