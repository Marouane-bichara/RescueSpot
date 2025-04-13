<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RescueSpot - Home</title>
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
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-2 rounded-lg">
                            <i class="fas fa-paw text-xl"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-800">RescueSpot</span>
                    </a>
                </div>

                <!-- Main Navigation - Desktop -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="HomeUser" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600">Home</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Adoption</a>
                    <a href="{{ route('user.UserReports.index') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Reports</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Messages</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Contact</a>
                </div>

                <!-- Right Side Menu -->
                <div class="flex items-center space-x-4">
                    <button class="hidden md:block bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white py-2 px-4 rounded-lg shadow-md transition transform hover:scale-105">
                        <a href="{{ route('user.UserReports.index') }}" class="text-white text-sm font-medium">Report an animal</a>
                    </button>
                    
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
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-blue-500" src="/api/placeholder/40/40" alt="Profile">
                            </button>
                        </div>
                        <div id="profile-dropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <a href="Profile" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                <i class="far fa-user mr-3 text-gray-500"></i> My profile
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                <i class="fas fa-cog mr-3 text-gray-500"></i> Settings
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                <i class="fas fa-heart mr-3 text-gray-500"></i> My favorites
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                <i class="fas fa-history mr-3 text-gray-500"></i> History
                            </a>
                            <div class="border-t border-gray-100"></div>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-red-700 hover:bg-gray-100" role="menuitem">
                                <i class="fas fa-sign-out-alt mr-3 text-red-500"></i> Log out
                            </a>
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
                <a href="HomeUser" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600">Home</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Adoption</a>
                <a href="{{ route('user.UserReports.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Reports</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Messages</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Contact</a>
                <button class="mt-2 w-full flex justify-center items-center bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white py-2 px-4 rounded-lg shadow-md">
                <a></a>    
                <a href="{{ route('user.UserReports.index') }}" class="text-white text-sm font-medium">Report an animal</a>                    
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20 pb-12">
        <!-- Hero Section -->
        <div class="relative bg-white overflow-hidden mb-8">
            <div class="max-w-7xl mx-auto">
<!-- Truly Full-width Hero Section with No Side Margins -->
<style>
  .full-bleed {
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
  }
</style>

<div class="full-bleed relative overflow-hidden bg-gradient-to-br from-indigo-900 to-blue-900 border-0">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <!-- Use your own image here instead of the placeholder -->
        <img src="/api/placeholder/1920/1080" alt="" class="w-full h-full object-cover opacity-40">
        <!-- Strong overlay to hide any watermarks completely -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-indigo-800/90 to-blue-800/90"></div>
        <!-- Subtle pattern overlay for texture -->
        <div class="absolute inset-0 mix-blend-soft-light opacity-30" style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M0 0h20v20H0V0zm10 17c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7z\' fill=\'%23ffffff\' fill-opacity=\'0.05\'/%3E%3C/svg%3E');"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10">
        <div class="pt-16 pb-20 md:pt-24 md:pb-28 lg:pt-32 lg:pb-36 px-6 sm:px-12 md:px-16 lg:px-20 xl:px-24">
            <div class="max-w-screen-2xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Column - Text Content -->
                <div class="text-center lg:text-left">
                    <div class="inline-block mb-6 p-2 bg-blue-600 bg-opacity-30 rounded-lg backdrop-blur-sm">
                        <div class="flex items-center space-x-2 px-3 py-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-md">
                            <i class="fas fa-paw text-white"></i>
                            <span class="text-white font-medium">Change their lives</span>
                        </div>
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                        <span class="block">A platform dedicated to</span>
                        <span class="block mt-2 text-transparent bg-clip-text bg-gradient-to-r from-blue-300 via-indigo-300 to-purple-200"> </span>
                    </h1>
                    
                    <p class="mt-6 text-lg md:text-xl text-blue-100 max-w-2xl mx-auto lg:mx-0">
                        Together, let's give abandoned animals a second chance. Report an animal in distress or find your future companion among our protected ones.
                    </p>
                    
                    <div class="mt-8 flex flex-col sm:flex-row justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-xl text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-lg hover:shadow-xl transform transition duration-300 hover:-translate-y-1">
                            <i class="fas fa-search mr-2"></i>
                            Find an animal
                        </a>
                        <a href="{{ route('user.UserReports.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-xl text-base font-medium text-indigo-100 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-indigo-200/30 shadow-lg hover:shadow-xl transition duration-300 hover:-translate-y-1">
                            <i class="fas fa-plus mr-2"></i>
                            Report
                        </a>
                    </div>
                    
                    <!-- Trust Indicators -->
                    <div class="mt-8 pt-6 border-t border-blue-800/30 grid grid-cols-3 gap-4">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-white">250+</p>
                            <p class="text-blue-200 text-sm">Animals Saved</p>
                        </div>
                        <div class="text-center">
                            <p class="text-3xl font-bold text-white">40+</p>
                            <p class="text-blue-200 text-sm">Partner Shelters</p>
                        </div>
                        <div class="text-center">
                            <p class="text-3xl font-bold text-white">1.2k+</p>
                            <p class="text-blue-200 text-sm">Active Members</p>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - Image Card Stack -->
                <div class="relative">
                    <!-- Decorative elements -->
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-gradient-to-br from-purple-500 to-indigo-500 opacity-20 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-5 -left-5 w-28 h-28 bg-gradient-to-br from-blue-400 to-cyan-300 opacity-20 rounded-full blur-2xl"></div>
                    
                    <!-- 3D Card Stack Effect -->
                    <div class="relative mx-auto max-w-lg lg:max-w-none">
                        <!-- Background Card -->
                        <div class="absolute top-8 -left-6 -right-6 bottom-0 bg-gradient-to-br from-indigo-500/20 to-blue-600/20 rounded-xl backdrop-blur-sm shadow-xl rotate-6 border border-white/10"></div>
                        
                        <!-- Middle Card -->
                        <div class="absolute top-4 -left-3 -right-3 bottom-4 bg-gradient-to-br from-indigo-500/30 to-blue-600/30 rounded-xl backdrop-blur-sm shadow-xl -rotate-3 border border-white/20"></div>
                        
                        <!-- Main Card with Image -->
                        <div class="relative bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm p-3 rounded-xl shadow-2xl transform transition-transform hover:scale-[1.02] duration-500">
                            <img src="{{ asset('images/catimage.jpg') }}" class="w-full h-auto rounded-lg" alt="Happy rescued dog with owner">
                            
                            <!-- Floating Info Badge -->
                            <div class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 bg-white dark:bg-gray-800 px-4 py-2 rounded-lg shadow-lg flex items-center space-x-2">
                                <i class="fas fa-heart text-red-500"></i>
                                <span class="font-medium text-white">120 adoptions this month</span>
                                </div>
                            
                            <!-- Success Stories Badge -->
                            <div class="absolute -top-3 -right-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                                Success stories
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Paw Icons -->
                    <div class="absolute top-10 -left-4 bg-blue-600 p-2 rounded-full shadow-lg animate-bounce">
                        <i class="fas fa-paw text-white"></i>
                    </div>
                    <div class="absolute bottom-20 -right-2 bg-indigo-600 p-2 rounded-full shadow-lg animate-bounce" style="animation-delay: 0.5s">
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
            <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="/api/placeholder/800/600" alt="Animal rescue">
            </div>
        </div>

        <div class="container mx-auto px-4">
            <!-- Stats Section -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                        <div class="p-6 border-b md:border-r md:border-b-0 lg:border-r border-gray-200 text-center">
                            <span class="text-blue-600 text-4xl font-bold block">254</span>
                            <p class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wider">Animals saved</p>
                            <div class="mt-1">
                                <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                                <span class="text-green-500 text-sm">+12% this month</span>
                            </div>
                        </div>
                        <div class="p-6 border-b lg:border-r lg:border-b-0 border-gray-200 text-center">
                            <span class="text-indigo-600 text-4xl font-bold block">183</span>
                            <p class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wider">Successful adoptions</p>
                            <div class="mt-1">
                                <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                                <span class="text-green-500 text-sm">+8% this month</span>
                            </div>
                        </div>
                        <div class="p-6 border-b md:border-r md:border-b-0 border-gray-200 text-center">
                            <span class="text-yellow-600 text-4xl font-bold block">42</span>
                            <p class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wider">Partner shelters</p>
                            <div class="mt-1">
                                <i class="fas fa-plus text-green-500 mr-1"></i>
                                <span class="text-green-500 text-sm">3 new</span>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <span class="text-purple-600 text-4xl font-bold block">1208</span>
                            <p class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wider">Active members</p>
                            <div class="mt-1">
                                <i class="fas fa-user-plus text-green-500 mr-1"></i>
                                <span class="text-green-500 text-sm">+24 today</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Grid -->
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left Column - Main Content -->
                <div class="w-full lg:w-3/4 space-y-8">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-lg font-bold text-gray-800">Recently reported animals</h2>
        <div class="flex space-x-2">
            <button class="py-1 px-3 text-sm rounded-md bg-blue-100 text-blue-700 hover:bg-blue-200">All</button>
        </div>
    </div>
    
    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse ($reports as $report)
            {{-- Animal Card --}}
            <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 transition transform hover:shadow-md hover:-translate-y-1">
                <div class="relative">
                    <img src="{{ asset('storage/' . $report->photo) }}" alt="Reported animal" class="w-full h-48 object-cover">
                    @if($report->status == 'urgent')
                        <div class="absolute top-3 left-3 bg-red-500 text-white text-xs px-2 py-1 rounded-full">Urgent</div>
                    @endif
                    <div class="absolute top-3 right-3 bg-blue-500 text-white text-xs px-2 py-1 rounded-full">{{ \Carbon\Carbon::parse($report->reportDate)->diffForHumans() }}</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-semibold text-gray-800">Reported Animal</h3>
                        <span class="bg-{{ $report->status == 'pending' ? 'yellow' : ($report->status == 'processed' ? 'green' : 'blue') }}-100 
                              text-{{ $report->status == 'pending' ? 'yellow' : ($report->status == 'processed' ? 'green' : 'blue') }}-800 
                              text-xs px-2 py-1 rounded-full">
                            {{ ucfirst($report->status) }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">{{ Str::limit($report->description, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm"><i class="fas fa-map-marker-alt text-gray-500 mr-1"></i> {{ $report->location }}</span>
                        <a href="" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full p-6 text-center">
                <div class="inline-flex items-center justify-center bg-gray-100 rounded-full p-6 mb-4">
                    <i class="fas fa-paw text-gray-400 text-4xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-800 mb-2">No reported animals yet</h3>
                <p class="text-gray-600 mb-4">There are currently no reported animals in the system.</p>
                <a href="" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-plus mr-2"></i>
                    Report an animal
                </a>
            </div>
        @endforelse
    </div>
    
    <div class="px-6 py-4 border-t border-gray-200 text-center">
        <a href="" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
            View all reports
            <i class="fas fa-chevron-right ml-2 text-xs"></i>
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-lg font-bold text-gray-800">Available for adoption</h2>
        <div class="flex items-center">
            <button class="p-1 rounded text-gray-700 hover:bg-gray-100 mr-2">
                <i class="fas fa-filter"></i>
            </button>
            <a href="" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View all</a>
        </div>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($readyAnimals as $animal)
                {{-- Adoption Card --}}
                <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 group transition transform hover:shadow-md hover:-translate-y-1">
                    <div class="relative">
                        <!-- <img src="{{ asset('storage/' . $animal->photoAnimal) }}" alt="Animal for adoption" class="w-full h-48 object-cover"> -->
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
                                {{ $animal->shelters ? $animal->shelters->location ?? 'Unknown' : 'Unknown' }}
                            </span>
                            <a href="" class="bg-blue-600 hover:bg-blue-700 text-white py-1.5 px-3 rounded-lg text-sm transition-colors">
                                View profile
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full p-6 text-center">
                    <div class="inline-flex items-center justify-center bg-gray-100 rounded-full p-6 mb-4">
                        <i class="fas fa-home text-gray-400 text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">No animals available for adoption</h3>
                    <p class="text-gray-600 mb-4">Check back soon for more animals needing forever homes.</p>
                    <a href="" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-bell mr-2"></i>
                        Get notified
                    </a>
                </div>
            @endforelse
        </div>
    </div>
    
    <div class="px-6 py-4 border-t border-gray-200 text-center">
    </div>
</div>
                </div>

                <!-- Right Column - Sidebar -->
                <div class="w-full lg:w-1/4 space-y-8">
                    <!-- Action Buttons -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-xl p-6 text-white">
                        <h2 class="text-xl font-bold mb-4">Quick actions</h2>
                        <div class="space-y-3">
                            <a href="#" class="flex items-center p-3 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-xl transition">
                                <div class="w-10 h-10 flex items-center justify-center bg-yellow-500 rounded-lg mr-4">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <div>
                                    <span class="font-medium">Report an animal</span>
                                    <p class="text-xs text-blue-100">Help an animal in distress</p>
                                </div>
                            </a>
                            <a href="#" class="flex items-center p-3 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-xl transition">
                                <div class="w-10 h-10 flex items-center justify-center bg-green-500 rounded-lg mr-4">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div>
                                    <span class="font-medium">Adopt an animal</span>
                                    <p class="text-xs text-blue-100">Find your companion</p>
                                </div>
                            </a>
                            <a href="#" class="flex items-center p-3 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-xl transition">
                                <div class="w-10 h-10 flex items-center justify-center bg-purple-500 rounded-lg mr-4">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                                <div>
                                    <span class="font-medium">Make a donation</span>
                                    <p class="text-xs text-blue-100">Support our actions</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Your Activity -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-bold text-gray-800">Your activity</h2>
    </div>
    <div class="p-6">
        <div class="mb-6">
            <h3 class="font-medium text-gray-800 mb-3 flex items-center">
                <i class="fas fa-bell text-blue-500 mr-2"></i> Your reports
            </h3>

            @if ($reportsUser->isEmpty())
                <div class="bg-gray-100 rounded-lg p-4 mb-4 text-sm text-gray-600">
                    You have not submitted any reports yet.
                </div>
            @else
                @foreach ($reportsUser as $report)
                    <div class="bg-blue-50 rounded-lg p-4 mb-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h4 class="font-medium">
                                    {{ $report->description }}
                                </h4>
                                <p class="text-sm text-gray-600">
                                    Reported {{ \Carbon\Carbon::parse($report->reportDate)->diffForHumans() }}
                                </p>
                            </div>
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                {{ ucfirst($report->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-700 mb-2">
                            Location: {{ $report->location }}
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View details</a>
                    </div>
                @endforeach

                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                    <span>View all your reports</span>
                    <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
            @endif
        </div>

        <!-- Your adoption requests section can stay below -->
    </div>
</div>


                    <!-- Recent Messages -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-lg font-bold text-gray-800">Recent messages</h2>
        @php $unreadCount = 0; @endphp
        @foreach($conversations as $conv)
            @php
                // Assume you later extend this with 'is_read' to handle real unread logic
                // For now, let's simulate all messages as read
            @endphp
        @endforeach
        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadCount }} unread</span>
    </div>

    <div class="divide-y">
        @forelse($conversations as $conversation)
            <div class="px-6 py-4 hover:bg-gray-50 cursor-pointer">
                <div class="flex items-start gap-3">
                    <img src="{{ asset('storage/photos/' . $conversation['photo']) }}" alt="User Photo" class="w-10 h-10 rounded-full">
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="font-medium truncate">User #{{ $conversation['user_id'] }}</h3>
                            <span class="text-xs text-gray-500">Now</span> {{-- You can add timestamps later --}}
                        </div>
                        <p class="text-sm text-gray-600 truncate">{{ $conversation['last_message'] }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="px-6 py-4 text-center text-gray-500">
                There are no messages yet.
            </div>
        @endforelse
    </div>

    <div class="px-6 py-4 border-t border-gray-200 text-center">
        <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
            View all messages
            <i class="fas fa-chevron-right ml-2 text-xs"></i>
        </a>
    </div>
</div>


                    <!-- Mission & Info -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800">Our mission</h2>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-700 mb-4">RescueSpot connects citizens with dedicated shelters to rescue and offer a second chance to our four-legged friends.</p>
                            <div class="flex justify-center gap-4 mb-6">
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-hand-holding-heart text-xl"></i>
                                    </div>
                                    <span class="text-sm">Report</span>
                                </div>
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-ambulance text-xl"></i>
                                    </div>
                                    <span class="text-sm">Rescue</span>
                                </div>
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-home text-xl"></i>
                                    </div>
                                    <span class="text-sm">Adopt</span>
                                </div>
                            </div>
                            <a href="#" class="block text-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-2 px-4 rounded-lg transition transform hover:scale-105">Learn more</a>
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