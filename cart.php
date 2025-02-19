<?php
require_once 'config/database.php';
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Cricket Equipment Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="cart-page">
        <div class="cart-container">
            <h1>Shopping Cart</h1>
            
            <?php if (empty($_SESSION['cart'])): ?>
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <h2>Your cart is empty</h2>
                    <p>Looks like you haven't added any items to your cart yet.</p>
                    <a href="products.php" class="cta-button">Continue Shopping</a>
                </div>
            <?php else: ?>
                <div class="cart-grid">
                    <div class="cart-items">
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $product_id => $quantity):
                            $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
                            $stmt->execute([$product_id]);
                            $product = $stmt->fetch(PDO::FETCH_ASSOC);
                            $subtotal = $product['price'] * $quantity;
                            $total += $subtotal;
                        ?>
                            <div class="cart-item">
                                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                                <div class="item-details">
                                    <h3><?php echo $product['name']; ?></h3>
                                    <p class="price">₹<?php echo number_format($product['price'], 2); ?></p>
                                    <div class="quantity-controls">
                                        <button class="quantity-btn minus" data-id="<?php echo $product_id; ?>">-</button>
                                        <input type="number" value="<?php echo $quantity; ?>" min="1" max="10">
                                        <button class="quantity-btn plus" data-id="<?php echo $product_id; ?>">+</button>
                                    </div>
                                </div>
                                <div class="item-subtotal">
                                    <p>Subtotal:</p>
                                    <p class="price">₹<?php echo number_format($subtotal, 2); ?></p>
                                    <button class="remove-item" data-id="<?php echo $product_id; ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="cart-summary">
                        <h3>Order Summary</h3>
                        <div class="summary-item">
                            <span>Subtotal</span>
                            <span>₹<?php echo number_format($total, 2); ?></span>
                        </div>
                        <div class="summary-item">
                            <span>Shipping</span>
                            <span><?php echo $total > 1000 ? 'FREE' : '₹100.00'; ?></span>
                        </div>
                        <div class="summary-total">
                            <span>Total</span>
                            <span>₹<?php echo number_format($total + ($total > 1000 ? 0 : 100), 2); ?></span>
                        </div>
                        <button class="checkout-button">
                            Proceed to Checkout <i class="fas fa-arrow-right"></i>
                        </button>
                        <div class="payment-methods">
                            <p>We Accept:</p>
                            <div class="payment-icons">
                                <i class="fab fa-cc-visa"></i>
                                <i class="fab fa-cc-mastercard"></i>
                                <i class="fab fa-cc-amex"></i>
                                <i class="fab fa-cc-paypal"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="js/cart.js"></script>
</body>
</html> 