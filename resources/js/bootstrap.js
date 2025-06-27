import './bootstrap';

// Import the theme's main JavaScript files
import '../assets/vendor/libs/jquery/jquery.js';
import '../assets/vendor/libs/popper/popper.js';
import '../assets/vendor/js/bootstrap.js';
import '../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js';
import '../assets/vendor/js/menu.js';
import '../assets/js/main.js';
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
