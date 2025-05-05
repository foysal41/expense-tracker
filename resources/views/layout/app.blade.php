<!-- resources/views/layout/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css'])

    <!-- Scripts -->
    @vite(['resources/js/app.js'])


</head>
<body class="font-sans antialiased bg-gray-100">



    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-indigo-600 p-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <a href="/" class="text-white text-2xl font-bold">Expense Tracker</a>
                <div class="space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-white hover:text-indigo-200">Login</a>
                        <a href="{{ route('register') }}" class="text-white hover:text-indigo-200">Register</a>
                    @else
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-white hover:text-indigo-200">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </nav>

        <!-- Main Section: Sidebar + Content -->
        <div class="flex flex-grow">

            @if (!in_array(request()->route()->getName(), ['login', 'register']))
            <aside class="w-64 bg-gray-800 text-white p-5 space-y-2">
                <h2 class="text-xl font-bold mb-4">Admin Menu</h2>
                <a href="{{ route("dashboard") }}" class="block py-2 px-3 rounded hover:bg-gray-600">Dashboard</a>
                <a href="{{ route("income") }}" class="block py-2 px-3 rounded hover:bg-gray-600">Income</a>
                <a href="{{ route("expense") }}" class="block py-2 px-3 rounded hover:bg-gray-600">Expense</a>
                <a href="{{ route("liabilitie") }}" class="block py-2 px-3 rounded hover:bg-gray-600">Liabilities</a>
            </aside>
            @endif
            <!-- Sidebar -->


            <!-- Dynamic Content -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>



        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-4">
            <div class="max-w-7xl mx-auto text-center">
                <p>&copy; {{ date('Y') }} Foysal Jaman. All rights reserved.</p>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
