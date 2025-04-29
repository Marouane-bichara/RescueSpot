<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RescueSpot - Shelters</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
<div class="relative min-h-screen">
    <!-- Mobile menu button -->
    <div class="fixed top-0 left-0 right-0 z-20 flex items-center justify-between px-4 py-3 bg-white border-b md:hidden">
        <button id="mobile-menu-button" class="p-2 text-gray-600 rounded-md focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <div class="flex items-center">
            <i class="fas fa-paw text-emerald-600 text-xl mr-2"></i>
            <h1 class="text-lg font-bold text-emerald-600">RescueSpot</h1>
        </div>
        <div class="flex items-center">
            <button class="relative p-2 text-gray-600 rounded-full focus:outline-none">
                <i class="fas fa-bell"></i>
                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
        </div>
    </div>

    <!-- Mobile menu (hidden by default) -->
    <div id="mobile-menu" class="fixed inset-0 z-30 hidden bg-white">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-between px-4 py-3 border-b">
                <div class="flex items-center">
                    <i class="fas fa-paw text-emerald-600 text-xl mr-2"></i>
                    <h1 class="text-lg font-bold text-emerald-600">RescueSpot</h1>
                </div>
                <button id="close-mobile-menu" class="p-2 text-gray-600 rounded-md focus:outline-none">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="flex-1 px-4 py-4 overflow-y-auto">
                <nav class="space-y-2">
                    <a href="HomeAdmin" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="ReportsAnimal" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100">
                        <i class="fas fa-paw mr-3"></i>
                        Animal Reports
                    </a>
                    <a href="adoptions" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100">
                        <i class="fas fa-heart mr-3"></i>
                        Adoptions
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-white bg-emerald-600 rounded-md">
                        <i class="fas fa-home mr-3"></i>
                        Shelters
                    </a>

                    <a href="users" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100">
                        <i class="fas fa-users mr-3"></i>
                        Users
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100">
                        <i class="fas fa-cog mr-3"></i>
                        Settings
                    </a>
                </nav>
            </div>
            <div class="px-4 py-3 border-t">
                <div class="flex items-center">
                    <img class="w-10 h-10 rounded-full object-cover" src="/placeholder.svg?height=40&width=40" alt="User avatar">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700">Admin User</p>
                        <p class="text-xs text-gray-500">admin@rescuespot.com</p>
                    </div>
                </div>
                <!-- Mobile Logout Button -->
                <button class="w-full mt-4 flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Log Out
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar (hidden on mobile) -->
    <div class="fixed inset-y-0 left-0 z-10 hidden w-64 bg-white border-r md:block">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-center h-16 px-4 border-b">
                <i class="fas fa-paw text-emerald-600 text-xl mr-2"></i>
                <h1 class="text-xl font-bold text-emerald-600">RescueSpot</h1>
            </div>
            <div class="flex-1 px-4 py-4 overflow-y-auto">
                <nav class="space-y-2">
                    <a href="HomeAdmin" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="ReportsAnimal" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100">
                        <i class="fas fa-paw mr-3"></i>
                        Animal Reports
                    </a>
                    <a href="adoptions" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100">
                        <i class="fas fa-heart mr-3"></i>
                        Adoptions
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-white bg-emerald-600 rounded-md">
                        <i class="fas fa-home mr-3"></i>
                        Shelters
                    </a>

                    <a href="users" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100">
                        <i class="fas fa-users mr-3"></i>
                        Users
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100">
                        <i class="fas fa-cog mr-3"></i>
                        Settings
                    </a>
                </nav>
            </div>
            <div class="px-4 py-3 border-t">
                <div class="flex items-center">
                    <img class="w-10 h-10 rounded-full object-cover" src="/placeholder.svg?height=40&width=40" alt="User avatar">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700">Admin User</p>
                        <p class="text-xs text-gray-500">admin@rescuespot.com</p>
                    </div>
                </div>
                <!-- Desktop Logout Button -->
                <button class="w-full mt-4 flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Log Out
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="md:pl-64 pt-14 md:pt-0">
        <!-- Top Navigation (visible on desktop) -->
        <header class="hidden md:flex items-center justify-between h-16 px-6 bg-white border-b">
            <h2 class="text-xl font-semibold text-gray-800">Shelters</h2>
            <div class="flex items-center">
                <div class="relative mr-4">
                    <input type="text" id="search-input" placeholder="Search shelters..." class="w-64 px-4 py-2 text-sm bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <button class="absolute right-0 top-0 mt-2 mr-3 text-gray-400">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <button class="relative p-2 text-gray-500 rounded-full hover:bg-gray-100 focus:outline-none">
                    <i class="fas fa-bell"></i>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="px-4 py-6 md:px-6 md:py-8">
            <!-- Shelters Overview -->
            <div class="mb-6 bg-white rounded-lg shadow overflow-hidden">
                <div class="md:flex">
                    <div class="p-6 md:w-1/2">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Animal Shelters</h2>
                        <p class="mt-2 text-sm md:text-base text-gray-600">Manage and monitor animal shelters in our network.</p>
                        <div class="mt-4 flex flex-wrap gap-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                                <i class="fas fa-home mr-1"></i> <span id="total-count">{{ count($shelters) }}</span> Total Shelters
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> 
                                <span id="active-count">{{ $shelters->filter(function($shelter) { return $shelter->user->status === 'active'; })->count() }}</span> Active
                            </span>
                        </div>
                    </div>
                    <div class="md:w-1/2 bg-emerald-50 flex items-center justify-center">
                        <div class="p-6 text-center">
                            <i class="fas fa-home text-emerald-500 text-5xl mb-3"></i>
                            <h3 class="text-lg font-semibold text-gray-800">Shelter Network</h3>
                            <p class="text-sm text-gray-600 mt-1">Our network of shelters helps thousands of animals find homes each year.</p>
                            <button class="mt-3 px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                Add New Shelter
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Controls - Updated with better styling and icons -->
            <div class="mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="w-full md:w-auto flex flex-wrap gap-2">
                    <button id="filter-all" class="filter-btn px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-colors" data-status="all">
                        <i class="fas fa-list-ul mr-1.5"></i> All Shelters
                    </button>
                    <button id="filter-active" class="filter-btn px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-md text-sm font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-colors" data-status="active">
                        <i class="fas fa-check-circle mr-1.5 text-green-600"></i> Active
                    </button>
                    <button id="filter-inactive" class="filter-btn px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-md text-sm font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-colors" data-status="inactive">
                        <i class="fas fa-ban mr-1.5 text-gray-500"></i> Inactive
                    </button>
                </div>
                <div class="w-full md:w-auto">
                    <select id="sort-select" class="px-3 py-2 bg-white text-gray-700 border border-gray-300 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="name">Sort by: Name</option>
                        <option value="location">Sort by: Location</option>
                        <option value="newest">Sort by: Newest First</option>
                        <option value="oldest">Sort by: Oldest First</option>
                    </select>
                </div>
            </div>

            <!-- Shelters Cards Container (Scrollable) -->
            <div class="mb-8">
                <!-- Increased height for the scrollable container -->
                <div class="h-[calc(100vh-250px)] overflow-y-auto pr-2 pb-4 rounded-lg border border-gray-200">
                    @if(count($shelters) > 0)
                        <div id="shelters-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                            @foreach($shelters as $shelter)
                            <div class="shelter-card bg-white rounded-lg shadow overflow-hidden" 
                                 data-status="{{ $shelter->user->status }}" 
                                 data-name="{{ $shelter->shelterName }}" 
                                 data-location="{{ $shelter->city }}, {{ $shelter->country }}"
                                 data-date="{{ $shelter->created_at }}">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $shelter->user->backgroundProfile) }}" alt="{{ $shelter->shelterName }}" class="w-full h-48 object-cover">
                                    <div class="absolute top-2 right-2">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($shelter->user->status == 'active') bg-green-100 text-green-800 
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($shelter->user->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex items-center mb-3">
                                        <img src="{{ asset('storage/' . $shelter->user->profilePhoto) }}" alt="{{ $shelter->user->name }}" class="w-10 h-10 rounded-full object-cover mr-3">
                                        <div>
                                            <h3 class="font-semibold text-gray-800 text-lg">{{ $shelter->shelterName }}</h3>
                                            <p class="text-xs text-gray-500">Managed by: {{ $shelter->user->name }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center text-xs text-gray-500 mb-3">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        <span>{{ $shelter->address }}, {{ $shelter->city }}, {{ $shelter->country }}</span>
                                    </div>
                                    
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $shelter->description }}</p>
                                    
                                    <div class="flex items-center text-xs text-gray-500 mb-1">
                                        <i class="fas fa-phone mr-1"></i>
                                        <span>{{ $shelter->user->phone }}</span>
                                    </div>
                                    <div class="flex items-center text-xs text-gray-500 mb-3">
                                        <i class="fas fa-envelope mr-1"></i>
                                        <span>{{ $shelter->user->email }}</span>
                                    </div>
                                    
                                    <div class="border-t border-gray-100 pt-3 mt-3">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs text-gray-500">
                                                <i class="fas fa-calendar-alt mr-1"></i> Joined: {{ \Carbon\Carbon::parse($shelter->created_at)->format('M d, Y') }}
                                            </span>
                                            @if($shelter->website != "No Website")
                                            <a href="{{ $shelter->website }}" target="_blank" class="text-xs text-emerald-600 hover:underline">
                                                <i class="fas fa-globe mr-1"></i> Website
                                            </a>
                                            @endif
                                        </div>
                                        
                                        <div class="flex gap-2 mt-3">
                                            <form action="{{ route('admin.activeUser') }}" method="POST" class="flex-1">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $shelter->user->id }}">
                                                <input type="hidden" name="status" value="active">
                                                <button type="submit" class="w-full px-3 py-2 bg-green-600 text-white rounded text-sm font-medium hover:bg-green-700 focus:outline-none {{ $shelter->user->status == 'active' ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $shelter->user->status == 'active' ? 'disabled' : '' }}>
                                                    <i class="fas fa-check-circle mr-1"></i> Active
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('admin.inactiveUser') }}" method="POST" class="flex-1">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $shelter->user->id }}">
                                                <input type="hidden" name="status" value="inactive">
                                                <button type="submit" class="w-full px-3 py-2 bg-gray-600 text-white rounded text-sm font-medium hover:bg-gray-700 focus:outline-none {{ $shelter->user->status == 'inactive' ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $shelter->user->status == 'inactive' ? 'disabled' : '' }}>
                                                    <i class="fas fa-ban mr-1"></i> Inactive
                                                </button>
                                            </form>
                                        </div>
                                        
                                        <button class="w-full px-3 py-2 bg-emerald-600 text-white rounded text-sm font-medium hover:bg-emerald-700 focus:outline-none mt-2">
                                            <i class="fas fa-info-circle mr-1"></i> View Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- No results message (hidden by default) -->
                        <div id="no-results" class="hidden flex flex-col items-center justify-center h-full py-16">
                            <div class="bg-gray-100 p-4 rounded-full mb-4">
                                <i class="fas fa-search text-gray-400 text-5xl"></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-700 mb-2">No Shelters Match Your Filters</h3>
                            <p class="text-gray-500 text-center max-w-md mb-6">Try adjusting your filter criteria or search terms to find what you're looking for.</p>
                            <button id="reset-filters" class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                <i class="fas fa-undo mr-2"></i> Reset Filters
                            </button>
                        </div>
                    @else
                        <!-- Empty state -->
                        <div class="flex flex-col items-center justify-center h-full py-16">
                            <div class="bg-gray-100 p-4 rounded-full mb-4">
                                <i class="fas fa-home text-gray-400 text-5xl"></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-700 mb-2">No Shelters Found</h3>
                            <p class="text-gray-500 text-center max-w-md mb-6">There are currently no shelters in the system. Add a new shelter to get started.</p>
                            <button class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                <i class="fas fa-plus mr-2"></i> Add New Shelter
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-lg font-medium text-gray-800 mb-3">Quick Actions</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <button class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-plus-circle text-emerald-600 mb-2"></i>
                        <span class="text-sm text-gray-700">Add Shelter</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-download text-emerald-600 mb-2"></i>
                        <span class="text-sm text-gray-700">Export List</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-chart-bar text-emerald-600 mb-2"></i>
                        <span class="text-sm text-gray-700">View Statistics</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-envelope text-emerald-600 mb-2"></i>
                        <span class="text-sm text-gray-700">Contact All</span>
                    </button>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- JavaScript for mobile menu toggle and filtering/sorting -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const closeMobileMenuButton = document.getElementById('close-mobile-menu');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.remove('hidden');
        });
        
        closeMobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
        });

        // Filter and sort functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const sortSelect = document.getElementById('sort-select');
        const searchInput = document.getElementById('search-input');
        const shelterCards = document.querySelectorAll('.shelter-card');
        const sheltersContainer = document.getElementById('shelters-container');
        const noResults = document.getElementById('no-results');
        const resetFiltersBtn = document.getElementById('reset-filters');
        
        let currentFilter = 'all';
        let currentSort = 'name';
        let searchTerm = '';

        // Function to update filter button styles
        function updateFilterButtons(activeButton) {
            filterButtons.forEach(button => {
                if (button === activeButton) {
                    button.classList.remove('bg-white', 'text-gray-700', 'border', 'border-gray-300');
                    button.classList.add('bg-emerald-600', 'text-white');
                } else {
                    button.classList.remove('bg-emerald-600', 'text-white');
                    button.classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-300');
                }
            });
        }

        // Function to filter and sort shelters
        function filterAndSortShelters() {
            let visibleCount = 0;
            let activeCount = 0;
            
            shelterCards.forEach(card => {
                const status = card.getAttribute('data-status');
                const name = card.getAttribute('data-name').toLowerCase();
                const location = card.getAttribute('data-location').toLowerCase();
                
                // Count active shelters
                if (status === 'active') {
                    activeCount++;
                }
                
                // Filter by status
                const statusMatch = currentFilter === 'all' || status === currentFilter;
                
                // Filter by search term
                const searchMatch = searchTerm === '' || 
                                   name.includes(searchTerm) || 
                                   location.includes(searchTerm);
                
                // Show/hide based on filters
                if (statusMatch && searchMatch) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            // Show/hide no results message
            if (visibleCount === 0 && shelterCards.length > 0) {
                sheltersContainer.classList.add('hidden');
                noResults.classList.remove('hidden');
            } else {
                sheltersContainer.classList.remove('hidden');
                noResults.classList.add('hidden');
            }

            // Update the visible count
            document.getElementById('total-count').textContent = visibleCount;
            document.getElementById('active-count').textContent = activeCount;
            
            // Sort visible cards
            sortShelters();
        }

        // Function to sort shelters
        function sortShelters() {
            const cards = Array.from(shelterCards).filter(card => !card.classList.contains('hidden'));
            
            cards.sort((a, b) => {
                if (currentSort === 'name') {
                    return a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'));
                } else if (currentSort === 'location') {
                    return a.getAttribute('data-location').localeCompare(b.getAttribute('data-location'));
                } else if (currentSort === 'newest') {
                    return new Date(b.getAttribute('data-date')) - new Date(a.getAttribute('data-date'));
                } else if (currentSort === 'oldest') {
                    return new Date(a.getAttribute('data-date')) - new Date(b.getAttribute('data-date'));
                }
                return 0;
            });
            
            // Reorder the cards in the DOM
            cards.forEach(card => {
                sheltersContainer.appendChild(card);
            });
        }

        // Event listeners for filter buttons
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                currentFilter = this.getAttribute('data-status');
                updateFilterButtons(this);
                filterAndSortShelters();
            });
        });

        // Event listener for sort select
        sortSelect.addEventListener('change', function() {
            currentSort = this.value;
            filterAndSortShelters();
        });

        // Event listener for search input
        searchInput.addEventListener('input', function() {
            searchTerm = this.value.toLowerCase();
            filterAndSortShelters();
        });

        // Event listener for reset filters button
        resetFiltersBtn.addEventListener('click', function() {
            // Reset filter
            currentFilter = 'all';
            updateFilterButtons(document.getElementById('filter-all'));
            
            // Reset sort
            sortSelect.value = 'name';
            currentSort = 'name';
            
            // Reset search
            searchInput.value = '';
            searchTerm = '';
            
            // Apply reset
            filterAndSortShelters();
        });

        // Initialize with default filter and sort
        filterAndSortShelters();
    });
</script>
</body>
</html>