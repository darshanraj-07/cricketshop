document.addEventListener('DOMContentLoaded', function() {
    // Quantity controls
    const quantityBtns = document.querySelectorAll('.quantity-btn');
    quantityBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.dataset.id;
            const isIncrement = this.classList.contains('plus');
            updateQuantity(productId, isIncrement);
        });
    });

    // Remove item
    const removeButtons = document.querySelectorAll('.remove-item');
    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.id;
            removeFromCart(productId);
        });
    });

    // Update quantity function
    function updateQuantity(productId, isIncrement) {
        fetch('includes/update_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                product_id: productId,
                increment: isIncrement
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                location.reload();
            }
        });
    }

    // Remove from cart function
    function removeFromCart(productId) {
        fetch('includes/remove_from_cart.php', {
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
                location.reload();
            }
        });
    }
}); 