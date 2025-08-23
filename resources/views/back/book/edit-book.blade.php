<!-- Edit Book Modal -->
<div id="editBookModal" class="fixed flex inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div
        class="edit-book-modal-content bg-white dark:bg-gray-800 p-6 rounded-md shadow-md max-w-4xl overflow-y-auto max-h-screen w-full fixed transition-colors duration-300">

        <!-- Tombol Close -->
        <button id="closeEditBookFormButton"
            class="absolute top-2 right-2 text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white text-xl font-bold">✖
        </button>

        <h2 class="text-lg font-semibold mb-4 uppercase text-gray-900 dark:text-gray-100">Edit Book</h2>

        <form action="" method="POST" id="bookEditForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="lg:col-span-1">
                    <!-- Cover -->
                    <div class="mb-4">
                        <label for="edit_cover_image"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">
                            Cover
                        </label>
                        <input type="file" name="cover_image" id="edit_cover_image" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-md cursor-pointer bg-white dark:bg-gray-700">
                        <!-- Preview -->
                        <div class="my-3">
                            <img id="editCoverPreview" class="hidden w-40 h-56 object-cover rounded-md border">
                        </div>
                    </div>

                    <!-- File -->
                    <div class="mb-4">
                        <label for="edit_file_path"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">
                            File
                        </label>
                        <input type="file" name="file_path" id="edit_file_path"
                            accept=".pdf, .epub, .mobi, .doc, .docx"
                            class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-md cursor-pointer bg-white dark:bg-gray-700">
                        <input type="hidden" name="old_file_path" id="old_file_path">

                        <p id="currentFile" class="mt-2 text-sm text-gray-500 dark:text-gray-300 hidden">
                            Current file: <a id="fileLink" href="#" target="_blank"
                                class="text-blue-600 underline">Download</a>
                        </p>
                    </div>

                    <!-- Categories -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">
                            Categories
                        </label>
                        <div
                            class="mt-2 max-h-48 overflow-y-auto border border-gray-300 dark:border-gray-600 rounded-md p-2 bg-white dark:bg-gray-700">
                            @if ($categories->isEmpty())
                                <div class="text-center text-gray-500 dark:text-gray-400">
                                    Data kategori kosong.
                                </div>
                            @else
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach ($categories as $category)
                                        <label
                                            class="flex items-center gap-2 p-2 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-gray-600">
                                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <span class="text-gray-700 dark:text-gray-300">{{ $category->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Title -->
                    <div>
                        <label for="edit_title"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">
                            Title
                        </label>
                        <input type="text" name="title" id="edit_title" required placeholder="Title . . ."
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 placeholder:text-gray-400 dark:placeholder-gray-500 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Slug -->
                    <input type="hidden" name="slug" id="editBookSlug">

                    <!-- Author -->
                    <div>
                        <label for="edit_author"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">
                            Author
                        </label>
                        <input type="text" name="author" id="edit_author" required placeholder="Author . . ."
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 placeholder:text-gray-400 dark:placeholder-gray-500 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Publisher -->
                    <div>
                        <label for="edit_publisher"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">
                            Publisher
                        </label>
                        <input type="text" name="publisher" id="edit_publisher" placeholder="Publisher . . ."
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 placeholder:text-gray-400 dark:placeholder-gray-500 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Year Published -->
                    <div>
                        <label for="edit_year_published"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">
                            Year Published
                        </label>
                        <select name="year_published" id="edit_year_published"
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Year</option>
                            @for ($year = date('Y'); $year >= 1900; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="edit_stock"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">
                            Stock
                        </label>
                        <input type="number" name="stock" id="edit_stock" required min="0"
                            placeholder="Stock . . ."
                            class="no-spinner mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- ISBN -->
                    <div>
                        <label for="edit_isbn"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">
                            ISBN
                        </label>
                        <input type="number" name="isbn" id="edit_isbn"
                            oninput="this.value = this.value.slice(0, 13);" placeholder="ISBN . . ."
                            class="no-spinner mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="edit_description"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">
                            Description
                        </label>
                        <textarea name="description" id="edit_description" rows="4" placeholder="Book description . . ." required
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 placeholder:text-gray-400 dark:placeholder-gray-500 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" id="cancelEditBookButton"
                    class="px-4 py-2 rounded-md bg-red-600 hover:bg-red-700 text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 transition duration-200">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-green-600 hover:bg-green-700 text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 transition duration-200">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    if (book.file_url) {
        fileLink.href = book.file_url;
        fileLink.textContent = book.file_name ?? 'Download'; // Menampilkan nama file lama
        currentFile.classList.remove('hidden');
        oldFileInput.value = book.file_path;
    } else {
        currentFile.classList.add('hidden');
        oldFileInput.value = '';
    }
</script>
