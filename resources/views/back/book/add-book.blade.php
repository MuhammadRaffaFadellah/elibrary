<style>
    /* Hilangkan panah di Chrome, Safari, Edge, Opera */
    .no-spinner::-webkit-outer-spin-button,
    .no-spinner::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Hilangkan panah di Firefox */
    .no-spinner[type=number] {
        -moz-appearance: textfield;
    }
</style>

<div id="addBookModal" class="fixed flex inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div
        class="book-modal-content bg-white dark:bg-gray-800 p-6 rounded-md shadow-md max-w-4xl overflow-y-auto max-h-screen w-full fixed transition-colors duration-300">
        <button id="closeFormButton"
            class="absolute top-2 right-2 text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white text-xl font-bold">✖
        </button>
        <h2 class="text-lg font-semibold mb-4 uppercase text-gray-900 dark:text-gray-100">Add Data</h2>
        <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data" class="">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Group left -->
                <div class="lg:col-span-1 ">
                    <div class="mb-4">
                        <label for="cover_image"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">Cover
                            <span class="text-red-700">*</span></label>
                        <input type="file" name="cover_image" id="cover_image" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-md cursor-pointer bg-white dark:bg-gray-700">
                        <!-- Preview -->
                        <div class="my-3">
                            <img id="coverPreview" class="hidden w-40 h-56 object-cover rounded-md border">
                        </div>
                    </div>
                    <!-- File -->
                    <div class="mb-4">
                        <label for="file_path"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">
                            File <span class="text-red-700">*</span>
                        </label>
                        <input type="file" name="file_path" id="file_path" accept=".pdf, .epub, .mobi, .doc, .docx"
                            class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-md cursor-pointer bg-white dark:bg-gray-700">
                    </div>

                    <!-- Categories -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">
                            Categories <span class="text-red-700">*</span>
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

                    <!-- Rekomendasi -->
                    <div class="mt-6">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="hidden" name="is_recommended" value="0">
                            <input type="checkbox" name="is_recommended" value="1"
                                class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="text-gray-700 dark:text-gray-300 font-sm font-medium">Buku
                                Rekomendasi</span>
                        </label>
                        <p class="text-xs text-gray-500 dark:text-gray-400 ml-8 mt-1">
                            Centang jika buku ini ingin ditampilkan di halaman rekomendasi.
                        </p>
                    </div>

                </div>

                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Title -->
                    <div>
                        <label for="title"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">Title
                            <span class="text-red-700">*</span></label>
                        <input type="text" name="title" id="title" required placeholder="Title . . ."
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 placeholder:text-gray-400 dark:placeholder-gray-500 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Slug -->
                    <input type="hidden" name="slug" id="slug">

                    <!-- Author -->
                    <div>
                        <label for="author"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">Author
                            <span class="text-red-700">*</span></label>
                        <input type="text" name="author" id="author" required placeholder="Author . . ."
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 placeholder:text-gray-400 dark:placeholder-gray-500 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Publisher -->
                    <div>
                        <label for="publisher"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">Publisher
                            <span class="text-red-700">*</span></label>
                        <input type="text" name="publisher" id="publisher" placeholder="Publisher . . ."
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 placeholder:text-gray-400 dark:placeholder-gray-500 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Year Published -->
                    <div>
                        <label for="year_published"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">Year Published
                            <span class="text-red-700">*</span></label>
                        <select name="year_published" id="year_published"
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Year</option>
                            @for ($year = date('Y'); $year >= 1900; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">Stock
                            <span class="text-red-700">*</span></label>
                        <input type="number" name="stock" id="stock" required min="0"
                            placeholder="Stock . . ."
                            class="no-spinner mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Status -->
                    <input type="hidden" name="status" value="available">

                    <!-- ISBN -->
                    <div>
                        <label for="isbn"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">
                            ISBN
                        </label>
                        <input type="number" name="isbn" id="isbn"
                            oninput="this.value = this.value.slice(0, 13);" placeholder="ISBN . . ."
                            class="no-spinner mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 uppercase">Description
                            <span class="text-red-700">*</span></label>
                        <textarea name="description" id="description" rows="4" placeholder="Book description . . ." required
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 placeholder:text-gray-400 dark:placeholder-gray-500 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" id="cancelButton"
                    class="px-4 py-2 rounded-md bg-red-600 hover:bg-red-700 text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 transition duration-200">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-green-600 hover:bg-green-700 text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 transition duration-200">
                    Add
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('cover_image').addEventListener('change', function(event) {
        const preview = document.getElementById('coverPreview');
        const file = event.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.querySelector('input[name="title"]');
        const slugInput = document.querySelector('input[name="slug"]');

        if (nameInput && slugInput) {
            nameInput.addEventListener('input', function() {
                slugInput.value = this.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9]+/g, '-') // ganti spasi & karakter aneh dengan -
                    .replace(/^-+|-+$/g, ''); // hapus - di awal/akhir
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#categories').select2({
            placeholder: "Select Categories",
            allowClear: true,
            dropdownParent: $('#addBookModal')
        })
    })
</script>
