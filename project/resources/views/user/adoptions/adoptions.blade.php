<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RescueSpot - Find Your Forever Friend</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #ff6b6b;
            --primary-dark: #ff4757;
            --secondary: #1dd1a1;
            --dark: #2d3436;
            --light: #f9f9f9;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Quicksand', sans-serif;
        }
        
        .btn-primary {
            background-color: var(--primary);
            transition: all 0.3s ease-in-out;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(255, 107, 107, 0.4);
        }
        
        .btn-secondary {
            background-color: var(--secondary);
            transition: all 0.3s ease-in-out;
        }
        
        .btn-secondary:hover {
            background-color: #10ac84;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(29, 209, 161, 0.4);
        }
        
        .animal-card {
            transition: all 0.3s ease-in-out;
        }
        
        .animal-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .image-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 60%);
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .animate-pulse-custom {
            animation: pulse 2s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
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
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-md fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center px-4 py-3 sm:px-6 lg:px-8">
                <!-- Logo -->
                <div class="flex justify-start">
                    <a href="/" class="flex items-center">
                        <span class="text-2xl font-bold text-gray-800">
                            Rescue<span class="text-red-500">Spot</span>
                        </span>
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button
                        type="button"
                        id="mobile-menu-button"
                        class="rounded-full p-2 inline-flex items-center justify-center text-gray-500 hover:text-gray-600 hover:bg-gray-100 focus:outline-none"
                        aria-expanded="false"
                        aria-label="Toggle menu"
                    >
                        <span class="sr-only">Open menu</span>
                        <i class="fas fa-bars h-6 w-6"></i>
                    </button>
                </div>

                <!-- Desktop navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="/" class="text-base font-medium text-gray-500 hover:text-red-500 transition-colors duration-200">
                        Home
                    </a>
                    <a href="#" class="text-base font-medium text-red-500 border-b-2 border-red-500 pb-1">
                        Find a Pet
                    </a>
                    <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500 transition-colors duration-200">
                        Report Animal
                    </a>
                    <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500 transition-colors duration-200">
                        Shelters
                    </a>
                    <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500 transition-colors duration-200">
                        About Us
                    </a>
                </nav>

                <!-- Desktop right buttons - User profile for logged in users -->
                <div class="hidden md:flex items-center">
                    <div class="relative">
                        <button id="user-menu-button" class="flex items-center space-x-3 focus:outline-none">
                            <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Profile" class="h-8 w-8 rounded-full border-2 border-red-100">
                            <span class="text-gray-700">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
                        </button>
                        <!-- Dropdown menu - hidden by default -->
                        <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-10">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Adoptions</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <div class="border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu - hidden by default -->
            <div id="mobile-menu" class="hidden absolute top-0 inset-x-0 p-6 transition transform origin-top-right md:hidden bg-white shadow-lg rounded-b-lg mt-16 z-50">
                <div class="space-y-6">
                    <div class="grid gap-y-8">
                        <a href="/" class="text-base font-medium text-gray-500 hover:text-red-500">
                            Home
                        </a>
                        <a href="#" class="text-base font-medium text-red-500 hover:text-red-600">
                            Find a Pet
                        </a>
                        <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500">
                            Report Animal
                        </a>
                        <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500">
                            Shelters
                        </a>
                        <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500">
                            About Us
                        </a>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Profile" class="h-10 w-10 rounded-full border-2 border-red-100">
                            <div class="ml-3">
                                <p class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Your Profile</a>
                            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Your Adoptions</a>
                            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20">
        <!-- Adoption Section -->
        <section class="py-16 md:py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-block px-4 py-1 rounded-full bg-green-100 text-green-600 text-sm font-semibold mb-4">
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

                <!-- Animal Cards Grid -->
                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                    @forelse($animals->where('status', 'ready') as $animal)
                    <!-- Animal Card -->
                    <div class="animal-card bg-white rounded-3xl shadow-md overflow-hidden cursor-pointer" 
                         onclick="openAdoptionModal('{{ $animal->id }}', '{{ $animal->name }}', '{{ $animal->breed }}', '{{ $animal->age }}', '{{ $animal->species }}', '{{ asset('storage/' . $animal->photoAnimal) }}')">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $animal->photoAnimal) }}" alt="{{ $animal->name }}" class="h-64 w-full object-cover">
                            <button class="absolute top-4 right-4 bg-white p-2 rounded-full shadow text-red-500 hover:text-red-600 hover:scale-110 transition-all duration-200 focus:outline-none">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-xl font-bold text-gray-900">{{ $animal->name }}</h3>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-600">{{ $animal->age }}</span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mb-4">{{ $animal->breed }}</p>
                            <p class="text-sm text-gray-500 mb-4">{{ $animal->species }}</p>
                            
                            <button type="button" class="block w-full text-center px-4 py-3 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-full transition-all duration-200">
                                View Profile
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-12">
                        <div class="bg-white rounded-xl shadow-md p-8 max-w-lg mx-auto">
                            <div class="text-red-500 mb-4">
                                <i class="fas fa-paw text-5xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">No Animals Available</h3>
                            <p class="text-gray-600 mb-6">
                                There are currently no animals available for adoption. Please check back later or contact us for more information.
                            </p>
                            <a href="/" class="btn-primary inline-block px-6 py-3 rounded-full text-white font-medium">
                                Return to Home
                            </a>
                        </div>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($animals->count() > 0)
                <div class="mt-12 flex justify-center">
                    {{ $animals->links() }}
                </div>
                @endif
            </div>
        </section>
    </main>

    <!-- Adoption Modal -->
    <div id="adoptionModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
        <div class="modal-overlay fixed inset-0"></div>
        
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="modal-container bg-white rounded-3xl shadow-xl transform transition-all sm:max-w-4xl sm:w-full mx-auto">
                <div class="absolute top-4 right-4 z-10">
                    <button onclick="closeAdoptionModal()" class="bg-white p-2 rounded-full shadow-md text-gray-500 hover:text-gray-700 focus:outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <!-- Animal Details -->
                    <div class="p-8 bg-gradient-to-br from-red-50 to-white">
                        <div class="mb-6">
                            <img id="modalAnimalImage" class="w-full h-64 object-cover rounded-2xl shadow-md" src="/placeholder.svg" alt="Animal">
                        </div>
                        <h3 id="modalAnimalName" class="text-2xl font-bold text-gray-900 mb-2"></h3>
                        <div class="flex items-center mb-4">
                            <span id="modalAnimalBreed" class="text-gray-600"></span>
                            <span class="mx-2">•</span>
                            <span id="modalAnimalAge" class="text-gray-600"></span>
                        </div>
                        
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">About</h4>
                            <p class="text-gray-600">
                                <span id="modalAnimalSpecies"></span>
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
                        
                        <form id="adoptionForm" action="{{ route('adoptions.store') }}" method="POST">
                            @csrf
                            <input type="hidden" id="animalId" name="animalId" value="">
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-red-500 focus:border-red-500" required>
                                </div>
                                
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Home Address</label>
                                    <input type="text" id="address" name="address" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-red-500 focus:border-red-500" required>
                                </div>
                                
                                <div>
                                    <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Previous Pet Experience</label>
                                    <select id="experience" name="experience" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-red-500 focus:border-red-500">
                                        <option value="None">None</option>
                                        <option value="Some">Some (1-2 years)</option>
                                        <option value="Experienced">Experienced (3+ years)</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="housing" class="block text-sm font-medium text-gray-700 mb-1">Housing Type</label>
                                    <select id="housing" name="housing" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-red-500 focus:border-red-500">
                                        <option value="Apartment">Apartment</option>
                                        <option value="House">House</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="reason" class="block text-sm font-medium text-gray-700 mb-1">Why do you want to adopt this pet?</label>
                                    <textarea id="reason" name="reason" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-red-500 focus:border-red-500" required></textarea>
                                </div>
                                
                                <div class="pt-4">
                                    <button type="submit" class="w-full btn-primary px-6 py-3 rounded-full text-white font-medium shadow-lg">
                                        Submit Adoption Request
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 md:gap-12 mb-16">
                <!-- About -->
                <div class="col-span-1 lg:col-span-2">
                    <div class="flex items-center mb-6">
                        <span class="text-2xl font-bold text-white">
                            Rescue<span class="text-red-500">Spot</span>
                        </span>
                    </div>
                    <p class="text-gray-400 mb-8">
                        RescueSpot connects people with animal shelters to rescue, rehabilitate, and rehome animals in need. Our
                        mission is to ensure every animal finds a loving home.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-facebook-f"></i>
                            <span class="sr-only">Facebook</span>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-twitter"></i>
                            <span class="sr-only">Twitter</span>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-instagram"></i>
                            <span class="sr-only">Instagram</span>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-youtube"></i>
                            <span class="sr-only">YouTube</span>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-span-1">
                    <h4 class="text-lg font-bold text-white mb-6">Quick Links</h4>
                    <ul class="space-y-4">
                        <li>
                            <a href="/" class="text-gray-400 hover:text-white transition-colors duration-200">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                                Find a Pet
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                                Report Animal
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                                Shelters
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                                Success Stories
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                                About Us
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Resources -->
                <div class="col-span-1">
                    <h4 class="text-lg font-bold text-white mb-6">Resources</h4>
                    <ul class="space-y-4">
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                                Pet Care Tips
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                                Adoption Guide
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                                Rescue Resources
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                                FAQs
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                                Terms of Service
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-span-1">
                    <h4 class="text-lg font-bold text-white mb-6">Contact Us</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 text-red-400 mr-3 flex-shrink-0"></i>
                            <span>
                                123 Rescue Lane
                                <br>
                                Animal City, AC 12345
                            </span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-red-400 mr-3 flex-shrink-0"></i>
                            <span>(800) RESCUE-1</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-red-400 mr-3 flex-shrink-0"></i>
                            <span>help@rescuespot.com</span>
                        </li>
                    </ul>
                    <div class="mt-8 bg-gray-800 p-4 rounded-2xl">
                        <h5 class="text-sm font-bold text-white mb-2">Emergency Hotline</h5>
                        <p class="text-red-400 text-xl font-bold">(800) 555-HELP</p>
                        <p class="text-gray-500 text-xs">Available 24/7 for animal emergencies</p>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-800">
                <div class="flex flex-col md:flex-row md:justify-between items-center">
                    <p class="text-gray-400 text-sm mb-4 md:mb-0">
                        &copy; {{ date('Y') }} RescueSpot. All rights reserved.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Privacy</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Terms</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript for UI interactions only -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
            
            // User dropdown toggle
            const userMenuButton = document.getElementById('user-menu-button');
            const userDropdown = document.getElementById('user-dropdown');
            
            if (userMenuButton) {
                userMenuButton.addEventListener('click', function() {
                    userDropdown.classList.toggle('hidden');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                        userDropdown.classList.add('hidden');
                    }
                });
            }
        });
        
        // Adoption modal functions
        function openAdoptionModal(id, name, breed, age, species, image) {
            // Set animal details in the modal
            document.getElementById('animalId').value = id;
            document.getElementById('modalAnimalName').textContent = name;
            document.getElementById('modalAnimalBreed').textContent = breed;
            document.getElementById('modalAnimalAge').textContent = age;
            document.getElementById('modalAnimalSpecies').textContent = species;
            document.getElementById('modalAnimalImage').src = image;
            document.getElementById('modalAnimalImage').alt = name;
            
            // Show the modal
            const modal = document.getElementById('adoptionModal');
            modal.classList.remove('hidden');
            modal.classList.add('modal-active');
            document.body.classList.add('modal-open'); // Prevent scrolling when modal is open
        }
        
        function closeAdoptionModal() {
            const modal = document.getElementById('adoptionModal');
            modal.classList.add('hidden');
            modal.classList.remove('modal-active');
            document.body.classList.remove('modal-open'); // Re-enable scrolling
        }
        
        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('adoptionModal');
            const modalContainer = modal.querySelector('.modal-container');
            
            if (modal && !modal.classList.contains('hidden') && !modalContainer.contains(event.target) && !event.target.closest('.animal-card')) {
                closeAdoptionModal();
            }
        });
        
        // Prevent form submission if fields are empty
        document.getElementById('adoptionForm').addEventListener('submit', function(event) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            if (!isValid) {
                event.preventDefault();
                alert('Please fill out all required fields');
            }
        });
    </script>
</body>
</html>