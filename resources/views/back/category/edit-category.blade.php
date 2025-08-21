<div id="editCategoryModal" class="fixed flex inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">

    <div class="edit-modal-content bg-white dark:bg-gray-800 p-6 rounded-md shadow-md max-w-lg w-full fixed">
        <button id="closeEditFormButton"
            class="absolute top-2 right-2 text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white text-xl font-bold transition-colors duration-200">✖
        </button>
        <h2 class="text-lg font-semibold mb-4 uppercase dark:text-gray-100 transition-colors duration-300">Edit Data</h2>
        <form action="" method="POST" id="categoryEditForm">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                <div class="mb-4">
                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 uppercase transition-colors duration-300">Name
                        <span class="text-red-700">*</span></label>
                    <input type="text" name="name" required value="{{ old('name') }}"
                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md 
                                focus:ring focus:ring-blue-200 dark:focus:ring-blue-500 
                                bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition-colors duration-300">
                </div>

                <div class="mb-4">
                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 uppercase transition-colors duration-300">
                        Slug <span class="text-red-700">*</span>
                    </label>
                    <input type="text" name="slug" id="slug" required value="{{ old('slug') }}"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md 
                                focus:ring focus:ring-blue-200 dark:focus:ring-blue-500 
                                bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition-colors duration-300">
                </div>

                <div class="mb-4">
                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 uppercase transition-colors duration-300">
                        Description <span class="text-red-700">*</span>
                    </label>
                    <textarea name="description" placeholder="Tuliskan deskripsi kategori..."
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md 
                                focus:ring focus:ring-blue-200 dark:focus:ring-blue-500 
                                bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition-colors duration-300"
                        rows="4 ">
                    {{ old('description') }}
                </textarea>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" id="cancelEditButton"
                    class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 
                        focus:outline-none focus:ring-2 focus:ring-offset-2 
                        focus:ring-red-600 transition duration-200">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-green-600 text-white hover:bg-green-700 
                        focus:outline-none focus:ring-2 focus:ring-offset-2 
                        focus:ring-green-600 transition duration-200">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ambil input hanya dari form edit
        const editForm = document.getElementById('categoryEditForm');
        if (!editForm) return;

        const nameInput = editForm.querySelector('input[name="name"]');
        const slugInput = editForm.querySelector('input[name="slug"]');

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
