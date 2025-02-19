// Cart functionality
document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.id;
            addToCart(productId);
        });
    });
});

function addToCart(productId) {
    fetch('includes/add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('Product added to cart!');
            updateCartCount();
        } else {
            alert('Error adding product to cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function updateCartCount() {
    fetch('includes/get_cart_count.php')
    .then(response => response.json())
    .then(data => {
        document.querySelector('.cart-count').textContent = data.count;
    });
}

// Mobile menu toggle
const mobileMenuButton = document.querySelector('.mobile-menu-button');
const navLinks = document.querySelector('.nav-links');

if(mobileMenuButton) {
    mobileMenuButton.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
}

// Product Slider
const productSlider = document.querySelector('.product-slider');
let isDown = false;
let startX;
let scrollLeft;

productSlider.addEventListener('mousedown', (e) => {
    isDown = true;
    startX = e.pageX - productSlider.offsetLeft;
    scrollLeft = productSlider.scrollLeft;
});

productSlider.addEventListener('mouseleave', () => {
    isDown = false;
});

productSlider.addEventListener('mouseup', () => {
    isDown = false;
});

productSlider.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - productSlider.offsetLeft;
    const walk = (x - startX) * 2;
    productSlider.scrollLeft = scrollLeft - walk;
});

// Add image loading handler
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img');
    
    images.forEach(img => {
        img.addEventListener('load', function() {
            this.classList.add('loaded');
        });
        
        img.addEventListener('error', function() {
            this.src = 'images/placeholder.jpg'; // Add a placeholder image
        });
    });
}); 