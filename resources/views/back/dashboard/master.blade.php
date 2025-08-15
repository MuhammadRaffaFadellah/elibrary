<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <title>@yield('name')</title>

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.3/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

<body class="h-full overflow-auto">
    @include('spinner')

    <div class="flex flex-col h-full">
        <!-- Header -->
        @include('back.dashboard.header')

        <div class="flex flex-1 overflow-hidden mt-16">
            <!-- Sidebar -->
            @include('back.dashboard.sidebar')

            <!-- Main content -->
            <main class="flex-1 overflow-auto p-4 lg:ml-64 sm:ml-0 md:ml-64">
                <h2 class="font-semibold">@yield('page-title')</h2>
                <p class="text-xs text-gray-400">@yield('page-description')</p>
                @yield('body')
            </main>
        </div>
    </div>

    @yield('sscript')
</body>

</html>


</html>
