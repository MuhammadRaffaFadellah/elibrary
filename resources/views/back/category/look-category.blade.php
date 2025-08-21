<!-- Modal Look Card -->
<div id="lookCardModal" class="hidden fixed inset-0 bg-black bg-opacity-40 items-center justify-center z-50">
    <div
        class="look-modal-content bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96 relative text-gray-900 dark:text-gray-100">
        <!-- Button Close -->
        <button id="closeLookCard"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 text-xl font-bold">✖</button>

        <h2 class="text-lg font-semibold mb-4">Category Detail</h2>

        <div class="mb-2 flex">
            <label class="text-sm font-semibold text-gray-600 dark:text-gray-200 me-2">Name</label>
            <span class="ms-7 me-3">:</span>
            <p class="text-gray-800 dark:text-gray-200" id="categoryName"></p>
        </div>

        <div class="mb-2 flex">
            <label class="text-sm font-semibold text-gray-600 dark:text-gray-200 me-5">Slug</label>
            <span class="ms-7 me-3">:</span>
            <p class="text-gray-800 dark:text-gray-200" id="categorySlug"></p>
        </div>

        <div class="mb-2">
            <label class="text-sm font-semibold text-gray-600 dark:text-gray-200">Description</label>
            <span>:</span>
            <p class="text-gray-800 dark:text-gray-200" id="categoryDescription"></p>
        </div>
    </div>
</div>
