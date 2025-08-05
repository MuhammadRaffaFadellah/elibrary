    <aside
        class="fixed top-16 left-0 z-40 w-64 h-full bg-gray-300 border-r border-gray-200 shadow-md transform transition-transform duration-300 ease-in-out
            md:translate-x-0"
        :class="{ '-translate-x-full': !sidebarOpen }" x-cloak>
        <nav class="p-4 space-y-2">
            <a href="#" class="block p-2 rounded hover:bg-gray-100">Dashboard</a>
            <a href="#" class="block p-2 rounded hover:bg-gray-100">Users</a>
            <a href="#" class="block p-2 rounded hover:bg-gray-100">Settings</a>
            <a href="#" class="block p-2 rounded hover:bg-gray-100">Logout</a>
        </nav>
    </aside>