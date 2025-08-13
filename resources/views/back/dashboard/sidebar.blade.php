<aside x-data="sidebarState()" x-init="init()"
    class="fixed top-16 left-0 z-40 w-64 h-full bg-gray-300 border-r border-gray-200 shadow-md transform transition-transform duration-300 ease-in-out
        md:translate-x-0"
    :class="{ '-translate-x-full': !sidebarOpen }" x-cloak>
    <nav class="p-4 space-y-2">

        <a href="{{ route('dashboard.index') }}" @click="setActive('Dashboard')"
            :class="active === 'Dashboard' ? 'bg-white font-semibold text-gray-900' : 'hover:bg-gray-100'"
            class="block p-2 rounded transition">
            <i class="fa-solid fa-house me-2"></i>
            Dashboard
        </a>

        <!-- Book with Dropdown -->
        <div>
            <button @click="toggleDropdown('book')"
                :class="(openDropdown === 'book' && !['All Books', 'Add Book'].includes(active)) ?
                'bg-white font-semibold text-gray-900' :
                'hover:bg-gray-100'"
                class="w-full text-left p-2 rounded transition flex items-center">
                <i class="fa-solid fa-book-open me-3"></i> Book
                <svg :class="openDropdown === 'book' ? 'rotate-90' : ''"
                    class="w-4 h-4 ms-auto transform transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Dropdown Items -->
            <div x-show="openDropdown === 'book'" x-transition class="ml-4 mt-1 space-y-1">
                <a href="{{ route('book.index') }}" @click="active = 'All Books'"
                    :class="active === 'All Books' ? 'bg-white font-semibold text-gray-900' : 'hover:bg-gray-100'"
                    class="block p-2 rounded transition">
                    All Books
                </a>
                <a href="#" @click="setActive('Add Book')"
                    :class="active === 'Add Book' ? 'bg-white font-semibold text-gray-900' : 'hover:bg-gray-100'"
                    class="block p-2 rounded transition">
                    Add Book
                </a>
            </div>
        </div>

        @auth
            @if (Auth::user()->role->name === 'super_admin')
                <!-- User with Dropdown -->
                <div>
                    <button @click="toggleDropdown('user-management')"
                        :class="(openDropdown === 'user-management') ?
                        'bg-white font-semibold text-gray-900' :
                        'hover:bg-gray-100'"
                        class="w-full text-left p-2 rounded transition flex items-center">
                        <i class="fa-solid fa-users me-3"></i> User Management
                        <svg :class="openDropdown === 'user-management' ? 'rotate-90' : ''"
                            class="w-4 h-4 ms-auto transform transition-transform" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Dropdown Items -->
                    <div x-show="openDropdown === 'user-management'" x-transition class="ml-4 mt-1 space-y-1">
                        <a href="{{ route('admin.index') }}" @click="setActive('Admin')"
                            :class="active === 'Admin' ? 'bg-white font-semibold text-gray-900' : 'hover:bg-gray-100'"
                            class="block p-2 rounded transition">
                            <i class="fa-solid fa-user-tie me-1"></i> Admin
                        </a>
                        <a href="{{ route('user.index') }}" @click="setActive('Users')"
                            :class="active === 'Users' ? 'bg-white font-semibold text-gray-900' : 'hover:bg-gray-100'"
                            class="block p-2 rounded transition">
                            <i class="fa-solid fa-user me-1"></i> User
                        </a>
                    </div>
                </div>
            @endif
            @if (Auth::user()->role->name === 'admin')
                <a href="{{ route('user.index') }}" @click="setActive('Users')"
                    :class="active === 'Users' ? 'bg-white font-semibold text-gray-900' : 'hover:bg-gray-100'"
                    class="block p-2 rounded transition">
                    <i class="fa-solid fa-user me-1"></i> User
                </a>
            @endif
        @endauth

        <a href="#" @click="setActive('Settings')"
            :class="active === 'Settings' ? 'bg-white font-semibold text-gray-900' : 'hover:bg-gray-100'"
            class="block p-2 rounded transition">
            Settings
        </a>

        <form method="POST" action="{{ route('logout') }}" @click="setActive('Logout')"
            :class="active === 'Logout' ? 'bg-white font-semibold text-gray-900' : 'hover:bg-gray-100'"
            class="block p-2 rounded transition">
            @csrf
            <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault();
                this.closest('form').submit();">
                {{ __('Logout') }}
            </x-dropdown-link>
        </form>

    </nav>
</aside>

<script>
    function sidebarState() {
        return {
            active: localStorage.getItem('sidebar-active') || 'Dashboard',
            openDropdown: localStorage.getItem('sidebar-dropdown') || null,

            init() {
                // Dipanggil saat sidebar diinisialisasi
            },

            setActive(name) {
                this.active = name;
                localStorage.setItem('sidebar-active', name);
            },

            toggleDropdown(name) {
                this.openDropdown = this.openDropdown === name ? null : name;
                localStorage.setItem('sidebar-dropdown', this.openDropdown);
            }
        }
    }
</script>
