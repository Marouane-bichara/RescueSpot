<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RescueSpot - Accueil</title>
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
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600">Accueil</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Adoption</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Signalements</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Messages</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Contact</a>
                </div>

                <!-- Right Side Menu -->
                <div class="flex items-center space-x-4">
                    <button class="hidden md:block bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white py-2 px-4 rounded-lg shadow-md transition transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>Signaler un animal
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
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                <i class="far fa-user mr-3 text-gray-500"></i> Mon profil
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                <i class="fas fa-cog mr-3 text-gray-500"></i> Paramètres
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                <i class="fas fa-heart mr-3 text-gray-500"></i> Mes favoris
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                <i class="fas fa-history mr-3 text-gray-500"></i> Historique
                            </a>
                            <div class="border-t border-gray-100"></div>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-red-700 hover:bg-gray-100" role="menuitem">
                                <i class="fas fa-sign-out-alt mr-3 text-red-500"></i> Déconnexion
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
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600">Accueil</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Adoption</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Signalements</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Messages</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">Contact</a>
                <button class="mt-2 w-full flex justify-center items-center bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white py-2 px-4 rounded-lg shadow-md">
                    <i class="fas fa-plus mr-2"></i>Signaler un animal
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20 pb-12">
        <!-- Hero Section -->
        <div class="relative bg-white overflow-hidden mb-8">
            <div class="max-w-7xl mx-auto">
                <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                    <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                        <polygon points="50,0 100,0 50,100 0,100" />
                    </svg>

                    <div class="relative px-4 pt-6 sm:px-6 lg:px-8"></div>

                    <div class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 lg:mt-16 lg:px-8">
                        <div class="sm:text-center lg:text-left">
                            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                                <span class="block">Une plateforme dédiée au</span>
                                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">sauvetage animal</span>
                            </h1>
                            <p class="mt-3 text-base text-gray-600 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto lg:mx-0">
                                Ensemble, donnons une seconde chance aux animaux abandonnés. Signalez un animal en détresse ou découvrez votre futur compagnon parmi nos protégés.
                            </p>
                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                <div class="rounded-md shadow">
                                    <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 md:py-3 md:text-lg md:px-10">
                                        <i class="fas fa-search mr-2"></i> Trouver un animal
                                    </a>
                                </div>
                                <div class="mt-3 sm:mt-0 sm:ml-3">
                                    <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 md:py-3 md:text-lg md:px-10">
                                        <i class="fas fa-plus mr-2"></i> Signaler
                                    </a>
                                </div>
                            </div>
                        </div>
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
                            <p class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wider">Animaux sauvés</p>
                            <div class="mt-1">
                                <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                                <span class="text-green-500 text-sm">+12% ce mois</span>
                            </div>
                        </div>
                        <div class="p-6 border-b lg:border-r lg:border-b-0 border-gray-200 text-center">
                            <span class="text-indigo-600 text-4xl font-bold block">183</span>
                            <p class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wider">Adoptions réussies</p>
                            <div class="mt-1">
                                <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                                <span class="text-green-500 text-sm">+8% ce mois</span>
                            </div>
                        </div>
                        <div class="p-6 border-b md:border-r md:border-b-0 border-gray-200 text-center">
                            <span class="text-yellow-600 text-4xl font-bold block">42</span>
                            <p class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wider">Refuges partenaires</p>
                            <div class="mt-1">
                                <i class="fas fa-plus text-green-500 mr-1"></i>
                                <span class="text-green-500 text-sm">3 nouveaux</span>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <span class="text-purple-600 text-4xl font-bold block">1208</span>
                            <p class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wider">Membres actifs</p>
                            <div class="mt-1">
                                <i class="fas fa-user-plus text-green-500 mr-1"></i>
                                <span class="text-green-500 text-sm">+24 aujourd'hui</span>
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
            <button class="py-1 px-3 text-sm rounded-md text-gray-700 hover:bg-gray-100">Urgent</button>
            <button class="py-1 px-3 text-sm rounded-md text-gray-700 hover:bg-gray-100">Pending</button>
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
                        <h2 class="text-xl font-bold mb-4">Actions rapides</h2>
                        <div class="space-y-3">
                            <a href="#" class="flex items-center p-3 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-xl transition">
                                <div class="w-10 h-10 flex items-center justify-center bg-yellow-500 rounded-lg mr-4">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <div>
                                    <span class="font-medium">Signaler un animal</span>
                                    <p class="text-xs text-blue-100">Aidez un animal en détresse</p>
                                </div>
                            </a>
                            <a href="#" class="flex items-center p-3 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-xl transition">
                                <div class="w-10 h-10 flex items-center justify-center bg-green-500 rounded-lg mr-4">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div>
                                    <span class="font-medium">Adopter un animal</span>
                                    <p class="text-xs text-blue-100">Trouvez votre compagnon</p>
                                </div>
                            </a>
                            <a href="#" class="flex items-center p-3 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-xl transition">
                                <div class="w-10 h-10 flex items-center justify-center bg-purple-500 rounded-lg mr-4">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                                <div>
                                    <span class="font-medium">Faire un don</span>
                                    <p class="text-xs text-blue-100">Soutenez nos actions</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Your Activity -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800">Votre activité</h2>
                        </div>
                        <div class="p-6">
                            <div class="mb-6">
                                <h3 class="font-medium text-gray-800 mb-3 flex items-center">
                                    <i class="fas fa-bell text-blue-500 mr-2"></i> Vos signalements
                                </h3>
                                <div class="bg-blue-50 rounded-lg p-4 mb-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-medium">Chien trouvé au parc</h4>
                                            <p class="text-sm text-gray-600">Signalé il y a 3 jours</p>
                                        </div>
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Sauvé</span>
                                    </div>
                                    <p class="text-sm text-gray-700 mb-2">Le refuge "Patte Tendue" a récupéré l'animal et l'a pris en charge.</p>
                                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Voir les détails</a>
                                </div>
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                                    <span>Voir tous vos signalements</span>
                                    <i class="fas fa-chevron-right ml-1 text-xs"></i>
                                </a>
                            </div>
                            
                            <div>
                                <h3 class="font-medium text-gray-800 mb-3 flex items-center">
                                    <i class="fas fa-paw text-purple-500 mr-2"></i> Vos demandes d'adoption
                                </h3>
                                <div class="bg-purple-50 rounded-lg p-4 mb-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-medium">Tina - Chatte tigrée</h4>
                                            <p class="text-sm text-gray-600">Demande envoyée le 12/03</p>
                                        </div>
                                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">En attente</span>
                                    </div>
                                    <p class="text-sm text-gray-700 mb-2">Votre demande est en cours d'examen par le refuge.</p>
                                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Suivre la demande</a>
                                </div>
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                                    <span>Voir toutes vos demandes</span>
                                    <i class="fas fa-chevron-right ml-1 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Messages -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-lg font-bold text-gray-800">Messages récents</h2>
                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">3 non lus</span>
                        </div>
                        <div class="divide-y">
                            <div class="px-6 py-4 hover:bg-gray-50 cursor-pointer">
                                <div class="flex items-start gap-3">
                                    <img src="/api/placeholder/40/40" alt="Refuge" class="w-10 h-10 rounded-full">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-center mb-1">
                                            <h3 class="font-medium truncate">Refuge "Patte Tendue"</h3>
                                            <span class="text-xs text-gray-500">15:42</span>
                                        </div>
                                        <p class="text-sm text-gray-600 truncate">Bonjour, nous avons bien reçu votre signalement concernant...</p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50 cursor-pointer">
                                <div class="flex items-start gap-3">
                                    <img src="/api/placeholder/40/40" alt="Refuge" class="w-10 h-10 rounded-full">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-center mb-1">
                                            <h3 class="font-medium truncate">Association "Coeur Animal"</h3>
                                            <span class="text-xs text-gray-500">Hier</span>
                                        </div>
                                        <p class="text-sm text-gray-600 truncate">Votre demande d'adoption pour Mina a été examinée et nous...</p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50 cursor-pointer">
                                <div class="flex items-start gap-3">
                                    <img src="/api/placeholder/40/40" alt="Support" class="w-10 h-10 rounded-full">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-center mb-1">
                                            <h3 class="font-medium truncate">Support RescueSpot</h3>
                                            <span class="text-xs text-gray-500">03/04</span>
                                        </div>
                                        <p class="text-sm text-gray-600 truncate">Merci pour votre inscription ! N'hésitez pas si vous avez besoin...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-4 border-t border-gray-200 text-center">
                            <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                Voir tous les messages
                                <i class="fas fa-chevron-right ml-2 text-xs"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Mission & Info -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800">Notre mission</h2>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-700 mb-4">RescueSpot connecte les citoyens avec des refuges dévoués pour secourir et offrir une seconde chance à nos amis à quatre pattes.</p>
                            <div class="flex justify-center gap-4 mb-6">
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-hand-holding-heart text-xl"></i>
                                    </div>
                                    <span class="text-sm">Signaler</span>
                                </div>
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-ambulance text-xl"></i>
                                    </div>
                                    <span class="text-sm">Secourir</span>
                                </div>
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-home text-xl"></i>
                                    </div>
                                    <span class="text-sm">Adopter</span>
                                </div>
                            </div>
                            <a href="#" class="block text-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-2 px-4 rounded-lg transition transform hover:scale-105">En savoir plus</a>
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
                    <p class="text-gray-400 text-sm mb-4">Plateforme dédiée au sauvetage et à l'adoption d'animaux abandonnés.</p>
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
                    <h3 class="text-lg font-semibold mb-4">Liens rapides</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Accueil</a></li>
                        <li><a href="#" class="hover:text-white transition">Signaler un animal</a></li>
                        <li><a href="#" class="hover:text-white transition">Adoption</a></li>
                        <li><a href="#" class="hover:text-white transition">Messages</a></li>
                        <li><a href="#" class="hover:text-white transition">À propos de nous</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Nous contacter</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-blue-500"></i>
                            contact@rescuespot.fr
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-2 text-blue-500"></i>
                            01 23 45 67 89
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                            75 Rue de l'Espoir, Paris
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                    <p class="text-gray-400 text-sm mb-4">Recevez nos actualités et conseils pour les animaux.</p>
                    <form>
                        <div class="flex">
                            <input type="email" placeholder="Votre email" class="px-4 py-2 w-full rounded-l-lg focus:outline-none text-gray-800">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-lg transition">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-400">
                <p>&copy; 2024 RescueSpot. Tous droits réservés. | <a href="#" class="text-blue-400 hover:text-white">Politique de confidentialité</a> | <a href="#" class="text-blue-400 hover:text-white">Conditions d'utilisation</a></p>
            </div>
        </div>
    </footer>
</body>
</html>