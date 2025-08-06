<aside x-data="{ openDropdown: null, active: 'Dashboard' }"
    class="fixed top-16 left-0 z-40 w-64 h-full bg-gray-300 border-r border-gray-200 shadow-md transform transition-transform duration-300 ease-in-out
        md:translate-x-0"
    :class="{ '-translate-x-full': !sidebarOpen }" x-cloak>
    <nav class="p-4 space-y-2">

        <a href="" @click="active = 'Dashboard'"
            :class="active === 'Dashboard' ? 'bg-white font-semibold text-gray-900' : 'hover:bg-gray-100'"
            class="block p-2 rounded transition">
            Dashboard
        </a>

        <!-- Book with Dropdown -->
        <div>
            <button @click="openDropdown === 'book' ? openDropdown = null : openDropdown = 'book'"
                :class="active === 'Book' ? 'bg-white font-semibold text-gray-900' : 'hover:bg-gray-100'"
                class="w-full text-left p-2 rounded transition flex justify-between items-center">
                Book
                <svg :class="openDropdown === 'book' ? 'rotate-90' : ''"
                    class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Dropdown Items -->
            <div x-show="openDropdown === 'book'" x-transition class="ml-4 mt-1 space-y-1">
                <a href="{{ route('book.index') }}" @click="active = 'All Books'"
                    :class="active === 'All Books' ? 'bg-white font-semibold text-blue-600' : 'hover:bg-gray-100'"
                    class="block p-2 rounded transition">
                    All Books
                </a>
                <a href="#" @click="active = 'Add Book'"
                    :class="active === 'Add Book' ? 'bg-white font-semibold text-blue-600' : 'hover:bg-gray-100'"
                    class="block p-2 rounded transition">
                    Add Book
                </a>
            </div>
        </div>

        <a href="#" @click="active = 'Users'"
            :class="active === 'Users' ? 'bg-white font-semibold text-gray-900' : 'hover:bg-gray-100'"
            class="block p-2 rounded transition">
            Users
        </a>

        <a href="#" @click="active = 'Settings'"
            :class="active === 'Settings' ? 'bg-white font-semibold text-gray-900' : 'hover:bg-gray-100'"
            class="block p-2 rounded transition">
            Settings
        </a>

        <a href="#" @click="active = 'Logout'"
            :class="active === 'Logout' ? 'bg-white font-semibold text-gray-900' : 'hover:bg-gray-100'"
            class="block p-2 rounded transition">
            Logout
        </a>

    </nav>
</aside>
