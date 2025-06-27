document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded - main.js initialized');

    // Mobile menu toggle
    function setupMobileMenu() {
        const menuBtn = document.querySelector('#menu-btn');
        const menu = document.querySelector('#menu');
        
        if (menuBtn && menu) {
            console.log('Mobile menu elements found');
            menuBtn.addEventListener('click', function() {
                menu.classList.toggle('hidden');
                if (menu.classList.contains('flex')) {
                    menu.classList.remove('flex');
                } else {
                    menu.classList.add('flex');
                }
                console.log('Menu toggled');
            });
        }
    }

    // Header scroll behavior with smooth transition
    function setupScrollHeader() {
        const header = document.querySelector('header, #header');
        
        if (header) {
            console.log('Header element found');
            
            // Add transition class for smooth animation
            header.style.transition = 'transform 0.3s ease';
            
            let lastScrollY = window.scrollY;
            
            window.addEventListener('scroll', function() {
                const currentScrollY = window.scrollY;
                
                if (currentScrollY > lastScrollY && currentScrollY > 100) {
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

    // FAQ accordion functionality
    function setupFaqAccordion() {
        const faqButtons = document.querySelectorAll('.faq-toggle');
        
        if (faqButtons.length > 0) {
            console.log('FAQ elements found:', faqButtons.length);
            
            faqButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const answer = this.nextElementSibling;
                    
                    if (answer && answer.classList.contains('faq-answer')) {
                        answer.classList.toggle('hidden');
                        
                        // Toggle icon rotation if it exists
                        const icon = this.querySelector('.faq-icon');
                        if (icon) {
                            icon.classList.toggle('rotate-180');
                        }
                    }
                });
            });
        }
    }

    // FAQ category filtering
    function setupFaqCategories() {
        const categoryButtons = document.querySelectorAll('.category-button');
        
        if (categoryButtons.length > 0) {
            console.log('FAQ category elements found');
            
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Update active button styling
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('active', 'bg-yellow-500', 'text-black');
                        btn.classList.add('bg-gray-700', 'text-white');
                    });
                    
                    this.classList.add('active', 'bg-yellow-500', 'text-black');
                    this.classList.remove('bg-gray-700', 'text-white');
                    
                    // Filter FAQ items
                    const category = this.getAttribute('data-category');
                    const faqItems = document.querySelectorAll('.faq-item');
                    
                    faqItems.forEach(item => {
                        if (category === 'all' || item.getAttribute('data-category') === category) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        }
    }

    // FAQ search functionality
    function setupFaqSearch() {
        const searchInput = document.getElementById('faq-search');
        
        if (searchInput) {
            console.log('FAQ search element found');
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const faqItems = document.querySelectorAll('.faq-item');
                
                faqItems.forEach(item => {
                    const questionText = item.querySelector('button span')?.textContent.toLowerCase() || '';
                    const answerText = item.querySelector('.faq-answer')?.textContent.toLowerCase() || '';
                    
                    if (questionText.includes(searchTerm) || answerText.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }
    }

    // Initialize all functionality
    setupMobileMenu();
    setupScrollHeader();
    setupFaqAccordion();
    setupFaqCategories();
    setupFaqSearch();
    
    console.log('All JavaScript functionality initialized');
});