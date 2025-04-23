<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RescueSpot - Profile</title>
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
    </style>
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

            // Handling image uploads
            const profilePhotoInput = document.getElementById('profile-photo-input');
            const backgroundPhotoInput = document.getElementById('background-photo-input');
            const profilePhotoBtn = document.getElementById('change-profile-photo');
            const backgroundPhotoBtn = document.getElementById('change-background-photo');
            
            profilePhotoBtn.addEventListener('click', function() {
                profilePhotoInput.click();
            });
            
            backgroundPhotoBtn.addEventListener('click', function() {
                backgroundPhotoInput.click();
            });
            
            profilePhotoInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('profile-photo').src = e.target.result;
                        // Here you would typically send the file to your server
                        showToast('Profile photo updated successfully!');
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
            
            backgroundPhotoInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('background-photo').style.backgroundImage = `url(${e.target.result})`;
                        // Here you would typically send the file to your server
                        showToast('Background photo updated successfully!');
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Edit profile functionality
            const editProfileBtn = document.getElementById('edit-profile-btn');
            const saveProfileBtn = document.getElementById('save-profile-btn');
            const cancelEditBtn = document.getElementById('cancel-edit-btn');
            const profileInfoSection = document.getElementById('profile-info-section');
            const profileEditSection = document.getElementById('profile-edit-section');
            
            editProfileBtn.addEventListener('click', function() {
                profileInfoSection.classList.add('hidden');
                profileEditSection.classList.remove('hidden');
            });
            
            cancelEditBtn.addEventListener('click', function() {
                profileInfoSection.classList.remove('hidden');
                profileEditSection.classList.add('hidden');
            });
            
            saveProfileBtn.addEventListener('click', function() {
                // Here you would typically send the form data to your server
                const formData = new FormData(document.getElementById('edit-profile-form'));
                
                // Update the profile info with the edited data
                document.getElementById('profile-name').textContent = formData.get('name');
                document.getElementById('profile-bio').textContent = formData.get('bio') || 'No bio added yet';
                document.getElementById('profile-birthday').textContent = formData.get('birthday') || 'Not specified';
                document.getElementById('profile-phone').textContent = formData.get('phone') || 'Not specified';
                document.getElementById('profile-address').textContent = formData.get('address') || 'Not specified';
                document.getElementById('profile-city').textContent = formData.get('city') || 'Not specified';
                document.getElementById('profile-country').textContent = formData.get('country') || 'Not specified';
                document.getElementById('profile-relationship').textContent = formData.get('relationship_status') || 'Not specified';
                
                profileInfoSection.classList.remove('hidden');
                profileEditSection.classList.add('hidden');
                
                showToast('Profile updated successfully!');
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

            // Tab functionality for profile sections
            const tabButtons = document.querySelectorAll('[data-tab-target]');
            const tabContents = document.querySelectorAll('[data-tab-content]');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const target = document.querySelector(button.dataset.tabTarget);
                    
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    
                    tabButtons.forEach(btn => {
                        btn.classList.remove('text-primary-600', 'border-primary-600');
                        btn.classList.add('text-gray-500', 'border-transparent');
                    });
                    
                    target.classList.remove('hidden');
                    button.classList.remove('text-gray-500', 'border-transparent');
                    button.classList.add('text-primary-600', 'border-primary-600');
                });
            });

            // Preview functions for profile photo and background photo
            window.previewProfilePhoto = function(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('profile-photo-preview').src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            };

            window.previewBackgroundPhoto = function(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('background-photo-preview').src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            };
        });
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Toast Notification -->
    <div id="toast" class="hidden fixed top-5 right-5 z-50 items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-xl shadow-lg border border-gray-100" role="alert">
        <div class="inline-flex flex-shrink-0 justify-center items-center w-10 h-10 text-secondary-500 bg-secondary-100 rounded-full">
            <i class="fas fa-check"></i>
        </div>
        <div id="toast-message" class="ml-3 text-sm font-medium">Profile updated successfully!</div>
        <button id="close-toast" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 items-center justify-center">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Top Navigation -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="#" class="flex items-center space-x-2">
                        <div class="profile-gradient text-white p-2 rounded-lg">
                            <i class="fas fa-paw text-xl"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-800">RescueSpot</span>
                    </a>
                </div>

                <!-- Main Navigation - Desktop -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="HomeUser" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Home</a>
                    <a href="{{ route('user.UserAdoptions.index') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Adoption</a>
                    <a href="{{ route('user.UserReports.index') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Reports</a>

                </div>

                <!-- Right Side Menu -->
                <div class="flex items-center space-x-4">
                    <button class="hidden md:block bg-gradient-to-r from-secondary-500 to-primary-500 hover:from-secondary-600 hover:to-primary-600 text-white py-2 px-4 rounded-lg shadow-md transition transform hover:scale-105 hover:shadow-lg">
                        <a href="{{ route('user.UserReports.index') }}" class="text-white text-sm font-medium">Report an animal</a>
                    </button>
                    
                    <!-- Notifications -->


                    
                    <!-- Profile Dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <button type="button" id="profile-btn" class="flex text-sm bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150" aria-expanded="false" aria-haspopup="true">
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-primary-500" 
                                src="{{ $userinfo->profilePhoto ? asset('storage/' . $userinfo->profilePhoto) : asset('images/defaultImageProfile.jpg') }}" 
                                alt="Profile">
                            </button>
                        </div>
                        <div id="profile-dropdown"
                            class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 overflow-hidden"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">

                            <a href="Profile"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 transition-colors duration-150"
                            role="menuitem">
                                <i class="far fa-user text-primary-500"></i> My profile
                            </a>

                            <a href="#"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 transition-colors duration-150"
                            role="menuitem">
                                <i class="fas fa-cog text-primary-500"></i> Settings
                            </a>

                            <a href="#"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 transition-colors duration-150"
                            role="menuitem">
                                <i class="fas fa-heart text-primary-500"></i> My favorites
                            </a>

                            <a href="#"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 transition-colors duration-150"
                            role="menuitem">
                                <i class="fas fa-history text-primary-500"></i> History
                            </a>

                            <div class="border-t border-gray-100 my-1"></div>

                            <form method="POST" action="{{ route('user.logout') }}">
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
                <a href="HomeUser" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Home</a>
                <a href="" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-primary-600 to-secondary-600">Profile</a>
                <a href="{{ route('user.UserAdoptions.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Adoption</a>
                <a href="{{ route('user.UserReports.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Reports</a>

                <button class="mt-2 w-full flex justify-center items-center bg-gradient-to-r from-secondary-500 to-primary-500 hover:from-secondary-600 hover:to-primary-600 text-white py-2 px-4 rounded-lg shadow-md transition duration-150">
                    <a href="{{ route('user.UserReports.index') }}" class="text-white text-sm font-medium">Report an animal</a>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16 pb-12">
        <!-- Profile Header Section -->
        <div class="relative">
            <!-- Background Image -->
            <div id="background-photo" 
                class="h-72 md:h-96 bg-cover bg-center relative" 
                style="background-image: url('{{ $userinfo->backgroundProfile ? asset('storage/' . $userinfo->backgroundProfile) : asset('images/backgrounddesfaultimage.jpg') }}');">
                
                <!-- Change Background Photo Button -->
                <button id="change-background-photo" class="absolute bottom-4 right-4 bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-700 py-2 px-4 rounded-lg shadow-md flex items-center transition duration-150 hover:shadow-lg">
                    <i class="fas fa-camera mr-2 text-primary-500"></i>
                    Change Cover
                </button>
                <input type="file" id="background-photo-input" class="hidden" accept="image/*">
                
                <!-- Decorative Elements -->
                <div class="absolute top-0 left-0 right-0 bottom-0 bg-gradient-to-b from-transparent to-black opacity-40 pointer-events-none"></div>
                <div class="absolute top-10 left-10 bg-primary-500 p-2 rounded-full shadow-lg animate-float opacity-70">
                    <i class="fas fa-paw text-white"></i>
                </div>
                <div class="absolute bottom-20 right-20 bg-secondary-500 p-2 rounded-full shadow-lg animate-float-delay-1 opacity-70">
                    <i class="fas fa-paw text-white"></i>
                </div>
                <div class="absolute top-1/3 right-1/4 bg-primary-400 p-1.5 rounded-full shadow-lg animate-float-delay-2 opacity-50">
                    <i class="fas fa-paw text-white text-sm"></i>
                </div>
            </div>

            <!-- Profile Photo -->
            <div class="absolute -bottom-20 left-1/2 transform -translate-x-1/2 md:left-10 md:translate-x-0">
                <div class="relative group">
                    <div class="absolute inset-0 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 animate-pulse blur-md opacity-70 group-hover:opacity-100 transition duration-300"></div>
                    <img id="profile-photo" 
                        src="{{ $userinfo->profilePhoto ? asset('storage/' . $userinfo->profilePhoto) : asset('images/defaultImageProfile.jpg') }}" 
                        alt="Profile Photo" 
                        class="relative w-40 h-40 rounded-full border-4 border-white shadow-xl object-cover"> 
                    <button id="change-profile-photo" class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <i class="fas fa-camera text-white text-2xl"></i>
                    </button>
                    <input type="file" id="profile-photo-input" class="hidden" accept="image/*">
                </div>
            </div>
        </div>
        
        <!-- Profile Content -->
        <div class="container mx-auto px-4 mt-24">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-start mb-8">
                    <div class="mb-4 md:mb-0">
                        <h1 id="profile-name" class="text-3xl font-bold text-gray-800 mb-1">{{$userinfo->name}}</h1>
                        <p class="text-gray-600 flex items-center">
                            <i class="fas fa-heart text-red-500 mr-2"></i>
                            Animal Lover | RescueSpot Member
                        </p>
                    </div>
                    
                    <div class="flex space-x-3">
                        <button id="edit-profile-btn" class="bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white py-2.5 px-5 rounded-lg shadow-md flex items-center transition duration-150 hover:shadow-lg">
                            <i class="fas fa-user-edit mr-2"></i>
                            Edit Profile
                        </button>
                        <button class="bg-gradient-to-r from-secondary-500 to-secondary-600 hover:from-secondary-600 hover:to-secondary-700 text-white py-2.5 px-5 rounded-lg shadow-md flex items-center transition duration-150 hover:shadow-lg">
                            <i class="fas fa-share-alt mr-2"></i>
                            Share
                        </button>
                    </div>
                </div>
                
                <!-- Profile Navigation Tabs -->
                <div class="relative border-b border-gray-200 mb-8">
                    <div class="flex flex-wrap -mb-px">
                        <button data-tab-target="#tab-about" class="text-primary-600 border-b-2 border-primary-600 inline-block p-4 rounded-t-lg font-medium transition duration-150">
                            <i class="fas fa-user mr-2"></i>
                            About
                        </button>
                        <button data-tab-target="#tab-reports" class="text-gray-500 border-b-2 border-transparent hover:text-primary-500 hover:border-primary-300 inline-block p-4 rounded-t-lg font-medium transition duration-150">
                            <i class="fas fa-clipboard-list mr-2"></i>
                            Reports
                        </button>
                        <button data-tab-target="#tab-adoptions" class="text-gray-500 border-b-2 border-transparent hover:text-primary-500 hover:border-primary-300 inline-block p-4 rounded-t-lg font-medium transition duration-150">
                            <i class="fas fa-heart mr-2"></i>
                            Adoptions
                        </button>
                    </div>
                </div>
                
                <!-- Tab Contents -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8 border border-gray-100">
                    <!-- About Tab Content -->
                    <div id="tab-about" data-tab-content class="p-8">
                        <!-- Profile Info Display Section -->
                        <div id="profile-info-section">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                <span class="profile-gradient w-10 h-10 rounded-full flex items-center justify-center mr-3 text-white shadow-md">
                                    <i class="fas fa-user"></i>
                                </span>
                                Profile Information
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-info-circle text-primary-500 mr-2"></i>
                                        About Me
                                    </h3>
                                    <p id="profile-bio" class="text-gray-600 mb-6 bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        @if (empty($userinfo->bio))
                                            <span class="text-gray-400 italic">Not specified</span>
                                        @else
                                            {{ $userinfo->bio }}
                                        @endif
                                    </p>                                    
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-address-card text-primary-500 mr-2"></i>
                                        Basic Information
                                    </h3>
                                    <div class="space-y-3 bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <div class="flex items-center">
                                            <span class="w-32 text-gray-500 flex items-center"><i class="fas fa-envelope text-primary-400 mr-2"></i>Email:</span>
                                            <span class="text-gray-700 font-medium">{{$userinfo->email}}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="w-32 text-gray-500 flex items-center"><i class="fas fa-birthday-cake text-primary-400 mr-2"></i>Birthday:</span>
                                            <span id="profile-birthday" class="text-gray-700">
                                                @if ($userinfo->birthday == null)
                                                    <span class="text-gray-400 italic">Not specified</span>
                                                @else
                                                    {{ $userinfo->birthday }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="w-32 text-gray-500 flex items-center"><i class="fas fa-heart text-primary-400 mr-2"></i>Status:</span>
                                                <span id="profile-relationship" class="text-gray-700">
                                                    @if ($userinfo->relationship_status == null)
                                                        <span class="text-gray-400 italic">Not specified</span>
                                                    @else
                                                        {{ $userinfo->relationship_status }}
                                                    @endif
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-phone-alt text-primary-500 mr-2"></i>
                                        Contact Information
                                    </h3>
                                    <div class="space-y-3 bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <div class="flex items-center">
                                            <span class="w-32 text-gray-500 flex items-center"><i class="fas fa-phone text-primary-400 mr-2"></i>Phone:</span>
                                            <span id="profile-phone" class="text-gray-700">
                                                @if (empty($userinfo->phone))
                                                    <span class="text-gray-400 italic">No phone number added yet</span>
                                                @else
                                                    {{ $userinfo->phone }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="w-32 text-gray-500 flex items-center"><i class="fas fa-map-marker-alt text-primary-400 mr-2"></i>Address:</span>
                                            <span id="profile-address" class="text-gray-700">
                                                @if (empty($userinfo->address))
                                                    <span class="text-gray-400 italic">Location not shared yet 🌍</span>
                                                @else
                                                    {{ $userinfo->address }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="w-32 text-gray-500 flex items-center"><i class="fas fa-city text-primary-400 mr-2"></i>City:</span>
                                            <span class="text-gray-700">
                                                @if (empty($userinfo->city))
                                                    <span class="text-gray-400 italic">Not shared yet 🏙️</span>
                                                @else
                                                    {{ $userinfo->city }}
                                                @endif
                                            </span>               
                                        </div>
                                        <div class="flex items-center">
                                            <span class="w-32 text-gray-500 flex items-center"><i class="fas fa-globe text-primary-400 mr-2"></i>Country:</span>
                                            <span id="profile-country" class="text-gray-700">
                                                @if (empty($userinfo->country))
                                                    <span class="text-gray-400 italic">Somewhere on the map 🗺️</span>
                                                @else
                                                    {{ $userinfo->country }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-4 flex items-center">
                                        <i class="fas fa-share-alt text-primary-500 mr-2"></i>
                                        Social Media
                                    </h3>
                                    <div class="flex space-x-4 bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <a href="#" class="text-blue-600 hover:text-blue-800 transition duration-150 transform hover:scale-110 p-2">
                                            <i class="fab fa-facebook-f text-xl"></i>
                                        </a>
                                        <a href="#" class="text-blue-400 hover:text-blue-600 transition duration-150 transform hover:scale-110 p-2">
                                            <i class="fab fa-twitter text-xl"></i>
                                        </a>
                                        <a href="#" class="text-pink-600 hover:text-pink-800 transition duration-150 transform hover:scale-110 p-2">
                                            <i class="fab fa-instagram text-xl"></i>
                                        </a>
                                        <a href="#" class="text-blue-700 hover:text-blue-900 transition duration-150 transform hover:scale-110 p-2">
                                            <i class="fab fa-linkedin-in text-xl"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Statistics Cards -->
                            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                <div class="bg-gradient-to-br from-primary-50 to-primary-100 p-6 rounded-xl border border-primary-200 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                                    <div class="flex items-center">
                                        <div class="p-3 bg-primary-500 text-white rounded-lg mr-4 shadow-md">
                                            <i class="fas fa-clipboard-list"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-primary-600 font-medium">Reports</p>
                                            <p class="text-2xl font-bold text-gray-800">
                                                {{ $reportsCount > 0 ? $reportsCount : '0' }}
                                                @if($reportsCount == 0)
                                                    <span class="text-sm font-normal text-gray-500">No reports yet 🐾</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-br from-secondary-50 to-secondary-100 p-6 rounded-xl border border-secondary-200 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                                    <div class="flex items-center">
                                        <div class="p-3 bg-secondary-500 text-white rounded-lg mr-4 shadow-md">
                                            <i class="fas fa-heart"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-secondary-600 font-medium">Adoptions</p>
                                            <p class="text-2xl font-bold text-gray-800">
                                                {{ $adoptionCount > 0 ? $adoptionCount : '0' }}
                                                @if($adoptionCount == 0)
                                                    <span class="text-sm font-normal text-gray-500">No adoptions yet 🐾</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-6 rounded-xl border border-amber-200 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                                    <div class="flex items-center">
                                        <div class="p-3 bg-amber-500 text-white rounded-lg mr-4 shadow-md">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-amber-600 font-medium">Followers</p>
                                            <p class="text-2xl font-bold text-gray-800">
                                                {{ $followersCount > 0 ? $followersCount : '0' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl border border-purple-200 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                                    <div class="flex items-center">
                                        <div class="p-3 bg-purple-500 text-white rounded-lg mr-4 shadow-md">
                                            <i class="fas fa-hand-holding-heart"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-purple-600 font-medium">Donations</p>
                                            <p class="text-2xl font-bold text-gray-800">0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Profile Edit Form -->
                        <div id="profile-edit-section" class="hidden">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                                    <span class="profile-gradient w-10 h-10 rounded-full flex items-center justify-center mr-3 text-white shadow-md">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                    Edit Profile
                                </h2>
                                <div class="flex space-x-3">
                                    <button id="cancel-edit-btn" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2.5 px-5 rounded-lg shadow-sm flex items-center transition duration-150">
                                        <i class="fas fa-times mr-2"></i>
                                        Cancel
                                    </button>
                                    <button id="save-profile-btn" type="submit" form="edit-profile-form" class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white py-2.5 px-5 rounded-lg shadow-md flex items-center transition duration-150 hover:shadow-lg">
                                        <i class="fas fa-save mr-2"></i>
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                            
                            <form id="edit-profile-form" action="{{ route('user.editProfile') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                @csrf
                                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-image text-primary-500 mr-2"></i>
                                        Profile Images
                                    </h3>
                                    
                                    <!-- Profile Photo Upload -->
                                    <div class="mb-6">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Photo</label>
                                        <div class="flex items-center space-x-4">
                                            <div class="relative group h-24 w-24">
                                                <div class="absolute inset-0 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 animate-pulse blur-md opacity-70 group-hover:opacity-100 transition duration-300"></div>
                                                <img id="profile-photo-preview" 
                                                    src="{{ $userinfo->profilePhoto ? asset('storage/' . $userinfo->profilePhoto) : asset('images/defaultImageProfile.jpg') }}" 
                                                    alt="Profile Photo" 
                                                    class="relative h-24 w-24 rounded-full border-2 border-white object-cover">
                                                <div class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <label for="profile_photo" class="cursor-pointer text-white p-2">
                                                        <i class="fas fa-camera text-xl"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <input type="file" id="profile_photo" name="profilePhoto" class="hidden" accept="image/*" onchange="previewProfilePhoto(this)">
                                                <label for="profile_photo" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg shadow-sm text-sm cursor-pointer inline-block transition duration-150">
                                                    <i class="fas fa-upload mr-1"></i> Choose Photo
                                                </label>
                                                <p class="text-xs text-gray-500 mt-1">JPG, PNG or GIF (Max. 2MB)</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Background Photo Upload -->
                                    <div class="mb-6">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Background Image</label>
                                        <div class="relative bg-gray-100 rounded-lg overflow-hidden h-32 mb-2">
                                            <img id="background-photo-preview" 
                                                src="{{ $userinfo->backgroundProfile ? asset('storage/' . $userinfo->backgroundProfile) : asset('images/backgrounddesfaultimage.jpg') }}" 
                                                alt="Background" 
                                                class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                                <label for="background_photo" class="cursor-pointer text-white p-2">
                                                    <i class="fas fa-camera text-2xl"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <div>
                                            <input type="file" id="background_photo" name="backgroundProfile" class="hidden" accept="image/*" onchange="previewBackgroundPhoto(this)">
                                            <label for="background_photo" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg shadow-sm text-sm cursor-pointer inline-block transition duration-150">
                                                <i class="fas fa-upload mr-1"></i> Choose Background
                                            </label>
                                            <p class="text-xs text-gray-500 mt-1">JPG, PNG or GIF (Max. 2MB)</p>
                                        </div>
                                    </div>

                                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-user text-primary-500 mr-2"></i>
                                        Personal Information
                                    </h3>
                                    
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                        <input type="text" id="name" name="name" value="{{ $userinfo->name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                        <input type="email" id="email" name="email" value="{{ $userinfo->email }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 bg-gray-100" readonly disabled>
                                        <p class="text-xs text-gray-500 mt-1">Email cannot be changed</p>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="birthday" class="block text-sm font-medium text-gray-700 mb-1">Birthday</label>
                                        <input type="date" id="birthday" name="birthday" value="{{ $userinfo->birthday }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="relationship" class="block text-sm font-medium text-gray-700 mb-1">Relationship Status</label>
                                        <select id="relationship" name="relationship_status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                                            <option value="Single" {{ $userinfo->relationship == 'Single' ? 'selected' : '' }}>Single</option>
                                            <option value="In a Relationship" {{ $userinfo->relationship == 'In a Relationship' ? 'selected' : '' }}>In a Relationship</option>
                                            <option value="Married" {{ $userinfo->relationship == 'Married' ? 'selected' : '' }}>Married</option>
                                            <option value="Prefer not to say" {{ $userinfo->relationship == 'Prefer not to say' ? 'selected' : '' }}>Prefer not to say</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                                        <textarea id="bio" name="bio" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">{{ $userinfo->bio }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-address-book text-primary-500 mr-2"></i>
                                        Contact Information
                                    </h3>
                                    
                                    <div class="mb-4">
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                        <input type="tel" id="phone" name="phone" value="{{ $userinfo->phone }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                        <input type="text" id="address" name="address" value="{{ $userinfo->address }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input type="text" id="city" name="city" value="{{ $userinfo->city }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                        <input type="text" id="country" name="country" value="{{ $userinfo->country }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                                    </div>
                                    
                                    <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-4 flex items-center">
                                        <i class="fas fa-share-alt text-primary-500 mr-2"></i>
                                        Social Media Links
                                    </h3>
                                    
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="mb-4">
                                            <label for="facebook" class="block text-sm font-medium text-gray-700 mb-1">
                                                <i class="fab fa-facebook-f text-blue-600 mr-2"></i>Facebook
                                            </label>
                                            <input type="url" id="facebook" name="facebook" value="{{ $userinfo->facebook }}" placeholder="Facebook profile URL" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label for="twitter" class="block text-sm font-medium text-gray-700 mb-1">
                                                <i class="fab fa-twitter text-blue-400 mr-2"></i>Twitter
                                            </label>
                                            <input type="url" id="twitter" name="twitter" value="{{ $userinfo->twitter }}" placeholder="Twitter profile URL" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label for="instagram" class="block text-sm font-medium text-gray-700 mb-1">
                                                <i class="fab fa-instagram text-pink-600 mr-2"></i>Instagram
                                            </label>
                                            <input type="url" id="instagram" name="instagram" value="{{ $userinfo->instagram }}" placeholder="Instagram profile URL" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-1">
                                                <i class="fab fa-linkedin-in text-blue-700 mr-2"></i>LinkedIn
                                            </label>
                                            <input type="url" id="linkedin" name="linkedin" value="{{ $userinfo->linkedin }}" placeholder="LinkedIn profile URL" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Reports Tab Content -->
                    <div id="tab-reports" data-tab-content class="p-8 hidden">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <span class="profile-gradient w-10 h-10 rounded-full flex items-center justify-center mr-3 text-white shadow-md">
                                <i class="fas fa-clipboard-list"></i>
                            </span>
                            My Reports
                        </h2>
                        
                        <div class="max-h-[70vh] overflow-y-auto pr-2 scrollbar-hide">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @if ($reportsCount > 0)
                                    <!-- Loop through the reports and display each one -->
                                    @foreach ($reportsUser as $report)
                                        <div class="bg-white rounded-xl overflow-hidden shadow-md border border-gray-100 transition transform hover:shadow-lg hover:-translate-y-2 duration-300">
                                            <div class="relative">
                                                <img src="{{ $report->photo ? asset('storage/' . $report->photo) : '/api/placeholder/400/250' }}" alt="Reported animal" class="w-full h-48 object-cover">
                                                <div class="absolute top-3 left-3 
                                                    @if($report->status == 'okay')
                                                        bg-green-500
                                                    @elseif($report->status == 'injured')
                                                        bg-orange-500
                                                    @elseif($report->status == 'critical')
                                                        bg-red-500
                                                    @else
                                                        bg-gray-500
                                                    @endif
                                                    text-white text-xs px-3 py-1 rounded-full shadow-md">
                                                    {{$report->status}}
                                                </div>              
                                                <div class="absolute top-3 right-3 bg-primary-500 text-white text-xs px-3 py-1 rounded-full shadow-md">{{ $report->created_at->diffForHumans() }}</div>
                                            </div>
                                            <div class="p-5">
                                                <div class="flex justify-between items-start mb-3">
                                                    <h3 class="font-semibold text-gray-800 text-lg">{{ $report->title }}</h3>
                                                    <span class="text-xs px-2 py-1 rounded-full
                                                    @if($report->status == 'okay')
                                                        bg-green-100 text-green-800
                                                    @elseif($report->status == 'injured')
                                                        bg-orange-100 text-orange-800
                                                    @elseif($report->status == 'critical')
                                                        bg-red-100 text-red-800
                                                    @else
                                                        bg-gray-100 text-gray-800
                                                    @endif
                                                ">{{ $report->status }}</span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-4">{{ Str::limit($report->description, 100) }}</p>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm flex items-center"><i class="fas fa-map-marker-alt text-primary-500 mr-1"></i> {{ $report->location }}</span>
                                                    <a href="#" class="text-primary-600 hover:text-primary-800 text-sm font-medium flex items-center transition duration-150">
                                                        View details
                                                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <!-- Display message if there are no reports -->
                                    <div class="col-span-full flex flex-col items-center justify-center py-12 bg-gray-50 rounded-xl border border-gray-200">
                                        <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-clipboard-list text-primary-500 text-2xl"></i>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-800 mb-2">No reports yet</h3>
                                        <p class="text-gray-500 text-center mb-6">You haven't reported any animals yet.</p>
                                        <a href="{{ route('user.UserReports.index') }}" class="bg-primary-600 hover:bg-primary-700 text-white py-2 px-6 rounded-lg shadow-md inline-flex items-center transition duration-150">
                                            <i class="fas fa-plus mr-2"></i>
                                            Create Your First Report
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        @if ($reportsCount > 0)
                            <div class="mt-8 text-center">
                                <a href="{{ route('user.UserReports.index') }}" class="bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white py-3 px-8 rounded-lg shadow-md inline-flex items-center transition duration-150 hover:shadow-lg">
                                    <i class="fas fa-plus mr-2"></i>
                                    Create New Report
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Adoptions Tab Content -->
                    <div id="tab-adoptions" data-tab-content class="p-8 hidden">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <span class="profile-gradient w-10 h-10 rounded-full flex items-center justify-center mr-3 text-white shadow-md">
                                <i class="fas fa-heart"></i>
                            </span>
                            My Adoptions
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @if ($adoptionCount > 0)
                                <!-- Loop through the adoptions and display each one -->
                                @foreach ($adoptions as $adoption)
                                    <div class="bg-white rounded-xl overflow-hidden shadow-md border border-gray-100 transition transform hover:shadow-lg hover:-translate-y-2 duration-300">
                                        <div class="relative">
                                            <img src="{{ $adoption->animal && $adoption->animal->image ? asset('storage/' . $adoption->animal->image) : '/api/placeholder/400/250' }}" 
                                                alt="Adopted animal" 
                                                class="w-full h-48 object-cover">
                                            <div class="absolute top-3 right-3 bg-green-500 text-white text-xs px-3 py-1 rounded-full shadow-md">Adopted</div>
                                        </div>
                                        <div class="p-5">
                                            <div class="flex justify-between items-start mb-3">
                                                <h3 class="font-semibold text-gray-800 text-lg">{{ $adoption->animal->name ?? 'Unknown' }}</h3>
                                                <div class="flex space-x-1">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <i class="fas fa-star {{ $i < ($adoption->rating ?? 0) ? 'text-yellow-400' : 'text-gray-300' }} text-sm"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="flex flex-wrap gap-2 mb-3">
                                                <span class="bg-primary-100 text-primary-800 text-xs px-2 py-1 rounded-full">{{ $adoption->animal->type ?? 'N/A' }}</span>
                                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">{{ $adoption->animal->age ?? '?' }} years</span>
                                                <span class="bg-secondary-100 text-secondary-800 text-xs px-2 py-1 rounded-full">{{ $adoption->animal->breed ?? 'N/A' }}</span>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-4">{{ Str::limit($adoption->animal->description ?? 'No description available.', 100) }}</p>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm flex items-center text-gray-500">
                                                    <i class="far fa-calendar-alt text-primary-500 mr-1"></i>
                                                    {{ \Carbon\Carbon::parse($adoption->requestDate)->format('M d, Y') }}
                                                </span>
                                                <a href="#" class="text-primary-600 hover:text-primary-800 text-sm font-medium flex items-center transition duration-150">
                                                    View profile
                                                    <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Display message if there are no adoptions -->
                                <div class="col-span-full flex flex-col items-center justify-center py-12 bg-gray-50 rounded-xl border border-gray-200">
                                    <div class="w-20 h-20 bg-secondary-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-heart text-secondary-500 text-2xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-800 mb-2">No adoptions yet</h3>
                                    <p class="text-gray-500 text-center mb-6">You haven't adopted any animals yet.</p>
                                    <a href="#" class="bg-gradient-to-r from-secondary-600 to-primary-600 hover:from-secondary-700 hover:to-primary-700 text-white py-2 px-6 rounded-lg shadow-md inline-flex items-center transition duration-150 hover:shadow-lg">
                                        <i class="fas fa-search mr-2"></i>
                                        Find Animals to Adopt
                                    </a>
                                </div>
                            @endif
                        </div>
                        
                        @if ($adoptionCount > 0)
                            <div class="mt-8 text-center">
                                <a href="#" class="bg-gradient-to-r from-secondary-600 to-primary-600 hover:from-secondary-700 hover:to-primary-700 text-white py-3 px-8 rounded-lg shadow-md inline-flex items-center transition duration-150 hover:shadow-lg">
                                    <i class="fas fa-search mr-2"></i>
                                    Find More Animals to Adopt
                                </a>
                            </div>
                        @endif
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
                        <li><a href="#" class="hover:text-white transition duration-150">Home</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">Report an animal</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">Adoption</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">Messages</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">About us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact us</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-primary-500"></i>
                            contact@rescuespot.com
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-2 text-primary-500"></i>
                            (123) 456-7890
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-primary-500"></i>
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
                            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-r-lg transition duration-150">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-400">
                <p>&copy; 2024 RescueSpot. All rights reserved. | <a href="#" class="text-primary-400 hover:text-white transition duration-150">Privacy Policy</a> | <a href="#" class="text-primary-400 hover:text-white transition duration-150">Terms of Use</a></p>
            </div>
        </div>
    </footer>
</body>
</html>
