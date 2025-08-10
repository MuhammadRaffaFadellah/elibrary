@extends('back.dashboard.master')
@section('name', 'User Management - Ecommerce')
@section('page-title', 'User Management')
@section('page-description', 'User management table')
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

    <div class="wrapper flex mt-3 mb-2.5 align-items-end justify-end gap-2">



        <!-- Button ASC/DESC -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 flex items-center gap-2">
                Urutkan
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" @click.away="open = false"
                class="absolute mt-2 w-40 bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 z-50">
                <a href="{{ route('user.index', ['order' => 'asc']) }}" class="block px-4 py-2 hover:bg-gray-100">
                    Urutkan A-Z ⬆️
                </a>
                <a href="{{ route('user.index', ['order' => 'desc']) }}" class="block px-4 py-2 hover:bg-gray-100">
                    Urutkan Z-A ⬇️
                </a>
            </div>
        </div>

        <!-- Button Tambah -->
        <button id="openAddModal"
            class="px-4 py-2.5 rounded-md bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600  text-white font-medium shadow-md transition duration-250">
            <i class="fa-solid fa-plus"></i>
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
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
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
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                            {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}.
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->username }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                            {{ $user->role->name === 'super_admin' ? 'Super Admin' : ucfirst($user->role->name) }}</td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex space-x-2 align-items-center justify-center">
                            <!-- Tombol Edit -->
                            <button type="button" data-edit-user="{{ $user->id }}"
                                data-user='@json($user)'
                                class="inline-flex items-center px-3 py-2 bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-200">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            <!-- Tombol Delete -->
                            <form id="deleteForm-{{ $user->id }}" action="{{ route('user.delete', $user->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    onclick="confirmDelete('{{ $user->name }}' , {{ $user->id }})"
                                    class="inline-flex items-center px-3 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition duration-200">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-xs text-gray-400 py-2">Tidak ada user terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $users->links() }}
        </div>

        <!-- Card tambah data user -->
        <div>
            @include('back.user-management.add-user')
        </div>

        <!-- Card edit data user -->
        <div>
            @include('back.user-management.edit-user')
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
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414
                                                                                                                                    1.414L11.414 10l4.293 4.293a1 1 0 01-1.414
                                                                                                                                    1.414L10 11.414l-4.293 4.293a1 1 0
                                                                                                                                    01-1.414-1.414L8.586 10 4.293 5.707a1 1 0
                                                                                                                                    010-1.414z"
                            clip-rule="evenodd" />
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

        <!-- Toast Delete -->
        @if (session('deleted'))
            <div class="fixed bottom-5 right-5 z-50 flex items-center w-full max-w-xs p-4 text-green-800 bg-green-100 border border-green-400 rounded-lg shadow-md transition-opacity duration-500 opacity-0"
                id="toast-deleted" role="alert">

                <!-- Icon toast -->
                <div class="flex-shrink-0 w-6 h-6 mr-3 animate-bounce-in">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <!-- Pesan deleted -->
                <div class="text-sm text-green-500 font-medium flex-1">
                    {{ session('deleted') }}
                </div>

                <!-- Button tutup -->
                <button type="button" class="ml-auto text-green-500 hover:text-green-700 focus:outline-none"
                    onclick="document.getElementById('toast-deleted').remove()">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414
                                                                                                                                    1.414L11.414 10l4.293 4.293a1 1 0 01-1.414
                                                                                                                                    1.414L10 11.414l-4.293 4.293a1 1 0
                                                                                                                                    01-1.414-1.414L8.586 10 4.293 5.707a1 1 0
                                                                                                                                    010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const toast = document.getElementById('toast-deleted');
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

        <!-- Toast Error -->
        @if (session('error'))
            <div class="fixed bottom-5 right-5 z-50 flex items-center w-full max-w-xs p-4 text-red-800 bg-red-100 border border-red-400 rounded-lg shadow-md transition-opacity duration-500 opacity-0"
                id="toast-error" role="alert">

                <!-- Icon toast -->
                <div class="flex-shrink-0 w-6 h-6 mr-3 animate-bounce-in">
                    <i class="fa-solid fa-xmark"></i>
                </div>

                <!-- Pesan deleted -->
                <div class="text-xs text-red-500 font-medium flex-1">
                    {{ session('error') }}
                </div>

                <!-- Button tutup -->
                <button type="button" class="ml-auto text-red-500 hover:text-red-700 focus:outline-none"
                    onclick="document.getElementById('toast-error').remove()">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414
                                                                                                                                    1.414L11.414 10l4.293 4.293a1 1 0 01-1.414
                                                                                                                                    1.414L10 11.414l-4.293 4.293a1 1 0
                                                                                                                                    01-1.414-1.414L8.586 10 4.293 5.707a1 1 0
                                                                                                                                    010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const toast = document.getElementById('toast-error');
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
            const openButton = document.getElementById('openAddModal');
            const modal = document.getElementById('addUserModal');
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

        // SweetAlert untuk session deleted
        function confirmDelete(userName, userId) {
            Swal.fire({
                icon: "question",
                title: `Delete ${userName}?`,
                text: "Are you sure you want to delete this user?",
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: `<i class="fa-solid fa-check"></i> Yes`,
                confirmButtonColor: "#7ADAA5",
                cancelButtonText: `<i class="fa-solid fa-xmark"></i> No`,
                cancelButtonColor: "#D92C54",
                customClass: {
                    confirmButton: 'bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600',
                    cancelButton: 'bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600'
                },
                showClass: {
                    popup: `
                        animate__animated
                        animate__fadeInUp
                        animate__faster
                    `
                },
                hideClass: {
                    popup: `
                        animate__animated
                        animate__fadeOutDown
                        animate__faster
                    `
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: "success",
                        title: "Deleted!",
                        text: "User has been deleted successfully.",
                        timer: 5000,
                        showConfirmButton: true,
                        confirmButtoText: 'OK',
                        customClass: {
                            confirmButton: 'bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600',
                        }
                    }).then(() => {
                        document.getElementById(`deleteForm-${userId}`).submit();
                    })
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        icon: "error",
                        title: "Cancelled!",
                        text: "User deletion has been cancelled.",
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600',
                        }
                    });
                }
            })
        }
    </script>

    <!-- Edit Modal Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButton = document.querySelectorAll('[data-edit-user]');
            const editModal = document.getElementById('editUserModal');
            const editModalContent = editModal.querySelector('.edit-modal-content');
            const closeEditButton = document.getElementById('closeEditFormButton');
            const cancelEditButton = document.getElementById('cancelEditButton');

            function showEditModal() {
                editModal.classList.remove('hidden');
                editModalContent.classList.remove('slide-up');
                void editModalContent.offsetWidth;
                editModalContent.classList.add('slide-up');
            }

            function hideEditModal() {
                editModal.classList.add('hidden');
            }

            editButton.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-edit-user');
                    showEditModal();

                    const user = JSON.parse(this.getAttribute('data-user'));
                    editModal.querySelector('input[name="name"]').value = user.name;
                    editModal.querySelector('input[name="username"]').value = user.username;
                    editModal.querySelector('input[name="email"]').value = user.email;
                    editModal.querySelector('form#userEditForm').action =
                        `/user-management/process/edit/${user.id}`;
                    editModal.querySelector('input[name="password"]').value = '';
                })
            })

            closeEditButton.addEventListener('click', hideEditModal);
            cancelEditButton.addEventListener('click', hideEditModal);

            editModal.addEventListener('click', (e) => {
                if (e.target === editModal) {
                    hideEditModal();
                }
            })
        })
    </script>

    <script>
        document.addEventListener('DOMContentLoader', function() {
            const sortButtons = document.querySelectorAll('.sort-btn')

            sortButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const column = this.dataset.column
                    let order = this.dataset.order
                    const table = document.querySelector('table tbody')
                    const rows = Array.from(table.querySelectorAll('tr'))

                    const th = this.closest('th')
                    const columnIndex = Array.from(th.parentNode.children).indexOf(th)

                    rows.sort((a, b) => {
                        const aText = a.children[columnIndex].innerText.trim().toLowerCase()
                        const bText = b.children[columnIndex].innerText.trim().toLowerCase()

                        return order === 'asc' ?
                            aText.localeCompare(bText) :
                            bText.localeCompare(aText)
                    })

                    if (order === 'asc') {
                        this.dataset.order = 'desc'
                        this.innetHTML = '<i class="fa-solid fa-arrow-down-short-wide"></i>'
                    } else {
                        this.dataset.order = 'asc'
                        this.innerHTML = '<i class="fa-solid fa-arrow-down-wide-short"></i>'
                    }

                    table.innerHTML = ''
                    rows.forEach(row => table.appendChild(row))
                })
            })
        })
    </script>
@endsection
