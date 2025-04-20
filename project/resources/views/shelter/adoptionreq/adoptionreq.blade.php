<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RescueSpot - Adoption Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        secondary: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        },
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .profile-gradient {
            background: linear-gradient(135deg, #0ea5e9 0%, #14b8a6 100%);
        }
        
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        .tab-indicator {
            transition: all 0.3s ease;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .animate-float-delay-1 {
            animation: float 3s ease-in-out infinite;
            animation-delay: 0.5s;
        }
        
        .animate-float-delay-2 {
            animation: float 3s ease-in-out infinite;
            animation-delay: 1s;
        }

        .modal {
            transition: opacity 0.3s ease;
        }

        .modal-content {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .modal.hidden .modal-content {
            transform: scale(0.95);
            opacity: 0;
        }

        .modal.flex .modal-content {
            transform: scale(1);
            opacity: 1;
        }
        
        /* Custom scrollbar styles */
        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }
        
        .scrollbar-thin::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }
        
        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
        
        /* For Firefox */
        .scrollbar-thin {
            scrollbar-width: thin;
            scrollbar-color: #d1d5db #f1f1f1;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Toast Notification -->
    <div id="toast" class="hidden fixed top-5 right-5 z-50 items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-xl shadow-lg border border-gray-100" role="alert">
        <div class="inline-flex flex-shrink-0 justify-center items-center w-10 h-10 text-secondary-500 bg-secondary-100 rounded-full">
            <i class="fas fa-check"></i>
        </div>
        <div id="toast-message" class="ml-3 text-sm font-medium">Request status updated successfully!</div>
        <button id="close-toast" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 items-center justify-center">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- View Request Details Modal -->
    <div id="view-request-modal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 justify-center items-center">
        <div id="view-modal-overlay" class="absolute inset-0"></div>
        <div class="modal-content relative bg-white rounded-2xl shadow-xl max-w-4xl w-full mx-4 my-8">
            <div class="sticky top-0 z-10 bg-white px-6 py-4 border-b border-gray-200 rounded-t-2xl flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <span class="profile-gradient w-8 h-8 rounded-full flex items-center justify-center mr-3 text-white shadow-md">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    Adoption Request Details
                </h2>
                <button data-close-view-modal class="text-gray-400 hover:text-gray-600 focus:outline-none">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="p-6 overflow-y-auto max-h-[70vh]" id="request-details-container">
                <!-- Request details will be inserted here by JavaScript -->
            </div>
            
            <div class="sticky bottom-0 z-10 bg-white px-6 py-4 border-t border-gray-200 rounded-b-2xl flex justify-end space-x-3">
                <button data-close-view-modal class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg shadow-sm transition duration-150">
                    Close
                </button>
                <div id="view-modal-actions" class="flex space-x-2">
                    <!-- Action buttons will be inserted here by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Top Navigation -->
    <nav class="bg-white shadow-md fixed w-full z-40">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="#" class="flex items-center space-x-2">
                        <div class="profile-gradient text-white p-2 rounded-lg">
                            <i class="fas fa-paw text-xl"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-800">RescueSpot</span>
                        <span class="bg-teal-100 text-teal-800 text-xs px-2 py-1 rounded-full">Shelter Portal</span>
                    </a>
                </div>

                <!-- Main Navigation - Desktop -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Dashboard</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Animals</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-secondary-600">Adoption Requests</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Reports</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Messages</a>
                </div>

                <!-- Right Side Menu -->
                <div class="flex items-center space-x-4">
                    <button class="hidden md:block bg-gradient-to-r from-secondary-500 to-primary-500 hover:from-secondary-600 hover:to-primary-600 text-white py-2 px-4 rounded-lg shadow-md transition transform hover:scale-105 hover:shadow-lg">
                        <span class="text-white text-sm font-medium">Add Animal</span>
                    </button>
                    
                    <!-- Notifications -->
                    <button class="relative p-1 rounded-full text-gray-600 hover:text-primary-600 hover:bg-primary-50 focus:outline-none transition duration-150">
                        <i class="far fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs w-4 h-4 flex items-center justify-center rounded-full">7</span>
                    </button>
                    
                    <!-- Messages -->
                    <button class="relative p-1 rounded-full text-gray-600 hover:text-primary-600 hover:bg-primary-50 focus:outline-none transition duration-150">
                        <i class="far fa-envelope text-xl"></i>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs w-4 h-4 flex items-center justify-center rounded-full">3</span>
                    </button>
                    
                    <!-- Profile Dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <button type="button" id="profile-btn" class="flex text-sm bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150" aria-expanded="false" aria-haspopup="true">
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-primary-500" 
                                src="{{ $user->profilePhoto ? asset('storage/'.$user->profilePhoto) : 'https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80' }}" 
                                alt="Shelter Profile">
                            </button>
                        </div>
                        <div id="profile-dropdown"
                            class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 overflow-hidden"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">

                            <a href="#"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 transition-colors duration-150"
                            role="menuitem">
                                <i class="far fa-user text-primary-500"></i> Shelter Profile
                            </a>

                            <a href="#"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 transition-colors duration-150"
                            role="menuitem">
                                <i class="fas fa-cog text-primary-500"></i> Settings
                            </a>

                            <a href="#"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 transition-colors duration-150"
                            role="menuitem">
                                <i class="fas fa-chart-line text-primary-500"></i> Statistics
                            </a>

                            <a href="#"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 transition-colors duration-150"
                            role="menuitem">
                                <i class="fas fa-users text-primary-500"></i> Staff
                            </a>

                            <div class="border-t border-gray-100 my-1"></div>

                            <form method="POST" action="{{ route('shelter.logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150"
                                        role="menuitem">
                                    <i class="fas fa-sign-out-alt text-red-500"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Mobile menu button -->
                    <button type="button" id="mobile-menu-btn" class="md:hidden bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150" aria-controls="mobile-menu" aria-expanded="false">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white shadow-md">
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Dashboard</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Animals</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-primary-600 to-secondary-600">Adoption Requests</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Reports</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Messages</a>
                <button class="mt-2 w-full flex justify-center items-center bg-gradient-to-r from-secondary-500 to-primary-500 hover:from-secondary-600 hover:to-primary-600 text-white py-2 px-4 rounded-lg shadow-md transition duration-150">
                    <span class="text-white text-sm font-medium">Add Animal</span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20 pb-12">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <!-- Page Header -->
                <div class="flex flex-col md:flex-row justify-between items-start mb-8">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold text-gray-800 mb-1">Adoption Requests</h1>
                        <p class="text-gray-600 flex items-center">
                            <i class="fas fa-clipboard-list text-primary-500 mr-2"></i>
                            Manage and respond to adoption applications
                        </p>
                    </div>
                    
                    <div class="flex space-x-3">
                        <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 py-2.5 px-5 rounded-lg shadow-sm flex items-center transition duration-150">
                            <i class="fas fa-filter mr-2"></i>
                            Filters
                        </button>
                        <button class="bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white py-2.5 px-5 rounded-lg shadow-md flex items-center transition duration-150 hover:shadow-lg">
                            <i class="fas fa-download mr-2"></i>
                            Export
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-500 text-white rounded-lg mr-4 shadow-md">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <p class="text-sm text-blue-600 font-medium">Pending</p>
                                <p class="text-2xl font-bold text-gray-800">
                                    {{ $stats['pending'] ?? '0' }}
                                </p>
                                <p class="text-xs text-gray-500">Awaiting review</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border border-green-200 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-500 text-white rounded-lg mr-4 shadow-md">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <p class="text-sm text-green-600 font-medium">Approved</p>
                                <p class="text-2xl font-bold text-gray-800">
                                    {{ $stats['approved'] ?? '0' }}
                                </p>
                                <p class="text-xs text-gray-500">Ready for adoption</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl border border-red-200 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="p-3 bg-red-500 text-white rounded-lg mr-4 shadow-md">
                                <i class="fas fa-times"></i>
                            </div>
                            <div>
                                <p class="text-sm text-red-600 font-medium">Rejected</p>
                                <p class="text-2xl font-bold text-gray-800">
                                    {{ $stats['rejected'] ?? '0' }}
                                </p>
                                <p class="text-xs text-gray-500">Not approved</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-6 rounded-xl border border-amber-200 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="p-3 bg-amber-500 text-white rounded-lg mr-4 shadow-md">
                                <i class="fas fa-home"></i>
                            </div>
                            <div>
                                <p class="text-sm text-amber-600 font-medium">Home Checks</p>
                                <p class="text-2xl font-bold text-gray-800">
                                    {{ $stats['home_check'] ?? '0' }}
                                </p>
                                <p class="text-xs text-gray-500">Scheduled visits</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search and Filter Bar -->
                <div class="bg-white p-4 rounded-xl shadow-sm mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="relative w-full md:w-96">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" id="search-input" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150" placeholder="Search by applicant, animal, or status...">
                    </div>
                    
                    <div class="flex flex-wrap gap-2 w-full md:w-auto">
                        <select id="status-filter" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                            <option value="all">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="interview">Interview</option>
                            <option value="home_check">Home Check</option>
                        </select>
                        
                        <select id="date-filter" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                            <option value="all">All Dates</option>
                            <option value="today">Today</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                        </select>
                        
                        <button id="reset-filters" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition duration-150">
                            <i class="fas fa-redo-alt mr-1"></i> Reset
                        </button>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="bg-white rounded-t-xl shadow-sm mb-0 border border-gray-200 border-b-0">
                    <div class="flex overflow-x-auto scrollbar-hide">
                        <button data-tab="all" class="tab-btn active-tab text-primary-600 border-b-2 border-primary-600 px-6 py-4 font-medium focus:outline-none">
                            All Requests
                        </button>
                        <button data-tab="pending" class="tab-btn text-gray-500 border-b-2 border-transparent hover:text-primary-500 hover:border-primary-300 px-6 py-4 font-medium focus:outline-none">
                            Pending
                            <span class="ml-2 bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full">{{ $stats['pending'] ?? '0' }}</span>
                        </button>
                        <button data-tab="approved" class="tab-btn text-gray-500 border-b-2 border-transparent hover:text-primary-500 hover:border-primary-300 px-6 py-4 font-medium focus:outline-none">
                            Approved
                            <span class="ml-2 bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">{{ $stats['approved'] ?? '0' }}</span>
                        </button>
                        <button data-tab="rejected" class="tab-btn text-gray-500 border-b-2 border-transparent hover:text-primary-500 hover:border-primary-300 px-6 py-4 font-medium focus:outline-none">
                            Rejected
                            <span class="ml-2 bg-red-100 text-red-800 text-xs px-2 py-0.5 rounded-full">{{ $stats['rejected'] ?? '0' }}</span>
                        </button>
                        <button data-tab="interview" class="tab-btn text-gray-500 border-b-2 border-transparent hover:text-primary-500 hover:border-primary-300 px-6 py-4 font-medium focus:outline-none">
                            Interview
                            <span class="ml-2 bg-purple-100 text-purple-800 text-xs px-2 py-0.5 rounded-full">{{ $stats['interview'] ?? '0' }}</span>
                        </button>
                        <button data-tab="home_check" class="tab-btn text-gray-500 border-b-2 border-transparent hover:text-primary-500 hover:border-primary-300 px-6 py-4 font-medium focus:outline-none">
                            Home Check
                            <span class="ml-2 bg-amber-100 text-amber-800 text-xs px-2 py-0.5 rounded-full">{{ $stats['home_check'] ?? '0' }}</span>
                        </button>
                    </div>
                </div>

                <!-- Adoption Requests Table -->
                <div class="bg-white rounded-b-xl shadow-md overflow-hidden border border-gray-200 border-t-0">
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
                                    <tr class="hover:bg-gray-50 transition duration-150" data-request-id="{{ $request->id }}" data-request-status="{{ $request->status }}">
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
                                                    'home_check' => 'bg-amber-100 text-amber-800',
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
                                                <button type="button" class="view-request-btn text-primary-600 hover:text-primary-900" data-request-id="{{ $request->id }}">
                                                    <i class="fas fa-eye"></i> View
                                                </button>

                                                @if($request->status == 'pending')
                                                    <form action="" method="POST" class="inline">
                                                        @csrf
                                                        <input type="hidden" name="request_id" value="{{ $request->id }}">
                                                        <button type="submit" class="text-green-600 hover:text-green-900">
                                                            <i class="fas fa-check"></i> Approve
                                                        </button>
                                                    </form>

                                                    <form action="" method="POST" class="inline ml-2">
                                                        @csrf
                                                        <input type="hidden" name="request_id" value="{{ $request->id }}">
                                                        <input type="hidden" name="rejection_reason" value="Application rejected">
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            <i class="fas fa-times"></i> Reject
                                                        </button>
                                                    </form>
                                                @endif

                                                @if($request->status == 'approved')
                                                    <button type="button" class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-calendar"></i> Schedule
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="text-gray-400 mb-4">
                                                    <i class="fas fa-clipboard-list text-5xl"></i>
                                                </div>
                                                <h3 class="text-lg font-semibold text-gray-700 mb-1">No adoption requests found</h3>
                                                <p class="text-gray-500 mb-4">There are currently no adoption requests to display.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if(isset($adoptionRequests) && $adoptionRequests->hasPages())
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                            {{ $adoptionRequests->links() }}
                        </div>
                    @endif
                </div>

                <!-- Card View (Alternative) -->
                <div class="mt-8 mb-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Adoption Requests</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($recentRequests ?? [] as $request)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition duration-200">
                                <div class="p-4 border-b border-gray-100">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center">
                                            <img class="h-12 w-12 rounded-full object-cover" src="{{ asset('storage/' . $request->adopter->profilePhoto) }}" alt="Adopter Photo">
                                            <div class="ml-3">
                                                <h3 class="text-base font-semibold text-gray-800">{{ $request->adopter->name }}</h3>
                                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($request->requestDate)->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($request->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($request->status == 'approved') bg-green-100 text-green-800
                                            @elseif($request->status == 'rejected') bg-red-100 text-red-800
                                            @elseif($request->status == 'interview') bg-blue-100 text-blue-800
                                            @elseif($request->status == 'home_check') bg-amber-100 text-amber-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucwords(str_replace('_', ' ', $request->status)) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="p-4">
                                    <div class="flex mb-4">
                                        <div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-100 mr-4">
                                            <img src="{{ asset('storage/' . $request->animal->photoAnimal) }}" alt="{{ $request->animal->name }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-800">{{ $request->animal->name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $request->animal->race }}, {{ $request->animal->age }} years</p>
                                            <p class="text-sm text-gray-500 mt-1">ID: {{ $request->animal->code }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="text-sm text-gray-600 mb-4 line-clamp-2">
                                        {{ $request->message ?? 'No additional message provided.' }}
                                    </div>
                                    
                                    <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                                        <button type="button" class="view-request-btn text-primary-600 hover:text-primary-900 text-sm font-medium" data-request-id="{{ $request->id }}">
                                            View Details
                                        </button>
                                        
                                        <div class="flex space-x-2">
                                            @if($request->status == 'pending')
                                                <form action="" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="request_id" value="{{ $request->id }}">
                                                    <button type="submit" class="text-green-600 hover:text-green-900 text-sm font-medium">
                                                        Approve
                                                    </button>
                                                </form>

                                                <form action="{{ route('shelter.rejectAdoptionRequest', ['id' => $request->id]) }}" method="POST" class="inline ml-2">
                                                    @csrf
                                        
                                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                                        Reject
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                                <div class="flex flex-col items-center justify-center text-center">
                                    <div class="text-gray-400 mb-4">
                                        <i class="fas fa-clipboard-list text-5xl"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-700 mb-1">No recent adoption requests</h3>
                                    <p class="text-gray-500 mb-4">There are no recent adoption requests to display.</p>
                                    <p class="text-sm text-gray-500">New requests will appear here as they are submitted.</p>
                                </div>
                            </div>
                        @endforelse
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
                        <div class="profile-gradient text-white p-2 rounded-lg">
                            <i class="fas fa-paw text-xl"></i>
                        </div>
                        <span class="text-xl font-bold">RescueSpot</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">Platform dedicated to rescuing and adopting abandoned animals.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-150 transform hover:scale-110">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-150 transform hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-150 transform hover:scale-110">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-150 transform hover:scale-110">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick links</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition duration-150">Dashboard</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">Animals</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">Adoption Requests</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">Reports</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">Messages</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact us</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-primary-500"></i>
                            {{ $user->email }}
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-2 text-primary-500"></i>
                            {{ $user->phone ?? '(123) 456-7890' }}
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-primary-500"></i>
                            {{ $user->address ?? '123 Rescue Lane' }}, {{ $user->city ?? 'Animal City' }}
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                    <p class="text-gray-400 text-sm mb-4">Receive our news and advice for animal shelters.</p>
                    <form>
                        <div class="flex">
                            <input type="email" placeholder="Your email" class="px-4 py-2 w-full rounded-l-lg focus:outline-none text-gray-800">
                            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-r-lg transition duration-150">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} RescueSpot. All rights reserved. | <a href="#" class="text-primary-400 hover:text-white transition duration-150">Privacy Policy</a> | <a href="#" class="text-primary-400 hover:text-white transition duration-150">Terms of Use</a></p>
            </div>
        </div>
    </footer>

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

            // Toast functionality
            function showToast(message) {
                const toast = document.getElementById('toast');
                const toastMessage = document.getElementById('toast-message');
                
                toastMessage.textContent = message;
                toast.classList.remove('hidden');
                toast.classList.add('flex');
                
                setTimeout(function() {
                    toast.classList.add('hidden');
                    toast.classList.remove('flex');
                }, 3000);
            }

            // Close toast on click
            document.getElementById('close-toast').addEventListener('click', function() {
                document.getElementById('toast').classList.add('hidden');
                document.getElementById('toast').classList.remove('flex');
            });

            // Tab functionality
            const tabButtons = document.querySelectorAll('.tab-btn');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all tabs
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active-tab', 'text-primary-600', 'border-primary-600');
                        btn.classList.add('text-gray-500', 'border-transparent');
                    });
                    
                    // Add active class to clicked tab
                    button.classList.add('active-tab', 'text-primary-600', 'border-primary-600');
                    button.classList.remove('text-gray-500', 'border-transparent');
                    
                    // Filter table rows based on tab
                    const tabValue = button.getAttribute('data-tab');
                    const rows = document.querySelectorAll('tbody tr');
                    
                    rows.forEach(row => {
                        const status = row.getAttribute('data-request-status');
                        if (tabValue === 'all' || status === tabValue) {
                            row.classList.remove('hidden');
                        } else {
                            row.classList.add('hidden');
                        }
                    });
                });
            });

            // Search functionality
            const searchInput = document.getElementById('search-input');
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.classList.remove('hidden');
                    } else {
                        row.classList.add('hidden');
                    }
                });
            });

            // Status filter
            const statusFilter = document.getElementById('status-filter');
            
            statusFilter.addEventListener('change', function() {
                const selectedStatus = this.value;
                const rows = document.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const status = row.getAttribute('data-request-status');
                    if (selectedStatus === 'all' || status === selectedStatus) {
                        row.classList.remove('hidden');
                    } else {
                        row.classList.add('hidden');
                    }
                });
            });

            // Reset filters
            const resetFiltersBtn = document.getElementById('reset-filters');
            
            resetFiltersBtn.addEventListener('click', function() {
                searchInput.value = '';
                statusFilter.value = 'all';
                document.getElementById('date-filter').value = 'all';
                
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    row.classList.remove('hidden');
                });
                
                // Reset tabs
                tabButtons.forEach(btn => {
                    btn.classList.remove('active-tab', 'text-primary-600', 'border-primary-600');
                    btn.classList.add('text-gray-500', 'border-transparent');
                });
                
                document.querySelector('[data-tab="all"]').classList.add('active-tab', 'text-primary-600', 'border-primary-600');
                document.querySelector('[data-tab="all"]').classList.remove('text-gray-500', 'border-transparent');
            });

            // View request details modal
            const viewButtons = document.querySelectorAll('.view-request-btn');
            const viewRequestModal = document.getElementById('view-request-modal');
            const closeViewModalBtns = document.querySelectorAll('[data-close-view-modal]');
            const viewModalOverlay = document.getElementById('view-modal-overlay');
            
            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const requestId = this.getAttribute('data-request-id');
                    
                    // In a real application, you would fetch the request details via AJAX
                    // For this example, we'll just show a placeholder
                    document.getElementById('request-details-container').innerHTML = `
                        <div class="text-center py-8">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-600 mx-auto mb-4"></div>
                            <p class="text-gray-500">Loading request details...</p>
                        </div>
                    `;
                    
                    // Simulate loading data
                    setTimeout(() => {
                        document.getElementById('request-details-container').innerHTML = `
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Applicant Information</h3>
                                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                                        <div class="flex items-center mb-4">
                                            <div class="flex-shrink-0 h-16 w-16">
                                                <img class="h-16 w-16 rounded-full object-cover" src="{{ asset('storage/' . $request->adopter->profilePhoto) }}" alt="Adopter Photo">
                                            </div>
                                            <div class="ml-4">
                                                <h4 class="font-medium text-gray-800">{{ $request->adopter->name }}</h4>
                                                <p class="text-sm text-gray-600">{{ $request->adopter->email }}</p>
                                                <p class="text-sm text-gray-600">{{ $request->adopter->phone }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="space-y-3">
                                            <div class="flex">
                                                <span class="w-32 text-gray-500 text-sm">Address:</span>
                                                <span class="text-sm text-gray-700">{{ $request->adopter->address }}</span>
                                            </div>
                                            <div class="flex">
                                                <span class="w-32 text-gray-500 text-sm">Occupation:</span>
                                                <span class="text-sm text-gray-700">{{ $request->adopter->occupation ?? 'Not specified' }}</span>
                                            </div>
                                            <div class="flex">
                                                <span class="w-32 text-gray-500 text-sm">Home Type:</span>
                                                <span class="text-sm text-gray-700">{{ $request->adopter->homeType ?? 'Not specified' }}</span>
                                            </div>
                                            <div class="flex">
                                                <span class="w-32 text-gray-500 text-sm">Has Children:</span>
                                                <span class="text-sm text-gray-700">{{ $request->adopter->hasChildren ? 'Yes' : 'No' }}</span>
                                            </div>
                                            <div class="flex">
                                                <span class="w-32 text-gray-500 text-sm">Other Pets:</span>
                                                <span class="text-sm text-gray-700">{{ $request->adopter->otherPets ?? 'None' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Request Details</h3>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="space-y-3">
                                            <div class="flex">
                                                <span class="w-32 text-gray-500 text-sm">Request Date:</span>
                                                <span class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($request->requestDate)->format('F j, Y') }}</span>
                                            </div>
                                            <div class="flex">
                                                <span class="w-32 text-gray-500 text-sm">Status:</span>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$request->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ ucwords(str_replace('_', ' ', $request->status)) }}
                                                </span>
                                            </div>
                                            <div class="flex">
                                                <span class="w-32 text-gray-500 text-sm">Experience:</span>
                                                <span class="text-sm text-gray-700">{{ $request->experience ?? 'Not specified' }}</span>
                                            </div>
                                            <div class="flex">
                                                <span class="w-32 text-gray-500 text-sm">Hours Alone:</span>
                                                <span class="text-sm text-gray-700">{{ $request->hoursAlone ?? 'Not specified' }}</span>
                                            </div>
                                            <div class="flex">
                                                <span class="w-32 text-gray-500 text-sm">Activity Level:</span>
                                                <span class="text-sm text-gray-700">{{ $request->activityLevel ?? 'Not specified' }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <h4 class="font-medium text-gray-800 mb-2">Applicant Message:</h4>
                                            <p class="text-sm text-gray-600 bg-white p-3 rounded border border-gray-100">
                                                {{ $request->message ?? 'No message provided.' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Animal Information</h3>
                                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                                        <div class="flex items-center mb-4">
                                            <div class="w-24 h-24 rounded-lg overflow-hidden bg-gray-200">
                                                <img src="{{ asset('storage/' . $request->animal->photoAnimal) }}" alt="{{ $request->animal->name }}" class="w-full h-full object-cover">
                                            </div>
                                            <div class="ml-4">
                                                <h4 class="font-medium text-gray-800">{{ $request->animal->name }}</h4>
                                                <p class="text-sm text-gray-600">{{ $request->animal->race }}, {{ $request->animal->age }} years</p>
                                                <p class="text-sm text-gray-500">ID: {{ $request->animal->code }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="space-y-3">
                                            <div class="flex">
                                                <span class="w-32 text-gray-500 text-sm">Species:</span>
                                                <span class="text-sm text-gray-700">{{ $request->animal->species }}</span>
                                            </div>
                                            <div class="flex">
                                                <span class="w-32 text-gray-500 text-sm">Gender:</span>
                                                <span class="text-sm text-gray-700">{{ $request->animal->gender }}</span>
                                            </div>
                                            <div class="flex">
                                                <span class="w-32 text-gray-500 text-sm">Size:</span>
                                                <span class="text-sm text-gray-700">{{ $request->animal->size }}</span>
                                            </div>
                                            <div class="flex">
                                                <span class="w-32 text-gray-500 text-sm">Status:</span>
                                                <span class="text-sm text-gray-700">{{ ucfirst($request->animal->status) }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <h4 class="font-medium text-gray-800 mb-2">Description:</h4>
                                            <p class="text-sm text-gray-600 bg-white p-3 rounded border border-gray-100">
                                                {{ $request->animal->description ?? 'No description available.' }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    @if($request->status == 'approved' || $request->status == 'rejected')
                                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Decision Information</h3>
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            @if($request->status == 'approved')
                                                <div class="p-3 bg-green-50 border border-green-100 rounded-lg mb-4">
                                                    <h4 class="font-medium text-green-800 flex items-center mb-2">
                                                        <i class="fas fa-check-circle mr-2"></i>
                                                        Approved on {{ \Carbon\Carbon::parse($request->approvedDate)->format('F j, Y') }}
                                                    </h4>
                                                    @if($request->approvalNotes)
                                                        <p class="text-sm text-gray-600">{{ $request->approvalNotes }}</p>
                                                    @endif
                                                </div>
                                                
                                                <div class="space-y-3">
                                                    <div class="flex">
                                                        <span class="w-32 text-gray-500 text-sm">Approved By:</span>
                                                        <span class="text-sm text-gray-700">{{ $request->approvedBy ?? 'Not recorded' }}</span>
                                                    </div>
                                                    <div class="flex">
                                                        <span class="w-32 text-gray-500 text-sm">Pickup Date:</span>
                                                        <span class="text-sm text-gray-700">{{ $request->pickupDate ? \Carbon\Carbon::parse($request->pickupDate)->format('F j, Y') : 'Not scheduled' }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            @if($request->status == 'rejected')
                                                <div class="p-3 bg-red-50 border border-red-100 rounded-lg mb-4">
                                                    <h4 class="font-medium text-red-800 flex items-center mb-2">
                                                        <i class="fas fa-times-circle mr-2"></i>
                                                        Rejected on {{ \Carbon\Carbon::parse($request->rejectedDate)->format('F j, Y') }}
                                                    </h4>
                                                    @if($request->rejectionReason)
                                                        <p class="text-sm text-gray-600">Reason: {{ $request->rejectionReason }}</p>
                                                    @endif
                                                </div>
                                                
                                                <div class="space-y-3">
                                                    <div class="flex">
                                                        <span class="w-32 text-gray-500 text-sm">Rejected By:</span>
                                                        <span class="text-sm text-gray-700">{{ $request->rejectedBy ?? 'Not recorded' }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        `;
                        
                        // Set action buttons based on status
                        const row = document.querySelector(`tr[data-request-id="${requestId}"]`);
                        const status = row ? row.getAttribute('data-request-status') : 'pending';
                        
                        let actionButtons = '';
                        
                        if (status === 'pending') {
                            actionButtons = `
                                <form action="" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="request_id" value="${requestId}">
                                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-md transition duration-150 hover:shadow-lg">
                                        <i class="fas fa-check mr-2"></i>
                                        Approve
                                    </button>
                                </form>
                                <form action="" method="POST" class="inline ml-2">
                                    @csrf
                                    <input type="hidden" name="request_id" value="${requestId}">
                                    <input type="hidden" name="rejection_reason" value="Application rejected">
                                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-md transition duration-150 hover:shadow-lg">
                                        <i class="fas fa-times mr-2"></i>
                                        Reject
                                    </button>
                                </form>
                            `;
                        } else if (status === 'approved') {
                            actionButtons = `
                                <button type="button" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition duration-150 hover:shadow-lg">
                                    <i class="fas fa-calendar mr-2"></i>
                                    Schedule Pickup
                                </button>
                            `;
                        } else if (status === 'rejected') {
                            actionButtons = `
                                <button type="button" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow-md transition duration-150 hover:shadow-lg">
                                    <i class="fas fa-envelope mr-2"></i>
                                    Contact Applicant
                                </button>
                            `;
                        }
                        
                        document.getElementById('view-modal-actions').innerHTML = actionButtons;
                    }, 1000);
                    
                    viewRequestModal.classList.remove('hidden');
                    viewRequestModal.classList.add('flex');
                    document.body.classList.add('overflow-hidden');
                });
            });
            
            function closeViewModal() {
                viewRequestModal.classList.add('hidden');
                viewRequestModal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }
            
            closeViewModalBtns.forEach(button => {
                button.addEventListener('click', closeViewModal);
            });
            
            viewModalOverlay.addEventListener('click', closeViewModal);
        });
    </script>
</body>
</html>