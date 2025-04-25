<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RescueSpot - Animals</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .profile-gradient {
        background: linear-gradient(to right, #10b981, #059669);
    }
    
    /* Custom scrollbar styles */
    .scrollbar-thin::-webkit-scrollbar {
        width: 8px;
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
    
    /* Ensure the animal container takes up available space */
    .animal-container {
        height: calc(100vh - 250px);
        min-height: 500px;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle edit forms
        document.querySelectorAll('.edit-animal-btn').forEach(button => {
            button.addEventListener('click', function() {
                const animalId = this.getAttribute('data-animal-id');
                document.getElementById(`animal-info-${animalId}`).classList.add('hidden');
                document.getElementById(`animal-edit-form-${animalId}`).classList.remove('hidden');
            });
        });
        
        // Cancel edit
        document.querySelectorAll('.cancel-edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const animalId = this.getAttribute('data-animal-id');
                document.getElementById(`animal-edit-form-${animalId}`).classList.add('hidden');
                document.getElementById(`animal-info-${animalId}`).classList.remove('hidden');
            });
        });
        
        // Filter animals
        document.querySelectorAll('[data-animal-filter]').forEach(button => {
            button.addEventListener('click', function() {
                // Update active filter button
                document.querySelectorAll('[data-animal-filter]').forEach(btn => {
                    btn.classList.remove('bg-teal-100', 'text-teal-700');
                    btn.classList.add('bg-gray-100', 'text-gray-700');
                });
                this.classList.remove('bg-gray-100', 'text-gray-700');
                this.classList.add('bg-teal-100', 'text-teal-700');
                
                const filter = this.getAttribute('data-animal-filter');
                
                document.querySelectorAll('[data-animal-card]').forEach(card => {
                    if (filter === 'all') {
                        card.classList.remove('hidden');
                    } else {
                        const species = card.getAttribute('data-animal-species');
                        if (species === filter) {
                            card.classList.remove('hidden');
                        } else {
                            card.classList.add('hidden');
                        }
                    }
                });
            });
        });
        
        // Search animals
        const searchInput = document.getElementById('animal-search');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            document.querySelectorAll('[data-animal-card]').forEach(card => {
                const name = card.getAttribute('data-animal-name').toLowerCase();
                const breed = card.getAttribute('data-animal-breed').toLowerCase();
                const species = card.getAttribute('data-animal-species').toLowerCase();
                
                if (name.includes(searchTerm) || breed.includes(searchTerm) || species.includes(searchTerm)) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        });
        
        // Preview uploaded animal photo
        window.previewAnimalPhoto = function(input, previewId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        };
        
        // Confirm delete
        document.querySelectorAll('.delete-animal-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to delete this animal?')) {
                    e.preventDefault();
                }
            });
        });
        
        // Modal functionality
        const modalTriggers = document.querySelectorAll('[data-modal-target]');
        const closeModalButtons = document.querySelectorAll('[data-close-modal]');
        const overlay = document.getElementById('modal-overlay');

        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', () => {
                const modalId = trigger.getAttribute('data-modal-target');
                const modal = document.getElementById(modalId);
                
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
        
        // File upload preview
        const photoInput = document.getElementById('photoAnimal');
        const photoPreview = document.getElementById('photo-preview');
        
        if (photoInput && photoPreview) {
            photoInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        photoPreview.src = e.target.result;
                        photoPreview.classList.remove('hidden');
                        document.getElementById('upload-icon-container').classList.add('hidden');
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
    });
</script>
</head>
<body class="bg-gray-100 font-sans">
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Page Header -->
        <div class="bg-gradient-to-r from-teal-600 to-emerald-600 px-8 py-6 text-white">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold flex items-center">
                    <span class="bg-white w-10 h-10 rounded-full flex items-center justify-center mr-3 text-teal-600 shadow-md">
                        <i class="fas fa-paw"></i>
                    </span>
                    Shelter Animals
                </h1>
                <a href="HomeShelter" class="bg-white text-teal-600 hover:bg-gray-100 px-4 py-2 rounded-lg shadow-md transition duration-150 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                </a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="p-8">
            <div class="flex justify-between items-center mb-6">
                <div class="flex space-x-2 overflow-x-auto pb-2">
                    <button data-animal-filter="all" class="py-1 px-3 text-sm rounded-md bg-teal-100 text-teal-700 hover:bg-teal-200">All</button>
                    <button data-animal-filter="Dog" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Dogs</button>
                    <button data-animal-filter="Cat" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Cats</button>
                    <button data-animal-filter="rabbit" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Rabbits</button>
                    <button data-animal-filter="Other" class="py-1 px-3 text-sm rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Others</button>
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <input type="text" id="animal-search" placeholder="Search animals..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150">
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <button data-modal-target="add-animal-modal" class="ml-3 bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-600 hover:to-emerald-600 text-white py-2 px-4 rounded-lg shadow-md transition duration-150 flex items-center">
                        <i class="fas fa-plus mr-2"></i> Add Animal
                    </button>
                </div>
            </div>
            
            <!-- Scrollable container for animals -->
            <div class="animal-container overflow-y-auto pr-2 mb-6 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($animals as $animal)
                    <!-- Animal Card -->
                    <div data-animal-card data-animal-species="{{ $animal->species }}" data-animal-name="{{ $animal->name }}" data-animal-breed="{{ $animal->breed }}" class="bg-white rounded-xl overflow-hidden shadow-md border border-gray-100 transition transform hover:shadow-lg hover:-translate-y-1 duration-300">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $animal->photoAnimal) }}" alt="{{ $animal->name }}" class="w-full h-48 object-cover">
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
                                        class="edit-animal-btn bg-teal-500 hover:bg-teal-600 text-white py-1 px-3 rounded-lg text-sm transition duration-150"
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
                                    <input type="text" id="name_{{ $animal->id }}" name="name" value="{{ $animal->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 text-sm">
                                </div>
                                
                                <div class="grid grid-cols-2 gap-3 mb-3">
                                    <div>
                                        <label for="species_{{ $animal->id }}" class="block text-sm font-medium text-gray-700 mb-1">Species</label>
                                        <select id="species_{{ $animal->id }}" name="species" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 text-sm">
                                            <option value="Dog" {{ $animal->species == 'Dog' ? 'selected' : '' }}>Dog</option>
                                            <option value="Cat" {{ $animal->species == 'Cat' ? 'selected' : '' }}>Cat</option>
                                            <option value="rabbit" {{ $animal->species == 'rabbit' ? 'selected' : '' }}>Rabbit</option>
                                            <option value="Other" {{ $animal->species == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="breed_{{ $animal->id }}" class="block text-sm font-medium text-gray-700 mb-1">Breed</label>
                                        <input type="text" id="breed_{{ $animal->id }}" name="breed" value="{{ $animal->breed }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 text-sm">
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-3 mb-3">
                                    <div>
                                        <label for="age_{{ $animal->id }}" class="block text-sm font-medium text-gray-700 mb-1">Age (years)</label>
                                        <input type="number" id="age_{{ $animal->id }}" name="age" value="{{ $animal->age }}" min="0" step="0.1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 text-sm">
                                    </div>
                                    <div>
                                        <label for="status_{{ $animal->id }}" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                        <select id="status_{{ $animal->id }}" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 text-sm">
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
                                    <textarea id="description_{{ $animal->id }}" name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 text-sm">{{ $animal->description }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                                    <div class="flex items-center space-x-3">
                                        <div class="relative h-16 w-16 rounded-lg overflow-hidden bg-gray-100">
                                            <img id="animal-photo-preview-{{ $animal->id }}" src="{{ asset('storage/'.$animal->photoAnimal) }}" alt="{{ $animal->name }}" class="h-full w-full object-cover">
                                        </div>
                                        <div>
                                            <input type="file" id="photo_{{ $animal->id }}" name="photoAnimal" class="hidden" accept="image/*" onchange="previewAnimalPhoto(this, 'animal-photo-preview-{{ $animal->id }}')">
                                            <label for="photo_{{ $animal->id }}" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1.5 rounded-lg shadow-sm text-xs cursor-pointer inline-block transition duration-150">
                                                <i class="fas fa-upload mr-1"></i> Change Photo
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex justify-end space-x-2 mt-4">
                                    <button type="button" class="cancel-edit-btn px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg shadow-sm transition duration-150 text-sm" data-animal-id="{{ $animal->id }}">
                                        Cancel
                                    </button>
                                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-600 hover:to-emerald-600 text-white rounded-lg shadow-md transition duration-150 hover:shadow-lg text-sm">
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
                        <button data-modal-target="add-animal-modal" class="bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white py-2 px-6 rounded-lg shadow-md inline-flex items-center transition duration-150 hover:shadow-lg">
                            <i class="fas fa-plus mr-2"></i>
                            Add Your First Animal
                        </button>
                    </div>
                    @endforelse
                </div>
            </div>
            
            @if(count($animals) > 0)
            <div class="text-center">
                <button data-modal-target="add-animal-modal" class="bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white py-3 px-8 rounded-lg shadow-md inline-flex items-center transition duration-150 hover:shadow-lg">
                    <i class="fas fa-plus mr-2"></i>
                    Add New Animal
                </button>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Overlay -->
<div id="modal-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50"></div>

<!-- Add Animal Modal -->
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
                            <div id="upload-icon-container" class="flex flex-col items-center">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-500 mb-2">Drag and drop photos here, or click to select files</p>
                            </div>
                            <img id="photo-preview" class="hidden max-h-40 mx-auto mb-3 rounded-lg" alt="Animal photo preview">
                            <input type="file" id="photoAnimal" name="photoAnimal" class="hidden" accept="image/*">
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
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="description" name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500" placeholder="Enter a description of the animal..."></textarea>
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