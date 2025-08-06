<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <title>Dashboard - Elibrary</title>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/b628ba4512.js" crossorigin="anonymous"></script>

    <!-- Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Alpine JS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/app.css')
    @yield('style')
</head>

<body class="h-full">
    @include('spinner')
    <!-- Header -->
    @include('back.dashboard.header')

    <!-- Sidebar -->
    <div class="flex pt-16">
        @include('back.dashboard.sidebar')

        <!-- Main content -->
        <main class="flex-1 lg:ml-64 sm:ml-0 md:ml-64 transition-all duration-300 fixed"
            :class="sidebarOpen ? 'translate-x-64' : 'translate-x-0'">
            <div class="p-6">
                <h2 class="text-xl">@yield('page-title')</h2>
                @yield('body')
            </div>
        </main>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.tailwindcss.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script> --}}
</body>

</html>
