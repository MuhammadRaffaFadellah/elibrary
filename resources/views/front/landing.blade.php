<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>eLibrary - Landing Page</title>
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/app.css')
    @yield('style')
</head>

<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">
    <style>
        /* Hilangkan scrollbar di semua browser */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .carousel-container {
            position: relative;
            overflow: hidden;
            height: 100vh;
        }

        .carousel-track {
            display: flex;
            transition: transform 0.8s ease-in-out;
            height: 100%;
        }

        .carousel-item {
            min-width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .carousel-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            color: white;
            padding: 1rem;
        }
    </style>
    <!-- Navbar -->
    <nav class="fixed w-full bg-white dark:bg-gray-800 shadow z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
            <div class="text-2xl font-bold text-green-700 dark:text-green-400">eLibrary</div>
            <div class="space-x-4 hidden md:flex">
                <a href="#features" class="hover:text-green-700 text-gray-800  dark:text-gray-100">Features</a>
                <a href="#testimonials" class="hover:text-green-700 text-gray-800  dark:text-gray-100">Testimonials</a>
                <a href="#contact" class="hover:text-green-700 text-gray-800  dark:text-gray-100">Contact</a>
            </div>
            {{-- <div class="space-x-2">
                <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Login</button>
                <button class="px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200">Register</button>
            </div> --}}
            <div class="flex items-center space-x-4">
                <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Login</button>
                <button
                    class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600">Register</button>
                <button id="darkToggle"
                    class="p-2 bg-gray-200 dark:bg-gray-700 rounded-full shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    <i id="themeIcon" class="fas fa-moon text-gray-700 dark:text-yellow-300"></i>
                </button>
            </div>

        </div>
    </nav>

    <!-- Hero Carousel -->
    <section class="carousel-container">
        <div id="carousel" class="carousel-track">
            <!-- Slide 1 -->
            <div class="carousel-item"
                style="background-image:url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1500&q=80')">
                <div class="carousel-overlay">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4">Welcome to eLibrary</h1>
                    <p class="mb-6 text-lg md:text-xl">Read books anytime, anywhere</p>
                    <button class="px-6 py-3 bg-green-600 rounded-lg hover:bg-green-700">Explore Now</button>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item"
                style="background-image:url('https://images.unsplash.com/photo-1519682337058-a94d519337bc?auto=format&fit=crop&w=1500&q=80')">
                <div class="carousel-overlay">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4">Thousands of Books</h1>
                    <p class="mb-6 text-lg md:text-xl">Explore unlimited collections</p>
                    <button class="px-6 py-3 bg-green-600 rounded-lg hover:bg-green-700">Browse</button>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item"
                style="background-image:url('https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1500&q=80')">
                <div class="carousel-overlay">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4">Any Device Access</h1>
                    <p class="mb-6 text-lg md:text-xl">Your library in your pocket</p>
                    <button class="px-6 py-3 bg-green-600 rounded-lg hover:bg-green-700">Get Started</button>
                </div>
            </div>
        </div>

        <!-- Carousel controls -->
        <button id="prev"
            class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white/70 hover:bg-white text-green-700 rounded-full p-3 shadow">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button id="next"
            class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white/70 hover:bg-white text-green-700 rounded-full p-3 shadow">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Carousel indicators -->
        <div id="indicators" class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2"></div>
    </section>

    <!-- Features -->
    <section id="features" class="py-20 bg-gray-100 dark:bg-gray-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto text-center">
            <!-- Judul -->
            <h2 class="text-3xl font-bold mb-10 text-gray-800 dark:text-white transition-colors duration-300">
                Why Choose eLibrary?
            </h2>

            <!-- Grid Fitur -->
            <div class="grid md:grid-cols-3 gap-8 px-6">
                <!-- Fitur 1 -->
                <div
                    class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-lg dark:hover:shadow-xl transition">
                    <i class="fas fa-book-open text-green-600 text-4xl mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">
                        Vast Collection
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Access thousands of eBooks from various genres and authors.
                    </p>
                </div>

                <!-- Fitur 2 -->
                <div
                    class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-lg dark:hover:shadow-xl transition">
                    <i class="fas fa-laptop text-green-600 text-4xl mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">
                        Read Anywhere
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Enjoy reading from any device with seamless experience.
                    </p>
                </div>

                <!-- Fitur 3 -->
                <div
                    class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-lg dark:hover:shadow-xl transition">
                    <i class="fas fa-bolt text-green-600 text-4xl mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">
                        Fast & Easy
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Find and read your favorite books instantly with smooth interface.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <div class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-3xl font-bold text-center mb-8">Recommended Books</h2>

        <div class="relative">
            <!-- Wrapper Carousel -->
            <div class="flex gap-6 overflow-x-auto pb-4 snap-x snap-mandatory scrollbar-hide justify-center items-center"
                style="scroll-snap-type: x mandatory;">

                @foreach ($recommendedBooks as $book)
                    <div
                        class="flex-shrink-0 w-[220px] bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden snap-start hover:shadow-xl hover:scale-105 transition-transform duration-300 mt-5 mx-2.5">

                        <!-- Cover Buku -->
                        <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/default-book.jpg') }}"
                            alt="{{ $book->title }}" class="w-full h-64 object-cover rounded-t-xl">

                        <!-- Info Buku -->
                        <div class="p-3 text-center">
                            <h3 class="text-sm font-semibold truncate" title="{{ $book->title }}">
                                {{ $book->title }}
                            </h3>
                            <p class="text-gray-500 text-xs mb-3">by {{ $book->author }}</p>
                            <a href="{{ route('landing', $book->slug) }}"
                                class="inline-block px-3 py-1.5 bg-green-600 text-white text-xs rounded-lg hover:bg-green-700 transition">
                                Read Now
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <section id="testimonials" class="py-20 bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto text-center px-6">
            <!-- Judul -->
            <h2 class="text-3xl font-bold mb-10 text-gray-800 dark:text-white transition-colors duration-300">
                What Our Readers Say
            </h2>

            <!-- Grid Testimonials -->
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div
                    class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-lg dark:hover:shadow-xl transition-transform duration-300 hover:scale-105">
                    <p class="mb-4 italic text-gray-700 dark:text-gray-300">
                        “eLibrary has changed how I read books. Super convenient!”
                    </p>
                    <h3 class="font-semibold text-gray-800 dark:text-white">- Sarah J.</h3>
                </div>

                <!-- Testimonial 2 -->
                <div
                    class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-lg dark:hover:shadow-xl transition-transform duration-300 hover:scale-105">
                    <p class="mb-4 italic text-gray-700 dark:text-gray-300">
                        “The best collection of eBooks with amazing user interface.”
                    </p>
                    <h3 class="font-semibold text-gray-800 dark:text-white">- Michael T.</h3>
                </div>

                <!-- Testimonial 3 -->
                <div
                    class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-lg dark:hover:shadow-xl transition-transform duration-300 hover:scale-105">
                    <p class="mb-4 italic text-gray-700 dark:text-gray-300">
                        “I can read anywhere, anytime. Truly love it!”
                    </p>
                    <h3 class="font-semibold text-gray-800 dark:text-white">- Linda K.</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact"
        class="bg-green-700 dark:bg-gray-800 text-white dark:text-gray-300 py-10 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-8">
            <!-- Brand -->
            <div>
                <h3 class="font-bold text-lg mb-2 text-white dark:text-white">eLibrary</h3>
                <p class="text-gray-200 dark:text-gray-400">
                    Your digital library for modern readers.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="font-bold text-lg mb-2 text-white dark:text-white">Quick Links</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="#features"
                            class="hover:text-green-300 dark:hover:text-green-400 transition-colors duration-300">
                            Features
                        </a>
                    </li>
                    <li>
                        <a href="#testimonials"
                            class="hover:text-green-300 dark:hover:text-green-400 transition-colors duration-300">
                            Testimonials
                        </a>
                    </li>
                    <li>
                        <a href="#contact"
                            class="hover:text-green-300 dark:hover:text-green-400 transition-colors duration-300">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="font-bold text-lg mb-2 text-white dark:text-white">Contact Us</h3>
                <p class="text-gray-200 dark:text-gray-400">
                    Email: support@elibrary.com
                </p>
                <p class="text-gray-200 dark:text-gray-400">
                    Phone: +62 812-3456-7890
                </p>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-6 text-gray-100 dark:text-gray-500 transition-colors duration-300">
            &copy; 2025 eLibrary. All rights reserved.
        </div>
    </footer>

    <!-- Carousel Script -->
    <script>
        const track = document.getElementById("carousel");
        const slides = document.querySelectorAll(".carousel-item");
        const prevBtn = document.getElementById("prev");
        const nextBtn = document.getElementById("next");
        const indicatorsContainer = document.getElementById("indicators");

        let currentIndex = 0;

        // Create indicators
        slides.forEach((_, idx) => {
            const dot = document.createElement("div");
            dot.classList.add("w-3", "h-3", "rounded-full", "cursor-pointer",
                idx === 0 ? "bg-green-600" : "bg-white/70", "transition");
            dot.addEventListener("click", () => goToSlide(idx));
            indicatorsContainer.appendChild(dot);
        });

        const indicators = indicatorsContainer.children;

        function updateIndicators() {
            Array.from(indicators).forEach((dot, idx) => {
                dot.classList.remove("bg-green-600", "bg-white/70");
                dot.classList.add(idx === currentIndex ? "bg-green-600" : "bg-white/70");
            });
        }

        function goToSlide(index) {
            currentIndex = (index + slides.length) % slides.length;
            track.style.transform = `translateX(-${currentIndex * 100}%)`;
            updateIndicators();
        }

        prevBtn.addEventListener("click", () => goToSlide(currentIndex - 1));
        nextBtn.addEventListener("click", () => goToSlide(currentIndex + 1));

        // Auto slide
        setInterval(() => {
            goToSlide(currentIndex + 1);
        }, 5000);
    </script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 3
                },
                1024: {
                    slidesPerView: 4
                },
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>

    <script>
        const body = document.documentElement;
        const toggleBtn = document.getElementById("darkToggle");
        const themeIcon = document.getElementById("themeIcon");

        // Cek preferensi user sebelumnya atau sistem
        if (
            localStorage.theme === "dark" ||
            (!("theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            body.classList.add("dark");
            themeIcon.classList.replace("fa-moon", "fa-sun");
        } else {
            body.classList.remove("dark");
            themeIcon.classList.replace("fa-sun", "fa-moon");
        }

        // Toggle dark/light mode
        toggleBtn.addEventListener("click", () => {
            body.classList.toggle("dark");
            const isDark = body.classList.contains("dark");

            if (isDark) {
                themeIcon.classList.replace("fa-moon", "fa-sun");
                localStorage.theme = "dark";
            } else {
                themeIcon.classList.replace("fa-sun", "fa-moon");
                localStorage.theme = "light";
            }
        });
    </script>

</body>

</html>
