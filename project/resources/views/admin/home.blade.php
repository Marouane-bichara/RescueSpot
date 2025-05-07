<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RescueSpot - Dashboard</title>
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
                        <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-white bg-emerald-600 rounded-md">
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
                        <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-white bg-emerald-600 rounded-md">
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
                <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
                <div class="flex items-center">
                    <div class="relative mr-4">
                        <input type="text" placeholder="Search..." class="w-64 px-4 py-2 text-sm bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
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
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Welcome to RescueSpot</h2>
                            <p class="mt-2 text-sm md:text-base text-gray-600">Your platform for animal rescue and adoption management. Here's what's happening today.</p>
                            <div class="mt-4 flex flex-wrap gap-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $arrayofInfo['pendingAdoptions'] }} Pending Adoptions
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-heart mr-1"></i> {{ $arrayofInfo['totalAdoptions'] }} Total Adoptions
                                </span>
                            </div>
                        </div>
                        <div class="md:w-1/2">
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-4 md:gap-6">
                    <div class="p-4 md:p-6 bg-white rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 bg-emerald-100 rounded-full">
                                <i class="fas fa-paw text-emerald-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-xs md:text-sm font-medium text-gray-500">Total Reports</p>
                                <p class="text-xl md:text-2xl font-semibold text-gray-800">{{ $arrayofInfo['totalReports'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-xs md:text-sm font-medium text-green-600">
                                <i class="fas fa-arrow-up"></i> New reports
                            </span>
                            <span class="text-xs md:text-sm text-gray-500 ml-2">this month</span>
                        </div>
                    </div>

                    <div class="p-4 md:p-6 bg-white rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-full">
                                <i class="fas fa-heart text-blue-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-xs md:text-sm font-medium text-gray-500">Adoptions</p>
                                <p class="text-xl md:text-2xl font-semibold text-gray-800">{{ $arrayofInfo['totalAdoptions'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-xs md:text-sm font-medium text-green-600">
                                <i class="fas fa-arrow-up"></i> New adoptions
                            </span>
                            <span class="text-xs md:text-sm text-gray-500 ml-2">this month</span>
                        </div>
                    </div>

                    <div class="p-4 md:p-6 bg-white rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-full">
                                <i class="fas fa-home text-purple-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-xs md:text-sm font-medium text-gray-500">Active Shelters</p>
                                <p class="text-xl md:text-2xl font-semibold text-gray-800">{{ $arrayofInfo['totalShelters'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-xs md:text-sm font-medium text-green-600">
                                <i class="fas fa-arrow-up"></i> New shelters
                            </span>
                            <span class="text-xs md:text-sm text-gray-500 ml-2">this month</span>
                        </div>
                    </div>

                    <div class="p-4 md:p-6 bg-white rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 bg-yellow-100 rounded-full">
                                <i class="fas fa-clock text-yellow-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-xs md:text-sm font-medium text-gray-500">Pending Adoptions</p>
                                <p class="text-xl md:text-2xl font-semibold text-gray-800">{{ $arrayofInfo['pendingAdoptions'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-xs md:text-sm font-medium text-yellow-600">
                                <i class="fas fa-clock"></i> Waiting approval
                            </span>
                            <span class="text-xs md:text-sm text-gray-500 ml-2">currently</span>
                        </div>
                    </div>
                </div>


                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Featured Animals</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($arrayofInfo['lastFourAnimals'] as $animal)
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <img src="{{ asset('storage/' . $animal->photoAnimal) }}" alt="{{ $animal->name }}" class="w-full h-40 object-cover">
                            <div class="p-3">
                                <h4 class="font-medium text-sm">{{ $animal->name }}</h4>
                                <p class="text-xs text-gray-500">{{ $animal->species }} • {{ $animal->age }} yrs</p>
                                <span class="mt-2 inline-block px-2 py-1 text-xs font-semibold 
                                    @if($animal->status == 'ready') text-green-800 bg-green-100 
                                    @elseif($animal->status == 'pending') text-yellow-800 bg-yellow-100 
                                    @else text-blue-800 bg-blue-100 @endif 
                                    rounded-full">
                                    {{ ucfirst($animal->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>


                <div class="grid grid-cols-1 gap-6 mb-8 lg:grid-cols-2">

                <div class="bg-white rounded-lg shadow">
                        <div class="px-4 py-3 md:px-6 md:py-4 border-b">
                            <h3 class="text-base md:text-lg font-semibold text-gray-800">Recent Animal Reports</h3>
                        </div>
                        <div class="p-4 md:p-6">
                            <ul class="divide-y divide-gray-200">
                                @forelse($arrayofInfo['recentAnimalReports'] as $report)
                                <li class="py-3 md:py-4">
                                    <div class="flex items-center">
                                        <img class="w-10 h-10 md:w-12 md:h-12 rounded-full object-cover" 
                                             src="{{ asset('storage/' . $report->photo) }}" alt="Report Photo">
                                        <div class="ml-3 md:ml-4 flex-1 min-w-0">
                                            <p class="text-xs md:text-sm font-medium text-gray-900 truncate">{{ $report->description }}</p>
                                            <p class="text-xs text-gray-500 truncate">Location: {{ $report->location }} • {{ \Carbon\Carbon::parse($report->created_at)->diffForHumans() }}</p>
                                        </div>
                                        <span class="ml-2 px-2 py-1 text-xs font-semibold 
                                            @if($report->status == 'critical') text-red-800 bg-red-100 
                                            @elseif($report->status == 'pending') text-yellow-800 bg-yellow-100 
                                            @elseif($report->status == 'in-progress') text-blue-800 bg-blue-100 
                                            @else text-green-800 bg-green-100 @endif 
                                            rounded-full whitespace-nowrap">
                                            {{ ucfirst($report->status) }}
                                        </span>
                                    </div>
                                </li>
                                @empty
                                <li class="py-3 md:py-4 text-center text-gray-500">No recent reports found</li>
                                @endforelse
                            </ul>
                            <div class="mt-4 text-center">
                                <a href="#" class="text-xs md:text-sm font-medium text-emerald-600 hover:text-emerald-500">View all reports</a>
                            </div>
                        </div>
                    </div>


                    <div class="bg-white rounded-lg shadow">
                        <div class="px-4 py-3 md:px-6 md:py-4 border-b">
                            <h3 class="text-base md:text-lg font-semibold text-gray-800">Recent Adoption Requests</h3>
                        </div>
                        <div class="p-4 md:p-6">
                            <ul class="divide-y divide-gray-200">
                                @forelse($arrayofInfo['recentAdoptionRequestWithAnimal'] as $adoption)
                                <li class="py-3 md:py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 relative">
                                            <img class="w-10 h-10 md:w-12 md:h-12 rounded-full object-cover" 
                                                 src="/placeholder.svg?height=48&width=48" alt="User">
                                            @if(isset($adoption->animal))
                                            <img class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full border-2 border-white object-cover" 
                                                 src="{{ asset('storage/' . $adoption->animal->photoAnimal) }}" alt="Animal">
                                            @endif
                                        </div>
                                        <div class="ml-3 md:ml-4 flex-1 min-w-0">
                                            <p class="text-xs md:text-sm font-medium text-gray-900 truncate">
                                                Request for Animal #{{ $adoption->animalId }}
                                                @if(isset($adoption->animal))
                                                ({{ $adoption->animal->name }})
                                                @endif
                                            </p>
                                            <p class="text-xs text-gray-500 truncate">
                                                From: Adopter #{{ $adoption->adopterId }} • {{ \Carbon\Carbon::parse($adoption->created_at)->diffForHumans() }}
                                            </p>
                                        </div>
                                        <span class="ml-2 px-2 py-1 text-xs font-semibold 
                                            @if($adoption->status == 'pending') text-yellow-800 bg-yellow-100 
                                            @elseif($adoption->status == 'approved') text-green-800 bg-green-100 
                                            @elseif($adoption->status == 'declined') text-red-800 bg-red-100 
                                            @else text-blue-800 bg-blue-100 @endif 
                                            rounded-full whitespace-nowrap">
                                            {{ ucfirst($adoption->status) }}
                                        </span>
                                    </div>
                                </li>
                                @empty
                                <li class="py-3 md:py-4 text-center text-gray-500">No recent adoption requests found</li>
                                @endforelse
                            </ul>
                            <div class="mt-4 text-center">
                                <a href="#" class="text-xs md:text-sm font-medium text-emerald-600 hover:text-emerald-500">View all adoption requests</a>
                            </div>
                        </div>
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
        });
    </script>
</body>
</html>