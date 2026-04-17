<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <nav class="bg-white shadow-sm p-4 flex justify-between items-center">
        <span class="text-xl font-bold text-blue-600">InsuranceSystem</span>
        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-gray-600">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 mr-4">Login</a>
                    <a href="{{ route('register') }}" class="text-blue-600 font-semibold">Register</a>
                @endauth
            @endif
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center text-center px-4">
        <div class="max-w-2xl">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                Insurance Policy Management
            </h1>
            <p class="text-gray-600 mb-8">
                Easily manage your Policies, Customers, and Vehicles in one place.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700">
                    Get Started
                </a>
            </div>
        </div>
    </main>

    <footer class="p-6 text-center text-gray-500 text-sm">
        &copy; 2026 Activity 3 - Insurance System
    </footer>

</body>
</html>
