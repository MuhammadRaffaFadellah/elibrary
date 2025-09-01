@extends('back.dashboard.master')
@section('name', 'Dashboard - Elibrary')
@section('page-title', 'Dashboard')
@section('page-description')
    @if (Auth::user()->role->name === 'super_admin')
        Welcome, Admin {{ $user->username }}!
    @elseif (Auth::user()->role->name === 'admin')
        Welcome, Admin {{ $user->username }}!
    @endif
@endsection
@section('body')
    <div class="container mt-10 flex-wrap justify-center max-w-full">
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 ml-0 lg:ml-0 md:ml-0 sm:ml-0">

            <div class="max-w-sm p-6 bg-blue-100 border border-blue-300 rounded-lg shadow-sm">
                <h5 class="mb-4 text-2xl font-bold tracking-tight text-blue-900 flex items-center gap-3">
                    <i class="fa-solid fa-book"></i>
                    <span>Book</span>
                </h5>
                <p class="text-blue-800 text-base leading-relaxed">
                    Number of books
                </p>
                <p class="text-blue-800 text-xl font-semibold mt-2 ">
                    {{ $booksCount }} Recorded
                </p>
            </div>
            <div class="max-w-sm p-6 bg-green-100 border border-green-300 rounded-lg shadow-sm">
                <h5 class="mb-4 text-2xl font-bold tracking-tight text-green-900 flex items-center gap-3">
                    <i class="fa-solid fa-book-bookmark"></i>
                    <span>Borrowed Books</span>
                </h5>
                <p class="text-green-800 text-base leading-relaxed">
                    Number of books borrowed
                </p>

            </div>

            <div
                class="max-w-sm p-6 bg-yellow-100 border border-yellow-300 rounded-lg shadow-sm flex flex-col justify-between">
                <h5 class="mb-4 text-2xl font-bold tracking-tight text-yellow-900 flex items-center gap-3">
                    <i class="fa-solid fa-user"></i>
                    <span>Registered User</span>
                </h5>

                <p class="text-yellow-800 text-base">
                    Number of registered users
                </p>
                <p class="text-yellow-800 text-xl font-semibold mt-2 ">
                    {{ $userCount }} Registered
                </p>
            </div>

            <div class="max-w-sm p-6 bg-pink-100 border border-pink-300 rounded-lg shadow-sm">
                <h5 class="mb-4 text-2xl font-bold tracking-tight text-pink-900 flex items-center gap-3">
                    <i class="fa-solid fa-stopwatch"></i>
                    <span>Overdue Book</span>
                </h5>
                <p class="text-pink-800 text-base leading-relaxed">
                    Number of overdue books
                </p>
                <p class="text-yellow-800 text-xl font-semibold mt-2 ">
                    0 Books
                </p>
            </div>

        </div>
    </div>
@endsection
