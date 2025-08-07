@extends('back.dashboard.master')
@section('name', 'User Management - Elibrary')
@section('page-title', 'Dashboard > User Management')
@section('body')
    <style>
        @keyframes slideUp {
            from {
                transform: translateY(100px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .slide-up {
            animation: slideUp 0.4s ease-out;
        }
    </style>

    <div class="wrapper flex mt-5 mb-5 align-items-end justify-end">
        <!-- Button Tambah -->
        <button id="openFormButton"
            class="px-4 py-2 rounded-md bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600  text-white font-medium shadow-md transition duration-250">
            Tambah
        </button>

    </div>
    <div class="overflow-x-auto">
        <!-- Tabel User -->
        <table class="w-full min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Username
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Role
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                            {{ $loop->iteration }}.
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->username }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                            {{ $user->role->name === 'super_admin' ? 'Super Admin' : ucfirst($user->role->name) }}</td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex space-x-2 align-items-center justify-center">
                            <!-- Tombol Edit -->
                            <a href=""
                                class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-sm font-medium rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            <!-- Tombol Delete -->
                            <form action="" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Card tambah data user -->
        <div>
            @include('back.user-management.add-user')
        </div>

        <!-- Card edit data user -->
        <div>
            {{-- @include('') --}}
        </div>

        <!-- Toast Sukses -->
        @if (session('success'))
            <div class="fixed bottom-5 right-5 z-50 flex items-center w-full max-w-xs p-4 text-green-800 bg-green-100 border border-green-400 rounded-lg shadow-md transition-opacity duration-500 opacity-0"
                id="toast-success" role="alert">

                <!-- Icon toast -->
                <div class="flex-shrink-0 w-6 h-6 mr-3 animate-bounce-in">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <!-- Pesan sukses -->
                <div class="text-sm font-medium flex-1">
                    {{ session('success') }}
                </div>

                <!-- Button tutup -->
                <button type="button" class="ml-auto text-green-500 hover:text-green-700 focus:outline-none"
                    onclick="document.getElementById('toast-success').remove()">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414
                            1.414L11.414 10l4.293 4.293a1 1 0 01-1.414
                            1.414L10 11.414l-4.293 4.293a1 1 0
                            01-1.414-1.414L8.586 10 4.293 5.707a1 1 0
                            010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const toast = document.getElementById('toast-success');
                    if (toast) {
                        toast.classList.remove('opacity-0');
                        toast.classList.add('opacity-100');

                        // Otomatis hide after 5 detik
                        setTimeout(() => {
                            toast.classList.add('opacity-0');
                            setTimeout(() => toast.remove(), 500);
                        }, 5000);
                    }
                })
            </script>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openButton = document.getElementById('openFormButton');
            const modal = document.getElementById('userFormModal');
            const modalContent = modal.querySelector('.modal-content');
            const closeButton = document.getElementById('closeFormButton');
            const cancelButton = document.getElementById('cancelButton');

            function showModal() {
                modal.classList.remove('hidden');
                modalContent.classList.remove('slide-up'); // Reset dulu
                void modalContent.offsetWidth; // Force reflow to re-trigger animation
                modalContent.classList.add('slide-up');
            }

            function hideModal() {
                modal.classList.add('hidden');
            }

            openButton.addEventListener('click', showModal);
            closeButton.addEventListener('click', hideModal);
            cancelButton.addEventListener('click', hideModal);

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    hideModal();
                }
            });
        });
    </script>
@endsection
