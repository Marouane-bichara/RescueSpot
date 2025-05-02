<!DOCTYPE
html >
  <html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>RescueSpot - Shelter Profile</title>
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

          // Edit profile modal functionality
          const editProfileBtn = document.getElementById('edit-profile-btn');
          const editProfileModal = document.getElementById('edit-profile-modal');
          const closeModalBtns = document.querySelectorAll('[data-close-modal]');
          const modalOverlay = document.getElementById('modal-overlay');
          
          editProfileBtn.addEventListener('click', function() {
              editProfileModal.classList.remove('hidden');
              editProfileModal.classList.add('flex');
              document.body.classList.add('overflow-hidden');
          });
          
          function closeModal() {
              editProfileModal.classList.add('hidden');
              editProfileModal.classList.remove('flex');
              document.body.classList.remove('overflow-hidden');
          }
          
          closeModalBtns.forEach(button => {
              button.addEventListener('click', closeModal);
          });
          
          modalOverlay.addEventListener('click', closeModal);
          
          // Prevent modal content clicks from closing the modal
          document.querySelector('.modal-content').addEventListener('click', function(e) {
              e.stopPropagation();
          });
          
          // Save profile changes
          const saveProfileBtn = document.getElementById('save-profile-btn');

          saveProfileBtn.addEventListener('click', function() {
              // Get the form element
              const form = document.getElementById('edit-profile-form');
              
              // Submit the form to the server
              form.submit();
              
              // Note: The page will refresh after form submission, so the following code
              // will only execute if there's an issue with the form submission
              showToast('Submitting form...');
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

          // Filter animals by species
          const animalFilterButtons = document.querySelectorAll('[data-animal-filter]');
          const animalCards = document.querySelectorAll('[data-animal-card]');
          
          animalFilterButtons.forEach(button => {
              button.addEventListener('click', () => {
                  const filter = button.dataset.animalFilter;
                  
                  // Update active filter button
                  animalFilterButtons.forEach(btn => {
                      btn.classList.remove('bg-teal-100', 'text-teal-700');
                      btn.classList.add('bg-gray-100', 'text-gray-700');
                  });
                  button.classList.remove('bg-gray-100', 'text-gray-700');
                  button.classList.add('bg-teal-100', 'text-teal-700');
                  
                  // Filter animal cards
                  animalCards.forEach(card => {
                      if (filter === 'all' || card.dataset.animalSpecies === filter) {
                          card.classList.remove('hidden');
                      } else {
                          card.classList.add('hidden');
                      }
                  });
              });
          });

          // Search animals functionality
          const animalSearchInput = document.getElementById('animal-search');
          
          if (animalSearchInput) {
              animalSearchInput.addEventListener('input', function() {
                  const searchTerm = this.value.toLowerCase();
                  
                  animalCards.forEach(card => {
                      const animalName = card.dataset.animalName.toLowerCase();
                      const animalBreed = card.dataset.animalBreed.toLowerCase();
                      
                      if (animalName.includes(searchTerm) || animalBreed.includes(searchTerm)) {
                          card.classList.remove('hidden');
                      } else {
                          card.classList.add('hidden');
                      }
                  });
              });
          }

          // Confirm delete animal
          const deleteButtons = document.querySelectorAll('.delete-animal-btn');
          
          deleteButtons.forEach(button => {
              button.addEventListener('click', (e) => {
                  if (!confirm('Are you sure you want to delete this animal?')) {
                      e.preventDefault();
                  }
              });
          });

          // Toggle edit animal forms
          const editAnimalButtons = document.querySelectorAll('.edit-animal-btn');
          const animalInfoSections = document.querySelectorAll('.animal-info-section');
          const animalEditForms = document.querySelectorAll('.animal-edit-form');
          
          editAnimalButtons.forEach(button => {
              button.addEventListener('click', function(e) {
                  e.preventDefault();
                  const animalId = this.getAttribute('data-animal-id');
                  
                  // Toggle visibility of info and edit form for this animal
                  const infoSection = document.getElementById(`animal-info-${animalId}`);
                  const editForm = document.getElementById(`animal-edit-form-${animalId}`);
                  
                  if (infoSection && editForm) {
                      infoSection.classList.toggle('hidden');
                      editForm.classList.toggle('hidden');
                  }
              });
          });

          // Cancel edit buttons
          const cancelEditButtons = document.querySelectorAll('.cancel-edit-btn');
          
          cancelEditButtons.forEach(button => {
              button.addEventListener('click', function(e) {
                  e.preventDefault();
                  const animalId = this.getAttribute('data-animal-id');
                  
                  // Hide edit form and show info section
                  const infoSection = document.getElementById(`animal-info-${animalId}`);
                  const editForm = document.getElementById(`animal-edit-form-${animalId}`);
                  
                  if (infoSection && editForm) {
                      infoSection.classList.remove('hidden');
                      editForm.classList.add('hidden');
                  }
              });
          });

          // Preview animal photo
          window.previewAnimalPhoto = function(input, previewId) {
              if (input.files && input.files[0]) {
                  const reader = new FileReader();
                  reader.onload = function(e) {
                      document.getElementById(previewId).src = e.target.result;
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
      <div id="toast-message" class="ml-3 text-sm font-medium">Shelter profile updated successfully!</div>
      <button id="close-toast" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 items-center justify-center">
          <i class="fas fa-times"></i>
      </button>
  </div>

  <!-- Edit Profile Modal -->
  <div id="edit-profile-modal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 justify-center items-center">
      <div id="modal-overlay" class="absolute inset-0"></div>
      <div class="modal-content relative bg-white rounded-2xl shadow-xl max-w-6xl w-full max-h-[90vh] overflow-auto mx-4 my-8">
          <div class="sticky top-0 z-10 bg-white px-6 py-4 border-b border-gray-200 rounded-t-2xl flex justify-between items-center">
              <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                  <span class="profile-gradient w-10 h-10 rounded-full flex items-center justify-center mr-3 text-white shadow-md">
                      <i class="fas fa-edit"></i>
                  </span>
                  Edit Shelter Profile
              </h2>
              <button data-close-modal class="text-gray-400 hover:text-gray-600 focus:outline-none">
                  <i class="fas fa-times text-xl"></i>
              </button>
          </div>
            
          <div class="p-6">
              <form id="edit-profile-form" action="{{ route('shelter.editProfile') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                  @csrf
                  <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                      <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                          <i class="fas fa-image text-primary-500 mr-2"></i>
                          Shelter Images
                      </h3>
                      
                      <!-- Profile Photo Upload -->
                      <div class="mb-6">
                          <label class="block text-sm font-medium text-gray-700 mb-2">Shelter Logo</label>
                          <div class="flex items-center space-x-4">
                              <div class="relative group h-24 w-24">
                                  <div class="absolute inset-0 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 animate-pulse blur-md opacity-70 group-hover:opacity-100 transition duration-300"></div>
                                  <img id="profile-photo-preview" 
                                      src="{{ $user->profilePhoto ? asset('storage/'.$user->profilePhoto) : 'https://images.unsplash.com/photo-1601758125946-6ec2ef64daf8?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80' }}" 
                                      alt="Shelter Logo" 
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
                                      <i class="fas fa-upload mr-1"></i> Choose Logo
                                  </label>
                                  <p class="text-xs text-gray-500 mt-1">JPG, PNG or GIF (Max. 2MB)</p>
                              </div>
                          </div>
                      </div>
                      
                      <!-- Background Photo Upload -->
                      <div class="mb-6">
                          <label class="block text-sm font-medium text-gray-700 mb-2">Cover Image</label>
                          <div class="relative bg-gray-100 rounded-lg overflow-hidden h-32 mb-2">
                              <img id="background-photo-preview" 
                                  src="{{ $user->backgroundProfile ? asset('storage/'.$user->backgroundProfile) : 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80' }}" 
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
                                  <i class="fas fa-upload mr-1"></i> Choose Cover
                              </label>
                              <p class="text-xs text-gray-500 mt-1">JPG, PNG or GIF (Max. 2MB)</p>
                          </div>
                      </div>

                      <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                          <i class="fas fa-building text-primary-500 mr-2"></i>
                          Shelter Information
                      </h3>
                      
                      <div class="mb-4">
                          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Shelter Name</label>
                          <input type="text" id="name" name="name" value="{{ $user->name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                      </div>
                      
                      <div class="mb-4">
                          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                          <input type="email" id="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                      </div>
                      
                      <div class="mb-4">
                          <label for="founded" class="block text-sm font-medium text-gray-700 mb-1">Founded Year</label>
                          <input type="number" id="founded" name="founded" value="2015" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                      </div>
                      
                      <div class="mb-4">
                          <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">About</label>
                          <textarea id="bio" name="bio" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">{{ $user->bio ?? 'Happy Paws Shelter is a non-profit animal rescue organization dedicated to finding loving homes for abandoned, abused, and neglected animals. Since our founding in 2015, we\'ve successfully rescued and rehomed over 2,000 animals. Our mission is to provide temporary shelter, care, and love to animals in need while working to find them permanent, responsible homes.' }}</textarea>
                      </div>
                  </div>
                  
                  <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                      <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                          <i class="fas fa-address-book text-primary-500 mr-2"></i>
                          Contact Information
                      </h3>
                      
                      <div class="mb-4">
                          <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                          <input type="tel" id="phone" name="phone" value="{{ $user->phone ?? '(123) 456-7890' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                      </div>
                      
                      <div class="mb-4">
                          <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                          <input type="text" id="address" name="address" value="{{ $user->address ?? '123 Rescue Lane' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                      </div>
                      
                      <div class="mb-4">
                          <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                          <input type="text" id="city" name="city" value="{{ $user->city ?? 'Animal City, AC 12345' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                      </div>
                      
                      <div class="mb-4">
                          <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                          <input type="text" id="country" name="country" value="{{ $user->country ?? 'United States' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                      </div>
                      
                      <div class="mb-4">
                          <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                          <input type="url" id="website" name="website" value="{{ $user->shelter->website ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                      </div>
                      
                      <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-4 flex items-center">
                          <i class="fas fa-clock text-primary-500 mr-2"></i>
                          Operating Hours
                      </h3>
                      
                      <div class="grid grid-cols-2 gap-4 mb-4">
                          <div>
                              <label for="weekday_hours" class="block text-sm font-medium text-gray-700 mb-1">Weekdays</label>
                              <input type="text" id="weekday_hours" name="weekday_hours" value="10:00 AM - 6:00 PM" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                          </div>
                          <div>
                              <label for="saturday_hours" class="block text-sm font-medium text-gray-700 mb-1">Saturday</label>
                              <input type="text" id="saturday_hours" name="saturday_hours" value="10:00 AM - 5:00 PM" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                          </div>
                          <div>
                              <label for="sunday_hours" class="block text-sm font-medium text-gray-700 mb-1">Sunday</label>
                              <input type="text" id="sunday_hours" name="sunday_hours" value="12:00 PM - 4:00 PM" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                          </div>
                          <div>
                              <label for="holiday_hours" class="block text-sm font-medium text-gray-700 mb-1">Holidays</label>
                              <input type="text" id="holiday_hours" name="holiday_hours" value="Closed" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                          </div>
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
                              <input type="url" id="facebook" name="facebook" value="{{ $user->facebook ?? 'https://facebook.com/happypawsshelter' }}" placeholder="Facebook page URL" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                          </div>
                          
                          <div class="mb-4">
                              <label for="twitter" class="block text-sm font-medium text-gray-700 mb-1">
                                  <i class="fab fa-twitter text-blue-400 mr-2"></i>Twitter
                              </label>
                              <input type="url" id="twitter" name="twitter" value="{{ $user->twitter ?? 'https://twitter.com/happypawsshelter' }}" placeholder="Twitter profile URL" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                          </div>
                          
                          <div class="mb-4">
                              <label for="instagram" class="block text-sm font-medium text-gray-700 mb-1">
                                  <i class="fab fa-instagram text-pink-600 mr-2"></i>Instagram
                              </label>
                              <input type="url" id="instagram" name="instagram" value="{{ $user->instagram ?? 'https://instagram.com/happypawsshelter' }}" placeholder="Instagram profile URL" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                          </div>
                          
                          <div class="mb-4">
                              <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-1">
                                  <i class="fab fa-linkedin text-blue-600 mr-2"></i>LinkedIn
                              </label>
                              <input type="url" id="linkedin" name="linkedin" value="{{ $user->linkedin ?? 'https://linkedin.com/company/happypawsshelter' }}" placeholder="LinkedIn profile URL" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                          </div>
                      </div>
                  </div>
              </form>
          </div>
          
          <div class="sticky bottom-0 z-10 bg-white px-6 py-4 border-t border-gray-200 rounded-b-2xl flex justify-end space-x-3">
              <button data-close-modal class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg shadow-sm transition duration-150">
                  Cancel
              </button>
              <button id="save-profile-btn" type="button" class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white rounded-lg shadow-md transition duration-150 hover:shadow-lg">
                  <i class="fas fa-save mr-2"></i>
                  Save Changes
              </button>
          </div>
      </div>
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
                      <span class="bg-teal-100 text-teal-800 text-xs px-2 py-1 rounded-full">Shelter Portal</span>
                  </a>
              </div>

              <!-- Main Navigation - Desktop -->
              <div class="hidden md:flex items-center space-x-1">
                  <a href="HomeShelter" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Dashboard</a>
                  <a href="animalsShelter" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Animals</a>
                  <a href="AdoptionsRequests" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Adoption Requests</a>
                  <a href="reportsShelter" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Reports</a>

              </div>

              <!-- Right Side Menu -->
              <div class="flex items-center space-x-4">
                  <button class="hidden md:block bg-gradient-to-r from-secondary-500 to-primary-500 hover:from-secondary-600 hover:to-primary-600 text-white py-2 px-4 rounded-lg shadow-md transition transform hover:scale-105 hover:shadow-lg">
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
              <a href="HomeShelter" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Dashboard</a>
              <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-primary-600 to-secondary-600">Profile</a>
              <a href="animalsShelter" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Animals</a>
              <a href="AdoptionsRequests" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Adoption Requests</a>
              <a href="reportsShelter" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition duration-150">Reports</a>
              <button class="mt-2 w-full flex justify-center items-center bg-gradient-to-r from-secondary-500 to-primary-500 hover:from-secondary-600 hover:to-primary-600 text-white py-2 px-4 rounded-lg shadow-md transition duration-150">
                  <span class="text-white text-sm font-medium">Add Animal</span>
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
              style="background-image: url('{{ $user->backgroundProfile ? asset('storage/'.$user->backgroundProfile) : 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80' }}');">
              
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
                      src="{{ $user->profilePhoto ? asset('storage/'.$user->profilePhoto) : 'https://images.unsplash.com/photo-1601758125946-6ec2ef64daf8?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80' }}" 
                      alt="Shelter Logo" 
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
                      <h1 id="shelter-name" class="text-3xl font-bold text-gray-800 mb-1">{{ $user->name }}</h1>
                      <p class="text-gray-600 flex items-center">
                          <i class="fas fa-shield-alt text-primary-500 mr-2"></i>
                          Verified Shelter | Since {{ date('Y', strtotime($user->created_at)) }}
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
                          <i class="fas fa-info-circle mr-2"></i>
                          About
                      </button>
                      <button data-tab-target="#tab-animals" class="text-gray-500 border-b-2 border-transparent hover:text-primary-500 hover:border-primary-300 inline-block p-4 rounded-t-lg font-medium transition duration-150">
                          <i class="fas fa-paw mr-2"></i>
                          Animals
                      </button>
                      <button data-tab-target="#tab-team" class="text-gray-500 border-b-2 border-transparent hover:text-primary-500 hover:border-primary-300 inline-block p-4 rounded-t-lg font-medium transition duration-150">
                          <i class="fas fa-users mr-2"></i>
                          Team
                      </button>
                      <button data-tab-target="#tab-reviews" class="text-gray-500 border-b-2 border-transparent hover:text-primary-500 hover:border-primary-300 inline-block p-4 rounded-t-lg font-medium transition duration-150">
                          <i class="fas fa-star mr-2"></i>
                          Reviews
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
                                  <i class="fas fa-building"></i>
                              </span>
                              Shelter Information
                          </h2>
                          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                              <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                                  <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                      <i class="fas fa-info-circle text-primary-500 mr-2"></i>
                                      About Us
                                  </h3>
                                  <p id="shelter-bio" class="text-gray-600 mb-6 bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                      {{ $user->bio ?? 'No bio added yet' }}
                                  </p>                                    
                                  <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                      <i class="fas fa-chart-bar text-primary-500 mr-2"></i>
                                      Shelter Statistics
                                  </h3>
                                  <div class="space-y-3 bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                      <div class="flex items-center justify-between">
                                          <span class="text-gray-500 flex items-center"><i class="fas fa-paw text-primary-400 mr-2"></i>Animals in Care:</span>
                                          <span class="text-gray-700 font-medium">42</span>
                                      </div>
                                      <div class="flex items-center justify-between">
                                          <span class="text-gray-500 flex items-center"><i class="fas fa-home text-primary-400 mr-2"></i>Adoptions (Total):</span>
                                          <span class="text-gray-700 font-medium">2,143</span>
                                      </div>
                                      <div class="flex items-center justify-between">
                                          <span class="text-gray-500 flex items-center"><i class="fas fa-heartbeat text-primary-400 mr-2"></i>Success Rate:</span>
                                          <span class="text-gray-700 font-medium">95%</span>
                                      </div>
                                      <div class="flex items-center justify-between">
                                          <span class="text-gray-500 flex items-center"><i class="fas fa-calendar-alt text-primary-400 mr-2"></i>Founded:</span>
                                          <span class="text-gray-700 font-medium">{{ date('Y', strtotime($user->created_at)) }}</span>
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
                                          <span class="w-32 text-gray-500 flex items-center"><i class="fas fa-envelope text-primary-400 mr-2"></i>Email:</span>
                                          <span id="shelter-email" class="text-gray-700">{{ $user->email }}</span>
                                      </div>
                                      <div class="flex items-center">
                                          <span class="w-32 text-gray-500 flex items-center"><i class="fas fa-phone text-primary-400 mr-2"></i>Phone:</span>
                                          <span id="shelter-phone" class="text-gray-700">{{ $user->phone ?? 'Not specified' }}</span>
                                      </div>
                                      <div class="flex items-center">
                                          <span class="w-32 text-gray-500 flex items-center"><i class="fas fa-map-marker-alt text-primary-400 mr-2"></i>Address:</span>
                                          <span id="shelter-address" class="text-gray-700">{{ $user->address ?? 'Not specified' }}</span>
                                      </div>
                                      <div class="flex items-center">
                                          <span class="w-32 text-gray-500 flex items-center"><i class="fas fa-city text-primary-400 mr-2"></i>City:</span>
                                          <span id="shelter-city" class="text-gray-700">{{ $user->city ?? 'Not specified' }}</span>
                                      </div>
                                      <div class="flex items-center">
                                          <span class="w-32 text-gray-500 flex items-center"><i class="fas fa-globe text-primary-400 mr-2"></i>Country:</span>
                                          <span id="shelter-country" class="text-gray-700">{{ $user->country ?? 'Not specified' }}</span>
                                      </div>
                                      <div class="flex items-center">
                                          <span class="w-32 text-gray-500 flex items-center"><i class="fas fa-link text-primary-400 mr-2"></i>Website:</span>
                                          <span id="shelter-website" class="text-gray-700">www.happypawsshelter.org</span>
                                      </div>
                                  </div>
                                  
                                  <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-4 flex items-center">
                                      <i class="fas fa-clock text-primary-500 mr-2"></i>
                                      Operating Hours
                                  </h3>
                                  <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                      <div class="grid grid-cols-2 gap-2">
                                          <div>
                                              <p class="text-sm font-medium text-gray-700">Monday - Friday</p>
                                              <p class="text-gray-600">10:00 AM - 6:00 PM</p>
                                          </div>
                                          <div>
                                              <p class="text-sm font-medium text-gray-700">Saturday</p>
                                              <p class="text-gray-600">10:00 AM - 5:00 PM</p>
                                          </div>
                                          <div>
                                              <p class="text-sm font-medium text-gray-700">Sunday</p>
                                              <p class="text-gray-600">12:00 PM - 4:00 PM</p>
                                          </div>
                                          <div>
                                              <p class="text-sm font-medium text-gray-700">Holidays</p>
                                              <p class="text-gray-600">Closed</p>
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-4 flex items-center">
                                      <i class="fas fa-share-alt text-primary-500 mr-2"></i>
                                      Social Media
                                  </h3>
                                  <div class="flex space-x-4 bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                      @if($user->facebook)
                                      <a href="{{ $user->facebook }}" class="text-blue-600 hover:text-blue-800 transition duration-150 transform hover:scale-110 p-2">
                                          <i class="fab fa-facebook-f text-xl"></i>
                                      </a>
                                      @endif
                                      @if($user->twitter)
                                      <a href="{{ $user->twitter }}" class="text-blue-400 hover:text-blue-600 transition duration-150 transform hover:scale-110 p-2">
                                          <i class="fab fa-twitter text-xl"></i>
                                      </a>
                                      @endif
                                      @if($user->instagram)
                                      <a href="{{ $user->instagram }}" class="text-pink-600 hover:text-pink-800 transition duration-150 transform hover:scale-110 p-2">
                                          <i class="fab fa-instagram text-xl"></i>
                                      </a>
                                      @endif
                                      @if($user->linkedin)
                                      <a href="{{ $user->linkedin }}" class="text-blue-600 hover:text-blue-800 transition duration-150 transform hover:scale-110 p-2">
                                          <i class="fab fa-linkedin text-xl"></i>
                                      </a>
                                      @endif
                                      @if(!$user->facebook && !$user->twitter && !$user->instagram && !$user->linkedin)
                                      <span class="text-gray-500">No social media links added</span>
                                      @endif
                                  </div>
                              </div>
                          </div>
                          
                          <!-- Statistics Cards -->
                          <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                              <div class="bg-gradient-to-br from-primary-50 to-primary-100 p-6 rounded-xl border border-primary-200 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                                  <div class="flex items-center">
                                      <div class="p-3 bg-primary-500 text-white rounded-lg mr-4 shadow-md">
                                          <i class="fas fa-paw"></i>
                                      </div>
                                      <div>
                                          <p class="text-sm text-primary-600 font-medium">Animals</p>
                                          <p class="text-2xl font-bold text-gray-800">
                                              {{ isset($statisticShelter['totalAnimals']) ? $statisticShelter['totalAnimals'] : count($animals) }}
                                          </p>
                                          <p class="text-xs text-gray-500">Currently in care</p>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="bg-gradient-to-br from-secondary-50 to-secondary-100 p-6 rounded-xl border border-secondary-200 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                                  <div class="flex items-center">
                                      <div class="p-3 bg-secondary-500 text-white rounded-lg mr-4 shadow-md">
                                          <i class="fas fa-home"></i>
                                      </div>
                                      <div>
                                          <p class="text-sm text-secondary-600 font-medium">Adoptions</p>
                                          <p class="text-2xl font-bold text-gray-800">
                                              {{ isset($statisticShelter['totalAdopted']) ? $statisticShelter['totalAdopted'] : '18' }}
                                          </p>
                                          <p class="text-xs text-gray-500">Pending requests</p>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-6 rounded-xl border border-amber-200 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                                  <div class="flex items-center">
                                      <div class="p-3 bg-amber-500 text-white rounded-lg mr-4 shadow-md">
                                          <i class="fas fa-clipboard-list"></i>
                                      </div>
                                      <div>
                                          <p class="text-sm text-amber-600 font-medium">Reports</p>
                                          <p class="text-2xl font-bold text-gray-800">
                                              {{ isset($statisticShelter['totalReports']) ? $statisticShelter['totalReports'] : '7' }}
                                          </p>
                                          <p class="text-xs text-gray-500">New animal reports</p>
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
                                          <p class="text-2xl font-bold text-gray-800">$12,450</p>
                                          <p class="text-xs text-gray-500">Last 30 days</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  
                  <!-- Animals Tab Content -->
                  <div id="tab-animals" data-tab-content class="p-8 hidden">
                      <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                          <span class="profile-gradient w-10 h-10 rounded-full flex items-center justify-center mr-3 text-white shadow-md">
                              <i class="fas fa-paw"></i>
                          </span>
                          Our Animals
                      </h2>
                      
                      <div class="flex justify-between items-center mb-6">
                          <div class="flex space-x-2">
                              <button data-animal-filter="all" class="py-1 px-3 text-sm rounded-md bg-teal-100 text-teal-700 hover:bg-teal-200">All</button>
                              <button data-animal-filter="Dog" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Dogs</button>
                              <button data-animal-filter="Cat" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Cats</button>
                              <button data-animal-filter="Other" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Others</button>
                          </div>
                          <div class="flex items-center">
                              <div class="relative">
                                  <input type="text" id="animal-search" placeholder="Search animals..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150">
                                  <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                      <i class="fas fa-search"></i>
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                      <!-- Scrollable container for animals -->
                      <div class="h-[500px] overflow-y-auto pr-2 mb-6 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                              @forelse($animals as $animal)
                              <!-- Animal Card -->
                              <div data-animal-card data-animal-species="{{ $animal->species }}" data-animal-name="{{ $animal->name }}" data-animal-breed="{{ $animal->breed }}" class="bg-white rounded-xl overflow-hidden shadow-md border border-gray-100 transition transform hover:shadow-lg hover:-translate-y-1 duration-300">
                                  <div class="relative">
                                      <img src="{{ asset('storage/'.$animal->photoAnimal) }}" alt="{{ $animal->name }}" class="w-full h-48 object-cover">
                                      <div class="absolute top-3 right-3 
                                          @if($animal->status == 'ready') bg-green-500 
                                          @elseif($animal->status == 'medical') bg-amber-500 
                                          @elseif($animal->status == 'training') bg-blue-500 
                                          @else bg-gray-500 
                                          @endif 
                                          text-white text-xs px-2 py-1 rounded-full">
                                          {{ ucfirst($animal->status) }}
                                      </div>
                                  </div>
                                  
                                  <!-- Animal Info Section (Default View) -->
                                  <div id="animal-info-{{ $animal->id }}" class="animal-info-section p-5">
                                      <div class="flex justify-between items-start mb-2">
                                          <h3 class="font-semibold text-gray-800 text-lg">{{ $animal->name }}</h3>
                                          <div class="flex space-x-1">
                                              <span class="text-xs bg-teal-100 text-teal-800 px-2 py-1 rounded-full">ID: {{ $animal->id }}</span>
                                          </div>
                                      </div>
                                      <div class="flex space-x-2 mb-2 text-xs">
                                          <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">{{ $animal->species }}</span>
                                          <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full">{{ $animal->age }} years</span>
                                          <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">{{ $animal->breed }}</span>
                                      </div>
                                      <p class="text-sm text-gray-600 mb-3">{{ $animal->description ?? 'No description available.' }}</p>
                                      <div class="flex justify-between items-center">
                                          <span class="text-sm text-gray-500">Added: {{ \Carbon\Carbon::parse($animal->created_at)->diffForHumans() }}</span>
                                          <div class="flex space-x-2">
                                              <button type="button" 
                                                  class="edit-animal-btn bg-primary-500 hover:bg-primary-600 text-white py-1 px-3 rounded-lg text-sm transition duration-150"
                                                  data-animal-id="{{ $animal->id }}">
                                                  <i class="fas fa-edit"></i> Edit
                                              </button>
                                              <form action="{{ route('shelter.ShelterProfile.destroy', $animal->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this animal?');">
                                                  @csrf
                                                  @method('DELETE')
                                                  <input type="hidden" name="animal_id" value="{{ $animal->id }}">
                                                  <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-lg text-sm transition duration-150 delete-animal-btn">
                                                      <i class="fas fa-trash"></i> Delete
                                                  </button>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <!-- Animal Edit Form (Hidden by Default) -->
                                  <div id="animal-edit-form-{{ $animal->id }}" class="animal-edit-form p-5 hidden">
                                      <form action="{{ route('shelter.ShelterProfile.update', $animal->id) }}" method="POST" enctype="multipart/form-data">
                                          @csrf
                                          @method('PUT')
                                          
                                          <div class="mb-3">
                                              <label for="name_{{ $animal->id }}" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                              <input type="text" id="name_{{ $animal->id }}" name="name" value="{{ $animal->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150 text-sm">
                                          </div>
                                          
                                          <div class="grid grid-cols-2 gap-3 mb-3">
                                              <div>
                                                  <label for="species_{{ $animal->id }}" class="block text-sm font-medium text-gray-700 mb-1">Species</label>
                                                  <select id="species_{{ $animal->id }}" name="species" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150 text-sm">
                                                      <option value="Dog" {{ $animal->species == 'Dog' ? 'selected' : '' }}>Dog</option>
                                                      <option value="Cat" {{ $animal->species == 'Cat' ? 'selected' : '' }}>Cat</option>
                                                      <option value="Other" {{ $animal->species == 'Other' ? 'selected' : '' }}>Other</option>
                                                  </select>
                                              </div>
                                              <div>
                                                  <label for="breed_{{ $animal->id }}" class="block text-sm font-medium text-gray-700 mb-1">Breed</label>
                                                  <input type="text" id="breed_{{ $animal->id }}" name="breed" value="{{ $animal->breed }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150 text-sm">
                                              </div>
                                          </div>
                                          
                                          <div class="grid grid-cols-2 gap-3 mb-3">
                                              <div>
                                                  <label for="age_{{ $animal->id }}" class="block text-sm font-medium text-gray-700 mb-1">Age (years)</label>
                                                  <input type="number" id="age_{{ $animal->id }}" name="age" value="{{ $animal->age }}" min="0" step="0.1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150 text-sm">
                                              </div>
                                              <div>
                                                  <label for="status_{{ $animal->id }}" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                                  <select id="status_{{ $animal->id }}" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150 text-sm">
                                                      <option value="ready" {{ $animal->status == 'ready' ? 'selected' : '' }}>Ready for Adoption</option>
                                                      <option value="medical" {{ $animal->status == 'medical' ? 'selected' : '' }}>Medical Treatment</option>
                                                      <option value="training" {{ $animal->status == 'training' ? 'selected' : '' }}>Training</option>
                                                      <option value="pending" {{ $animal->status == 'pending' ? 'selected' : '' }}>Adoption Pending</option>
                                                      <option value="adopted" {{ $animal->status == 'adopted' ? 'selected' : '' }}>Adopted</option>
                                                  </select>
                                              </div>
                                          </div>
                                          
                                          <div class="mb-3">
                                              <label for="description_{{ $animal->id }}" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                              <textarea id="description_{{ $animal->id }}" name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-150 text-sm">{{ $animal->description }}</textarea>
                                          </div>
                                          
                                          <div class="mb-3">
                                              <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                                              <div class="flex items-center space-x-3">
                                                  <div class="relative h-16 w-16 rounded-lg overflow-hidden bg-gray-100">
                                                      <img id="animal-photo-preview-{{ $animal->id }}" src="{{ asset('storage/'.$animal->photoAnimal) }}" alt="{{ $animal->name }}" class="h-full w-full object-cover">
                                                  </div>
                                                  <div>
                                                      <input type="file" id="photo_{{ $animal->id }}" name="photoAnimal" class="hidden" accept="image/*" onchange="previewAnimalPhoto(this, 'animal-photo-preview-{{ $animal->id }}')">
                                                      <label for="photo_{{ $animal->id }}" class="bg-primary-600 hover:bg-primary-700 text-white px-3 py-1.5 rounded-lg shadow-sm text-xs cursor-pointer inline-block transition duration-150">
                                                          <i class="fas fa-upload mr-1"></i> Change Photo
                                                      </label>
                                                  </div>
                                              </div>
                                          </div>
                                          
                                          <div class="flex justify-end space-x-2 mt-4">
                                              <button type="button" class="cancel-edit-btn px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg shadow-sm transition duration-150 text-sm" data-animal-id="{{ $animal->id }}">
                                                  Cancel
                                              </button>
                                              <button type="submit" class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white rounded-lg shadow-md transition duration-150 hover:shadow-lg text-sm">
                                                  <i class="fas fa-save mr-1"></i> Save Changes
                                              </button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                              @empty
                              <div class="col-span-3 text-center py-10">
                                  <div class="text-gray-400 mb-4">
                                      <i class="fas fa-paw text-6xl"></i>
                                  </div>
                                  <h3 class="text-xl font-semibold text-gray-700 mb-2">No animals found</h3>
                                  <p class="text-gray-500 mb-6">You haven't added any animals to your shelter yet.</p>
                                  <a href="" class="bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white py-2 px-6 rounded-lg shadow-md inline-flex items-center transition duration-150 hover:shadow-lg">
                                      <i class="fas fa-plus mr-2"></i>
                                      Add Your First Animal
                                  </a>
                              </div>
                              @endforelse
                          </div>
                      </div>
                      
                      @if(count($animals) > 0)
                      <div class="text-center">
                          <a href="" class="bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white py-3 px-8 rounded-lg shadow-md inline-flex items-center transition duration-150 hover:shadow-lg">
                              <i class="fas fa-plus mr-2"></i>
                              Add New Animal
                          </a>
                      </div>
                      @endif
                  </div>
                  
                  <!-- Team Tab Content -->
                  <div id="tab-team" data-tab-content class="p-8 hidden">
                      <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                          <span class="profile-gradient w-10 h-10 rounded-full flex items-center justify-center mr-3 text-white shadow-md">
                              <i class="fas fa-users"></i>
                          </span>
                          Our Team
                      </h2>
                      
                      <div class="mb-8">
                          <h3 class="text-xl font-semibold text-gray-800 mb-4">Leadership</h3>
                          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                              <!-- Team Member -->
                              <div class="flex space-x-4">
                                  <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Dr. Emily Chen" class="w-24 h-24 rounded-lg object-cover">
                                  <div>
                                      <h3 class="text-lg font-semibold text-gray-800">Dr. Emily Chen</h3>
                                      <p class="text-primary-600">Founder & Executive Director</p>
                                      <p class="text-gray-600 text-sm mt-2">Veterinarian with over 15 years of experience in animal welfare. Founded Happy Paws in 2015 with a mission to create a no-kill shelter focused on rehabilitation.</p>
                                  </div>
                              </div>
                              
                              <!-- Team Member -->
                              <div class="flex space-x-4">
                                  <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Mark Johnson" class="w-24 h-24 rounded-lg object-cover">
                                  <div>
                                      <h3 class="text-lg font-semibold text-gray-800">Mark Johnson</h3>
                                      <p class="text-primary-600">Operations Director</p>
                                      <p class="text-gray-600 text-sm mt-2">Former business executive who joined Happy Paws in 2017. Oversees daily operations, facilities management, and strategic planning.</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                      <div class="mb-8">
                          <h3 class="text-xl font-semibold text-gray-800 mb-4">Staff</h3>
                          <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                              <!-- Staff Member -->
                              <div class="text-center">
                                  <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-2">
                                      <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Staff Member" class="w-full h-full object-cover">
                                  </div>
                                  <h4 class="font-medium text-gray-800">Lisa Park</h4>
                                  <p class="text-xs text-gray-500">Animal Care</p>
                              </div>
                              
                              <!-- Staff Member -->
                              <div class="text-center">
                                  <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-2">
                                      <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Staff Member" class="w-full h-full object-cover">
                                  </div>
                                  <h4 class="font-medium text-gray-800">James Wilson</h4>
                                  <p class="text-xs text-gray-500">Trainer</p>
                              </div>
                              
                              <!-- Staff Member -->
                              <div class="text-center">
                                  <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-2">
                                      <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Staff Member" class="w-full h-full object-cover">
                                  </div>
                                  <h4 class="font-medium text-gray-800">Emma Davis</h4>
                                  <p class="text-xs text-gray-500">Vet Assistant</p>
                              </div>
                              
                              <!-- Staff Member -->
                              <div class="text-center">
                                  <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-2">
                                      <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Staff Member" class="w-full h-full object-cover">
                                  </div>
                                  <h4 class="font-medium text-gray-800">Alex Kim</h4>
                                  <p class="text-xs text-gray-500">Admin</p>
                              </div>
                              
                              <!-- Staff Member -->
                              <div class="text-center">
                                  <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-2">
                                      <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Staff Member" class="w-full h-full object-cover">
                                  </div>
                                  <h4 class="font-medium text-gray-800">Maya Patel</h4>
                                  <p class="text-xs text-gray-500">Foster Coord.</p>
                              </div>
                          </div>
                      </div>
                      
                      <div>
                          <h3 class="text-xl font-semibold text-gray-800 mb-4">Volunteer Program</h3>
                          <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                              <p class="text-gray-700 mb-4">Our shelter is supported by a dedicated team of over 75 active volunteers who contribute their time and skills in various ways.</p>
                              
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                  <div>
                                      <h4 class="font-medium text-gray-800 mb-2">Volunteer Roles</h4>
                                      <ul class="space-y-1 text-gray-600">
                                          <li class="flex items-center"><i class="fas fa-check text-primary-500 mr-2"></i>Animal Care Assistants</li>
                                          <li class="flex items-center"><i class="fas fa-check text-primary-500 mr-2"></i>Dog Walkers</li>
                                          <li class="flex items-center"><i class="fas fa-check text-primary-500 mr-2"></i>Cat Socializers</li>
                                          <li class="flex items-center"><i class="fas fa-check text-primary-500 mr-2"></i>Adoption Counselors</li>
                                          <li class="flex items-center"><i class="fas fa-check text-primary-500 mr-2"></i>Event Coordinators</li>
                                          <li class="flex items-center"><i class="fas fa-check text-primary-500 mr-2"></i>Foster Families</li>
                                      </ul>
                                  </div>
                                  
                                  <div>
                                      <h4 class="font-medium text-gray-800 mb-2">Become a Volunteer</h4>
                                      <p class="text-gray-600 mb-4">We're always looking for compassionate individuals to join our volunteer team!</p>
                                      <a href="#" class="bg-primary-600 hover:bg-primary-700 text-white py-2 px-4 rounded-lg shadow-md inline-flex items-center transition duration-150">
                                          <i class="fas fa-hands-helping mr-2"></i>
                                          Apply to Volunteer
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  
                  <!-- Reviews Tab Content -->
                  <div id="tab-reviews" data-tab-content class="p-8 hidden">
                      <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                          <span class="profile-gradient w-10 h-10 rounded-full flex items-center justify-center mr-3 text-white shadow-md">
                              <i class="fas fa-star"></i>
                          </span>
                          Reviews & Testimonials
                      </h2>
                      
                      <div class="flex justify-between items-center mb-6">
                          <div class="flex items-center">
                              <div class="flex items-center text-yellow-400 mr-2">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star-half-alt"></i>
                              </div>
                              <span class="text-gray-700 font-medium">4.8 out of 5</span>
                              <span class="text-gray-500 ml-2">(42 reviews)</span>
                          </div>
                          <button class="bg-primary-600 hover:bg-primary-700 text-white py-2 px-4 rounded-lg shadow-md inline-flex items-center transition duration-150">
                              <i class="fas fa-pen mr-2"></i>
                              Write a Review
                          </button>
                      </div>
                      
                      <div class="space-y-6">
                          <!-- Review -->
                          <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                              <div class="flex items-start">
                                  <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="Reviewer" class="w-12 h-12 rounded-full mr-4">
                                  <div class="flex-1">
                                      <div class="flex justify-between items-center mb-1">
                                          <h4 class="font-medium text-gray-800">Sarah Johnson</h4>
                                          <div class="flex text-yellow-400">
                                              <i class="fas fa-star"></i>
                                              <i class="fas fa-star"></i>
                                              <i class="fas fa-star"></i>
                                              <i class="fas fa-star"></i>
                                              <i class="fas fa-star"></i>
                                          </div>
                                      </div>
                                      <p class="text-sm text-gray-500 mb-2">Adopted Max in 2022</p>
                                      <p class="text-gray-600">The team at Happy Paws Shelter is amazing! They were so helpful throughout the entire adoption process. They took the time to understand what kind of dog would fit well with our family and matched us with Max, who has been the perfect addition to our home. The follow-up support has been wonderful too.</p>
                                  </div>
                              </div>
                          </div>
                          
                          <!-- Review -->
                          <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                              <div class="flex items-start">
                                  <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="Reviewer" class="w-12 h-12 rounded-full mr-4">
                                  <div class="flex-1">
                                      <div class="flex justify-between items-center mb-1">
                                          <h4 class="font-medium text-gray-800">Michael Brown</h4>
                                          <div class="flex text-yellow-400">
                                              <i class="fas fa-star"></i>
                                              <i class="fas fa-star"></i>
                                              <i class="fas fa-star"></i>
                                              <i class="fas fa-star"></i>
                                              <i class="fas fa-star"></i>
                                          </div>
                                      </div>
                                      <p class="text-sm text-gray-500 mb-2">Adopted Luna in 2021</p>
                                      <p class="text-gray-600">I can't say enough good things about Happy Paws. The facility is clean and well-maintained, and it's obvious that they truly care about the animals. Luna was a shy cat when I first met her, but the staff had worked with her to build her confidence. They provided great advice on how to help her adjust to my home, and now she's a confident, loving companion.</p>
                                  </div>
                              </div>
                          </div>
                          
                          <!-- Review -->
                          <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                              <div class="flex items-start">
                                  <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="Reviewer" class="w-12 h-12 rounded-full mr-4">
                                  <div class="flex-1">
                                      <div class="flex justify-between items-center mb-1">
                                          <h4 class="font-medium text-gray-800">Emily Davis</h4>
                                          <div class="flex text-yellow-400">
                                              <i class="fas fa-star"></i>
                                              <i class="fas fa-star"></i>
                                              <i class="fas fa-star"></i>
                                              <i class="fas fa-star"></i>
                                              <i class="far fa-star"></i>
                                          </div>
                                      </div>
                                      <p class="text-sm text-gray-500 mb-2">Volunteer since 2020</p>
                                      <p class="text-gray-600">As a volunteer, I've seen firsthand the dedication and compassion that goes into caring for the animals at Happy Paws. The staff works tirelessly to ensure each animal receives proper care, enrichment, and training to prepare them for their forever homes. It's a wonderful organization that truly makes a difference in our community.</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                      <div class="mt-6 text-center">
                          <a href="#" class="text-primary-600 hover:text-primary-800 font-medium inline-flex items-center">
                              View all 42 reviews
                              <i class="fas fa-arrow-right ml-2"></i>
                          </a>
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
</body>
</html>
