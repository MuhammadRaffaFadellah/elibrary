@extends('back.dashboard.master')
@section('name', 'Category - Elibrary')
@section('page-title', 'Category')
@section('page-description', 'Category table')
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
    <div class="wrapper flex flex-wrap md:flex-nowrap mt-3 mb-2.5 gap-2">
        <!-- Search -->
        <form action="{{ route('category.index') }}" method="GET"
            class="flex w-full md:flex-grow lg:w-auto md:w-auto sm:w-full">
            <input type="hidden" name="order" value="{{ request('order', 'desc') }}" />
            <input type="search" name="search" placeholder="Search . . ."
                class="flex-grow rounded-l-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                value="{{ request('search', '') }}">
            <button type="submit"
                class="px-4 py-2 rounded-r-md bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 text-white shadow-md transition duration-200 border border-blue-500 text-sm">
                Search
            </button>
        </form>

        <!-- Button ASC/DESC -->
        <div x-data="{ open: false }" class="relative w-full md:w-auto">
            <button @click="open = !open"
                class="w-full md:w-auto px-5 py-2.5 shadow-md bg-blue-500 text-white rounded-md hover:bg-blue-600 flex items-center justify-center gap-2 text-sm">
                Sort
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" @click.away="open = false"
                class="absolute mt-2 w-40 bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 z-50">
                <a href="{{ route('category.index', ['order' => 'asc']) }}" class="block px-4 py-2 hover:bg-gray-100">
                    Sort A-Z ⬆️
                </a>
                <a href="{{ route('category.index', ['order' => 'desc']) }}" class="block px-4 py-2 hover:bg-gray-100">
                    Sort Z-A ⬇️
                </a>
            </div>
        </div>

        <!-- Button export -->
        <button type="button"
            class="w-full md:w-auto px-4 py-2 rounded-md bg-gray-400 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 text-white shadow-md transition duration-200 text-sm">
            <i class="fa-solid fa-print"></i> Export as Excel
        </button>

        <!-- Button Tambah -->
        <button id="openAddModal"
            class="w-full md:w-auto px-4 py-2 rounded-md bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 text-white font-medium shadow-md transition duration-250 text-sm">
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>

    <div class="overflow-x-auto">
        <!-- Category table -->
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
                        Slug
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($categories as $category)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                            {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}.
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->slug }}</td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex space-x-2 align-items-center justify-center">
                            <!-- Tombol Lihat -->
                            <button
                                onclick="openLookCard('{{ $category->name }}', '{{ $category->slug }}', '{{ $category->description }}')"
                                class="group relative inline-flex items-center justify-center w-9 h-9 rounded-md bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200">
                                <i class="fa-solid fa-eye"></i>
                                <span
                                    class="absolute bottom-full mb-1 hidden group-hover:block text-xs text-white bg-gray-800 px-2 py-1 rounded-md shadow-md">
                                    Lihat
                                </span>
                            </button>

                            <!-- Tombol Edit -->
                            <button type="button" data-edit-category="{{ $category->id }}"
                                data-category='@json($category)'
                                class="group relative inline-flex items-center justify-center w-9 h-9 rounded-md bg-yellow-500 text-white hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition duration-200">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span
                                    class="absolute bottom-full mb-1 hidden group-hover:block text-xs text-white bg-gray-800 px-2 py-1 rounded-md shadow-md">
                                    Edit
                                </span>
                            </button>

                            <!-- Tombol Delete -->
                            <form id="deleteForm-{{ $category->id }}"
                                action="{{ route('category.delete', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    onclick="confirmDelete('{{ $category->name }}' , {{ $category->id }})"
                                    class="group relative inline-flex items-center justify-center w-9 h-9 rounded-md bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 transition duration-200">
                                    <i class="fa-solid fa-trash"></i>
                                    <span
                                        class="absolute bottom-full mb-1 hidden group-hover:block text-xs text-white bg-gray-800 px-2 py-1 rounded-md shadow-md">
                                        Hapus
                                    </span>
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-xs text-gray-400 py-2">No category data is registered.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $categories->links() }}
        </div>

        <!-- Card tambah data category -->
        <div>
            @include('back.category.add-category')
        </div>

        <!-- Card edit data category -->
        <div>
            @include('back.category.edit-category')
        </div>

        <!-- Card lihat data category -->
        <div>
            @include('back.category.look-category')
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
            const modal = document.getElementById('addCategoryModal');
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
                text: "Are you sure you want to delete this Category?",
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
                        text: "Category has been deleted successfully.",
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
                        text: "Category deletion has been cancelled.",
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
            const editButton = document.querySelectorAll('[data-edit-category]');
            const editModal = document.getElementById('editCategoryModal');
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
                    const userId = this.getAttribute('data-edit-category');
                    showEditModal();

                    const category = JSON.parse(this.getAttribute('data-category'));
                    editModal.querySelector('input[name="name"]').value = category.name;
                    editModal.querySelector('input[name="slug"]').value = category.slug;
                    editModal.querySelector('input[name="description"]').value = category
                        .description;
                    editModal.querySelector('form#adminEditForm').action =
                        `/category/process/edit/${category.id}`;
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
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('lookCardModal');
            const modalContent = modal.querySelector('.look-modal-content');
            const closeButton = document.getElementById('closeLookCard');

            // buka modal dengan data dinamis
            window.openLookCard = function(name, slug, description) {
                document.getElementById('categoryName').textContent = name;
                document.getElementById('categorySlug').textContent = slug;
                document.getElementById('categoryDescription').textContent = description;

                modal.classList.remove('hidden');
                modal.classList.add('flex');

                modalContent.classList.remove('slide-up');
                void modalContent.offsetWidth;
                modalContent.classList.add('slide-up');
            };

            // close modal
            function hideModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
            closeButton.addEventListener('click', hideModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    hideModal();
                }
            });
        });
    </script>
@endsection
