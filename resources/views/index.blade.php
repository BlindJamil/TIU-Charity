<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TIU Home</title>
    <link rel="stylesheet" href="/src/styles/style.css">
</head>
<body class="font-sans">

    <!-- nav Section -->
    <header id="header" class="bg-gray-900 text-white fixed w-full top-0 z-50 transition-transform transform">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold w-20"><img src="/src/assets/img/Logo_of_Tishk_International_University.png" alt="TIU Logo"></h1>
            <button id="menu-btn" class="lg:hidden block text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <nav id="menu" class="hidden lg:flex flex-col lg:flex-row absolute lg:static top-16 left-0 w-full lg:w-auto bg-gray-900 lg:bg-transparent text-white lg:space-x-6 space-y-4 lg:space-y-0 p-4 lg:p-0 z-50">
                <a href="#" class="block px-4 py-2 lg:inline-block hover:text-yellow-500 transition">Home</a>
                <a href="about.html" class="block px-4 py-2 lg:inline-block hover:text-yellow-500 transition">About</a>
                <a href="cause.html" class="block px-4 py-2 lg:inline-block hover:text-yellow-500 transition">Cause</a>
                <a href="contact.html" class="block px-4 py-2 lg:inline-block hover:text-yellow-500 transition">Contact</a>
                <button id="login-btn" class="text-yellow-500 hover:text-yellow-600 font-semibold">Sign In</button>            
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-cover bg-center h-screen flex items-center justify-center" style="background-image: url('/src/assets/img/hero_bg.png');">
        <div class="text-center text-white  p-6 rounded-lg">
            <h2 class="text-5xl font-bold mb-6">Together for a Better Future</h2>
            <p class="text-xl mb-10">Join us in making the world a better place for everyone.</p>
            <a href="cause.html" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-3 px-4 rounded">Donate Now</a>
        </div>
    </section>

  <!-- Login Popup -->
<div id="login-popup" class="hidden fixed inset-0 bg-gray-900 bg-opacity-80 flex items-center justify-center z-50 backdrop-blur-none transition-all duration-500">
    <div class="bg-gray-800 rounded-lg shadow-lg p-8 max-w-md w-full transform scale-90 opacity-0 transition-all duration-500">
        <button id="close-popup" class="absolute top-4 right-4 text-yellow-500 hover:text-yellow-600 font-bold text-lg">&times;</button>
        <h2 class="text-3xl font-bold text-center mb-6 text-white">Sign In</h2>
        <form id="login-form" action="#" method="POST" class="space-y-6">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" id="email" name="email" required class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-yellow-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input type="password" id="password" name="password" required class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-yellow-500">
            </div>
            <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-3 px-4 rounded-lg transition">Sign In</button>
        </form>
    </div>
</div>

<!-- Stats Section -->
<section class="bg-gray-800 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Stat Item -->
            <div class="flex flex-col items-center">
                <h4 class="text-4xl font-extrabold text-yellow-500 mb-2">$50K+</h4>
                <p class="text-lg font-medium">Funds Raised</p>
            </div>
            <!-- Stat Item -->
            <div class="flex flex-col items-center">
                <h4 class="text-4xl font-extrabold text-yellow-500 mb-2">200+</h4>
                <p class="text-lg font-medium">Volunteers</p>
            </div>
            <!-- Stat Item -->
            <div class="flex flex-col items-center">
                <h4 class="text-4xl font-extrabold text-yellow-500 mb-2">50+</h4>
                <p class="text-lg font-medium">Community Projects</p>
            </div>
            <!-- Stat Item -->
            <div class="flex flex-col items-center">
                <h4 class="text-4xl font-extrabold text-yellow-500 mb-2">100+</h4>
                <p class="text-lg font-medium">Volunteers Engaged</p>
            </div>
        </div>
    </div>
</section>

  <!-- About Section -->
<section id="about" class="py-48 bg-gray-900 text-white">
    <div class="container mx-auto flex flex-col lg:flex-row items-center space-y-10 lg:space-y-0 lg:space-x-16">
        <!-- Left Video Section -->
        <div class="lg:w-1/2 w-full">
            <div class="relative w-full max-w-3xl mx-auto lg:mx-0">
                <iframe 
                    class="w-full h-64 sm:h-80 md:h-96 rounded-lg shadow-lg" 
                    src="https://www.youtube.com/embed/CiFoHm7HD94" 
                    title="YouTube video player" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
                </iframe>
            </div>
        </div>

        <!-- Right Text Section -->
        <div class="lg:w-1/2 lg:pl-16 text-center lg:text-left">
            <h3 class="text-sm uppercase font-bold text-yellow-500 tracking-wide mb-4">About Us</h3>
            <h2 class="text-3xl md:text-4xl font-extrabold leading-tight mb-6">
                Empowering Students and Communities<br>Through Education and Support
            </h2>
            <p class="text-base md:text-lg text-gray-300 leading-relaxed mb-8">
                Our mission is to provide opportunities for growth, learning, and development within our university and local community. Together, we can make a lasting impact through dedicated efforts and collaborative initiatives.
            </p>
            <a href="about.html" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-4 px-8 rounded-lg shadow-lg transition duration-300">
                Read More
            </a>
        </div>
    </div>
</section>

<!-- contribution Section -->
<section id="difference" class="py-48 bg-gradient-to-r from-gray-800 via-gray-900 to-black text-white relative ">
    <div class="container mx-auto flex flex-col lg:flex-row items-center space-y-10 lg:space-y-0 lg:space-x-16">
        <!-- Left Text Section -->
        <div class="lg:w-1/2 text-center lg:text-left">
            <h3 class="text-sm uppercase font-bold text-yellow-500 tracking-wide mb-6">How You Can Make a Difference</h3>
            <h2 class="text-4xl font-extrabold leading-tight mb-8">
                Your Contribution Can<br>Change Lives.
            </h2>
            <p class="text-lg text-gray-300 leading-relaxed mb-10">
                Every small effort counts. Your support helps us empower students, enhance learning opportunities, and build a stronger community. Join us in creating meaningful change.
            </p>
            <a href="cause.html" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-4 px-10 rounded-lg shadow-lg transition duration-300">
                See How You Can Help
            </a>
        </div>

        <!-- Right Image Section -->
<div class="lg:w-1/2 relative mt-10 lg:mt-0">
    <div class="relative max-w-lg mx-auto lg:mx-0">
        <!-- Decorative Elements -->
        <div class="absolute -top-6 -right-6 bg-yellow-500 w-28 h-28 rounded-full opacity-30 hidden md:block md:w-20 md:h-20 lg:w-28 lg:h-28"></div>
        <div class="absolute -bottom-6 -left-6 bg-yellow-700 w-24 h-24 rounded-full opacity-30 hidden md:block md:w-16 md:h-16 lg:w-24 lg:h-24"></div>
        <div class="absolute bottom-12 right-12 w-36 h-36 border-4 border-dotted border-yellow-500 rounded-full opacity-30 hidden md:block md:w-24 md:h-24 lg:w-36 lg:h-36"></div>
    </div>
</div>


    <!-- Decorative Divider
    <div class="absolute inset-x-0 -bottom-1 ">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 180">
            <path fill="#1a202c" fill-opacity="1" d="M0,192L48,186.7C96,181,192,171,288,165.3C384,160,480,160,576,165.3C672,171,768,181,864,186.7C960,192,1056,192,1152,181.3C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div> -->
</section>

<!-- Fully Responsive Event Section -->
<section class="bg-gray-900 text-white py-20">
    <div class="container mx-auto px-8">
      <!-- Section Title -->
      <h2 class="text-4xl font-bold text-center mb-16">Upcoming Events</h2>
  
      <!-- Events Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Event 1 -->
        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col">
          <div class="h-80 w-full overflow-hidden rounded-t-lg">
            <img
              src="/src/assets/img/donation1.jpg"
              alt="Event 1"
              class="h-full w-full object-cover"
            />
          </div>
          <div class="p-6">
            <div class="text-gray-400 text-sm mb-3">
              <span>📅 Sep. 10, 2023</span> • <span>📍 Main Campus</span>
            </div>
            <h3 class="text-2xl font-bold mb-4">World Wide Donation</h3>
            <p class="text-gray-400 mb-6">
              Join us in a global donation event to bring hope and help to those in need. Every contribution counts!
            </p>
            <a
              href="/events/world-wide-donation"
              class="text-yellow-500 hover:text-yellow-600 font-semibold transition duration-300"
              >Learn more &gt;</a
            >
          </div>
        </div>
  
        <!-- Event 2 -->
        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col">
          <div class="h-80 w-full overflow-hidden rounded-t-lg">
            <img
              src="/src/assets/img/donation4.jpg"
              alt="Event 2"
              class="h-full w-full object-cover"
            />
          </div>
          <div class="p-6">
            <div class="text-gray-400 text-sm mb-3">
              <span>📅 Oct. 15, 2023</span> • <span>📍 City Park</span>
            </div>
            <h3 class="text-2xl font-bold mb-4">Fundraising Marathon</h3>
            <p class="text-gray-400 mb-6">
              Run for a cause! Join our fundraising marathon and make a difference, one step at a time.
            </p>
            <a
              href="/events/fundraising-marathon"
              class="text-yellow-500 hover:text-yellow-600 font-semibold transition duration-300"
              >Learn more &gt;</a
            >
          </div>
        </div>
  
        <!-- Event 3 -->
        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col">
          <div class="h-80 w-full overflow-hidden rounded-t-lg">
            <img
              src="/src/assets/img/donation3.jpg"
              alt="Event 3"
              class="h-full w-full object-cover"
            />
          </div>
          <div class="p-6">
            <div class="text-gray-400 text-sm mb-3">
              <span>📅 Nov. 20, 2023</span> • <span>📍 Art Gallery</span>
            </div>
            <h3 class="text-2xl font-bold mb-4">Charity Art Auction</h3>
            <p class="text-gray-400 mb-6">
              Support art and charity! Attend our charity art auction to raise funds for a meaningful cause.
            </p>
            <a
              href="/events/charity-art-auction"
              class="text-yellow-500 hover:text-yellow-600 font-semibold transition duration-300"
              >Learn more &gt;</a
            >
          </div>
        </div>
      </div>
    </div>
  </section>
  
  

<!-- Contact Section -->
<section id="contact-cta" class="py-24 bg-[#1A202C] text-white text-center relative ">
    <div class="container mx-auto px-6 lg:px-20">
        <h2 class="text-4xl font-bold mb-6">Have Questions or Need Assistance?</h2>
        <p class="text-lg text-gray-300 mb-8">
            We're here to help. Feel free to reach out for any inquiries or assistance. Let's work together to make a difference!
        </p>
        <a href="contact.html" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-4 px-8 rounded-lg shadow-lg transition duration-300">
            Contact Us Now
        </a>
    </div>
</section>

    <!-- Footer Section -->
<footer class="bg-gray-900 text-gray-400 py-12">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Logo and Description -->
        <div>
            <h1 class="mb-6 w-20"><img src="/src/assets/img/Logo_of_Tishk_International_University.png" alt="TIU Logo"></h1>
            <p class="text-sm leading-relaxed">
                Empowering communities and students to create a brighter future through education and support.
            </p>
            <form class="mt-6">
                <label for="email" class="sr-only">Email Address</label>
                <div class="flex items-center border border-gray-700 rounded-lg overflow-hidden">
                    <input 
                        type="email" 
                        id="email" 
                        placeholder="Type Your Email" 
                        class="w-full px-4 py-2 bg-gray-800 text-gray-300 focus:outline-none"
                    />
                    <button 
                        type="submit" 
                        class="bg-yellow-500 px-4 py-2 text-white font-bold hover:bg-yellow-600 transition"
                    >
                        →
                    </button>
                </div>
            </form>
        </div>

        <!-- Company Links -->
        <div>
            <h3 class="text-lg font-semibold text-white mb-4">Company</h3>
            <ul class="space-y-2">
                <li><a href="about.html" class="hover:text-yellow-500 transition">About</a></li>
                <li><a href="cause.html" class="hover:text-yellow-500 transition">Cause</a></li>
                <li><a href="contact.html" class="hover:text-yellow-500 transition">Contact</a></li>
                <li><a href="#Volunteer" class="hover:text-yellow-500 transition">Volunteer</a></li>
            </ul>
        </div>

        <!-- Social Media Links -->
        <div>
            <h3 class="text-lg font-semibold text-white mb-4">Social Media</h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-yellow-500 transition">Facebook</a></li>
                <li><a href="#" class="hover:text-yellow-500 transition">Instagram</a></li>
                <li><a href="#" class="hover:text-yellow-500 transition">Twitter</a></li>
                <li><a href="#" class="hover:text-yellow-500 transition">LinkedIn</a></li>
            </ul>
        </div>

        <!-- Legal Links -->
        <div>
            <h3 class="text-lg font-semibold text-white mb-4">Legal & Press</h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-yellow-500 transition">Privacy Policy</a></li>
                <li><a href="#" class="hover:text-yellow-500 transition">Terms & Conditions</a></li>
                <li><a href="#" class="hover:text-yellow-500 transition">Presskit</a></li>
            </ul>
        </div>
    </div>
    <div class="border-t border-gray-700 mt-8 pt-6 text-center">
        <p class="text-sm">&copy; 2024 TIU Charity. All Rights Reserved.</p>
    </div>
</footer>



    <!-- JavaScript -->
    <script>
         const menuBtn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');
    const header = document.getElementById('header');
    let lastScrollY = window.scrollY;

    // Toggle menu visibility
    menuBtn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
        menu.classList.toggle('flex');
    });

    // Show/hide header on scroll
    window.addEventListener('scroll', () => {
        const currentScrollY = window.scrollY;

        if (currentScrollY > lastScrollY) {
            // Scrolling down, hide the header
            header.style.transform = 'translateY(-100%)';
        } else {
            // Scrolling up, show the header
            header.style.transform = 'translateY(0)';
        }

        lastScrollY = currentScrollY;
    });

    document.addEventListener("DOMContentLoaded", () => {
    const loginBtn = document.getElementById("login-btn");
    const loginPopup = document.getElementById("login-popup");
    const closePopup = document.getElementById("close-popup");

    // Show the login popup
    loginBtn.addEventListener("click", () => {
        loginPopup.classList.remove("hidden");

        // Start the blur animation
        setTimeout(() => {
            loginPopup.classList.add("backdrop-blur-xl"); // Add blur effect
            const popupContent = loginPopup.querySelector("div");
            popupContent.classList.replace("scale-90", "scale-100");
            popupContent.classList.replace("opacity-0", "opacity-100");
        }, 10); // Small delay to allow DOM updates
    });

    // Close the login popup
    closePopup.addEventListener("click", () => {
        const popupContent = loginPopup.querySelector("div");

        // Start popup close animation
        popupContent.classList.replace("scale-100", "scale-90");
        popupContent.classList.replace("opacity-100", "opacity-0");

        // Start blur removal animation
        setTimeout(() => {
            loginPopup.classList.add("transition-all", "duration-500"); // Ensure smooth blur
            loginPopup.classList.remove("backdrop-blur-xl");
        }, 10); // Immediate transition for blur

        // Fully hide the popup after animations complete
        setTimeout(() => {
            loginPopup.classList.add("hidden");
            loginPopup.classList.remove("transition-all", "duration-500"); // Cleanup
        }, 600); // Matches animation duration
    });
});



    </script>
</body>
</html>
