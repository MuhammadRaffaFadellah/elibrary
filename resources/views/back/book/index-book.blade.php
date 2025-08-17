@extends('back.dashboard.master')
@section('name', 'Books - Elibrary')
@section('page-title', 'Books')
@section('page-description', 'Books table')
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
    <div class="wrapper flex mt-3 mb-2.5 gap-2">
        <form action="{{ route('book.index') }}" method="GET" class="flex flex-grow">
            <input type="hidden" name="order" value="{{ request('order', 'desc') }}" />
            <input type="search" name="search" placeholder="Search . . ."
                class="flex-grow rounded-l-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                value="{{ request('search', '') }}">
            <button type="submit"
                class="px-4 py-2 rounded-r-md bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 text-white shadow-md transition duration-200 border border-blue-500">
                Search
            </button>
        </form>

        <!-- Button export -->
        <button type="button"
            class="ms-auto px-4 py-2 rounded-md bg-gray-400 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 text-white shadow-md transition duration-200">
            <i class="fa-solid fa-print"></i> Export as Excel
        </button>

        <!-- Button ASC/DESC -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="px-5 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 flex items-center gap-2">
                Sort
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" @click.away="open = false"
                class="absolute mt-2 w-40 bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 z-50">
                <a href="{{ route('book.index', ['order' => 'asc']) }}" class="block px-4 py-2 hover:bg-gray-100">
                    Sort A-Z ⬆️
                </a>
                <a href="{{ route('book.index', ['order' => 'desc']) }}" class="block px-4 py-2 hover:bg-gray-100">
                    Sort Z-A ⬇️
                </a>
            </div>
        </div>

        <!-- Button Tambah -->
        <button id="openAddModal"
            class="px-4 py-2 rounded-md bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600  text-white font-medium shadow-md transition duration-250">
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>

    <div class="overflow-x-auto">
        <!-- Books table -->
        <table class="w-full min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        No
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Cover
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Title
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Category
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Author
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Publisher
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Year
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Stock
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($books as $book)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                            {{ $loop->iteration + ($books->currentPage() - 1) * $books->perPage() }}.
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $admin->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $admin->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $admin->categories->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $admin->author }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $admin->publisher }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $admin->year_published }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $admin->stock }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $admin->status }}</td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex space-x-2 align-items-center justify-center">
                            <!-- Tombol Edit -->
                            <button type="button" data-edit-book="{{ $book->id }}"
                                data-book='@json($book)'
                                class="inline-flex items-center px-3 py-2 bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-200">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            <!-- Tombol Delete -->
                            <form id="deleteForm-{{ $book->id }}" action="{{ route('book.delete', $admin->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    onclick="confirmDelete('{{ $book->title }}' , {{ $book->id }})"
                                    class="inline-flex items-center px-3 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition duration-200">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-xs text-gray-400 py-2">No book data registered.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $books->links() }}
        </div>

        <!-- Card tambah data book -->
        <div>
            @include('back.book.add-book')
        </div>

        <!-- Card edit data book -->
        <div>
            @include('back.book.edit-book')
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openButton = document.getElementById('openAddModal');
            const modal = document.getElementById('addBookModal');
            const modalContent = modal.querySelector('.book-modal-content');
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
                text: "Are you sure you want to delete this book?",
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
                        text: "Book has been deleted successfully.",
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
                        text: "Admin deletion has been cancelled.",
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
@endsection
