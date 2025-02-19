document.addEventListener('DOMContentLoaded', function() {
    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.id;
            addToCart(productId);
        });
    });

    // Add to wishlist functionality
    const wishlistButtons = document.querySelectorAll('.add-to-wishlist');
    wishlistButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.id;
            addToWishlist(productId);
        });
    });

    // Image lazy loading
    const images = document.querySelectorAll('img[loading="lazy"]');
    
    images.forEach(img => {
        // Set up intersection observer
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.addEventListener('load', function() {
                            img.classList.add('loaded');
                        });
                        observer.unobserve(img);
                    }
                });
            });

            imageObserver.observe(img);
        } else {
            // Fallback for browsers that don't support IntersectionObserver
            img.src = img.dataset.src;
        }

        // Error handling
        img.addEventListener('error', function() {
            this.src = 'images/placeholder.jpg';
            this.classList.add('error');
        });
    });

    // Price range filter
    const priceFilter = document.querySelector('.price-filter');
    if (priceFilter) {
        priceFilter.addEventListener('submit', function(e) {
            e.preventDefault();
            const minPrice = this.querySelector('[name="price_min"]').value;
            const maxPrice = this.querySelector('[name="price_max"]').value;
            const currentUrl = new URL(window.location.href);
            if (minPrice) currentUrl.searchParams.set('price_min', minPrice);
            if (maxPrice) currentUrl.searchParams.set('price_max', maxPrice);
            window.location.href = currentUrl.toString();
        });
    }
});

function addToCart(productId) {
    fetch('includes/add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Product added to cart!', 'success');
            updateCartCount(data.cartCount);
        } else {
            showNotification('Error adding product to cart', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error adding product to cart', 'error');
    });
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
} 