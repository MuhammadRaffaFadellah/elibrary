<div id="lookBookModal" class="hidden fixed inset-0 bg-black bg-opacity-40 items-center justify-center z-50">
    <div
        class="look-book-modal-content bg-white dark:bg-gray-900 rounded-lg shadow-lg p-5 w-full max-w-md md:max-w-2xl relative max-h-[90vh] overflow-y-auto absolute transition-colors duration-300">
        <!-- Tombol Close -->
        <button id="closeLookBook"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100 transition-colors duration-300">
            ✖
        </button>

        <h2 class="text-lg font-semibold mb-4 uppercase text-gray-800 dark:text-gray-100">Book Detail</h2>

        <div class="wrapper">
            <div class="mb-2">
                <!-- Cover and Title -->
                <div class="flex gap-5">
                    <img src="" alt="Book cover" id="bookCover" class="h-40 w-28 object-cover rounded shadow">
                    <div class="flex flex-col flex-1">
                        <h2 class="text-lg ms-5 font-semibold text-gray-900 dark:text-white" id="bookTitle"></h2>
                        <div class="overflow-y-auto ms-5">
                            <!-- Description -->
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4" id="bookDescription"></p>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table-auto text-sm text-left w-full border-separate border-spacing-y-2">
                <tbody>
                    <tr class="align-top">
                        <td class="text-gray-500 dark:text-gray-300 w-28">Category</td>
                        <td class="px-2 dark:text-gray-300">:</td>
                        <td>
                            <div id="bookCategories" class="flex flex-wrap gap-2"></div>
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td class="text-gray-500 dark:text-gray-300">Author</td>
                        <td class="px-2 dark:text-gray-300">:</td>
                        <td>
                            <p id="bookAuthor"
                                class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-medium px-2.5 py-0.5 rounded shadow transition-colors duration-300">
                            </p>
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td class="text-gray-500 dark:text-gray-300">Publisher</td>
                        <td class="px-2 dark:text-gray-300">:</td>
                        <td>
                            <p id="bookPublisher"
                                class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-medium px-2.5 py-0.5 rounded shadow transition-colors duration-300">
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
