<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Al-ikhlas</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#15803d',
                        'primary-dark': '#166534',
                        'accent': '#facc15',
                        'accent-dark': '#eab308',
                    }
                }
            }
        }
    </script>
    <style>
        .islamic-pattern {
            background-color: #0a5c36;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%231a936f' fill-opacity='0.2'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .mosque-silhouette {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 800'%3E%3Cpath fill='%231a936f' fill-opacity='0.15' d='M600,200 C700,100 800,150 900,200 L900,600 C800,550 700,500 600,500 C500,500 400,550 300,600 L300,200 C400,150 500,100 600,200 Z'/%3E%3Cpath fill='%231a936f' fill-opacity='0.15' d='M600,150 C650,100 700,125 750,150 L750,200 C700,175 650,150 600,150 C550,150 500,175 450,200 L450,150 C500,125 550,100 600,150 Z'/%3E%3Ccircle fill='%231a936f' fill-opacity='0.15' cx='600' cy='100' r='30'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left Side - Image Section -->
        <div
            class="w-full md:w-1/2 mosque-silhouette flex items-center justify-center p-8 md:p-12 order-1 md:order-1">
            <div class="text-center text-white max-w-md">
                <img src="{{ asset('img/al_ikhlas_logo.png') }}" alt="Logo TPA">
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-8 md:p-12 order-2 md:order-2 bg-primary-dark">
            <div class="w-full max-w-md bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <!-- Header -->
                    <div class="text-start mb-8">
                        <h1 class="text-3xl font-bold text-green-800 mb-2">Masuk</h1>
                        <p class="text-gray-600">Silahkan login dengan akun anda</p>
                    </div>

                    <!-- Error / Success Message -->
                    @if (session('error'))
                        <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-400 text-red-700 text-sm">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if (session('success'))
                        <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-400 text-green-700 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <!-- Validasi Error -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 rounded-lg bg-yellow-100 border border-yellow-400 text-yellow-700 text-sm">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
        
                    <!-- Form -->
                    <form action="{{ route('action-login') }}" method="POST">
                        @csrf
                        <!-- Email/Username Field -->
                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="at-sign" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input type="text" id="email" name="email"
                                    class="w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                    placeholder="Masukkan email anda" value="{{ old('email') }}">
                            </div>
                        </div>
                    
                        <!-- Password Field -->
                        <div class="mb-6">
                            <label for="password" class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input type="password" id="password" name="password"
                                    class="w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                    placeholder="Masukkan password anda">
                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                    <i data-lucide="eye-off" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    
                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between mb-6">
                            <label for="remember" class="flex items-center cursor-pointer">
                                <!-- Toggle Switch -->
                                <div class="relative">
                                    <input type="checkbox" id="remember" class="sr-only peer">
                                    <div
                                        class="w-10 h-6 bg-gray-300 rounded-full peer peer-checked:bg-green-600 transition-colors duration-300">
                                    </div>
                                    <div
                                        class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full transition-transform duration-300 peer-checked:translate-x-2">
                                    </div>
                                </div>
                                <span class="ml-3 text-sm text-gray-700">Ingat Saya</span>
                            </label>
                        
                            <a href="#" class="text-sm text-primary hover:underline">Forgot Password?</a>
                        </div>
                    
                        <!-- Login Button -->
                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-800 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-offset-2">
                            Login
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        // Inisialisasi icon lucide
        lucide.createIcons();

        // Toggle Password
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // Ganti icon eye <-> eye-off
            this.innerHTML = "";
            const icon = document.createElement("i");
            icon.setAttribute("data-lucide", type === "password" ? "eye-off" : "eye");
            icon.className = "w-5 h-5";
            this.appendChild(icon);

            lucide.createIcons(); // re-render icon
        });
    </script>
</body>

</html>