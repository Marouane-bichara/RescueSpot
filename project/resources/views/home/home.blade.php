<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RescueSpot - Find, Rescue, Adopt</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap');
        
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
        
        /* Button Styles */
        .btn-primary {
            background-color: var(--primary);
            transition: all 0.4s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(255, 107, 107, 0.4);
        }
        
        .btn-secondary {
            background-color: var(--secondary);
            transition: all 0.4s ease;
        }
        
        .btn-secondary:hover {
            background-color: #10ac84;
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(29, 209, 161, 0.4);
        }
        
        /* Card Styles */
        .animal-card {
            transition: all 0.4s ease;
        }
        
        .animal-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Mobile Menu */
        .mobile-menu {
            transition: transform 0.3s ease-in-out;
            transform: translateX(-100%);
        }
        
        .mobile-menu.open {
            transform: translateX(0);
        }
        
        /* Image overlay */
        .image-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 60%);
        }
        
        /* Animations */
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .animate-pulse {
            animation: pulse 2s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>
    <!-- Header & Navigation -->
    <header class="bg-white shadow-md fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center px-4 py-3 sm:px-6 lg:px-8">
                <!-- Logo -->
                <div class="flex justify-start">
                    <a href="#" class="flex items-center">
                        <span class="text-2xl font-bold text-gray-800">Rescue<span class="text-red-500">Spot</span></span>
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button" class="rounded-full p-2 inline-flex items-center justify-center text-gray-500 hover:text-gray-600 hover:bg-gray-100 focus:outline-none">
                        <span class="sr-only">Open menu</span>
                        <i class="fa fa-bars text-xl"></i>
                    </button>
                </div>
                
                <!-- Desktop navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="text-base font-medium text-red-500 border-b-2 border-red-500 pb-1">Home</a>
                    <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500 transition-colors duration-200">Find a Pet</a>
                    <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500 transition-colors duration-200">Report Animal</a>
                    <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500 transition-colors duration-200">Shelters</a>
                    <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500 transition-colors duration-200">About Us</a>
                </nav>
                
                <!-- Desktop right buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="Auth" class="text-gray-500 hover:text-red-500 transition-colors duration-200">
                        Sign In
                    </a>
                    <a href="Auth" class="btn-primary px-5 py-2 rounded-full text-white font-medium shadow-md">
                        Register
                    </a>
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div id="mobile-menu" class="mobile-menu absolute top-0 inset-x-0 p-6 transition transform origin-top-right md:hidden bg-white shadow-lg rounded-b-lg mt-16 z-50">
                <div class="space-y-6">
                    <div class="grid gap-y-8">
                        <a href="#" class="text-base font-medium text-red-500 hover:text-red-600">Home</a>
                        <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500">Find a Pet</a>
                        <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500">Report Animal</a>
                        <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500">Shelters</a>
                        <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500">About Us</a>
                    </div>
                    <div class="space-y-4">
                        <a href="#" class="btn-primary block w-full text-center px-4 py-2 rounded-full text-white font-medium shadow-md">
                            Register
                        </a>
                        <div class="text-center">
                            <span class="text-gray-500">
                                Existing user?
                                <a href="#" class="text-red-500 hover:text-red-600 font-medium">
                                    Sign in
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="pt-28 pb-16 md:pt-32 md:pb-24 bg-gradient-to-br from-white to-red-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="flex-1 md:pr-10 mb-12 md:mb-0 text-center md:text-left">
                    <div class="inline-block px-4 py-1 rounded-full bg-red-100 text-red-600 text-sm font-semibold mb-5 animate-pulse">
                        <i class="fas fa-heart mr-2"></i> Save a Life Today
                    </div>
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-gray-900 leading-tight">
                        <span class="block">Every Pet Deserves</span>
                        <span class="block text-red-500">A Loving Home</span>
                    </h1>
                    <p class="mt-6 text-xl text-gray-600 max-w-xl mx-auto md:mx-0">
                        RescueSpot connects caring individuals with animals in need. Report strays, find adoptable pets, and make a difference today.
                    </p>
                    <div class="mt-8 flex flex-wrap justify-center md:justify-start gap-4">
                        <a href="#" class="btn-primary inline-flex items-center px-8 py-4 rounded-full shadow-lg text-base font-medium text-white">
                            <i class="fas fa-paw mr-2"></i> Find a Pet
                        </a>
                        <a href="#" class="btn-secondary inline-flex items-center px-8 py-4 rounded-full shadow-lg text-base font-medium text-white">
                            <i class="fas fa-bullhorn mr-2"></i> Report Animal
                        </a>
                    </div>
                    <div class="mt-8 hidden md:flex items-center justify-center md:justify-start">
                        <div class="flex -space-x-2 mr-3">
                            <img src="{{ asset('images/Said.jpg') }}" alt="User" class="inline-block h-10 w-10 rounded-full ring-2 ring-white">
                            <img src="{{ asset('images/Fatima.jpg') }}" alt="User" class="inline-block h-10 w-10 rounded-full ring-2 ring-white">
                            <img src="{{ asset('images/Tayeb.jpg') }}" alt="User" class="inline-block h-10 w-10 rounded-full ring-2 ring-white">
                        </div>
                        <p class="text-sm text-gray-500">Joined by <span class="font-bold text-gray-800">5,000+</span> animal lovers</p>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute -top-6 -left-6 w-32 h-32 bg-red-100 rounded-full opacity-70 animate-float"></div>
                        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-green-100 rounded-full opacity-70 animate-float" style="animation-delay: 1s;"></div>
                        <img src="{{ asset('images/dog1.jpg') }}" alt="Homepage Banner" class="relative z-10 rounded-3xl w-full h-auto object-cover shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Stats Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="animal-card bg-gradient-to-br from-red-50 to-white p-8 rounded-2xl shadow-md text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search-location text-2xl text-red-500"></i>
                    </div>
                    <span class="text-3xl md:text-4xl font-bold text-red-500 block mb-2">8,742</span>
                    <p class="text-gray-600">Animals Rescued</p>
                </div>
                <div class="animal-card bg-gradient-to-br from-green-50 to-white p-8 rounded-2xl shadow-md text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-home text-2xl text-green-500"></i>
                    </div>
                    <span class="text-3xl md:text-4xl font-bold text-green-500 block mb-2">7,219</span>
                    <p class="text-gray-600">Adoptions Completed</p>
                </div>
                <div class="animal-card bg-gradient-to-br from-red-50 to-white p-8 rounded-2xl shadow-md text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-building text-2xl text-red-500"></i>
                    </div>
                    <span class="text-3xl md:text-4xl font-bold text-red-500 block mb-2">152</span>
                    <p class="text-gray-600">Partner Shelters</p>
                </div>
                <div class="animal-card bg-gradient-to-br from-green-50 to-white p-8 rounded-2xl shadow-md text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-2xl text-green-500"></i>
                    </div>
                    <span class="text-3xl md:text-4xl font-bold text-green-500 block mb-2">35,426</span>
                    <p class="text-gray-600">Community Members</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-16 md:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-block px-4 py-1 rounded-full bg-red-100 text-red-600 text-sm font-semibold mb-4">Our Process</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-5">How RescueSpot Works</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Three simple steps that connect people, shelters, and animals in need
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-3">
                <!-- Step 1 -->
                <div class="animal-card bg-white rounded-3xl shadow-md overflow-hidden">
                    <div class="h-2 bg-red-500"></div>
                    <div class="p-8">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-camera text-2xl text-red-500"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Report</h3>
                        <p class="text-gray-600 mb-6">
                            Found an animal in need? Quickly report with photos and location details. Nearby shelters are immediately notified.
                        </p>
                        <ul class="space-y-4 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-red-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Upload photos and provide location details</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-red-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Shelters within the area are notified</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-red-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Get instant updates on rescue status</span>
                            </li>
                        </ul>
                        <a href="#" class="group inline-flex items-center text-red-500 font-medium hover:text-red-600">
                            Learn more <i class="fas fa-arrow-right ml-2 group-hover:ml-3 transition-all duration-300"></i>
                        </a>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="animal-card bg-white rounded-3xl shadow-md overflow-hidden">
                    <div class="h-2 bg-green-500"></div>
                    <div class="p-8">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-hand-holding-heart text-2xl text-green-500"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Rescue</h3>
                        <p class="text-gray-600 mb-6">
                            Shelters respond to reports, coordinate rescue efforts, and provide medical care for animals in need.
                        </p>
                        <ul class="space-y-4 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Shelters coordinate rescue operations</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Animals receive necessary medical care</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Chat with rescuers in real-time</span>
                            </li>
                        </ul>
                        <a href="#" class="group inline-flex items-center text-green-500 font-medium hover:text-green-600">
                            Learn more <i class="fas fa-arrow-right ml-2 group-hover:ml-3 transition-all duration-300"></i>
                        </a>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="animal-card bg-white rounded-3xl shadow-md overflow-hidden">
                    <div class="h-2 bg-red-500"></div>
                    <div class="p-8">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-home text-2xl text-red-500"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Rehome</h3>
                        <p class="text-gray-600 mb-6">
                            Once rehabilitated, animals are listed for adoption. Apply to give them their forever home.
                        </p>
                        <ul class="space-y-4 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-red-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Browse pets available for adoption</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-red-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Submit adoption applications online</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-red-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Track adoption status in real-time</span>
                            </li>
                        </ul>
                        <a href="#" class="group inline-flex items-center text-red-500 font-medium hover:text-red-600">
                            Learn more <i class="fas fa-arrow-right ml-2 group-hover:ml-3 transition-all duration-300"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Animals Needing Help -->
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-16">
                <div class="mb-8 md:mb-0">
                    <div class="inline-block px-4 py-1 rounded-full bg-red-100 text-red-600 text-sm font-semibold mb-4">Urgent Cases</div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Animals Needing Help</h2>
                    <p class="text-xl text-gray-600 max-w-2xl">
                        These animals have been recently reported and are waiting for rescue
                    </p>
                </div>
                <div>
                    <a href="#" class="btn-primary inline-flex items-center px-6 py-3 rounded-full text-white font-medium shadow-lg">
                        <i class="fas fa-plus mr-2"></i> Report an Animal
                    </a>
                </div>
            </div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Animal Card 1 -->
                <div class="animal-card bg-white rounded-3xl shadow-md overflow-hidden">
                    <div class="relative">
                        <img class="h-72 w-full object-cover" src="{{ asset('images/injureddog.jpg') }}" alt="Golden Retriever">
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <span class="relative flex h-3 w-3 mr-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                </span>
                                Urgent
                            </span>
                        </div>
                        <div class="absolute inset-x-0 bottom-0 h-24 image-overlay"></div>
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-lg font-bold text-white">Golden Retriever Mix</h3>
                            <div class="flex items-center text-white text-sm opacity-90">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                <span>Central Park, East Entrance</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm text-gray-500">Reported 1 hour ago</span>
                            <span class="text-sm font-medium text-red-500">Male • Adult</span>
                        </div>
                        <p class="text-gray-600 mb-5">
                            Found limping with an injured paw. Appears friendly but scared and hungry.
                        </p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-red-100" src="{{ asset('images/Anass.jpg') }}" alt="Reporter">
                                <span class="ml-2 text-sm text-gray-600">By Michael T.</span>
                            </div>
                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition-all duration-200 text-sm font-medium">
                                Details <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Animal Card 2 -->
                <div class="animal-card bg-white rounded-3xl shadow-md overflow-hidden">
                    <div class="relative">
                        <img class="h-72 w-full object-cover" src="{{ asset('images/injuerdcat.jpg') }}" alt="Tabby Cat">
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-2"></i> In Progress
                            </span>
                        </div>
                        <div class="absolute inset-x-0 bottom-0 h-24 image-overlay"></div>
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-lg font-bold text-white">Tabby Cat & Kittens</h3>
                            <div class="flex items-center text-white text-sm opacity-90">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                <span>Behind City College, West Area</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm text-gray-500">Reported 3 hours ago</span>
                            <span class="text-sm font-medium text-green-500">Female • Adult + Kittens</span>
                        </div>
                        <p class="text-gray-600 mb-5">
                            Mother cat with four kittens found in a cardboard box. All appear hungry but otherwise healthy.
                        </p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-yellow-100" src="{{ asset('images/Ilyass.jpg') }}" alt="Reporter">
                                <span class="ml-2 text-sm text-gray-600">By Jessica L.</span>
                            </div>
                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition-all duration-200 text-sm font-medium">
                                Details <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Animal Card 3 -->
                <div class="animal-card bg-white rounded-3xl shadow-md overflow-hidden">
                    <div class="relative">
                        <img class="h-72 w-full object-cover" src="{{ asset('images/injuredpoppy.jpg') }}" alt="Beagle Puppy">
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-2"></i> Rescued
                            </span>
                        </div>
                        <div class="absolute inset-x-0 bottom-0 h-24 image-overlay"></div>
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-lg font-bold text-white">Beagle Mix Puppy</h3>
                            <div class="flex items-center text-white text-sm opacity-90">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                <span>Oakwood Shopping Center Parking</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm text-gray-500">Reported 6 hours ago</span>
                            <span class="text-sm font-medium text-green-500">Male • Puppy</span>
                        </div>
                        <p class="text-gray-600 mb-5">
                            Young puppy found wandering alone. Very friendly and sociable. Currently at Metro Animal Shelter.
                        </p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-green-100" src="{{ asset('images/Abdelhafid.jpg') }}" alt="Reporter">
                                <span class="ml-2 text-sm text-gray-600">By David R.</span>
                            </div>
                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition-all duration-200 text-sm font-medium">
                                Details <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="#" class="inline-flex items-center px-6 py-3 rounded-full border border-gray-300 shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200">
                    View All Reports <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Adoption Section -->
    <section class="py-16 md:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-block px-4 py-1 rounded-full bg-green-100 text-green-600 text-sm font-semibold mb-4">Find Your Match</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Pets Available for Adoption</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    These rescued animals have been rehabilitated and are ready for their forever homes
                </p>
            </div>

            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Adoption Card 1 -->
                <div class="animal-card bg-white rounded-3xl shadow-md overflow-hidden">
                    <div class="relative">
                        <img class="h-64 w-full object-cover" src="{{ asset('images/LabradorMix.jpg') }}" alt="Buddy">
                        <button class="absolute top-4 right-4 bg-white p-2 rounded-full shadow text-red-500 hover:text-red-600 hover:scale-110 transition-all duration-200 focus:outline-none">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-bold text-gray-900">Buddy</h3>
                            <div class="flex items-center">
                                <i class="fas fa-mars text-blue-500 mr-1"></i>
                                <span class="text-sm text-gray-600">2 yrs</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-4">Labrador Mix</p>
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="inline-block px-3 py-1 bg-red-100 text-red-600 text-xs font-medium rounded-full">Friendly</span>
                            <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-600 text-xs font-medium rounded-full">Active</span>
                            <span class="inline-block px-3 py-1 bg-green-100 text-green-600 text-xs font-medium rounded-full">Kid-friendly</span>
                        </div>
                        <a href="#" class="block w-full text-center px-4 py-3 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-full transition-all duration-200">
                            View Profile
                        </a>
                    </div>
                </div>

                <!-- Adoption Card 2 -->
                <div class="animal-card bg-white rounded-3xl shadow-md overflow-hidden">
                    <div class="relative">
                        <img class="h-64 w-full object-cover" src="{{ asset('images/SiameseMix.jpg') }}" alt="Luna">
                        <button class="absolute top-4 right-4 bg-white p-2 rounded-full shadow text-red-500 hover:text-red-600 hover:scale-110 transition-all duration-200 focus:outline-none">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-bold text-gray-900">Luna</h3>
                            <div class="flex items-center">
                                <i class="fas fa-venus text-pink-500 mr-1"></i>
                                <span class="text-sm text-gray-600">1 yr</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-4">Siamese Mix</p>
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-600 text-xs font-medium rounded-full">Shy</span>
                            <span class="inline-block px-3 py-1 bg-green-100 text-green-600 text-xs font-medium rounded-full">Calm</span>
                            <span class="inline-block px-3 py-1 bg-red-100 text-red-600 text-xs font-medium rounded-full">Indoor Only</span>
                        </div>
                        <a href="#" class="block w-full text-center px-4 py-3 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-full transition-all duration-200">
                            View Profile
                        </a>
                    </div>
                </div>

                <!-- Adoption Card 3 -->
                <div class="animal-card bg-white rounded-3xl shadow-md overflow-hidden">
                    <div class="relative">
                        <img class="h-64 w-full object-cover" src="{{ asset('images/Beagle.jpg') }}" alt="Charlie">
                        <button class="absolute top-4 right-4 bg-white p-2 rounded-full shadow text-red-500 hover:text-red-600 hover:scale-110 transition-all duration-200 focus:outline-none">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-bold text-gray-900">Charlie</h3>
                            <div class="flex items-center">
                                <i class="fas fa-mars text-blue-500 mr-1"></i>
                                <span class="text-sm text-gray-600">3 yrs</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-4">Beagle</p>
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-600 text-xs font-medium rounded-full">Good with Pets</span>
                            <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 text-xs font-medium rounded-full">Playful</span>
                            <span class="inline-block px-3 py-1 bg-red-100 text-red-600 text-xs font-medium rounded-full">Friendly</span>
                        </div>
                        <a href="#" class="block w-full text-center px-4 py-3 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-full transition-all duration-200">
                            View Profile
                        </a>
                    </div>
                </div>

                <!-- Adoption Card 4 -->
                <div class="animal-card bg-white rounded-3xl shadow-md overflow-hidden">
                    <div class="relative">
                        <img class="h-64 w-full object-cover" src="{{ asset('images/TabbyKitten.jpg') }}" alt="Bella">
                        <button class="absolute top-4 right-4 bg-white p-2 rounded-full shadow text-red-500 hover:text-red-600 hover:scale-110 transition-all duration-200 focus:outline-none">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-bold text-gray-900">Bella</h3>
                            <div class="flex items-center">
                                <i class="fas fa-venus text-pink-500 mr-1"></i>
                                <span class="text-sm text-gray-600">6 mo</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-4">Tabby Kitten</p>
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 text-xs font-medium rounded-full">Playful</span>
                            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-600 text-xs font-medium rounded-full">Kitten</span>
                            <span class="inline-block px-3 py-1 bg-pink-100 text-pink-600 text-xs font-medium rounded-full">Affectionate</span>
                        </div>
                        <a href="#" class="block w-full text-center px-4 py-3 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-full transition-all duration-200">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="#" class="btn-primary inline-flex items-center px-8 py-4 rounded-full text-white font-medium shadow-lg">
                    Browse All Adoptable Pets <i class="fas fa-paw ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-block px-4 py-1 rounded-full bg-red-100 text-red-600 text-sm font-semibold mb-4">Success Stories</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Happy Tails</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Hear from people who have found their forever friends through RescueSpot
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-3">
                <!-- Testimonial 1 -->
                <div class="animal-card bg-gradient-to-tr from-white to-red-50 p-8 rounded-3xl shadow-md">
                    <div class="flex items-center mb-6">
                        <img class="h-14 w-14 rounded-full object-cover border-2 border-red-100" src="/api/placeholder/100/100" alt="User">
                        <div class="ml-4">
                            <h4 class="text-xl font-bold text-gray-900">Sarah & Max</h4>
                            <p class="text-gray-500">Adopted 6 months ago</p>
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="flex text-yellow-400 space-x-1">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-6">
                        "I found Max through RescueSpot after someone reported him abandoned. The platform made connecting with the shelter so easy, and now he's the happiest, most loving dog I could have asked for!"
                    </p>
                    <div class="flex items-center p-4 bg-white rounded-2xl shadow-sm">
                        <img src="/api/placeholder/120/120" alt="Pet" class="h-16 w-16 rounded-xl object-cover">
                        <div class="ml-4">
                            <span class="text-sm text-gray-500">Max now:</span>
                            <p class="text-sm text-green-600 font-medium">Happy and healthy in his forever home</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="animal-card bg-gradient-to-tr from-white to-green-50 p-8 rounded-3xl shadow-md">
                    <div class="flex items-center mb-6">
                        <img class="h-14 w-14 rounded-full object-cover border-2 border-green-100" src="/api/placeholder/100/100" alt="User">
                        <div class="ml-4">
                            <h4 class="text-xl font-bold text-gray-900">David & Luna</h4>
                            <p class="text-gray-500">Adopted 1 year ago</p>
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="flex text-yellow-400 space-x-1">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-6">
                        "I reported a cat I found in my neighborhood, and the shelter contacted me right away. I ended up adopting her myself! The chat feature made communication with the shelter seamless."
                    </p>
                    <div class="flex items-center p-4 bg-white rounded-2xl shadow-sm">
                        <img src="/api/placeholder/120/120" alt="Pet" class="h-16 w-16 rounded-xl object-cover">
                        <div class="ml-4">
                            <span class="text-sm text-gray-500">Luna now:</span>
                            <p class="text-sm text-green-600 font-medium">Enjoys sunny windowsills and cuddles</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="animal-card bg-gradient-to-tr from-white to-blue-50 p-8 rounded-3xl shadow-md">
                    <div class="flex items-center mb-6">
                        <img class="h-14 w-14 rounded-full object-cover border-2 border-blue-100" src="/api/placeholder/100/100" alt="User">
                        <div class="ml-4">
                            <h4 class="text-xl font-bold text-gray-900">Maria & Buddy</h4>
                            <p class="text-gray-500">Adopted 3 months ago</p>
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="flex text-yellow-400 space-x-1">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-6">
                        "RescueSpot made it easy to find the perfect companion. I could see Buddy's entire journey from rescue to rehabilitation. The profile details helped me know he would be a perfect fit for our family."
                    </p>
                    <div class="flex items-center p-4 bg-white rounded-2xl shadow-sm">
                        <img src="/api/placeholder/120/120" alt="Pet" class="h-16 w-16 rounded-xl object-cover">
                        <div class="ml-4">
                            <span class="text-sm text-gray-500">Buddy now:</span>
                            <p class="text-sm text-green-600 font-medium">Loves family hikes and playtime</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="#" class="inline-flex items-center px-6 py-3 rounded-full border border-gray-300 shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200">
                    Read More Success Stories <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 md:py-24 bg-gradient-to-r from-red-500 to-pink-500 text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-8">Ready to Make a Difference?</h2>
            <p class="text-xl md:text-2xl mb-12 text-white opacity-90 max-w-3xl mx-auto">
                Join our community today and help rescue animals in need. Together, we can create more happy endings.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6 mb-16">
                <a href="#" class="btn-secondary inline-flex items-center justify-center px-8 py-4 rounded-full shadow-lg text-white text-lg font-medium">
                    <i class="fas fa-user-plus mr-2"></i> Create an Account
                </a>
                <a href="#" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white rounded-full shadow-sm text-lg font-medium text-white hover:bg-white hover:text-red-500 transition-all duration-300">
                    <i class="fas fa-hands-helping mr-2"></i> Become a Volunteer
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <h3 class="text-4xl font-bold">30+</h3>
                    <p class="text-white opacity-80">Cities</p>
                </div>
                <div class="text-center">
                    <h3 class="text-4xl font-bold">8,000+</h3>
                    <p class="text-white opacity-80">Animals Rescued</p>
                </div>
                <div class="text-center">
                    <h3 class="text-4xl font-bold">150+</h3>
                    <p class="text-white opacity-80">Shelter Partners</p>
                </div>
                <div class="text-center">
                    <h3 class="text-4xl font-bold">5,000+</h3>
                    <p class="text-white opacity-80">Active Volunteers</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 md:gap-12 mb-16">
                <!-- About -->
                <div class="col-span-1 lg:col-span-2">
                    <div class="flex items-center mb-6">
                        <span class="text-2xl font-bold text-white">Rescue<span class="text-red-500">Spot</span></span>
                    </div>
                    <p class="text-gray-400 mb-8">
                        RescueSpot connects people with animal shelters to rescue, rehabilitate, and rehome animals in need. Our mission is to ensure every animal finds a loving home.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-facebook-f text-lg"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-twitter text-lg"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-instagram text-lg"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-youtube text-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-span-1">
                    <h4 class="text-lg font-bold text-white mb-6">Quick Links</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Find a Pet</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Report Animal</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Shelters</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Success Stories</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">About Us</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div class="col-span-1">
                    <h4 class="text-lg font-bold text-white mb-6">Resources</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Pet Care Tips</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Adoption Guide</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Rescue Resources</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">FAQs</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Terms of Service</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-span-1">
                    <h4 class="text-lg font-bold text-white mb-6">Contact Us</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 text-red-400 mr-3"></i>
                            <span>123 Rescue Lane<br>Animal City, AC 12345</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-red-400 mr-3"></i>
                            <span>(800) RESCUE-1</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-red-400 mr-3"></i>
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
                        &copy; 2025 RescueSpot. All rights reserved.
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

    <!-- JavaScript for Mobile Menu Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('open');
            });
        });
    </script>
</body>
</html>