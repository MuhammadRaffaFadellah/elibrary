<div x-data="{ sidebarOpen: false }" x-init="$watch('sidebarOpen', value => document.body.classList.toggle('overflow-hidden', value));
window.matchMedia('(min-width: 768px)').addEventListener('change', e => {
    if (e.matches) sidebarOpen = false;
});" class="dark:bg-gray-900 dark:text-gray-100">
    <header
        class="fixed top-0 left-0 w-full h-16 
               bg-white border-b border-gray-200 shadow z-10 
               flex items-center px-4 justify-between
               dark:bg-gray-800 dark:border-gray-700 dark:shadow-lg">
        <div class="flex items-center space-x-4">
            <!-- Hamburger (Mobile only) -->
            <button @click="sidebarOpen = !sidebarOpen"
                class="md:hidden text-gray-700 focus:outline-none dark:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Logo -->
            <img src="{{ asset('/assets/logo.png') }}" alt="Logo" class="h-16 mt-3">
            <h1 class="text-xl font-semibold dark:text-gray-100">Admin Panel</h1>
        </div>
    </header>
</div>
