<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RescueSpot - Authentication</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-green-100 min-h-screen flex items-center justify-center p-4">

<a href="Home" class="fixed top-6 left-6 bg-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 z-50 group">
        <i class="fas fa-home text-blue-600 text-xl group-hover:scale-110 transition-transform"></i>
    </a>

    <div class="w-full max-w-4xl bg-white shadow-2xl rounded-3xl flex flex-col md:flex-row overflow-hidden">
        <!-- Illustration Section -->
        <div class="md:w-1/2 bg-gradient-to-br from-blue-500 to-green-400 flex flex-col items-center justify-center p-8 relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <div class="absolute -top-10 -left-10 w-48 h-48 bg-white/20 rounded-full"></div>
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-white/20 rounded-full"></div>
            </div>

            <!-- Logo and Text -->
            <div class="absolute top-6 left-6 flex items-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M10.5 18.5c0 0.5-0.5 1-1 1s-1-0.5-1-1 0.5-1 1-1 1 0.5 1 1zM15.5 18.5c0 0.5-0.5 1-1 1s-1-0.5-1-1 0.5-1 1-1 1 0.5 1 1zM17.8 12c-0.5-2.2-2.2-4-4.5-4.5 0.3-0.5 0.5-1 0.5-1.6 0-1.7-1.3-3-3-3s-3 1.3-3 3c0 0.6 0.2 1.1 0.5 1.6-2.2 0.5-4 2.2-4.5 4.5-1.7 0.3-3 1.7-3 3.5 0 2 1.6 3.6 3.6 3.6h0.2c0.4 1.7 2 3 3.9 3 0.9 0 1.7-0.3 2.4-0.8 0.7 0.5 1.5 0.8 2.4 0.8 1.9 0 3.4-1.3 3.9-3h0.2c2 0 3.6-1.6 3.6-3.6 0-1.8-1.3-3.3-3-3.5zM10.8 4.9c0-0.7 0.6-1.3 1.3-1.3s1.3 0.6 1.3 1.3c0 0.7-0.6 1.3-1.3 1.3s-1.3-0.6-1.3-1.3zM15.1 18.2c-0.4 1.2-1.5 2-2.7 2-0.7 0-1.3-0.2-1.8-0.6-0.3-0.2-0.8-0.2-1.1 0-0.5 0.4-1.2 0.6-1.8 0.6-1.3 0-2.4-0.8-2.7-2h10.2zM19.4 15.5c0 1.1-0.9 2-2 2h-0.1c0-0.1 0-0.2 0-0.3 0-2.2-1.8-4-4-4h-2.5c-0.3 0-0.5 0.2-0.5 0.5s0.2 0.5 0.5 0.5h2.5c1.7 0 3 1.3 3 3 0 0.1 0 0.2 0 0.3h-10c0-0.1 0-0.2 0-0.3 0-1.7 1.3-3 3-3h0.9c0.3 0 0.5-0.2 0.5-0.5s-0.2-0.5-0.5-0.5h-0.9c-2.2 0-4 1.8-4 4 0 0.1 0 0.2 0 0.3h-0.1c-1.1 0-2-0.9-2-2s0.9-2 2-2h0.1c0.3 0 0.5-0.2 0.5-0.5s-0.2-0.5-0.5-0.5h-0.1c-0.8 0-1.4 0.3-1.9 0.9 0.5-2.3 2.5-4 4.9-4h6c2.4 0 4.4 1.7 4.9 4-0.5-0.5-1.2-0.9-1.9-0.9h-0.1c-0.3 0-0.5 0.2-0.5 0.5s0.2 0.5 0.5 0.5h0.1c1.1 0 2 0.9 2 2z"></path>
                </svg>
                <span class="font-bold text-lg">RescueSpot</span>
            </div>

            <!-- Animal Logo/Illustration -->
            <div class="text-center relative z-10">
                <!-- Animal Logo SVG -->
                <svg class="mx-auto mb-6 h-48 md:h-64 w-auto text-white animate-pulse" viewBox="0 0 512 512" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M256 224c-79.41 0-192 122.76-192 200.25 0 34.9 26.81 55.75 71.74 55.75 48.84 0 81.09-25.08 120.26-25.08 39.51 0 71.85 25.08 120.26 25.08 44.93 0 71.74-20.85 71.74-55.75C448 346.76 335.41 224 256 224zm-147.28-12.61c-10.4-34.65-42.44-57.09-71.56-50.13-29.12 6.96-44.29 40.69-33.89 75.34 10.4 34.65 42.44 57.09 71.56 50.13 29.12-6.96 44.29-40.69 33.89-75.34zm84.72-20.78c30.94-8.14 46.42-49.94 34.58-93.36s-46.52-72.01-77.46-63.87-46.42 49.94-34.58 93.36c11.84 43.42 46.53 72.02 77.46 63.87zm281.39-29.34c-29.12-6.96-61.15 15.48-71.56 50.13-10.4 34.65 4.77 68.38 33.89 75.34 29.12 6.96 61.15-15.48 71.56-50.13 10.4-34.65-4.77-68.38-33.89-75.34zm-156.27 29.34c30.94 8.14 65.62-20.45 77.46-63.87 11.84-43.42-3.64-85.21-34.58-93.36s-65.62 20.45-77.46 63.87c-11.84 43.42 3.64 85.22 34.58 93.36z"/>
                </svg>
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Welcome Back!</h2>
                <p class="text-white/80 max-w-xs mx-auto hidden md:block">
                    Your compassion can change an animal's life forever
                </p>
            </div>
        </div>

        <!-- Form Section -->
        <div class="md:w-1/2 p-6 md:p-12 flex flex-col justify-center relative">

            <!-- Login Form -->
            <form id="loginForm" action="{{ route('login') }}" method="POST" class="space-y-6">

            @csrf

                <h1 class="text-3xl md:text-4xl font-bold text-center mb-8 text-blue-900">
                    Login
                </h1>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        class="w-full px-4 py-3 border-2 border-blue-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300"
                        placeholder="Enter your email"
                    >
                </div>

                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            class="w-full px-4 py-3 border-2 border-blue-100 rounded-xl pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300"
                            placeholder="Enter your password"
                        >
                        <button
                            type="button"
                            id="passwordToggle"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M11 14l-3 3m0 0l-3-3m3 3V9" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full py-3.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition duration-300 flex items-center justify-center space-x-2 group"
                >
                    <span>Login</span>
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </button>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <button type="button" id="switchToRegister" class="text-blue-600 hover:text-blue-800 font-semibold ml-1 transition">
                            Sign Up
                        </button>
                    </p>
                </div>
            </form>

            <form id="registerForm" action="{{ route('register') }}" method="POST" class="space-y-6 hidden">
            @csrf
                <h1 class="text-3xl md:text-4xl font-bold text-center mb-8 text-blue-900">
                    Create Account
                </h1>

                <div>
                    <label for="fullName" class="block text-sm font-medium text-gray-700 mb-2">
                        Full Name
                    </label>
                    <input
                        type="text"
                        id="fullName"
                        name="name"
                        required
                        class="w-full px-4 py-3 border-2 border-blue-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300"
                        placeholder="Enter your full name"
                    >
                </div>

                <div>
                    <label for="registerEmail" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                    </label>
                    <input
                        type="email"
                        id="registerEmail"
                        name="email"
                        required
                        class="w-full px-4 py-3 border-2 border-blue-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300"
                        placeholder="Enter your email"
                    >
                </div>

                <!-- Account Type Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Account Type
                    </label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative flex cursor-pointer rounded-xl border-2 border-blue-100 bg-white p-4 focus-within:ring-2 focus-within:ring-blue-500 hover:border-blue-200">
                            <input type="radio" name="role_id" value="2" class="peer sr-only" checked>
                            <div class="flex items-center">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-3">
                                    <span class="text-gray-900 font-medium">User</span>
                                </div>
                            </div>
                            <div class="absolute top-4 right-4 h-5 w-5 text-blue-600 opacity-0 peer-checked:opacity-100">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="absolute inset-0 rounded-xl border-2 border-transparent peer-checked:border-blue-500"></div>
                        </label>
                        
                        <label class="relative flex cursor-pointer rounded-xl border-2 border-blue-100 bg-white p-4 focus-within:ring-2 focus-within:ring-blue-500 hover:border-blue-200">
                            <input type="radio" name="role_id" value="3" class="peer sr-only">
                            <div class="flex items-center">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 text-green-600">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="ml-3">
                                    <span class="text-gray-900 font-medium">Shelter</span>
                                </div>
                            </div>
                            <div class="absolute top-4 right-4 h-5 w-5 text-blue-600 opacity-0 peer-checked:opacity-100">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="absolute inset-0 rounded-xl border-2 border-transparent peer-checked:border-blue-500"></div>
                        </label>
                    </div>
                    
                    <!-- Hidden input field that will store the selected account type ID -->
                    <input type="hidden" id="accountTypeId" name="role_id" value="2">
                </div>

                <div class="relative">
                    <label for="registerPassword" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="registerPassword"
                            name="password"
                            required
                            class="w-full px-4 py-3 border-2 border-blue-100 rounded-xl pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300"
                            placeholder="Create a password"
                        >
                        <button
                            type="button"
                            id="registerPasswordToggle"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M11 14l-3 3m0 0l-3-3m3 3V9" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="relative">
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirm Password
                    </label>
                    <input
                        type="password"
                        id="confirmPassword"
                        name="confirmPassword"
                        required
                        class="w-full px-4 py-3 border-2 border-blue-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300"
                        placeholder="Confirm your password"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full py-3.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition duration-300 flex items-center justify-center space-x-2 group"
                >
                    <span>Sign Up</span>
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </button>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <button type="button" id="switchToLogin" class="text-blue-600 hover:text-blue-800 font-semibold ml-1 transition">
                            Login
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Form Toggle
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const switchToRegister = document.getElementById('switchToRegister');
        const switchToLogin = document.getElementById('switchToLogin');

        switchToRegister.addEventListener('click', () => {
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
        });

        switchToLogin.addEventListener('click', () => {
            registerForm.classList.add('hidden');
            loginForm.classList.remove('hidden');
        });

        // Password Visibility Toggle
        const passwordToggles = [
            { 
                toggle: document.getElementById('passwordToggle'), 
                input: document.getElementById('password'),
                svg: document.getElementById('passwordToggle').querySelector('svg path')
            },
            { 
                toggle: document.getElementById('registerPasswordToggle'), 
                input: document.getElementById('registerPassword'),
                svg: document.getElementById('registerPasswordToggle').querySelector('svg path')
            }
        ];

        passwordToggles.forEach(({ toggle, input, svg }) => {
            toggle.addEventListener('click', () => {
                const currentType = input.type;
                input.type = currentType === 'password' ? 'text' : 'password';
                
                if (currentType === 'password') {
                    svg.setAttribute('d', 
                        'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'
                    );
                } else {
                    svg.setAttribute('d', 
                        'M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M11 14l-3 3m0 0l-3-3m3 3V9'
                    );
                }
            });
        });

        // Account Type Selection
        const accountTypeRadios = document.querySelectorAll('input[name="role_id"]');
        const accountTypeIdInput = document.getElementById('accountTypeId');

        accountTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                accountTypeIdInput.value = this.value;
            });
        });

        // Form Validation
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password !== confirmPassword) {
                event.preventDefault();
                alert('Passwords do not match!');
            }
        });
    </script>
</body>
</html>