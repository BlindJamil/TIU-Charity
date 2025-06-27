document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded - main.js initialized');

    // Mobile menu toggle with improved functionality
    function setupMobileMenu() {
        const menuBtn = document.getElementById('menu-btn');
        const menu = document.getElementById('menu');
        const menuOpenIcon = document.querySelector('.menu-open');
        const menuCloseIcon = document.querySelector('.menu-close');
        
        if (menuBtn && menu) {
            console.log('Mobile menu elements found');
            
            menuBtn.addEventListener('click', function() {
                // Toggle menu visibility
                menu.classList.toggle('hidden');
                
                // Toggle icons
                if (menuOpenIcon && menuCloseIcon) {
                    menuOpenIcon.classList.toggle('hidden');
                    menuOpenIcon.classList.toggle('inline-flex');
                    menuCloseIcon.classList.toggle('hidden');
                    menuCloseIcon.classList.toggle('inline-flex');
                }
                
                console.log('Menu toggled');
            });
        }
    }

    // Header scroll behavior with smooth transition
    function setupScrollHeader() {
        const header = document.getElementById('header');
        
        if (header) {
            console.log('Header element found');
            
            // Transition is already in the HTML class, no need to add it in JS
            
            let lastScrollY = window.scrollY;
            
            window.addEventListener('scroll', function() {
                const currentScrollY = window.scrollY;
                
                if (currentScrollY > lastScrollY && currentScrollY > 50) {
                    // Scrolling down, hide the header
                    header.style.transform = 'translateY(-100%)';
                } else {
                    // Scrolling up or at top, show the header
                    header.style.transform = 'translateY(0)';
                }
                
                lastScrollY = currentScrollY;
            });
        }
    }

    // Initialize navigation functionality
    setupMobileMenu();
    setupScrollHeader();
    
    // Rest of your code for FAQ, etc...
    
    console.log('Navigation functionality initialized');
});