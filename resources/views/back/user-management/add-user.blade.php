<!-- Card to add a new user -->

<div id="userFormModal" class="fixed flex inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">

    <div class="modal-content bg-white p-6 rounded-md shadow-md max-w-lg w-full fixed">
        <button id="closeFormButton"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;
        </button>
        <h2 class="text-lg font-semibold mb-4">Tambah Data</h2>
        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200">
                </div>
            </div>

            <input type="hidden" name="role_id" value="3">

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" id="cancelButton"
                    class="px-4 py-2 rounded-md bg-gray-300 text-gray-800 hover:bg-gray-400 transition">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-green-600 text-white  hover:bg-green-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

