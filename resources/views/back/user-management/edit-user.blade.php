<!-- Card to add a new user -->

<div id="editUserModal" class="fixed flex inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">

    <div class="edit-modal-content bg-white p-6 rounded-md shadow-md max-w-lg w-full fixed">
        <button id="closeEditFormButton"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;
        </button>
        <h2 class="text-lg font-semibold mb-4">Edit Data</h2>
        <form action="{{ route('user.update' , $user->id) }}" method="POST" id="userEditForm">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" required value="{{ $user->name }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" required value="{{ $user->username }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" required value="{{ $user->email }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password-user" placeholder="Masukkan password baru"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200 placeholder:text-xs placeholder:opacity-75 placeholder:text-gray-400">
                    <p id="password-user-error" class="text-red-500 text-xs mt-1 hidden">
                        Password must be at least 8 characters
                    </p>
                    <p id="password-inform" class="text-xs mt-1 ms-1 text-gray-400">Kosongkan jika tidak ingin mengubah</p>
                </div>
            </div>

            <input type="hidden" name="role_id" value="3">

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" id="cancelEditButton"
                    class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 transition duration-200">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 transition duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const passwordUserInput = document.getElementById('password-user');
    const passwordUserError = document.getElementById('password-user-error');

    passwordUserInput.addEventListener('input', function() {
        if (passwordUserInput.value.length < 8) {
            passwordUserError.classList.remove('hidden');
        } else {
            passwordUserError.classList.add('hidden');
        }
    })
</script>
