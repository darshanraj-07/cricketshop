// Handle image loading
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.product-image img');
    
    images.forEach(img => {
        img.addEventListener('load', function() {
            this.parentElement.classList.add('loaded');
        });
        
        img.addEventListener('error', function() {
            this.src = 'img/placeholder.jpg';
            this.parentElement.classList.add('loaded');
        });
    });
}); 