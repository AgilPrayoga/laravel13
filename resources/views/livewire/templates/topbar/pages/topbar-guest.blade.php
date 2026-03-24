<nav x-data="{ open: false }" class="fixed top-0 left-0 w-full bg-white border-b border-gray-200 z-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <span class="text-xl font-bold text-blue-600">MyApp</span>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden md:flex space-x-6">
                <a href="#" class="text-gray-700 hover:text-blue-600">Home</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Courses</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">About</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Contact</a>
            </div>

            <!-- Button Mobile -->
            <div class="md:hidden">
                <button @click="open = !open" class="text-gray-700 focus:outline-none">
                    ☰
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div x-show="open" @click.outside="open = false" x-transition class="md:hidden bg-white border-t border-gray-200">
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Home</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Courses</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">About</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Contact</a>
    </div>
</nav>

<!-- Spacer biar konten tidak ketutup navbar -->
<div class="h-16"></div>
