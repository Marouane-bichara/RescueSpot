<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RescueSpot - Shelter Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-paw text-2xl"></i>
                    <span class="font-bold text-xl">RescueSpot</span>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex space-x-6">
                    <a href="#" class="py-2 px-3 bg-blue-700 rounded-lg font-medium">Dashboard</a>
                    <a href="#" class="py-2 px-3 hover:bg-blue-700 rounded-lg transition duration-300">Animals</a>
                    <a href="#" class="py-2 px-3 hover:bg-blue-700 rounded-lg transition duration-300">Adoption Requests</a>
                    <a href="#" class="py-2 px-3 hover:bg-blue-700 rounded-lg transition duration-300">Messages</a>
                </div>
                
                <!-- Profile Dropdown -->
                <div class="flex items-center space-x-4">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2">
                            <img src="/api/placeholder/40/40" alt="Shelter Profile" class="w-8 h-8 rounded-full">
                            <span class="hidden md:inline">{{ $shelter->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-100">Profile</a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-100">Settings</a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-100">Help</a>
                            <hr>
                            <form method="POST" action="{{ route('shelter.logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-white focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden pb-4">
                <a href="#" class="block py-2 px-4 bg-blue-700 rounded-lg font-medium my-1">Dashboard</a>
                <a href="#" class="block py-2 px-4 hover:bg-blue-700 rounded-lg transition duration-300 my-1">Animals</a>
                <a href="#" class="block py-2 px-4 hover:bg-blue-700 rounded-lg transition duration-300 my-1">Adoption Requests</a>
                <a href="#" class="block py-2 px-4 hover:bg-blue-700 rounded-lg transition duration-300 my-1">Messages</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Welcome Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Welcome back, {{ $shelter->name }}!</h1>
            <p class="text-gray-600 mt-2">Here's an overview of your shelter's current activity.</p>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-bullhorn text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-600">New Reports</h2>
                        <p class="text-2xl font-bold text-gray-800">{{ $newReportsCount }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View all reports →</a>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-paw text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-600">Animals in Care</h2>
                        <p class="text-2xl font-bold text-gray-800">{{ $animalsInCareCount }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="#" class="text-green-600 hover:text-green-800 text-sm font-medium">Manage animals →</a>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fas fa-home text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-600">Pending Adoptions</h2>
                        <p class="text-2xl font-bold text-gray-800">{{ $pendingAdoptionsCount }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="#" class="text-purple-600 hover:text-purple-800 text-sm font-medium">Review applications →</a>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-comments text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-600">New Messages</h2>
                        <p class="text-2xl font-bold text-gray-800">{{ $newMessagesCount }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="#" class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">Check inbox →</a>
                </div>
            </div>
        </div>
        
        <!-- Recent Reports Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Recent Animal Reports</h2>
                    <a href="#" class="text-blue-600 hover:text-blue-800">View all</a>
                </div>
                
                @if(count($recentReports) > 0)
                    <div class="space-y-4">
                        @foreach($recentReports as $report)
                            <div class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                                <div class="flex items-start">
                                    <img src="{{ $report->photo_url }}" alt="Animal" class="w-16 h-16 rounded-lg object-cover">
                                    <div class="ml-4 flex-1">
                                        <div class="flex justify-between">
                                            <h3 class="font-medium text-gray-800">{{ $report->animal_type }}</h3>
                                            <span class="text-sm text-gray-500">{{ $report->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1">{{ $report->description }}</p>
                                        <div class="flex items-center mt-2">
                                            <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>
                                            <span class="text-sm text-gray-500">{{ $report->location }}</span>
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('reports.show', $report->id) }}" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium hover:bg-blue-200 transition duration-300">
                                                View details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-clipboard-list text-4xl text-gray-300"></i>
                        <p class="mt-2 text-gray-500">No new reports at the moment</p>
                    </div>
                @endif
            </div>
            
            <!-- Recent Messages Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Recent Messages</h2>
                    <a href="#" class="text-blue-600 hover:text-blue-800">View all</a>
                </div>
                
                @if(count($recentMessages) > 0)
                    <div class="space-y-4">
                        @foreach($recentMessages as $message)
                            <div class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                                <div class="flex items-start">
                                    <img src="{{ $message->sender->profile_photo }}" alt="{{ $message->sender->name }}" class="w-10 h-10 rounded-full object-cover">
                                    <div class="ml-3 flex-1">
                                        <div class="flex justify-between">
                                            <h3 class="font-medium text-gray-800">{{ $message->sender->name }}</h3>
                                            <span class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($message->content, 80) }}</p>
                                        <div class="mt-3">
                                            <a href="{{ route('messages.show', $message->conversation_id) }}" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium hover:bg-green-200 transition duration-300">
                                                Reply <i class="fas fa-reply ml-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-comments text-4xl text-gray-300"></i>
                        <p class="mt-2 text-gray-500">No new messages at the moment</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Animals Ready for Adoption Section -->
        <div class="mt-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Animals Ready for Adoption</h2>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Manage all animals</a>
                </div>
                
                @if(count($adoptionReadyAnimals) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($adoptionReadyAnimals as $animal)
                            <div class="bg-gray-50 rounded-lg overflow-hidden shadow transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                                <img src="{{ $animal->photo_url }}" alt="{{ $animal->name }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <h3 class="font-semibold text-lg text-gray-800">{{ $animal->name }}</h3>
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Ready</span>
                                    </div>
                                    <div class="flex items-center mt-2 text-sm text-gray-600">
                                        <span>{{ $animal->species }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $animal->age }}</span>
                                    </div>
                                    <div class="mt-3 flex space-x-2">
                                        <a href="{{ route('animals.show', $animal->id) }}" class="flex-1 px-3 py-1 bg-blue-600 text-white text-center text-sm font-medium rounded-md hover:bg-blue-700 transition duration-300">Details</a>
                                        <a href="{{ route('animals.edit', $animal->id) }}" class="px-3 py-1 bg-gray-200 text-gray-700 text-center text-sm font-medium rounded-md hover:bg-gray-300 transition duration-300">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-paw text-4xl text-gray-300"></i>
                        <p class="mt-2 text-gray-500">No animals ready for adoption</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-6 mt-10">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <i class="fas fa-paw text-2xl"></i>
                    <span class="font-bold text-xl">RescueSpot</span>
                </div>
                <div class="text-sm text-blue-100">
                    © 2025 RescueSpot. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Alpine.js for dropdowns (you'll need to include Alpine.js in your project)
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', () => ({
                open: false,
                toggle() {
                    this.open = !this.open
                }
            }))
        });
    </script>
</body>
</html>