<div id="addCategoryModal" class="fixed flex inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">

    <div class="modal-content bg-white p-6 rounded-md shadow-md max-w-lg w-full fixed">
        <button id="closeFormButton" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">✖
        </button>
        <h2 class="text-lg font-semibold mb-4 uppercase">Add Data</h2>
        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1 uppercase">Name <span
                            class="text-red-700">*</span></label>
                    <input type="text" name="name" required placeholder="Name . . ."
                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200
                        placeholder:text-gray-400 placeholder:opacity-75">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1 uppercase">
                        Slug <span class="text-red-700">*</span>
                    </label>
                    <input type="text" name="slug" id="slug" required placeholder="Slug . . ."
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200
                        placeholder:text-gray-400 placeholder:opacity-75">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1 uppercase">
                        Description
                    </label>
                    <textarea name="description" placeholder="Tuliskan deskripsi kategori..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200
                        placeholder:text-gray-400 placeholder:opacity-75"
                        rows="4"></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" id="cancelButton"
                    class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 transition duration-200">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 transition duration-200">
                    Add
                </button>
            </div>
        </form>
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

<!-- Tambahkan di layout -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categories').select2({
            placeholder: "Pilih kategori",
            allowClear: true
        });
    });
</script>
