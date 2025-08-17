<div id="editCategoryModal" class="fixed flex inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">

    <div class="edit-modal-content bg-white p-6 rounded-md shadow-md max-w-lg w-full fixed">
        <button id="closeEditFormButton"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;
        </button>
        <h2 class="text-lg font-semibold mb-4 uppercase">Edit Data</h2>
        @if (isset($category))
            <form action="{{ route('category.update', $category->id) }}" method="POST" id="categoryEditForm">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1 uppercase">Name <span
                                class="text-red-700">*</span></label>
                        <input type="text" name="name" required value="{{ $category->name }}"
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200
                    placeholder:text-gray-400 placeholder:opacity-75">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1 uppercase">
                            Slug <span class="text-red-700">*</span>
                        </label>
                        <input type="text" name="slug" id="slug" required value="{{ $category->slug }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200
                    placeholder:text-gray-400 placeholder:opacity-75">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1 uppercase">
                            Description <span class="text-red-700">*</span>
                        </label>
                        <textarea name="description" placeholder="Tuliskan deskripsi kategori..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200
                            placeholder:text-gray-400 placeholder:opacity-75"
                            rows="4 ">
                    {{ $category->description }}
                </textarea>
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" id="cancelEditButton"
                        class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 transition duration-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-md bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 transition duration-200">
                        Update
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.querySelector('input[name="name"]');
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
