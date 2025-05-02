<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>RescueSpot - Shelter Reports</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script>
      tailwind.config = {
          theme: {
              extend: {
                  colors: {
                      primary: {
                          50: '#f0fdf4',
                          100: '#dcfce7',
                          200: '#bbf7d0',
                          300: '#86efac',
                          400: '#4ade80',
                          500: '#22c55e',
                          600: '#16a34a',
                          700: '#15803d',
                          800: '#166534',
                          900: '#14532d',
                      },
                      secondary: {
                          50: '#ecfdf5',
                          100: '#d1fae5',
                          200: '#a7f3d0',
                          300: '#6ee7b7',
                          400: '#34d399',
                          500: '#10b981',
                          600: '#059669',
                          700: '#047857',
                          800: '#065f46',
                          900: '#064e3b',
                      },
                      emerald: {
                          50: '#ecfdf5',
                          100: '#d1fae5',
                          200: '#a7f3d0',
                          300: '#6ee7b7',
                          400: '#34d399',
                          500: '#10b981',
                          600: '#059669',
                          700: '#047857',
                          800: '#065f46',
                          900: '#064e3b',
                      }
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
          background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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

      /* Status badge styles - Enhanced */
      .status-badge {
          @apply inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium shadow-sm;
      }
      .status-critical {
          @apply bg-red-100 text-red-800 border border-red-200;
      }
      .status-urgent {
          @apply bg-orange-100 text-orange-800 border border-orange-200;
      }
      .status-normal {
          @apply bg-blue-100 text-blue-800 border border-blue-200;
      }
      .status-low {
          @apply bg-green-100 text-green-800 border border-green-200;
      }
      
      /* Shelter status badge styles - Enhanced */
      .shelter-status-badge {
          @apply inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium shadow-sm;
      }
      .shelter-status-pending {
          @apply bg-yellow-100 text-yellow-800 border border-yellow-200;
      }
      .shelter-status-investigating {
          @apply bg-purple-100 text-purple-800 border border-purple-200;
      }
      .shelter-status-resolved {
          @apply bg-emerald-100 text-emerald-800 border border-emerald-200;
      }
      .shelter-status-rejected {
          @apply bg-gray-100 text-gray-800 border border-gray-200;
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

          // Toast functionality
          window.showToast = function(message) {
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

          // Filter reports by status
          const filterButtons = document.querySelectorAll('[data-filter]');
          const reportCards = document.querySelectorAll('.report-card');
          
          filterButtons.forEach(button => {
              button.addEventListener('click', () => {
                  const filter = button.dataset.filter;
                  
                  // Update active filter button
                  filterButtons.forEach(btn => {
                      btn.classList.remove('bg-emerald-100', 'text-emerald-800');
                      btn.classList.add('bg-gray-100', 'text-gray-700');
                  });
                  button.classList.remove('bg-gray-100', 'text-gray-700');
                  button.classList.add('bg-emerald-100', 'text-emerald-800');
                  
                  // Filter report cards
                  reportCards.forEach(card => {
                      if (filter === 'all' || card.dataset.status === filter) {
                          card.classList.remove('hidden');
                      } else {
                          card.classList.add('hidden');
                      }
                  });

                  // Update count
                  updateVisibleCount();
              });
          });

          // Filter reports by shelter status
          const shelterFilterButtons = document.querySelectorAll('[data-shelter-filter]');
          
          shelterFilterButtons.forEach(button => {
              button.addEventListener('click', () => {
                  const filter = button.dataset.shelterFilter;
                  
                  // Update active filter button
                  shelterFilterButtons.forEach(btn => {
                      btn.classList.remove('bg-emerald-100', 'text-emerald-800');
                      btn.classList.add('bg-gray-100', 'text-gray-700');
                  });
                  button.classList.remove('bg-gray-100', 'text-gray-700');
                  button.classList.add('bg-emerald-100', 'text-emerald-800');
                  
                  // Filter report cards
                  reportCards.forEach(card => {
                      if (filter === 'all' || card.dataset.shelterStatus === filter) {
                          card.classList.remove('hidden');
                      } else {
                          card.classList.add('hidden');
                      }
                  });

                  // Update count
                  updateVisibleCount();
              });
          });

          // Search functionality
          const searchInput = document.getElementById('report-search');
          
          searchInput.addEventListener('input', function() {
              const searchTerm = this.value.toLowerCase();
              
              reportCards.forEach(card => {
                  const location = card.dataset.location.toLowerCase();
                  const description = card.dataset.description.toLowerCase();
                  
                  if (location.includes(searchTerm) || description.includes(searchTerm)) {
                      card.classList.remove('hidden');
                  } else {
                      card.classList.add('hidden');
                  }
              });

              // Update count
              updateVisibleCount();
          });

          // Function to update visible count
          function updateVisibleCount() {
              const visibleCount = document.querySelectorAll('.report-card:not(.hidden)').length;
              document.getElementById('visible-count').textContent = visibleCount;
          }

          // Initialize count
          updateVisibleCount();
      });
  </script>
</head>
<body class="bg-gray-50 font-sans">
  <!-- Toast Notification -->
  <div id="toast" class="hidden fixed top-5 right-5 z-50 items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-xl shadow-lg border border-gray-100" role="alert">
      <div class="inline-flex flex-shrink-0 justify-center items-center w-10 h-10 text-emerald-500 bg-emerald-100 rounded-full">
          <i class="fas fa-check"></i>
      </div>
      <div id="toast-message" class="ml-3 text-sm font-medium">Report status updated successfully!</div>
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
                      <div class="bg-emerald-600 text-white p-2 rounded-lg">
                          <i class="fas fa-paw text-xl"></i>
                      </div>
                      <span class="text-xl font-bold text-gray-800">RescueSpot</span>
                      <span class="bg-emerald-100 text-emerald-800 text-xs px-2 py-1 rounded-full">Shelter Portal</span>
                  </a>
              </div>

              <!-- Main Navigation - Desktop -->
              <div class="hidden md:flex items-center space-x-1">
                  <a href="HomeShelter" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 transition duration-150">Dashboard</a>
                  <a href="animalsShelter" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 transition duration-150">Animals</a>
                  <a href="AdoptionsRequests" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 transition duration-150">Adoption Requests</a>
                  <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-emerald-600 bg-emerald-50">Reports</a>
              </div>

              <!-- Right Side Menu -->
              <div class="flex items-center space-x-4">
                  <button class="hidden md:block bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white py-2 px-4 rounded-lg shadow-md transition transform hover:scale-105 hover:shadow-lg">
                      <span class="text-white text-sm font-medium">Add Animal</span>
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
                          class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-emerald-50 transition-colors duration-150"
                          role="menuitem">
                              <i class="far fa-user text-emerald-500"></i> Shelter Profile
                          </a>

                          <a href="#"
                          class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-emerald-50 transition-colors duration-150"
                          role="menuitem">
                              <i class="fas fa-cog text-emerald-500"></i> Settings
                          </a>

                          <a href="#"
                          class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-emerald-50 transition-colors duration-150"
                          role="menuitem">
                              <i class="fas fa-chart-line text-emerald-500"></i> Statistics
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
                  <button type="button" id="mobile-menu-btn" class="md:hidden bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition duration-150" aria-controls="mobile-menu" aria-expanded="false">
                      <i class="fas fa-bars text-xl"></i>
                  </button>
              </div>
          </div>
      </div>

      <!-- Mobile menu, show/hide based on menu state -->
      <div class="md:hidden hidden" id="mobile-menu">
          <div class="px-2 pt-2 pb-3 space-y-1 bg-white shadow-md">
              <a href="HomeShelter" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 transition duration-150">Dashboard</a>
              <a href="animalsShelter" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 transition duration-150">Animals</a>
              <a href="AdoptionsRequests" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 transition duration-150">Adoption Requests</a>
              <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-emerald-600 to-emerald-700">Reports</a>
              <button class="mt-2 w-full flex justify-center items-center bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white py-2 px-4 rounded-lg shadow-md transition duration-150">
                  <span class="text-white text-sm font-medium">Add Animal</span>
              </button>
          </div>
      </div>
  </nav>

  <!-- Main Content -->
  <main class="pt-20 pb-12 px-4 md:px-8">
      <div class="max-w-7xl mx-auto">
          <!-- Page Header -->
          <div class="mb-8">
              <h1 class="text-3xl font-bold text-gray-800 mb-2">Animal Reports</h1>
              <p class="text-gray-600">Review and manage reports of animals in need of rescue or assistance.</p>
          </div>

          <!-- Reports Overview Card -->
          <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8 border border-gray-100">
              <div class="md:flex">
                  <div class="p-6 md:w-1/2">
                      <h2 class="text-xl font-bold text-gray-800 mb-2">Reports Overview</h2>
                      <p class="text-gray-600 mb-4">Manage reports submitted by community members about animals in need.</p>
                      <div class="flex flex-wrap gap-3">
                          <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                              <i class="fas fa-clipboard-list mr-1"></i> <span id="total-count">{{ count($reports) }}</span> Total Reports
                          </span>
                          <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                              <i class="fas fa-exclamation-circle mr-1"></i> <span id="critical-count">{{ $reports->where('status', 'critical')->count() }}</span> Critical
                          </span>
                          <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                              <i class="fas fa-clock mr-1"></i> <span id="pending-count">{{ $reports->where('shelter_status', 'pending')->count() }}</span> Pending
                          </span>
                      </div>
                  </div>
                  <div class="md:w-1/2 bg-emerald-50 flex items-center justify-center">
                      <div class="p-6 text-center">
                          <i class="fas fa-clipboard-check text-emerald-500 text-5xl mb-3"></i>
                          <h3 class="text-lg font-semibold text-gray-800">Report Management</h3>
                          <p class="text-sm text-gray-600 mt-1">Review, validate, and take action on animal reports from the community.</p>
                          <div class="mt-3 flex justify-center space-x-3">
                              <button class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                  <i class="fas fa-chart-bar mr-1"></i> View Statistics
                              </button>
                              <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                  <i class="fas fa-download mr-1"></i> Export Reports
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Filter Controls -->
          <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-6">
              <!-- Search -->
              <div class="relative">
                  <input type="text" id="report-search" placeholder="Search by location or description..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition duration-150">
                  <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                      <i class="fas fa-search"></i>
                  </div>
              </div>

              <!-- Report Status Filter -->
              <div class="flex flex-wrap gap-2">
                  <button data-filter="all" class="py-1 px-3 text-sm rounded-md bg-emerald-100 text-emerald-800 hover:bg-emerald-200">All</button>
                  <button data-filter="critical" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Critical</button>
                  <button data-filter="urgent" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Urgent</button>
                  <button data-filter="normal" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Normal</button>
                  <button data-filter="low" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Low</button>
              </div>

              <!-- Shelter Status Filter -->
              <div class="flex flex-wrap gap-2">
                  <button data-shelter-filter="all" class="py-1 px-3 text-sm rounded-md bg-emerald-100 text-emerald-800 hover:bg-emerald-200">All Statuses</button>
                  <button data-shelter-filter="pending" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Pending</button>
                  <button data-shelter-filter="investigating" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Investigating</button>
                  <button data-shelter-filter="resolved" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Resolved</button>
                  <button data-shelter-filter="rejected" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Rejected</button>
              </div>
          </div>

          <!-- Reports Count -->
          <div class="mb-4 flex items-center justify-between">
              <p class="text-gray-600">Showing <span id="visible-count">{{ count($reports) }}</span> reports</p>
              <div class="flex items-center">
                  <span class="text-gray-600 mr-2">Sort by:</span>
                  <select class="px-3 py-1 bg-white text-gray-700 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                      <option value="newest">Newest First</option>
                      <option value="oldest">Oldest First</option>
                      <option value="critical">Critical First</option>
                      <option value="pending">Pending First</option>
                  </select>
              </div>
          </div>

          <!-- Reports Cards Container (Scrollable) -->
          <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 mb-8">
              <div class="h-[calc(100vh-320px)] overflow-y-auto p-6 scrollbar-thin">
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                      @forelse($reports as $report)
                      <!-- Report Card -->
                      <div class="report-card bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition duration-200"
                           data-status="{{ $report->status }}"
                           data-shelter-status="{{ $report->shelter_status }}"
                           data-location="{{ $report->location }}"
                           data-description="{{ $report->description }}">
                          <div class="relative">
                              <img src="{{ asset('storage/' . $report->photo) }}" alt="Report Photo" class="w-full h-48 object-cover">
                              <div class="absolute top-3 right-3 flex space-x-2">
                                  <span class="status-badge status-{{ $report->status }}">
                                      <i class="fas fa-circle text-xs mr-1"></i> {{ ucfirst($report->status) }}
                                  </span>
                                  <span class="shelter-status-badge shelter-status-{{ $report->shelter_status }}">
                                      <i class="fas fa-tag text-xs mr-1"></i> {{ ucfirst($report->shelter_status) }}
                                  </span>
                              </div>
                              <div class="absolute bottom-3 left-3 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                              </div>
                          </div>
                          
                          <div class="p-4">
                              <div class="mb-3">
                                  <div class="flex items-center justify-between mb-1">
                                      <h3 class="font-semibold text-gray-800">Report from {{ $report->reporter_id }}</h3>
                                      <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($report->created_at)->format('M d, Y') }}</span>
                                  </div>
                                  <div class="flex items-center text-xs text-gray-500">
                                      <i class="fas fa-map-marker-alt mr-1 text-emerald-500"></i>
                                      <span>{{ $report->location }}</span>
                                  </div>
                              </div>
                              
                              <div class="mb-4">
                                  <h4 class="text-sm font-medium text-gray-700 mb-1">Description:</h4>
                                  <p class="text-sm text-gray-600 bg-gray-50 p-2 rounded-md">{{ $report->description }}</p>
                              </div>
                              
                              <div class="mb-4">
                                  <h4 class="text-sm font-medium text-gray-700 mb-1">Report Date:</h4>
                                  <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($report->reportDate)->format('F d, Y') }}</p>
                              </div>
                              
                              <form action="{{ route('shelter.requestStatus') }}" method="POST" class="border-t border-gray-100 pt-4">
                                  @csrf
                                  <input type="hidden" name="report_id" value="{{ $report->id }}">
                                  <div class="mb-3">
                                      <label for="shelter_status_{{ $report->id }}" class="block text-sm font-medium text-gray-700 mb-1">Update Status:</label>
                                      <select id="shelter_status_{{ $report->id }}" name="shelter_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition duration-150 text-sm">
                                          <option value="pending" {{ $report->shelter_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                          <option value="investigating" {{ $report->shelter_status == 'investigating' ? 'selected' : '' }}>Investigating</option>
                                          <option value="resolved" {{ $report->shelter_status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                          <option value="rejected" {{ $report->shelter_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                      </select>
                                  </div>
                                  <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white rounded-lg shadow-md transition duration-150 hover:shadow-lg">
                                      <i class="fas fa-check-circle mr-2"></i> Validate
                                  </button>
                              </form>
                          </div>
                      </div>
                      @empty
                      <!-- Empty State -->
                      <div class="col-span-3 text-center py-10">
                          <div class="text-gray-400 mb-4">
                              <i class="fas fa-clipboard-list text-6xl"></i>
                          </div>
                          <h3 class="text-xl font-semibold text-gray-700 mb-2">No reports found</h3>
                          <p class="text-gray-500 mb-6">There are currently no animal reports to review.</p>
                      </div>
                      @endforelse
                  </div>
              </div>
          </div>

          <!-- Quick Actions -->
          <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
              <h3 class="text-lg font-medium text-gray-800 mb-4">Quick Actions</h3>
              <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                  <button class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-150">
                      <i class="fas fa-check-double text-emerald-600 text-xl mb-2"></i>
                      <span class="text-sm text-gray-700">Mark All Reviewed</span>
                  </button>
                  <button class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-150">
                      <i class="fas fa-download text-emerald-600 text-xl mb-2"></i>
                      <span class="text-sm text-gray-700">Export Reports</span>
                  </button>
                  <button class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-150">
                      <i class="fas fa-chart-pie text-emerald-600 text-xl mb-2"></i>
                      <span class="text-sm text-gray-700">View Analytics</span>
                  </button>
                  <button class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-150">
                      <i class="fas fa-cog text-emerald-600 text-xl mb-2"></i>
                      <span class="text-sm text-gray-700">Report Settings</span>
                  </button>
              </div>
          </div>
      </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white mt-12">
      <div class="container mx-auto px-4 pt-12 pb-8">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
              <div>
                  <div class="flex items-center space-x-2 mb-4">
                      <div class="bg-emerald-600 text-white p-2 rounded-lg">
                          <i class="fas fa-paw text-xl"></i>
                      </div>
                      <span class="text-xl font-bold">RescueSpot</span>
                  </div>
                  <p class="text-gray-400 text-sm mb-4">Platform dedicated to rescuing and adopting abandoned animals.</p>
                  <div class="flex space-x-4">
                      <a href="#" class="text-gray-400 hover:text-white transition duration-150">
                          <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="#" class="text-gray-400 hover:text-white transition duration-150">
                          <i class="fab fa-twitter"></i>
                      </a>
                      <a href="#" class="text-gray-400 hover:text-white transition duration-150">
                          <i class="fab fa-instagram"></i>
                      </a>
                      <a href="#" class="text-gray-400 hover:text-white transition duration-150">
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
                          <i class="fas fa-envelope mr-2 text-emerald-500"></i>
                          contact@rescuespot.com
                      </li>
                      <li class="flex items-center">
                          <i class="fas fa-phone-alt mr-2 text-emerald-500"></i>
                          (123) 456-7890
                      </li>
                      <li class="flex items-center">
                          <i class="fas fa-map-marker-alt mr-2 text-emerald-500"></i>
                          123 Rescue Lane, Animal City
                      </li>
                  </ul>
              </div>
              <div>
                  <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                  <p class="text-gray-400 text-sm mb-4">Receive our news and advice for animal shelters.</p>
                  <form>
                      <div class="flex">
                          <input type="email" placeholder="Your email" class="px-4 py-2 w-full rounded-l-lg focus:outline-none text-gray-800">
                          <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-r-lg transition duration-150">
                              <i class="fas fa-paper-plane"></i>
                          </button>
                      </div>
                  </form>
              </div>
          </div>
          <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-400">
              <p>&copy; {{ date('Y') }} RescueSpot. All rights reserved. | <a href="#" class="text-emerald-400 hover:text-white transition duration-150">Privacy Policy</a> | <a href="#" class="text-emerald-400 hover:text-white transition duration-150">Terms of Use</a></p>
          </div>
      </div>
  </footer>
</body>
</html>