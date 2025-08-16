<!-- Card to edit admin -->

<div id="editAdminModal" class="fixed flex inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">

    <div class="edit-modal-content bg-white p-6 rounded-md shadow-md max-w-lg w-full fixed">
        <button id="closeEditFormButton"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">✖
        </button>
        <h2 class="text-lg font-semibold mb-4 uppercase">Edit Data</h2>
        @if (isset($user))
            <form action="{{ route('admin.update', $admin->id) }}" method="POST" id="adminEditForm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1 uppercase">Name</label>
                        <input type="text" name="name" required value="{{ $admin->name }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1 uppercase">Username</label>
                        <input type="text" name="username" required value="{{ $admin->username }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200">
                    </div>

                    <div class="mb-4 relative">
                        <label class="block text-sm font-medium text-gray-700 mb-1 uppercase">Email</label>
                        <input type="email" name="email" required value="{{ $admin->email }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-200">
                    </div>

                    <div class="mb-4 relative">
                        <label class="block text-sm font-medium text-gray-700 mb-1 uppercase">Password</label>

                        <!-- input password -->
                        <input type="password" name="password" id="password-admin-edit" placeholder="New Password . . ."
                            class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md focus:ring focus:ring-green-200
                                placeholder:text-gray-400 placeholder:opacity-75">

                        <p id="password-admin-error-edit" class="text-red-500 text-xs mt-1 hidden">
                            Password must be at least 8 characters
                        </p>

                        <!-- Icon di dalam input -->
                        <i id="toggleAdminPassword"
                            class="fa-solid fa-eye-slash mt-3 absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 cursor-pointer transition-colors duration-200">
                        </i>
                    </div>
                </div>

                <input type="hidden" name="role_id" value="2">

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
    document.addEventListener('DOMContentLoaded', () => {
        const passwordAdminInputEdit = document.getElementById('password-admin-edit');
        const passwordAdminErrorEdit = document.getElementById('password-admin-error-edit');

        passwordAdminInputEdit.addEventListener('input', function() {
            if (passwordAdminInputEdit.value.length < 8) {
                passwordAdminErrorEdit.classList.remove('hidden');
            } else {
                passwordAdminErrorEdit.classList.add('hidden');
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const passwordInput = document.getElementById('password-admin-edit');
        const toggleAdminPassword = document.getElementById('toggleAdminPassword');

        toggleAdminPassword.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';

            // Ganti icon dan warna
            toggleAdminPassword.classList.toggle('fa-eye');
            toggleAdminPassword.classList.toggle('fa-eye-slash');

            if (!isPassword) {
                // Mode sembunyikan password
                toggleAdminPassword.classList.remove('text-green-500');
                toggleAdminPassword.classList.add('text-gray-500');
            } else {
                // Mode lihat password
                toggleAdminPassword.classList.remove('text-gray-500');
                toggleAdminPassword.classList.add('text-green-500');
            }
        });
    })
</script>
