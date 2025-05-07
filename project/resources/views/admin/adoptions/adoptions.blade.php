<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RescueSpot - Adoptions</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
<div class="relative min-h-screen">

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
                    <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-white bg-emerald-600 rounded-md">
                        <i class="fas fa-heart mr-3"></i>
                        Adoptions
                    </a>
                    <a href="shelters" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100">
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

                <form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit"
            class="w-full mt-4 flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
            role="menuitem">
        <i class="fas fa-sign-out-alt mr-2"></i>
        Log Out
    </button>
</form>
            </div>
        </div>
    </div>

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
                    <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-white bg-emerald-600 rounded-md">
                        <i class="fas fa-heart mr-3"></i>
                        Adoptions
                    </a>
                    <a href="shelters" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100">
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

                <form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit"
            class="w-full mt-4 flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
            role="menuitem">
        <i class="fas fa-sign-out-alt mr-2"></i>
        Log Out
    </button>
</form>
            </div>
        </div>
    </div>

    <div class="md:pl-64 pt-14 md:pt-0">

    <header class="hidden md:flex items-center justify-between h-16 px-6 bg-white border-b">
            <h2 class="text-xl font-semibold text-gray-800">Adoptions</h2>
            <div class="flex items-center">
                <div class="relative mr-4">
                    <input type="text" id="search-input" placeholder="Search adoptions..." class="w-64 px-4 py-2 text-sm bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
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

        <main class="px-4 py-6 md:px-6 md:py-8">

        <div class="mb-6 bg-white rounded-lg shadow overflow-hidden">
                <div class="md:flex">
                    <div class="p-6 md:w-1/2">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Adoption Requests</h2>
                        <p class="mt-2 text-sm md:text-base text-gray-600">View and manage animal adoption requests from the community.</p>
                        <div class="mt-4 flex flex-wrap gap-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                                <i class="fas fa-heart mr-1"></i> <span id="total-count">{{ $adoptions ? count($adoptions) : 0 }}</span> Total Adoptions
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> 
                                <span id="approved-count">{{ $adoptions ? $adoptions->where('status', 'approved')->count() : 0 }}</span> Approved
                            </span>
                        </div>
                    </div>
                    <div class="md:w-1/2 bg-emerald-50 flex items-center justify-center">
                        <div class="p-6 text-center">
                            <i class="fas fa-heart text-emerald-500 text-5xl mb-3"></i>
                            <h3 class="text-lg font-semibold text-gray-800">Happy Adoptions!</h3>
                            <p class="text-sm text-gray-600 mt-1">Every adoption brings joy to both animals and their new families.</p>
                            <button class="mt-3 px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                View Adoption Statistics
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="w-full md:w-auto flex flex-wrap gap-2">
                    <button id="filter-all" class="filter-btn px-3 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700 focus:outline-none" data-status="all">
                        All Adoptions
                    </button>
                    <button id="filter-approved" class="filter-btn px-3 py-2 bg-white text-gray-700 border border-gray-300 rounded-md text-sm font-medium hover:bg-gray-50 focus:outline-none" data-status="approved">
                        Approved
                    </button>
                    <button id="filter-pending" class="filter-btn px-3 py-2 bg-white text-gray-700 border border-gray-300 rounded-md text-sm font-medium hover:bg-gray-50 focus:outline-none" data-status="pending">
                        Pending
                    </button>
                    <button id="filter-rejected" class="filter-btn px-3 py-2 bg-white text-gray-700 border border-gray-300 rounded-md text-sm font-medium hover:bg-gray-50 focus:outline-none" data-status="rejected">
                        Rejected
                    </button>
                </div>
                <div class="w-full md:w-auto">
                    <select id="sort-select" class="px-3 py-2 bg-white text-gray-700 border border-gray-300 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="newest">Sort by: Newest First</option>
                        <option value="oldest">Sort by: Oldest First</option>
                        <option value="animal">Sort by: Animal Name</option>
                        <option value="adopter">Sort by: Adopter Name</option>
                    </select>
                </div>
            </div>

            <div class="mb-8">

            <div class="h-[calc(100vh-250px)] overflow-y-auto pr-2 pb-4 rounded-lg border border-gray-200">
                    @if($adoptions && count($adoptions) > 0)
                        <div id="adoptions-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                            @foreach($adoptions as $adoption)
                            <div class="adoption-card bg-white rounded-lg shadow overflow-hidden" 
                                 data-status="{{ $adoption->status }}" 
                                 data-date="{{ $adoption->requestDate }}" 
                                 data-animal="{{ $adoption->animal->name }}"
                                 data-adopter="{{ $adoption->adopter->name }}">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $adoption->animal->photoAnimal) }}" alt="{{ $adoption->animal->name }}" class="w-full h-48 object-cover">
                                    <div class="absolute top-2 right-2">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($adoption->status == 'approved') bg-green-100 text-green-800 
                                            @elseif($adoption->status == 'pending') bg-yellow-100 text-yellow-800 
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($adoption->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="mb-3">
                                        <h3 class="font-semibold text-gray-800 text-lg">{{ $adoption->animal->name }}</h3>
                                        <div class="flex items-center mt-1">
                                            <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded mr-2">{{ $adoption->animal->species }}</span>
                                            <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded mr-2">{{ $adoption->animal->breed }}</span>
                                            <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded">{{ $adoption->animal->age }} yr</span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center text-xs text-gray-500 mb-3">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        <span>Request Date: {{ \Carbon\Carbon::parse($adoption->requestDate)->format('M d, Y') }}</span>
                                    </div>
                                    
                                    <div class="border-t border-gray-100 pt-3 mt-3">
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Adopter Information</h4>
                                        <div class="flex items-center mb-2">
                                            <img src="{{ asset('storage/' . $adoption->adopter->profilePhoto) }}" alt="{{ $adoption->adopter->name }}" class="w-8 h-8 rounded-full object-cover mr-2">
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">{{ $adoption->adopter->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $adoption->adopter->email }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center text-xs text-gray-500 mb-1">
                                            <i class="fas fa-phone mr-1"></i>
                                            <span>{{ $adoption->adopter->phone }}</span>
                                        </div>
                                        <div class="flex items-center text-xs text-gray-500">
                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                            <span>{{ $adoption->adopter->city }}, {{ $adoption->adopter->country }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <button class="w-full px-3 py-2 bg-emerald-600 text-white rounded text-sm font-medium hover:bg-emerald-700 focus:outline-none">
                                            View Full Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div id="no-results" class="hidden flex flex-col items-center justify-center h-full py-16">
                            <div class="bg-gray-100 p-4 rounded-full mb-4">
                                <i class="fas fa-search text-gray-400 text-5xl"></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-700 mb-2">No Adoptions Match Your Filters</h3>
                            <p class="text-gray-500 text-center max-w-md mb-6">Try adjusting your filter criteria or search terms to find what you're looking for.</p>
                            <button id="reset-filters" class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                <i class="fas fa-undo mr-2"></i> Reset Filters
                            </button>
                        </div>
                    @else

                    <div class="flex flex-col items-center justify-center h-full py-16">
                            <div class="bg-gray-100 p-4 rounded-full mb-4">
                                <i class="fas fa-heart text-gray-400 text-5xl"></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-700 mb-2">No Adoption Requests Found</h3>
                            <p class="text-gray-500 text-center max-w-md mb-6">There are currently no adoption requests in the system. New requests will appear here when community members submit them.</p>
                            <button class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                <i class="fas fa-sync-alt mr-2"></i> Refresh Page
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-lg font-medium text-gray-800 mb-3">Quick Actions</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <button class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-download text-emerald-600 mb-2"></i>
                        <span class="text-sm text-gray-700">Export Adoptions</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-envelope text-emerald-600 mb-2"></i>
                        <span class="text-sm text-gray-700">Contact Adopters</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-chart-bar text-emerald-600 mb-2"></i>
                        <span class="text-sm text-gray-700">View Statistics</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-cog text-emerald-600 mb-2"></i>
                        <span class="text-sm text-gray-700">Adoption Settings</span>
                    </button>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const closeMobileMenuButton = document.getElementById('close-mobile-menu');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.remove('hidden');
        });
        
        closeMobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
        });

        const filterButtons = document.querySelectorAll('.filter-btn');
        const sortSelect = document.getElementById('sort-select');
        const searchInput = document.getElementById('search-input');
        const adoptionCards = document.querySelectorAll('.adoption-card');
        const adoptionsContainer = document.getElementById('adoptions-container');
        const noResults = document.getElementById('no-results');
        const resetFiltersBtn = document.getElementById('reset-filters');
        
        let currentFilter = 'all';
        let currentSort = 'newest';
        let searchTerm = '';

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

        function filterAndSortAdoptions() {
            let visibleCount = 0;
            let approvedCount = 0;
            
            adoptionCards.forEach(card => {
                const status = card.getAttribute('data-status');
                const animalName = card.getAttribute('data-animal').toLowerCase();
                const adopterName = card.getAttribute('data-adopter').toLowerCase();
                
                if (status === 'approved') {
                    approvedCount++;
                }
                
                const statusMatch = currentFilter === 'all' || status === currentFilter;
                
                const searchMatch = searchTerm === '' || 
                                   animalName.includes(searchTerm) || 
                                   adopterName.includes(searchTerm);
                
                if (statusMatch && searchMatch) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            if (visibleCount === 0 && adoptionCards.length > 0) {
                adoptionsContainer.classList.add('hidden');
                noResults.classList.remove('hidden');
            } else {
                adoptionsContainer.classList.remove('hidden');
                noResults.classList.add('hidden');
            }

            document.getElementById('total-count').textContent = visibleCount;
            document.getElementById('approved-count').textContent = approvedCount;
            
            sortAdoptions();
        }

        function sortAdoptions() {
            const cards = Array.from(adoptionCards).filter(card => !card.classList.contains('hidden'));
            
            cards.sort((a, b) => {
                if (currentSort === 'newest') {
                    return new Date(b.getAttribute('data-date')) - new Date(a.getAttribute('data-date'));
                } else if (currentSort === 'oldest') {
                    return new Date(a.getAttribute('data-date')) - new Date(b.getAttribute('data-date'));
                } else if (currentSort === 'animal') {
                    return a.getAttribute('data-animal').localeCompare(b.getAttribute('data-animal'));
                } else if (currentSort === 'adopter') {
                    return a.getAttribute('data-adopter').localeCompare(b.getAttribute('data-adopter'));
                }
                return 0;
            });
            
            cards.forEach(card => {
                adoptionsContainer.appendChild(card);
            });
        }

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                currentFilter = this.getAttribute('data-status');
                updateFilterButtons(this);
                filterAndSortAdoptions();
            });
        });

        sortSelect.addEventListener('change', function() {
            currentSort = this.value;
            filterAndSortAdoptions();
        });

        searchInput.addEventListener('input', function() {
            searchTerm = this.value.toLowerCase();
            filterAndSortAdoptions();
        });

        resetFiltersBtn.addEventListener('click', function() {
            currentFilter = 'all';
            updateFilterButtons(document.getElementById('filter-all'));
            
            sortSelect.value = 'newest';
            currentSort = 'newest';
            
            searchInput.value = '';
            searchTerm = '';
            
            filterAndSortAdoptions();
        });

        filterAndSortAdoptions();
    });
</script>
</body>
</html>