<x-app-layout>
    
    <style>
        .scroll-to-top {
            position: fixed;
            bottom: 2rem;
            right: -50px;
            background-color: #4A90E2;
            color: white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: right 0.3s ease-in-out;
        }

        .scroll-to-top:hover {
            background-color: #357ABD;
        }
    </style>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">


        <!-- Page Heading -->
        

        <!-- Page Content -->
        <section class="bg-gray-800 py-20 h-[82vh] flex items-center">
            <div class="max-w-6xl mx-auto px-4 text-center">
                <h1 class="text-5xl font-extrabold text-zinc-200">Welcome to Our Store</h1>
                <p class="mt-4 text-lg text-gray-500 tracking-wider">
                    Discover the best products handpicked just for you. Quality and satisfaction guaranteed.
                </p>
                <div class="mt-8">
                    <a href="{{ route('product.show') }}" class="transition duration-200 px-6 py-3 bg-blue-600 text-white rounded-md text-lg font-semibold hover:bg-blue-700">
                        Start Shopping
                    </a>
                </div>
            </div>
        </section>

        <section id="about" class="py-16 bg-gray-900">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold text-zinc-200">About Our Store</h2>
                <p class="mt-4 text-gray-600 text-lg leading-8">
                    We are committed to providing top-quality products across a wide range of categories. From the latest gadgets to timeless fashion, our selection is curated with care to meet the highest standards.
                </p>
                <p class="mt-8 text-gray-600 text-lg leading-8">
                    Every product in our store goes through a rigorous quality check to ensure it meets our customers' expectations. We aim to make shopping easy, enjoyable, and convenient for everyone.
                </p>
            </div>
        </section>

        <!-- Location Section -->
        <section id="location" class="py-16 bg-gray-800">
            <div class="max-w-6xl mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold text-gray-200">Our Location</h2>
                <p class="mt-4 text-lg text-gray-500">Find us at the following address:</p>
    
                <div class="mt-6">
                    <address class="not-italic text-gray-400">
                        <p>1234 Main Street</p>
                        <p>City, State 12345</p>
                        <p class="mt-2">Phone: (123) 456-7890</p>
                    </address>
                </div>
    
                <div class="mt-6">
                    <a href="https://www.google.com/maps?q=1234+Main+Street,City,State+12345" target="_blank" class="transition duration-200 px-6 py-3 bg-blue-600 text-white rounded-md text-lg font-semibold hover:bg-blue-700">
                        Get Directions
                    </a>
                </div>
        </div>
    </section>


        <!-- Footer -->
        <footer class="bg-gray-900 py-8">
            <div class="max-w-6xl mx-auto px-4 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Our Store. All rights reserved. By <span class="text-lg text-zinc-200 tracking-wider">Adam El Bouchiri</span></p>
            </div>
        </footer>
    </div>

    <button id="scrollToTopBtn" class="transition duration-300 scroll-to-top flex items-center justify-center">
        ↑
    </button>

    <script>
        // Get the button element
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");

        // Show the button when the user scrolls down
        window.onscroll = function () {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                scrollToTopBtn.style.right = "20px";
            } else {
                scrollToTopBtn.style.right = "-50px";
            }
        };

        // Scroll to the top when the button is clicked
        scrollToTopBtn.onclick = function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };
    </script>
</body>

</x-app-layout>
