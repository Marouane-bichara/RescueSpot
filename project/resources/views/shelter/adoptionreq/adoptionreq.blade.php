<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RescueSpot - Adoption Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
            
            const profileBtn = document.getElementById('profile-btn');
            const profileDropdown = document.getElementById('profile-dropdown');
            
            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });
            
            document.addEventListener('click', function() {
                profileDropdown.classList.add('hidden');
            });

            const modalTriggers = document.querySelectorAll('[data-modal-target]');
            const closeModalButtons = document.querySelectorAll('[data-close-modal]');
            const overlay = document.getElementById('modal-overlay');

            modalTriggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const modalId = trigger.getAttribute('data-modal-target');
                    const modal = document.getElementById(modalId);
                    
                    const requestId = trigger.getAttribute('data-request-id');
                    
                    if (requestId) {
                        const rejectInput = document.getElementById('reject_request_id');
                        const approveInput = document.getElementById('approve_request_id');
                        
                        if (rejectInput) rejectInput.value = requestId;
                        if (approveInput) approveInput.value = requestId;
                    }
                    
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
            
            function asset(path) {
                return path;
            }

            const filterButtons = document.querySelectorAll('[data-filter]');
            const requestCards = document.querySelectorAll('[data-status]');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    filterButtons.forEach(btn => {
                        btn.classList.remove('bg-teal-100', 'text-teal-700');
                        btn.classList.add('bg-gray-100', 'text-gray-700');
                    });
                    
                    button.classList.remove('bg-gray-100', 'text-gray-700');
                    button.classList.add('bg-teal-100', 'text-teal-700');
                    
                    const filter = button.getAttribute('data-filter');
                    
                    requestCards.forEach(card => {
                        if (filter === 'all' || card.getAttribute('data-status') === filter) {
                            card.classList.remove('hidden');
                        } else {
                            card.classList.add('hidden');
                        }
                    });
                });
            });
        });
    </script>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col">
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="#" class="flex items-center space-x-2">
                        <div class="bg-gradient-to-r from-teal-600 to-emerald-600 text-white p-2 rounded-lg">
                            <i class="fas fa-paw text-xl"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-800">RescueSpot</span>
                        <span class="bg-teal-100 text-teal-800 text-xs px-2 py-1 rounded-full">Shelter Portal</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-1">
                    <a href="HomeShelter" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Dashboard</a>
                    <a href="animalsShelter" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Animals</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gradient-to-r from-teal-600 to-emerald-600">Adoption Requests</a>
                    <a href="reportsShelter" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Reports</a>
                </div>

                <div class="flex items-center space-x-4">
                    <button 
                        type="button" 
                        data-modal-target="add-animal-modal" 
                        class="bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-600 hover:to-emerald-600 text-white rounded-lg px-4 py-2 flex items-center justify-center">
                        <i class="fas fa-plus mr-2"></i>
                        <span>Add Animal</span>
                    </button>
                    
                    <div class="relative ml-3">
                    <div>
                          <button type="button" id="profile-btn" class="flex text-sm bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150" aria-expanded="false" aria-haspopup="true">
                              <img class="h-10 w-10 rounded-full object-cover border-2 border-primary-500" 
                              src="{{ $user->profilePhoto ? asset('storage/'.$user->profilePhoto) : 'https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80' }}" 
                              alt="Shelter Profile">
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
                    
                    <button type="button" id="mobile-menu-btn" class="md:hidden bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500" aria-controls="mobile-menu" aria-expanded="false">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white shadow-md">
                <a href="HomeShelter" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Dashboard</a>
                <a href="animalsShelter" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Animals</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-teal-600 to-emerald-600">Adoption Requests</a>
                <a href="reportsShelter" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Reports</a>

            </div>
        </div>
    </nav>

    <main class="pt-20 pb-12 flex-grow">
        <div class="container mx-auto px-4">
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Adoption Requests</h1>
                        <p class="text-gray-600">Manage and review adoption applications from potential pet parents</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="relative">
                            <input type="text" placeholder="Search requests..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        <button class="bg-white border border-gray-300 rounded-lg px-4 py-2 text-gray-700 hover:bg-gray-50 flex items-center justify-center">
                            <i class="fas fa-filter mr-2"></i>
                            <span>Filter</span>
                        </button>
                        <button class="bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-600 hover:to-emerald-600 text-white rounded-lg px-4 py-2 flex items-center justify-center">
                            <i class="fas fa-download mr-2"></i>
                            <span>Export</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-4 mb-6">
                <div class="flex flex-wrap gap-2">
                    <button data-filter="all" class="py-1.5 px-4 text-sm rounded-md bg-teal-100 text-teal-700 hover:bg-teal-200">
                        All Requests
                    </button>
                    <button data-filter="pending" class="py-1.5 px-4 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">
                        <span class="inline-block w-2 h-2 rounded-full bg-yellow-500 mr-1"></span>
                        Pending
                    </button>
                    <button data-filter="approved" class="py-1.5 px-4 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">
                        <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-1"></span>
                        Approved
                    </button>
                    <button data-filter="rejected" class="py-1.5 px-4 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">
                        <span class="inline-block w-2 h-2 rounded-full bg-red-500 mr-1"></span>
                        Rejected
                    </button>
                    <button data-filter="interview" class="py-1.5 px-4 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">
                        <span class="inline-block w-2 h-2 rounded-full bg-blue-500 mr-1"></span>
                        Interview
                    </button>
                    <button data-filter="home_check_passed" class="py-1.5 px-4 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">
                        <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-1"></span>
                        Home Check Passed
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-4 mb-6">
                <div class="h-[calc(100vh-300px)] overflow-y-auto pr-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($adoptionRequests as $request)
                            <div data-status="{{ $request->status }}" class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 transition hover:shadow-lg">
                                <div class="px-4 py-3 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-800">Request #{{ $request->id }}</span>
                                    </div>
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'approved' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                            'interview' => 'bg-blue-100 text-blue-800',
                                            'home_check_passed' => 'bg-green-100 text-green-800',
                                        ];
                                    @endphp
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$request->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucwords(str_replace('_', ' ', $request->status)) }}
                                    </span>
                                </div>
                                
                                <div class="p-4 border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            <img class="h-12 w-12 rounded-full object-cover" src="{{ asset('storage/' . $request->adopter->profilePhoto) }}" alt="Adopter Photo">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $request->adopter->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $request->adopter->email }}</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-4 border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-16 w-16">
                                            <img class="h-16 w-16 rounded-lg object-cover" src="{{ asset('storage/' . $request->animal->photoAnimal) }}" alt="Animal Photo">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $request->animal->name }} ({{ $request->animal->code }})</div>
                                            <div class="text-sm text-gray-500">{{ $request->animal->race }}, {{ $request->animal->age }} years</div>
                                            <div class="mt-1 flex items-center">
                                                <i class="far fa-calendar-alt text-gray-400 mr-1.5 text-xs"></i>
                                                <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($request->requestDate)->format('F j, Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-4 border-b border-gray-200">
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="block text-gray-500">Submitted</span>
                                            <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($request->requestDate)->diffForHumans() }}</span>
                                        </div>
                                        <div>
                                            <span class="block text-gray-500">Home Type</span>
                                            <span class="font-medium text-gray-800">{{ $request->adopter->homeType ?? 'Not specified' }}</span>
                                        </div>
                                        <div>
                                            <span class="block text-gray-500">Has Children</span>
                                            <span class="font-medium text-gray-800">{{ $request->adopter->hasChildren ? 'Yes' : 'No' }}</span>
                                        </div>
                                        <div>
                                            <span class="block text-gray-500">Has Pets</span>
                                            <span class="font-medium text-gray-800">{{ $request->adopter->hasPets ? 'Yes' : 'No' }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-4 bg-gray-50 flex justify-between items-center">
                                    <button 
                                        type="button" 
                                        data-modal-target="adoption-details-modal" 
                                        data-request-id="{{ $request->id }}" 
                                        class="text-teal-600 hover:text-teal-900 font-medium text-sm flex items-center">
                                        <i class="far fa-eye mr-1.5"></i> View
                                    </button>
                                    
                                    <div class="flex space-x-3">
                                        <form action="{{ route('shelter.aproveAdoptionRequest') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="adoption_request_id" value="{{ $request->id }}">
                                            <button type="submit" class="bg-green-100 hover:bg-green-200 text-green-800 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors">
                                                Approve
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('shelter.rejectAdoptionRequest') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="adoption_request_id" value="{{ $request->id }}">
                                            <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-800 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors">
                                                Decline
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white rounded-xl shadow-md p-8 text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                                    <i class="fas fa-clipboard-list text-gray-400 text-3xl"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">No adoption requests yet</h3>
                                <p class="text-gray-600 mb-6 max-w-md mx-auto">There are currently no adoption requests to review. When potential adopters submit applications, they will appear here.</p>
                                <div class="flex flex-col sm:flex-row justify-center gap-3">
                                    <a href="#" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                        <i class="fas fa-sync-alt mr-2"></i>
                                        Refresh page
                                    </a>
                                    <a href="#" 
                                       data-modal-target="add-animal-modal"
                                       class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-teal-500 to-emerald-500 text-white rounded-lg hover:from-teal-600 hover:to-emerald-600 transition">
                                        <i class="fas fa-plus mr-2"></i>
                                        Add new animal
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 w-full mt-auto">
    <div class="container mx-auto px-4">
        <div class="py-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-5">
                    <div class="bg-gradient-to-r from-teal-600 to-emerald-600 text-white p-2 rounded-lg">
                        <i class="fas fa-paw text-xl"></i>
                    </div>
                    <span class="text-xl font-bold text-white">RescueSpot</span>
                </div>
                <p class="text-gray-400 text-sm mb-5 leading-relaxed">
                    Dedicated to connecting rescued animals with loving forever homes. Together we can make a difference, one paw at a time.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="bg-gray-800 hover:bg-gray-700 text-gray-300 hover:text-white p-2 rounded-full transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-gray-700 text-gray-300 hover:text-white p-2 rounded-full transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-gray-700 text-gray-300 hover:text-white p-2 rounded-full transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-gray-700 text-gray-300 hover:text-white p-2 rounded-full transition-colors">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            
            <div>
                <h3 class="text-white text-lg font-semibold mb-5">Quick Links</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-gray-400 hover:text-teal-400 transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-teal-500"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-teal-400 transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-teal-500"></i>
                            Animals
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-teal-400 transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-teal-500"></i>
                            Adoption Requests
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-teal-400 transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-teal-500"></i>
                            Reports
                        </a>
                    </li>
                    <li>
     
                    </li>
                </ul>
            </div>
            
            <div>
                <h3 class="text-white text-lg font-semibold mb-5">Contact Us</h3>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <div class="mt-1 bg-gray-800 rounded-full p-1.5 mr-3 text-teal-500">
                            <i class="fas fa-map-marker-alt text-sm"></i>
                        </div>
                        <span class="text-gray-400">75 Hope Street<br>New York, NY 10001</span>
                    </li>
                    <li class="flex items-center">
                        <div class="bg-gray-800 rounded-full p-1.5 mr-3 text-teal-500">
                            <i class="fas fa-phone-alt text-sm"></i>
                        </div>
                        <span class="text-gray-400">(123) 456-7890</span>
                    </li>
                    <li class="flex items-center">
                        <div class="bg-gray-800 rounded-full p-1.5 mr-3 text-teal-500">
                            <i class="fas fa-envelope text-sm"></i>
                        </div>
                        <span class="text-gray-400">shelter@rescuespot.com</span>
                    </li>
                    <li class="flex items-center">
                        <div class="bg-gray-800 rounded-full p-1.5 mr-3 text-teal-500">
                            <i class="fas fa-clock text-sm"></i>
                        </div>
                        <span class="text-gray-400">Mon-Fri: 9AM-5PM<br>Sat-Sun: 10AM-4PM</span>
                    </li>
                </ul>
            </div>
            
            <div>
                <h3 class="text-white text-lg font-semibold mb-5">Newsletter</h3>
                <p class="text-gray-400 text-sm mb-4">Stay updated with our latest news and animal care tips.</p>
                <form class="mb-3">
                    <div class="relative">
                        <input type="email" placeholder="Your email address" class="w-full bg-gray-800 border border-gray-700 rounded-lg py-3 px-4 text-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        <button type="submit" class="absolute right-1 top-1 bottom-1 bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-600 hover:to-emerald-600 text-white px-4 rounded-md transition-colors">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
                <p class="text-gray-500 text-xs">By subscribing, you agree to our Privacy Policy and consent to receive updates.</p>
            </div>
        </div>
        
        <div class="py-4 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500 text-sm mb-2 md:mb-0">
                &copy; 2024 RescueSpot. All rights reserved.
            </p>
            <div class="flex space-x-4">
                <a href="#" class="text-gray-500 hover:text-teal-400 text-sm transition-colors">Privacy Policy</a>
                <a href="#" class="text-gray-500 hover:text-teal-400 text-sm transition-colors">Terms of Service</a>
                <a href="#" class="text-gray-500 hover:text-teal-400 text-sm transition-colors">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>

    <div id="modal-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50"></div>

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
                                        <form action="{{ route('shelter.rejectAdoptionRequest') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="adoption_request_id" id="reject_request_id" value="">
                                            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md shadow-sm text-sm font-medium focus:outline-none">
                                                Decline
                                            </button>
                                        </form>
                                        <form action="{{ route('shelter.aproveAdoptionRequest') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="adoption_request_id" id="approve_request_id" value="">
                                            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white rounded-md shadow-sm text-sm font-medium focus:outline-none">
                                                Approve
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
</body>
</html>