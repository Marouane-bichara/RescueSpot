<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RescueSpot - Shelter Dashboard</title>
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

            // Simplified Modal functionality - just toggle visibility
            const modalTriggers = document.querySelectorAll('[data-modal-target]');
            const closeModalButtons = document.querySelectorAll('[data-close-modal]');
            const overlay = document.getElementById('modal-overlay');

            modalTriggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const modalId = trigger.getAttribute('data-modal-target');
                    const modal = document.getElementById(modalId);
                    
                    modal.classList.remove('hidden');
                    overlay.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                });
            });

            function closeModal() {
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.classList.add('hidden');
                });
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            closeModalButtons.forEach(button => {
                button.addEventListener('click', closeModal);
            });

            overlay.addEventListener('click', closeModal);
            
            // Helper function to simulate Laravel's asset function
            function asset(path) {
                return path;
            }
        });
    </script>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Top Navigation -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="#" class="flex items-center space-x-2">
                        <div class="bg-gradient-to-r from-teal-600 to-emerald-600 text-white p-2 rounded-lg">
                            <i class="fas fa-paw text-xl"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-800">RescueSpot</span>
                        <span class="bg-teal-100 text-teal-800 text-xs px-2 py-1 rounded-full">Shelter Portal</span>
                    </a>
                </div>

                <!-- Main Navigation - Desktop -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gradient-to-r from-teal-600 to-emerald-600">Dashboard</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Animals</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Adoption Requests</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Reports</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Messages</a>
                </div>

                <!-- Right Side Menu -->
                <div class="flex items-center space-x-4">
                    <button data-modal-target="add-animal-modal" class="hidden md:block bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-600 hover:to-emerald-600 text-white py-2 px-4 rounded-lg shadow-md transition transform hover:scale-105">
                        <span class="text-white text-sm font-medium">Add Animal</span>
                    </button>
                    
                    <!-- Notifications -->
                    <button class="relative p-1 rounded-full text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none">
                        <i class="far fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs w-4 h-4 flex items-center justify-center rounded-full">7</span>
                    </button>
                    
                    <!-- Messages -->
                    <button class="relative p-1 rounded-full text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none">
                        <i class="far fa-envelope text-xl"></i>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs w-4 h-4 flex items-center justify-center rounded-full">3</span>
                    </button>
                    
                    <!-- Profile Dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <button type="button" id="profile-btn" class="flex text-sm bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500" aria-expanded="false" aria-haspopup="true">
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-teal-500" src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Shelter Profile">
                            </button>
                        </div> 
                        <div id="profile-dropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <a href="ShelterProfile" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                <i class="far fa-user mr-3 text-gray-500"></i> Shelter Profile
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                <i class="fas fa-cog mr-3 text-gray-500"></i> Settings
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                <i class="fas fa-chart-line mr-3 text-gray-500"></i> Statistics
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                <i class="fas fa-users mr-3 text-gray-500"></i> Staff
                            </a>
                            <div class="border-t border-gray-100"></div>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-red-700 hover:bg-gray-100" role="menuitem">
                                <i class="fas fa-sign-out-alt mr-3 text-red-500"></i> Log out
                            </a>
                        </div>
                    </div>
                    
                    <!-- Mobile menu button -->
                    <button type="button" id="mobile-menu-btn" class="md:hidden bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500" aria-controls="mobile-menu" aria-expanded="false">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white shadow-md">
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-teal-600 to-emerald-600">Dashboard</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Animals</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Adoption Requests</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Reports</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Messages</a>
                <button data-modal-target="add-animal-modal" class="mt-2 w-full flex justify-center items-center bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-600 hover:to-emerald-600 text-white py-2 px-4 rounded-lg shadow-md">
                    <span class="text-white text-sm font-medium">Add Animal</span>                    
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20 pb-12">
        <!-- Welcome Banner -->
        <div class="relative bg-white overflow-hidden mb-8">
            <div class="max-w-7xl mx-auto">
                <!-- Full-width Hero Section -->
                <style>
                  .full-bleed {
                    width: 100vw;
                    margin-left: calc(50% - 50vw);
                    margin-right: calc(50% - 50vw);
                  }
                </style>

                <div class="full-bleed relative overflow-hidden bg-gradient-to-br from-teal-900 to-emerald-900 border-0">
                    <!-- Background Image with Overlay -->
                    <div class="absolute inset-0 z-0">
                        <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="" class="w-full h-full object-cover opacity-40">
                        <!-- Strong overlay to hide any watermarks completely -->
                        <div class="absolute inset-0 bg-gradient-to-br from-teal-900/90 via-emerald-800/90 to-teal-800/90"></div>
                        <!-- Subtle pattern overlay for texture -->
                        <div class="absolute inset-0 mix-blend-soft-light opacity-30" style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M0 0h20v20H0V0zm10 17c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7z\' fill=\'%23ffffff\' fill-opacity=\'0.05\'/%3E%3C/svg%3E');"></div>
                    </div>

                    <!-- Main Content -->
                    <div class="relative z-10">
                        <div class="pt-16 pb-20 md:pt-24 md:pb-28 lg:pt-24 lg:pb-28 px-6 sm:px-12 md:px-16 lg:px-20 xl:px-24">
                            <div class="max-w-screen-2xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                                <!-- Left Column - Text Content -->
                                <div class="text-center lg:text-left">
                                    <div class="inline-block mb-6 p-2 bg-teal-600 bg-opacity-30 rounded-lg backdrop-blur-sm">
                                        <div class="flex items-center space-x-2 px-3 py-1 bg-gradient-to-r from-teal-500 to-emerald-600 rounded-md">
                                            <i class="fas fa-shield-alt text-white"></i>
                                            <span class="text-white font-medium">Shelter Dashboard</span>
                                        </div>
                                    </div>
                                    
                                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                                        <span class="block">Welcome back,</span>
                                        <span class="block mt-2 text-transparent bg-clip-text bg-gradient-to-r from-teal-300 via-emerald-300 to-green-200">Happy Paws Shelter</span>
                                    </h1>
                                    
                                    <p class="mt-6 text-lg md:text-xl text-teal-100 max-w-2xl mx-auto lg:mx-0">
                                        Your dedicated space to manage animal rescues, adoption requests, and connect with potential adopters. Together, we're making a difference.
                                    </p>
                                    
                                    <div class="mt-8 flex flex-col sm:flex-row justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-4">
                                        <a href="#" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-xl text-base font-medium text-white bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 shadow-lg hover:shadow-xl transform transition duration-300 hover:-translate-y-1">
                                            <i class="fas fa-clipboard-list mr-2"></i>
                                            View Pending Requests
                                        </a>
                                        <a data-modal-target="add-animal-modal" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-xl text-base font-medium text-teal-100 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-teal-200/30 shadow-lg hover:shadow-xl transition duration-300 hover:-translate-y-1">
                                            <i class="fas fa-plus mr-2"></i>
                                            Add New Animal
                                        </a>
                                    </div>
                                    
                                    <!-- Trust Indicators -->
                                    <div class="mt-8 pt-6 border-t border-teal-800/30 grid grid-cols-3 gap-4">
                                        <div class="text-center">
                                            <p class="text-3xl font-bold text-white">{{ count($allAnimalsReadyForAdoption) }}</p>
                                            <p class="text-teal-200 text-sm">Animals in Care</p>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-3xl font-bold text-white">18</p>
                                            <p class="text-teal-200 text-sm">Pending Adoptions</p>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-3xl font-bold text-white">7</p>
                                            <p class="text-teal-200 text-sm">New Reports</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Right Column - Image Card Stack -->
                                <div class="relative">
                                    <!-- Decorative elements -->
                                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-gradient-to-br from-green-500 to-teal-500 opacity-20 rounded-full blur-3xl"></div>
                                    <div class="absolute -bottom-5 -left-5 w-28 h-28 bg-gradient-to-br from-teal-400 to-emerald-300 opacity-20 rounded-full blur-2xl"></div>
                                    
                                    <!-- 3D Card Stack Effect -->
                                    <div class="relative mx-auto max-w-lg lg:max-w-none">
                                        <!-- Background Card -->
                                        <div class="absolute top-8 -left-6 -right-6 bottom-0 bg-gradient-to-br from-teal-500/20 to-emerald-600/20 rounded-xl backdrop-blur-sm shadow-xl rotate-6 border border-white/10"></div>
                                        
                                        <!-- Middle Card -->
                                        <div class="absolute top-4 -left-3 -right-3 bottom-4 bg-gradient-to-br from-teal-500/30 to-emerald-600/30 rounded-xl backdrop-blur-sm shadow-xl -rotate-3 border border-white/20"></div>
                                        
                                        <!-- Main Card with Image -->
                                        <div class="relative bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm p-3 rounded-xl shadow-2xl transform transition-transform hover:scale-[1.02] duration-500">
                                            <img src="https://images.unsplash.com/photo-1601758125946-6ec2ef64daf8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" class="w-full h-auto rounded-lg" alt="Shelter staff with rescued animals">
                                            
                                            <!-- Floating Info Badge -->
                                            <div class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 bg-white dark:bg-gray-800 px-4 py-2 rounded-lg shadow-lg flex items-center space-x-2">
                                                <i class="fas fa-heart text-red-500"></i>
                                                <span class="font-medium text-gray-800">12 successful adoptions this month</span>
                                            </div>
                                            
                                            <!-- Success Stories Badge -->
                                            <div class="absolute -top-3 -right-3 bg-gradient-to-r from-teal-500 to-emerald-600 text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                                                Shelter Spotlight
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Floating Paw Icons -->
                                    <div class="absolute top-10 -left-4 bg-teal-600 p-2 rounded-full shadow-lg animate-bounce">
                                        <i class="fas fa-paw text-white"></i>
                                    </div>
                                    <div class="absolute bottom-20 -right-2 bg-emerald-600 p-2 rounded-full shadow-lg animate-bounce" style="animation-delay: 0.5s">
                                        <i class="fas fa-paw text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Wave Shape Divider -->
                    <div class="absolute bottom-0 left-0 right-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" fill="#F3F4F6" class="w-full">
                            <path d="M0,64L48,64C96,64,192,64,288,53.3C384,43,480,21,576,16C672,11,768,21,864,37.3C960,53,1056,75,1152,75C1248,75,1344,53,1392,42.7L1440,32L1440,100L1392,100C1344,100,1248,100,1152,100C1056,100,960,100,864,100C768,100,672,100,576,100C480,100,384,100,288,100C192,100,96,100,48,100L0,100Z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4">
            <!-- Stats Section -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                        <div class="p-6 border-b md:border-r md:border-b-0 lg:border-r border-gray-200 text-center">
                            <span class="text-teal-600 text-4xl font-bold block">{{ count($allAnimalsReadyForAdoption) }}</span>
                            <p class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wider">Animals in care</p>
                            <div class="mt-1">
                                <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                                <span class="text-green-500 text-sm">+3 this week</span>
                            </div>
                        </div>
                        <div class="p-6 border-b lg:border-r lg:border-b-0 border-gray-200 text-center">
                            <span class="text-emerald-600 text-4xl font-bold block">18</span>
                            <p class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wider">Pending adoptions</p>
                            <div class="mt-1">
                                <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                                <span class="text-green-500 text-sm">+5 this week</span>
                            </div>
                        </div>
                        <div class="p-6 border-b md:border-r md:border-b-0 border-gray-200 text-center">
                            <span class="text-green-600 text-4xl font-bold block">87</span>
                            <p class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wider">Total adoptions</p>
                            <div class="mt-1">
                                <i class="fas fa-chart-line text-green-500 mr-1"></i>
                                <span class="text-green-500 text-sm">Growing steadily</span>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <span class="text-purple-600 text-4xl font-bold block">7</span>
                            <p class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wider">New reports</p>
                            <div class="mt-1">
                                <i class="fas fa-exclamation-circle text-amber-500 mr-1"></i>
                                <span class="text-amber-500 text-sm">Needs attention</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Grid -->
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left Column - Main Content -->
                <div class="w-full lg:w-3/4 space-y-8">
                    <!-- Animals in Care Section -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-lg font-bold text-gray-800">Animals in Care</h2>
                            <div class="flex space-x-2">
                                <button class="py-1 px-3 text-sm rounded-md bg-teal-100 text-teal-700 hover:bg-teal-200">All</button>
                                <button class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Dogs</button>
                                <button class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Cats</button>
                                <button class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Others</button>
                            </div>
                        </div>
                        
                        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                            @forelse ($allAnimalsReadyForAdoption as $animal)
                                <!-- Animal Card -->
                                <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 transition transform hover:shadow-md hover:-translate-y-1">
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $animal->photoAnimal) }}" alt="{{ $animal->name }}" class="w-full h-48 object-cover">
                                        <div class="absolute top-3 right-3 bg-green-500 text-white text-xs px-2 py-1 rounded-full">{{ ucfirst($animal->status) }}</div>
                                        <button class="absolute top-3 left-3 bg-white rounded-full p-2 text-gray-700 shadow hover:bg-gray-100 transition">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                    <div class="p-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <h3 class="font-semibold text-gray-800">{{ $animal->name }}</h3>
                                            <div class="flex space-x-1">
                                                <span class="text-xs bg-teal-100 text-teal-800 px-2 py-1 rounded-full">ID: {{ $animal->id }}</span>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2 mb-2 text-xs">
                                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">{{ $animal->species }}</span>
                                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full">{{ $animal->age }} years</span>
                                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">{{ $animal->breed }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-3">{{ $animal->species }} available for adoption.</p>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-500">In care: {{ \Carbon\Carbon::parse($animal->created_at)->diffForHumans() }}</span>
                                            <button data-modal-target="animal-details-modal" class="bg-teal-600 hover:bg-teal-700 text-white py-1.5 px-3 rounded-lg text-sm transition-colors">
                                                View details
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full text-center py-8">
                                    <p class="text-gray-500">No animals available for adoption at this time.</p>
                                </div>
                            @endforelse
                        </div>
                        
                        <div class="px-6 py-4 border-t border-gray-200 text-center">
                            <a href="#" class="inline-flex items-center text-teal-600 hover:text-teal-800 font-medium">
                                View all animals
                                <i class="fas fa-chevron-right ml-2 text-xs"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Adoption Requests Section -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-lg font-bold text-gray-800">Pending Adoption Requests</h2>
                            <div class="flex items-center">
                                <button class="p-1 rounded text-gray-700 hover:bg-gray-100 mr-2">
                                    <i class="fas fa-filter"></i>
                                </button>
                                <a href="#" class="text-teal-600 hover:text-teal-800 text-sm font-medium">View all</a>
                            </div>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Animal</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
    @forelse ($adoptionRequests as $request)
        <tr>
            {{-- Applicant --}}
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $request->adopter->profilePhoto) }}" alt="Adopter Photo">
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">{{ $request->adopter->name }}</div>
                        <div class="text-sm text-gray-500">{{ $request->adopter->email }}</div>
                    </div>
                </div>
            </td>

            {{-- Animal --}}
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $request->animal->photoAnimal) }}" alt="Animal Photo">
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">{{ $request->animal->name }} ({{ $request->animal->code }})</div>
                        <div class="text-sm text-gray-500">{{ $request->animal->race }}, {{ $request->animal->age }} years</div>
                    </div>
                </div>
            </td>

            {{-- Date --}}
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($request->requestDate)->format('F j, Y') }}</div>
                <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($request->requestDate)->diffForHumans() }}</div>
            </td>

            {{-- Status --}}
            <td class="px-6 py-4 whitespace-nowrap">
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'approved' => 'bg-green-100 text-green-800',
                        'rejected' => 'bg-red-100 text-red-800',
                        'interview' => 'bg-blue-100 text-blue-800',
                        'home_check_passed' => 'bg-green-100 text-green-800',
                    ];
                @endphp
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$request->status] ?? 'bg-gray-100 text-gray-800' }}">
                    {{ ucwords(str_replace('_', ' ', $request->status)) }}
                </span>
            </td>

            {{-- Actions --}}
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
    <div class="flex space-x-2">

    <form action="" method="GET">
            <button type="submit" class="text-teal-600 hover:text-teal-900">View</button>
        </form>


        <form action="" method="POST">
            @csrf

            <button type="submit" class="text-green-600 hover:text-green-900">Approve</button>
        </form>


        <form action="" method="POST">
            @csrf

            <button type="submit" class="text-red-600 hover:text-red-900">Decline</button>
        </form>
    </div>
</td>

        </tr>
    @empty
        <tr>
            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No adoption requests found.</td>
        </tr>
    @endforelse
</tbody>

                            </table>
                        </div>
                    </div>

              <!-- Recent Reports Section -->
<div class="bg-white rounded-2xl shadow-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-lg font-bold text-gray-800">Recent Animal Reports</h2>
        <div class="flex items-center">
            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full mr-2">{{ count($allthereports) }} new</span>
            <a href="" class="text-teal-600 hover:text-teal-800 text-sm font-medium">View all</a>
        </div>
    </div>

    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @if($allthereports->isEmpty())
            <div class="col-span-full text-center text-gray-500">
                <p>No reports available</p>
            </div>
        @else
            @foreach ($allthereports as $report)
                <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 transition transform hover:shadow-md hover:-translate-y-1">
                    <div class="relative">
                    <img src="{{ asset('storage/' . $report->photo) }}" alt="Reported animal" class="w-full h-48 object-cover">
                        @if ($report->status === 'injured' || $report->status === 'urgent')
                            <div class="absolute top-3 left-3 bg-red-500 text-white text-xs px-2 py-1 rounded-full capitalize">
                                {{ $report->status }}
                            </div>
                        @endif
                        <div class="absolute top-3 right-3 bg-teal-500 text-white text-xs px-2 py-1 rounded-full">New</div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-semibold text-gray-800">{{ Str::limit($report->description, 30) }}</h3>
                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full capitalize">{{ $report->status }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">{{ $report->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm"><i class="fas fa-map-marker-alt text-gray-500 mr-1"></i> {{ $report->location }}</span>
                            <a href="" class="text-teal-600 hover:text-teal-800 text-sm font-medium">View details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="px-6 py-4 border-t border-gray-200 text-center">
        <a href="" class="inline-flex items-center text-teal-600 hover:text-teal-800 font-medium">
            View all reports
            <i class="fas fa-chevron-right ml-2 text-xs"></i>
        </a>
    </div>
</div>


                </div>

                <!-- Right Column - Sidebar -->
                <div class="w-full lg:w-1/4 space-y-8">
                    <!-- Action Buttons -->
                    <div class="bg-gradient-to-r from-teal-600 to-emerald-600 rounded-2xl shadow-xl p-6 text-white">
                        <h2 class="text-xl font-bold mb-4">Quick actions</h2>
                        <div class="space-y-3">
                            <a data-modal-target="add-animal-modal" class="flex items-center p-3 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-xl transition">
                                <div class="w-10 h-10 flex items-center justify-center bg-teal-500 rounded-lg mr-4">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div>
                                    <span class="font-medium">Add new animal</span>
                                    <p class="text-xs text-teal-100">Register a new rescue</p>
                                </div>
                            </a>
                            <a href="#" class="flex items-center p-3 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-xl transition">
                                <div class="w-10 h-10 flex items-center justify-center bg-emerald-500 rounded-lg mr-4">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <div>
                                    <span class="font-medium">Process adoptions</span>
                                    <p class="text-xs text-teal-100">Review pending requests</p>
                                </div>
                            </a>
                            <a href="#" class="flex items-center p-3 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-xl transition">
                                <div class="w-10 h-10 flex items-center justify-center bg-green-500 rounded-lg mr-4">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <span class="font-medium">Check reports</span>
                                    <p class="text-xs text-teal-100">View nearby animal reports</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800">Upcoming Events</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 bg-teal-100 rounded-lg p-3 text-center">
                                        <span class="block text-lg font-bold text-teal-800">15</span>
                                        <span class="text-xs text-teal-600">APR</span>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-800">Adoption Day</h3>
                                        <p class="text-sm text-gray-600 mb-1">10:00 AM - 4:00 PM</p>
                                        <p class="text-sm text-gray-600">Open house for potential adopters to meet animals.</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 bg-teal-100 rounded-lg p-3 text-center">
                                        <span class="block text-lg font-bold text-teal-800">22</span>
                                        <span class="text-xs text-teal-600">APR</span>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-800">Vet Visit</h3>
                                        <p class="text-sm text-gray-600 mb-1">9:00 AM - 12:00 PM</p>
                                        <p class="text-sm text-gray-600">Regular check-ups and vaccinations for new arrivals.</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 bg-teal-100 rounded-lg p-3 text-center">
                                        <span class="block text-lg font-bold text-teal-800">28</span>
                                        <span class="text-xs text-teal-600">APR</span>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-800">Fundraising Event</h3>
                                        <p class="text-sm text-gray-600 mb-1">6:00 PM - 9:00 PM</p>
                                        <p class="text-sm text-gray-600">Community dinner to raise funds for shelter improvements.</p>
                                    </div>
                                </div>
                            </div>
                            <button class="mt-4 w-full bg-teal-100 hover:bg-teal-200 text-teal-800 py-2 px-4 rounded-lg transition">
                                <i class="far fa-calendar-plus mr-2"></i> Add new event
                            </button>
                        </div>
                    </div>

                    <!-- Recent Messages -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-lg font-bold text-gray-800">Recent Messages</h2>
                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">3 unread</span>
                        </div>

                        <div class="divide-y">
    @if (!empty($messages) && $messages->count())
        @foreach ($messages as $message)
            <div class="px-6 py-4 hover:bg-gray-50 cursor-pointer">
                <div class="flex items-start gap-3">
                    <img src="{{ asset('storage/' . $message['photo']) }}" alt="User Photo" class="w-10 h-10 rounded-full">
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="font-medium truncate">{{ $message['username'] }}</h3>
                            <span class="text-xs text-gray-500">Just now</span>
                        </div>
                        <p class="text-sm text-gray-600 truncate">{{ $message['last_message'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="px-6 py-4 text-center text-gray-400">
            No messages yet.
        </div>
    @endif
</div>


                    <!-- Shelter Stats -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800">Shelter Statistics</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm font-medium text-gray-700">Capacity</span>
                                        <span class="text-sm font-medium text-gray-700">42/50</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-teal-600 h-2.5 rounded-full" style="width: 84%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm font-medium text-gray-700">Adoption Rate</span>
                                        <span class="text-sm font-medium text-gray-700">76%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-green-600 h-2.5 rounded-full" style="width: 76%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm font-medium text-gray-700">Return Rate</span>
                                        <span class="text-sm font-medium text-gray-700">5%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-red-600 h-2.5 rounded-full" style="width: 5%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm font-medium text-gray-700">Medical Budget</span>
                                        <span class="text-sm font-medium text-gray-700">$3,250/$5,000</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-amber-500 h-2.5 rounded-full" style="width: 65%"></div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="mt-4 block text-center bg-teal-100 hover:bg-teal-200 text-teal-800 py-2 px-4 rounded-lg transition">
                                View detailed reports
                            </a>
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
                        <div class="bg-gradient-to-r from-teal-600 to-emerald-600 text-white p-2 rounded-lg">
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
                        <li><a href="#" class="hover:text-white transition">Dashboard</a></li>
                        <li><a href="#" class="hover:text-white transition">Animals</a></li>
                        <li><a href="#" class="hover:text-white transition">Adoption Requests</a></li>
                        <li><a href="#" class="hover:text-white transition">Reports</a></li>
                        <li><a href="#" class="hover:text-white transition">Messages</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact us</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-teal-500"></i>
                            shelter@rescuespot.com
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-2 text-teal-500"></i>
                            (123) 456-7890
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-teal-500"></i>
                            75 Hope Street, New York
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                    <p class="text-gray-400 text-sm mb-4">Receive our news and advice for animal shelters.</p>
                    <form>
                        <div class="flex">
                            <input type="email" placeholder="Your email" class="px-4 py-2 w-full rounded-l-lg focus:outline-none text-gray-800">
                            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-r-lg transition">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-400">
                <p>&copy; 2024 RescueSpot. All rights reserved. | <a href="#" class="text-teal-400 hover:text-white">Privacy Policy</a> | <a href="#" class="text-teal-400 hover:text-white">Terms of Use</a></p>
            </div>
        </div>
    </footer>

    <!-- Modal Overlay -->
    <div id="modal-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50"></div>

    <!-- Add Animal Modal -->
    <div id="add-animal-modal" class="modal hidden fixed inset-0 z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white">
            <h3 class="text-xl font-bold text-gray-800">Add New Animal</h3>
            <button data-close-modal class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('shelter.addAnimal') }}" enctype="multipart/form-data">
            @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Photos</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                            <div class="flex justify-center">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                            </div>
                            <p class="text-sm text-gray-500 mb-2">Drag and drop photos here, or click to select files</p>
                            <input type="file" id="photoAnimal" name="photoAnimal" class="hidden">
                            <button type="button" onclick="document.getElementById('photoAnimal').click()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                                <i class="fas fa-upload mr-2"></i>
                                Select Files
                            </button>
                        </div>
                    </div>
                    <div>
                        <label for="species" class="block text-sm font-medium text-gray-700 mb-1">Species</label>
                        <select id="species" name="species" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500">
                            <option value="">Select species</option>
                            <option value="dog">Dog</option>
                            <option value="cat">Cat</option>
                            <option value="rabbit">Rabbit</option>
                            <option value="bird">Bird</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label for="breed" class="block text-sm font-medium text-gray-700 mb-1">Breed</label>
                        <input type="text" id="breed" name="breed" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    <div>
                        <label for="age" class="block text-sm font-medium text-gray-700 mb-1">Age</label>
                        <input type="number" id="age" name="age" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500">
                            <option value="">Select status</option>
                            <option value="available">Available for Adoption</option>
                            <option value="pending">Pending Adoption</option>
                            <option value="medical">Medical Care</option>
                            <option value="quarantine">Quarantine</option>
                            <option value="foster">In Foster Care</option>
                            <option value="training">In Training</option>
                        </select>
                    </div>
 
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" data-close-modal class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white rounded-md shadow-sm text-sm font-medium focus:outline-none">
                        Add Animal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- Animal Details Modal -->
    <div id="animal-details-modal" class="modal hidden fixed inset-0 z-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white">
                <h3 class="text-xl font-bold text-gray-800">Animal Details</h3>
                <button data-close-modal class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Static content for the animal details modal -->
                    <div class="md:col-span-1">
                        <div class="bg-gray-100 rounded-lg overflow-hidden mb-4">
                            <img src="/placeholder.svg?height=300&width=400" alt="Animal" class="w-full h-auto">
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Animal Name</h2>
                                <p class="text-gray-500">ID: 12345</p>
                            </div>
                            <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">Available</span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-sm text-gray-500">Species</p>
                                <p class="font-medium">Dog</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Breed</p>
                                <p class="font-medium">Labrador Retriever</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Age</p>
                                <p class="font-medium">2 years</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Added On</p>
                                <p class="font-medium">April 10, 2024</p>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Description</h3>
                            <p class="text-gray-700">This is a friendly and energetic dog available for adoption. Great with children and other pets.</p>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Medical Information</h3>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-teal-100 text-teal-800 text-xs px-2 py-1 rounded-full">Vaccinated</span>
                                <span class="bg-teal-100 text-teal-800 text-xs px-2 py-1 rounded-full">Neutered</span>
                                <span class="bg-teal-100 text-teal-800 text-xs px-2 py-1 rounded-full">Microchipped</span>
                            </div>
                            <p class="mt-2 text-gray-700">This animal is in good health and ready for adoption.</p>
                        </div>
                        
                        <div class="flex justify-end space-x-3">
                            <button class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                                <i class="fas fa-edit mr-2"></i> Edit Details
                            </button>
                            <button class="px-4 py-2 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white rounded-md shadow-sm text-sm font-medium focus:outline-none">
                                <i class="fas fa-paw mr-2"></i> Manage Adoption Requests
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Details Modal -->
    <div id="report-details-modal" class="modal hidden fixed inset-0 z-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white">
                <h3 class="text-xl font-bold text-gray-800">Report Details</h3>
                <button data-close-modal class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="bg-gray-100 rounded-lg overflow-hidden mb-4">
                            <img src="https://images.unsplash.com/photo-1551717743-49959800b1f6?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Reported animal" class="w-full h-auto">
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <img src="https://images.unsplash.com/photo-1551717743-49959800b1f6?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=60" alt="" class="rounded cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1576201836106-db1758fd1c97?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=60" alt="" class="rounded cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=60" alt="" class="rounded cursor-pointer">
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Injured Stray Dog</h2>
                                <p class="text-gray-500">Report #R1042</p>
                            </div>
                            <span class="bg-red-100 text-red-800 text-sm px-3 py-1 rounded-full">Urgent</span>
                        </div>
                        
                        <div class="mb-6">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-user-circle text-gray-400 mr-2"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Reported by</p>
                                    <p class="font-medium">John Smith</p>
                                </div>
                            </div>
                            <div class="flex items-center mb-2">
                                <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Date reported</p>
                                    <p class="font-medium">April 14, 2024 (Today)</p>
                                </div>
                            </div>
                            <div class="flex items-center mb-2">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Location</p>
                                    <p class="font-medium">Central Park, near the south entrance</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-phone-alt text-gray-400 mr-2"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Contact</p>
                                    <p class="font-medium">(555) 123-4567</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Description</h3>
                            <p class="text-gray-700">Dog with injured paw found near Central Park. Appears to be a stray, medium-sized mixed breed with brown fur. The dog is limping badly and has a visible wound on its front right paw. It seems friendly but scared. Unable to approach closely due to the dog's fear.</p>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Status</h3>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500 mb-2">
                                <option value="pending">Pending</option>
                                <option value="in-progress">In Progress</option>
                                <option value="rescued">Rescued</option>
                                <option value="unable-to-locate">Unable to Locate</option>
                                <option value="false-report">False Report</option>
                            </select>
                            <textarea placeholder="Add notes about status update..." rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500"></textarea>
                        </div>
                        
                        <div class="flex justify-end space-x-3">
                            <button class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                                <i class="fas fa-comment-alt mr-2"></i> Contact Reporter
                            </button>
                            <button class="px-4 py-2 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white rounded-md shadow-sm text-sm font-medium focus:outline-none">
                                <i class="fas fa-ambulance mr-2"></i> Dispatch Rescue Team
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Adoption Details Modal -->
    <div id="adoption-details-modal" class="modal hidden fixed inset-0 z-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white">
                <h3 class="text-xl font-bold text-gray-800">Adoption Request Details</h3>
                <button data-close-modal class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <div class="p-4 border-b border-gray-200">
                                <h3 class="font-semibold text-gray-800">Applicant Information</h3>
                            </div>
                            <div class="p-4">
                                <div class="flex items-center mb-4">
                                    <img class="h-16 w-16 rounded-full mr-4" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                    <div>
                                        <h4 class="font-medium text-gray-900">Sarah Johnson</h4>
                                        <p class="text-gray-500 text-sm">sarah.j@example.com</p>
                                        <p class="text-gray-500 text-sm">(555) 987-6543</p>
                                    </div>
                                </div>
                                <div class="space-y-2 text-sm">
                                    <div>
                                        <span class="text-gray-500">Address:</span>
                                        <p class="text-gray-800">123 Main Street, Apt 4B<br>New York, NY 10001</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Occupation:</span>
                                        <p class="text-gray-800">Marketing Manager</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Living Situation:</span>
                                        <p class="text-gray-800">Apartment with small yard</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Other Pets:</span>
                                        <p class="text-gray-800">1 cat (5 years old)</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Children:</span>
                                        <p class="text-gray-800">None</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden mb-6">
                            <div class="p-4 border-b border-gray-200">
                                <h3 class="font-semibold text-gray-800">Application Details</h3>
                            </div>
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <img class="h-12 w-12 rounded-full object-cover mr-3" src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="">
                                        <div>
                                            <h4 class="font-medium text-gray-900">Max (A001)</h4>
                                            <p class="text-gray-500 text-sm">Labrador Retriever, 2 years</p>
                                        </div>
                                    </div>
                                    <span class="bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded-full">Review Pending</span>
                                </div>
                                
                                <div class="space-y-4 mb-4">
                                    <div>
                                        <h4 class="font-medium text-gray-800 mb-1">Why do you want to adopt this animal?</h4>
                                        <p class="text-gray-700 text-sm">I've always loved Labradors and have been looking for a companion for my daily runs and hikes. Max seems like the perfect fit for my active lifestyle, and I have plenty of time to dedicate to his care and training.</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800 mb-1">Experience with pets</h4>
                                        <p class="text-gray-700 text-sm">I grew up with dogs and currently have a 5-year-old cat. I've volunteered at animal shelters for the past 3 years and have experience with training and caring for various breeds.</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800 mb-1">Daily schedule and care plan</h4>
                                        <p class="text-gray-700 text-sm">I work from home most days, so Max would rarely be alone. I plan to take him for morning and evening walks, plus weekend hikes. I've already researched local vets and dog parks in my area.</p>
                                    </div>
                                </div>
                                
                                <div class="border-t border-gray-200 pt-4">
                                    <h4 class="font-medium text-gray-800 mb-2">References</h4>
                                    <div class="space-y-2 text-sm">
                                        <div>
                                            <p class="text-gray-800 font-medium">Dr. Emily Chen (Veterinarian)</p>
                                            <p class="text-gray-600">(555) 123-4567 • cityvet@example.com</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-800 font-medium">Mark Wilson (Landlord)</p>
                                            <p class="text-gray-600">(555) 987-1234 • mark.w@example.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <div class="p-4 border-b border-gray-200">
                                <h3 class="font-semibold text-gray-800">Application Status</h3>
                            </div>
                            <div class="p-4">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Update Status</label>
                                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500">
                                        <option value="review-pending">Review Pending</option>
                                        <option value="interview-scheduled">Interview Scheduled</option>
                                        <option value="home-check">Home Check</option>
                                        <option value="approved">Approved</option>
                                        <option value="declined">Declined</option>
                                    </select>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                                    <textarea rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500" placeholder="Add internal notes about this application..."></textarea>
                                </div>
                                
                                <div class="flex justify-between">
                                    <div class="flex space-x-2">
                                        <button class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                                            <i class="fas fa-comment-alt mr-2"></i> Message Applicant
                                        </button>
                                        <button class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                                            <i class="fas fa-calendar-alt mr-2"></i> Schedule Interview
                                        </button>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md shadow-sm text-sm font-medium focus:outline-none">
                                            Decline
                                        </button>
                                        <button class="px-4 py-2 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white rounded-md shadow-sm text-sm font-medium focus:outline-none">
                                            Approve
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>