@extends('back.dashboard.master')
@section('name', 'Dashboard - Ecommerce')
@section('page-title', 'Dashboard')
@section('page-description')
    @if (Auth::user()->role->name === 'super_admin')
        Welcome, Super Admin!
    @elseif (Auth::user()->role->name === 'admin')
        Welcome, Admin!
    @endif
@endsection
@section('body')
    <div class="container mt-10">
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 ml-10 lg:ml-0 md:ml-10 sm:ml-5">

            <div class="max-w-sm p-6 bg-blue-100 border border-blue-300 rounded-lg shadow-sm">
                <h5 class="mb-2 text-2xl font-bold tracking-light text-blue-900">
                    <i class="fa-solid fa-book"></i> Book
                </h5>
                <p class="mb-3 font-normal text-blue-800">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                </p>
                <a href="#"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Read more
                    <svg class="w-3.5 h-3.5 ms-2" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>

            <div class="max-w-sm p-6 bg-green-100 border border-green-300 rounded-lg shadow-sm">
                <h5 class="mb-2 text-2xl font-bold tracking-light text-green-900">
                    <i class="fa-solid fa-book-bookmark"></i> Borrowing
                </h5>
                <p class="mb-3 font-normal text-green-800">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                </p>
                <a href="#"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300">
                    Read more
                    <svg class="w-3.5 h-3.5 ms-2" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>

            <div class="max-w-sm p-6 bg-yellow-100 border border-yellow-300 rounded-lg shadow-sm">
                <h5 class="mb-2 text-2xl font-bold tracking-light text-yellow-900">
                    <i class="fa-solid fa-user"></i> Registered User
                </h5>
                <p class="mb-3 font-normal text-yellow-800">
                    Data pengguna terdaftar.
                </p>
            </div>

            <div class="max-w-sm p-6 bg-pink-100 border border-pink-300 rounded-lg shadow-sm">
                <h5 class="mb-2 text-2xl font-bold tracking-light text-pink-900">
                    <i class="fa-solid fa-check-double"></i> Approved
                </h5>
                <p class="mb-3 font-normal text-pink-800">
                    Data persetujuan.
                </p>
            </div>

        </div>
    </div>
@endsection
