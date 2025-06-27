// Notification handling
document.addEventListener('DOMContentLoaded', function() {
    // Function to show toast notification
    function showNotificationToast(message, type = 'info') {
        // Create the toast element
        const toast = document.createElement('div');
        toast.className = `fixed bottom-4 right-4 bg-gray-800 text-white px-4 py-3 rounded-lg shadow-lg border border-gray-700 z-50 notification-toast ${type}`;
        toast.style.transition = 'opacity 0.3s ease';
        
        // Set the content
        toast.innerHTML = `
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                </svg>
                <p>${message}</p>
            </div>
        `;
        
        // Add to document
        document.body.appendChild(toast);
        
        // Remove after 5 seconds
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 5000);
    }
    
    // Check for flash messages
    if (document.body.dataset.flashMessage) {
        showNotificationToast(document.body.dataset.flashMessage, document.body.dataset.flashType || 'info');
    }
    
    // Handle notification badge click
    const notificationButton = document.querySelector('[data-notification-button]');
    if (notificationButton) {
        notificationButton.addEventListener('click', function() {
            // You could mark notifications as read via AJAX here
        });
    }
});