<div id="addUserModal" class="fixed flex inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">

    <div
        class="modal-content bg-white dark:bg-gray-800 p-6 rounded-md shadow-md max-w-lg w-full fixed text-gray-900 dark:text-gray-100">

        <!-- Tombol close -->
        <button id="closeFormButton"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 text-xl font-bold">✖
        </button>

        <h2 class="text-lg font-semibold mb-4 uppercase">Add Data</h2>

        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 uppercase">Name
                        <span class="text-red-700">*</span></label>
                    <input type="text" name="name" required placeholder="Name . . ."
                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md 
                               bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                               focus:ring focus:ring-green-200
                               placeholder:text-gray-400 dark:placeholder:text-gray-500">
                </div>

                <!-- Username -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 uppercase">Username
                        <span class="text-red-700">*</span></label>
                    <input type="text" name="username" required placeholder="Username . . ."
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md 
                               bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                               focus:ring focus:ring-green-200
                               placeholder:text-gray-400 dark:placeholder:text-gray-500">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 uppercase">Email
                        <span class="text-red-700">*</span></label>
                    <input type="email" name="email" required placeholder="@example.com"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md 
                               bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                               focus:ring focus:ring-green-200
                               placeholder:text-gray-400 dark:placeholder:text-gray-500">
                </div>

                <!-- Password -->
                <div class="mb-4 relative">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 uppercase">Password
                        <span class="text-red-700">*</span></label>

                    <input type="password" name="password" id="password-admin-add" required placeholder="Password . . ."
                        class="w-full px-3 py-2 pr-10 border border-gray-300 dark:border-gray-600 rounded-md 
                               bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                               focus:ring focus:ring-green-200
                               placeholder:text-gray-400 dark:placeholder:text-gray-500">

                    <p id="password-admin-error" class="text-red-500 text-xs mt-1 hidden">
                        Password must be at least 8 characters
                    </p>

                    <!-- Icon show password -->
                    <i id="togglePassword"
                        class="fa-solid fa-eye-slash mt-3 absolute right-3 top-1/2 -translate-y-1/2 
                               text-gray-500 dark:text-gray-400 cursor-pointer transition-colors duration-200">
                    </i>
                </div>
            </div>

            <input type="hidden" name="role_id" value="2">

            <!-- Action buttons -->
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" id="cancelButton"
                    class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 
                    focus:outline-none focus:ring-2 focus:ring-offset-2 
                    focus:ring-red-600 transition duration-200">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-green-600 text-white hover:bg-green-700 
                    focus:outline-none focus:ring-2 focus:ring-offset-2 
                    focus:ring-green-600 transition duration-200">
                    Add
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {

        const passwordAdminInput = document.getElementById('password-admin-add');
        const passwordAdminError = document.getElementById('password-admin-error');

        passwordAdminInput.addEventListener('input', function() {
            if (passwordAdminInput.value.length < 8) {
                passwordAdminError.classList.remove('hidden');
            } else {
                passwordAdminError.classList.add('hidden');
            }
        })
    })
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const passwordInput = document.getElementById('password-admin-add');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';

            // Ganti icon dan warna
            togglePassword.classList.toggle('fa-eye');
            togglePassword.classList.toggle('fa-eye-slash');

            if (!isPassword) {
                // Mode sembunyikan password
                togglePassword.classList.remove('text-green-500');
                togglePassword.classList.add('text-gray-500');
            } else {
                // Mode lihat password
                togglePassword.classList.remove('text-gray-500');
                togglePassword.classList.add('text-green-500');
            }
        });
    })
</script>
