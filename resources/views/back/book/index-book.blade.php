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
    <div class="wrapper flex flex-wrap md:flex-nowrap mt-3 mb-2.5 gap-2">
        <form action="{{ route('book.index') }}" method="GET" class="flex flex-grow">
            <input type="hidden" name="order" value="{{ request('order', 'desc') }}" />
            <input type="search" name="search" placeholder="Search . . ."
                class="flex-grow rounded-l-md border border-gray-300 px-4 py-2 
                    focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500
                    bg-white text-gray-900
                    dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600 dark:placeholder-gray-400"
                value="{{ request('search', '') }}">
            <button type="submit"
                class="px-4 py-2 rounded-r-md bg-blue-500 hover:bg-blue-600 
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 
                    text-white shadow-md transition duration-200 border border-blue-500">
                Search
            </button>
        </form>

        <!-- Button ASC/DESC -->
        <div x-data="{ open: false }" class="relative w-full md:w-auto">
            <button @click="open = !open"
                class="w-full md:w-auto px-5 py-2.5 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 flex items-center justify-center gap-2 text-sm">
                Sort
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" @click.away="open = false"
                class="absolute mt-2 w-40 bg-white rounded-lg shadow-lg overflow-hidden 
                    border border-gray-200 z-50 dark:bg-gray-800 dark:border-gray-700">
                <a href="{{ route('book.index', ['order' => 'asc']) }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200">
                    Sort A-Z ⬆️
                </a>
                <a href="{{ route('book.index', ['order' => 'desc']) }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200">
                    Sort Z-A ⬇️
                </a>
            </div>
        </div>

        <!-- Button export -->
        <button type="button"
            class="w-full md:w-auto px-4 py-2 rounded-md bg-gray-400 hover:bg-gray-500 
                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 
                text-white shadow-md transition duration-200 text-sm">
            <i class="fa-solid fa-print"></i> Export as Excel
        </button>

        <!-- Button Tambah -->
        <button id="openAddModal"
            class="w-full md:w-auto px-4 py-2 rounded-md bg-green-600 hover:bg-green-700 
                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 
                text-white font-medium shadow-md transition duration-250 text-sm">
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>

    <div class="overflow-x-auto">
        <!-- Books table -->
        <table class="w-full min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        No
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Cover
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Title
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Category
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Author
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Publisher
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Year
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        ISBN
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Stock
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Status
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                @forelse ($books as $book)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200 text-center">
                            {{ $loop->iteration + ($books->currentPage() - 1) * $books->perPage() }}.
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Book Cover" class="h-16 rounded">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $book->title }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200 ">
                            <div class="flex justify-center gap-2">
                                @foreach ($book->categories as $category)
                                    <span
                                        class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded justify-center font-semibold">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $book->author }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            {{ $book->publisher }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            {{ $book->year_published }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            {{ $book->isbn }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200 text-center">
                            {{ $book->stock }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200 capitalize">
                            @if ($book->status === 'available')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                    {{ $book->status }}
                                </span>
                            @elseif ($book->status === 'borrowed')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                    {{ $book->status }}
                                </span>
                            @elseif ($book->status === 'inactive')
                                <span class="px-1 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                    {{ $book->status }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex space-x-1 mt-3.5 gap-1">
                            <button data-title="{{ $book->title }}"
                                data-image="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : '' }}"
                                data-description="{{ strip_tags($book->description) }}"
                                data-categories='@json($book->categories)' data-author='{{ $book->author }}'
                                data-publisher='{{ $book->publisher }}'
                                class="btn-look-book group relative inline-flex items-center justify-center w-9 h-9 rounded-md bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200">
                                <i class="fa-solid fa-eye"></i>
                                <span
                                    class="absolute bottom-full mb-1 hidden group-hover:block text-xs text-white bg-gray-800 px-2 py-1 rounded-md shadow-md">
                                    Look
                                </span>
                            </button>
                            @php
                                $bookPayload = [
                                    'id' => $book->id,
                                    'title' => $book->title,
                                    'slug' => $book->slug,
                                    'author' => $book->author,
                                    'publisher' => $book->publisher,
                                    'description' => $book->description,
                                    'year_published' => $book->year_published,
                                    'stock' => $book->stock,
                                    'isbn' => $book->isbn,

                                    // path & URL public
                                    'cover_image' => $book->cover_image,
                                    'cover_url' => $book->cover_image ? Storage::url($book->cover_image) : null,
                                    'file_path' => $book->file_path,
                                    'file_url' => $book->file_path ? Storage::url($book->file_path) : null,

                                    // array ID category
                                    'categories' => $book->categories ? $book->categories->pluck('id') : [],
                                ];
                            @endphp

                            <button type="button" data-edit-book='@json($bookPayload)'
                                class="group relative inline-flex items-center justify-center w-9 h-9 rounded-md bg-yellow-500 text-white hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition duration-200">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span
                                    class="absolute bottom-full mb-1 hidden group-hover:block text-xs text-white bg-gray-800 px-2 py-1 rounded-md shadow-md">
                                    Edit
                                </span>
                            </button>


                            <!-- Button Delete -->
                            <form id="deleteForm-{{ $book->id }}" action="{{ route('book.delete', $book->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    onclick="confirmDelete('{{ $book->title }}' , {{ $book->id }})"
                                    class="group relative inline-flex items-center justify-center w-9 h-9 rounded-md bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 transition duration-200">
                                    <i class="fa-solid fa-trash"></i>
                                    <span
                                        class="absolute bottom-full mb-1 hidden group-hover:block text-xs text-white bg-gray-800 px-2 py-1 rounded-md shadow-md">
                                        Delete
                                    </span>
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

        <!-- Card look data book -->
        <div>
            @include('back.book.look-book')
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

    <!-- Edit Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('[data-edit-book]');
            const editModal = document.getElementById('editBookModal');
            const editModalContent = editModal.querySelector('.edit-book-modal-content');
            const closeEditButton = document.getElementById('closeEditBookFormButton');
            const cancelEditButton = document.getElementById('cancelEditBookButton');

            const editCoverInput = document.getElementById('edit_cover_image');
            const editCoverPreview = document.getElementById('editCoverPreview');
            const oldCoverInput = document.getElementById('old_cover'); // bisa null
            const editFileInput = document.getElementById('edit_file_path');
            const oldFileInput = document.getElementById('old_file_path'); // bisa null
            const currentFile = document.getElementById('currentFile'); // bisa null
            const fileLink = document.getElementById('fileLink'); // bisa null

            function showEditModal() {
                editModal.classList.remove('hidden');
                editModalContent.classList.remove('slide-up');
                void editModalContent.offsetWidth;
                editModalContent.classList.add('slide-up');
            }

            function hideEditModal() {
                editModal.classList.add('hidden');
            }

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    let book;
                    try {
                        book = JSON.parse(this.getAttribute('data-edit-book'));
                    } catch (e) {
                        console.error('data-edit-book invalid', e);
                        return;
                    }

                    showEditModal();

                    const form = editModal.querySelector('form#bookEditForm');
                    form.action = `/book/process/edit/${book.id}`;

                    // isi input teks
                    document.getElementById('edit_title').value = book.title ?? '';
                    document.getElementById('editBookSlug').value = book.slug ?? '';
                    document.getElementById('edit_author').value = book.author ?? '';
                    document.getElementById('edit_publisher').value = book.publisher ?? '';
                    document.getElementById('edit_description').value = book.description ?? '';
                    document.getElementById('edit_year_published').value = book.year_published ??
                    '';
                    document.getElementById('edit_stock').value = book.stock ?? '';
                    document.getElementById('edit_isbn').value = book.isbn ?? '';

                    // COVER lama → pakai cover_url, fallback ke /storage/cover_image
                    const coverUrl = book.cover_url || (book.cover_image ?
                        `/storage/${book.cover_image}` : null);
                    if (coverUrl) {
                        editCoverPreview.src = coverUrl;
                        editCoverPreview.classList.remove('hidden');
                        if (oldCoverInput) oldCoverInput.value = book.cover_image ?? '';
                    } else {
                        editCoverPreview.classList.add('hidden');
                        if (oldCoverInput) oldCoverInput.value = '';
                    }
                    if (editCoverInput) editCoverInput.value = '';

                    // FILE lama → tampilkan link jika ada
                    const fileUrl = book.file_url || (book.file_path ?
                        `/storage/${book.file_path}` : null);
                    if (fileUrl && currentFile && fileLink) {
                        fileLink.href = fileUrl;
                        currentFile.classList.remove('hidden');
                        if (oldFileInput) oldFileInput.value = book.file_path ?? '';
                    } else {
                        if (currentFile) currentFile.classList.add('hidden');
                        if (oldFileInput) oldFileInput.value = '';
                    }
                    if (editFileInput) editFileInput.value = '';

                    // KATEGORI → normalisasi ke array ID
                    const categoryCheckboxes = form.querySelectorAll('input[name="categories[]"]');
                    categoryCheckboxes.forEach(cb => cb.checked = false);

                    let selectedIds = [];
                    if (Array.isArray(book.categories)) {
                        selectedIds = book.categories.map(c => (typeof c === 'object' && c !==
                            null) ? c.id : c);
                    }
                    selectedIds.forEach(id => {
                        const cb = form.querySelector(
                            `input[name="categories[]"][value="${id}"]`);
                        if (cb) cb.checked = true;
                    });
                });
            });

            // preview cover baru
            if (editCoverInput) {
                editCoverInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        editCoverPreview.src = URL.createObjectURL(file);
                        editCoverPreview.classList.remove('hidden');
                    }
                });
            }

            cancelEditButton.addEventListener('click', hideEditModal);
            closeEditButton.addEventListener('click', hideEditModal);
            editModal.addEventListener('click', (e) => {
                if (e.target === editModal) hideEditModal();
            });

            // auto-slug
            const titleInput = document.getElementById('edit_title');
            const slugInput = document.getElementById('editBookSlug');
            titleInput.addEventListener('input', function() {
                slugInput.value = this.value.toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(
                    /^-+|-+$/g, '');
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("lookBookModal");
            const modalContent = document.querySelector('.look-book-modal-content');
            const closeButton = document.getElementById("closeLookBook");

            const bookTitle = document.getElementById("bookTitle");
            const bookAuthor = document.getElementById("bookAuthor");
            const bookPublisher = document.getElementById("bookPublisher");
            const bookCover = document.getElementById("bookCover");
            const bookDescription = document.getElementById("bookDescription");
            const bookCategories = document.getElementById("bookCategories");

            // open look button 
            document.querySelectorAll(".btn-look-book").forEach(button => {
                button.addEventListener("click", function() {
                    // Ambil data dari atribut tombol
                    const title = this.getAttribute("data-title");
                    const author = this.getAttribute("data-author");
                    const publisher = this.getAttribute("data-publisher");
                    const image = this.getAttribute("data-image");
                    const description = this.getAttribute("data-description");
                    const categories = JSON.parse(this.getAttribute("data-categories"));

                    // Isi data ke modal
                    bookTitle.textContent = title;
                    bookAuthor.textContent = author;
                    bookPublisher.textContent = publisher;
                    bookCover.src = image;
                    bookDescription.textContent = description;

                    // Isi kategori
                    bookCategories.innerHTML = "";
                    if (categories.length > 0) {
                        categories.forEach(cat => {
                            const span = document.createElement("span");
                            span.textContent = cat.name;
                            span.className =
                                "inline bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded shadow";
                            bookCategories.appendChild(span);
                        });
                    } else {
                        bookCategories.innerHTML =
                            `<span class="text-gray-400 italic">Tidak ada kategori</span>`;
                    }

                    // Tampilkan modal
                    modal.classList.remove("hidden");
                    modal.classList.add("flex");

                    // Reset animasi supaya selalu jalan
                    modalContent.classList.remove("slide-up");
                    void modalContent.offsetWidth; // trik reflow
                    modalContent.classList.add("slide-up");
                });
            });

            if (closeButton) {
                closeButton.addEventListener("click", function() {
                    modal.classList.add("hidden");
                    modal.classList.remove("flex");
                });
            }

            // Klik di luar modal
            modal.addEventListener("click", function(e) {
                if (e.target === modal) {
                    modal.classList.add("hidden");
                    modal.classList.remove("flex");
                }
            });
        });
    </script>
@endsection
