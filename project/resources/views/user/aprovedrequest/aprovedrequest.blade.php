<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RescueSpot - Adoption Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
        }
        
        .adoption-card {
            transition: all 0.3s ease-in-out;
        }
        
        .adoption-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
         .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .status-pending {
            background-color: #FEF3C7;
            color: #D97706;
        }
        
        .status-approved {
            background-color: #D1FAE5;
            color: #059669;
        }
        
        .status-rejected {
            background-color: #FEE2E2;
            color: #DC2626;
        }
        
        .status-completed {
            background-color: #DBEAFE;
            color: #2563EB;
        }
        
         .scrollable-container {
            height: 600px;  
            overflow-y: auto;
            overflow-x: hidden;
            padding: 1.5rem;
            position: relative;
        }
        
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
<body class="bg-gray-100 font-sans">
     <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                 <div class="flex items-center">
                    <a href="#" class="flex items-center space-x-2">
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-2 rounded-lg">
                            <i class="fas fa-paw text-xl"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-800">RescueSpot</span>
                    </a>
                </div>

                 <div class="hidden md:flex items-center space-x-1">
                    <a href="HomeUser" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Home</a>
                    <a href="{{ route('user.UserAdoptions.index') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Adoption</a>
                    <a href="{{ route('user.AprovedRequests') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600">Requests</a>
                    <a href="{{ route('user.UserReports.index') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Reports</a>
                </div>

                 <div class="flex items-center space-x-4">
                    <button class="hidden md:block bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white py-2 px-4 rounded-lg shadow-md transition transform hover:scale-105">
                        <a href="{{ route('user.UserReports.index') }}" class="text-white text-sm font-medium">Report an animal</a>
                    </button>
                    
                     <div class="relative ml-3">
                        <div>
                            <button type="button" id="profile-btn" class="flex text-sm bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" aria-expanded="false" aria-haspopup="true">
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-blue-500" 
                                src="{{ isset($userinfo) && $userinfo->profilePhoto ? asset('storage/' . $userinfo->profilePhoto) : asset('images/defaultImageProfile.jpg') }}" 
                                alt="Profile">
                            </button>
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
                    
                     <button type="button" id="mobile-menu-btn" class="md:hidden bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" aria-controls="mobile-menu" aria-expanded="false">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

         <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white shadow-md">
                <a href="HomeUser" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Home</a>
                <a href="{{ route('user.UserAdoptions.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600">Adoption</a>
                <a href="{{ route('user.AprovedRequests') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Requests</a>
                <a href="{{ route('user.UserReports.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Reports</a>
                <button class="mt-2 w-full flex justify-center items-center bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white py-2 px-4 rounded-lg shadow-md">
                    <a href="{{ route('user.UserReports.index') }}" class="text-white text-sm font-medium">Report an animal</a>                    
                </button>
            </div>
        </div>
    </nav>

     <main class="pt-20 pb-12">
         <section class="py-8 md:py-12">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <div class="inline-block px-4 py-1 rounded-full bg-blue-100 text-blue-600 text-sm font-semibold mb-4">
                        My Adoptions
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Adoption Status</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Track the status of your adoption applications
                    </p>
                </div>

                 <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-bold text-gray-800">My Adoption Applications</h2>
                        <div class="flex items-center">
                            <button class="p-1 rounded text-gray-700 hover:bg-gray-100 mr-2">
                                <i class="fas fa-filter"></i>
                            </button>
                            <button class="p-1 rounded text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-sort"></i>
                            </button>
                        </div>
                    </div>
                    
                     <div class="scrollable-container">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($adoptionDetails as $adoption)
                            <div class="adoption-card bg-white rounded-xl overflow-hidden shadow-md border border-gray-200">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $adoption['animal_image']) }}" alt="{{ $adoption['animal_name'] }}" class="w-full h-48 object-cover">
                                    
                                     @php
                                        $statusClass = 'status-pending';
                                        if($adoption['status'] == 'approved') {
                                            $statusClass = 'status-approved';
                                        } elseif($adoption['status'] == 'rejected') {
                                            $statusClass = 'status-rejected';
                                        } elseif($adoption['status'] == 'completed') {
                                            $statusClass = 'status-completed';
                                        }
                                    @endphp
                                    
                                    <div class="absolute top-3 right-3">
                                        <span class="status-badge {{ $statusClass }}">
                                            {{ ucfirst($adoption['status']) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $adoption['animal_name'] }}</h3>
                                            <p class="text-sm text-gray-500">Application ID: #{{ rand(10000, 99999) }}</p>
                                        </div>
                                        <div class="bg-blue-100 rounded-full p-2 text-blue-600">
                                            <i class="fas fa-paw text-lg"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Shelter Information</h4>
                                        <div class="flex items-center">
                                            @if($adoption['shelter_image'])
                                            <div class="mr-3">
                                                <img src="{{ asset('storage/' . $adoption['shelter_image']) }}" alt="Shelter" class="w-12 h-12 rounded-full object-cover border-2 border-gray-200">
                                            </div>
                                            @else
                                            <div class="mr-3 w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-home text-gray-400"></i>
                                            </div>
                                            @endif
                                            <div>
                                            <p class="text-sm text-gray-600">{{$adoption['shelter_address']}}</p>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="mb-4">
                                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Timeline</h4>
                                        <div class="space-y-2">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                                    <i class="fas fa-check text-green-600"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-800">Application Submitted</p>
                                                    <p class="text-xs text-gray-500">{{ date('M d, Y', strtotime('-3 days')) }}</p>
                                                </div>
                                            </div>
                                            
                                            @if(in_array($adoption['status'], ['approved', 'completed']))
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                                    <i class="fas fa-check text-green-600"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-800">Application Approved</p>
                                                    <p class="text-xs text-gray-500">{{ date('M d, Y', strtotime('-1 day')) }}</p>
                                                </div>
                                            </div>
                                            @elseif($adoption['status'] == 'rejected')
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                                    <i class="fas fa-times text-red-600"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-800">Application Rejected</p>
                                                    <p class="text-xs text-gray-500">{{ date('M d, Y', strtotime('-1 day')) }}</p>
                                                </div>
                                            </div>
                                            @else
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                                    <i class="fas fa-clock text-gray-400"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-800">Under Review</p>
                                                    <p class="text-xs text-gray-500">{{ date('M d, Y') }}</p>
                                                </div>
                                            </div>
                                            @endif
                                            
                                            @if($adoption['status'] == 'completed')
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                                    <i class="fas fa-home text-blue-600"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-800">Adoption Completed</p>
                                                    <p class="text-xs text-gray-500">{{ date('M d, Y') }}</p>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                                        <span class="text-sm text-gray-600">
                                            <i class="far fa-calendar-alt mr-1"></i> 
                                            Applied on {{ date('M d, Y', strtotime('-3 days')) }}
                                        </span>
                                        
                                        @if($adoption['status'] == 'pending')
                                        <button class="bg-red-500 hover:bg-red-600 text-white py-1.5 px-3 rounded-lg text-sm transition-colors">
                                            Cancel
                                        </button>
                                        @elseif($adoption['status'] == 'approved')
                                        <button class="bg-blue-600 hover:bg-blue-700 text-white py-1.5 px-3 rounded-lg text-sm transition-colors">
                                            Next Steps
                                        </button>
                                        @elseif($adoption['status'] == 'completed')
                                        <button class="bg-green-600 hover:bg-green-700 text-white py-1.5 px-3 rounded-lg text-sm transition-colors">
                                            View Certificate
                                        </button>
                                        @else
                                        <button class="bg-gray-600 hover:bg-gray-700 text-white py-1.5 px-3 rounded-lg text-sm transition-colors">
                                            Details
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @empty
                             <div class="col-span-full p-8 text-center">
                                <div class="inline-flex items-center justify-center bg-gray-100 rounded-full p-8 mb-6">
                                    <i class="fas fa-paw text-gray-400 text-5xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">No adoption applications yet</h3>
                                <p class="text-gray-600 mb-6 max-w-lg mx-auto">You haven't submitted any adoption applications yet. Browse our available animals and find your perfect companion.</p>
                                <a href="{{ route('user.UserAdoptions.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition">
                                    <i class="fas fa-search mr-2"></i>
                                    Browse Available Animals
                                </a>
                            </div>
                            @endforelse
                        </div>
                        
                         @if(count($adoptionDetails) > 3)
                        <div class="scroll-indicator">
                            <i class="fas fa-chevron-down text-xl animate-bounce"></i>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

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
        
         function openAdoptionModal(modalId) {
             const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            modal.classList.add('modal-active');
            document.body.classList.add('modal-open');  
        }

        function closeAdoptionModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
            modal.classList.remove('modal-active');
            document.body.classList.remove('modal-open');  
        }

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