<?php
require_once 'config/database.php';

$stmt = $conn->prepare("SELECT * FROM products LIMIT 8");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($products as $product): ?>
    <div class="product-card">
        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
        <div class="product-info">
            <h3 class="product-title"><?php echo $product['name']; ?></h3>
            <p class="product-price">₹<?php echo number_format($product['price'], 2); ?></p>
            <button class="add-to-cart" data-id="<?php echo $product['id']; ?>">Add to Cart</button>
        </div>
    </div>
<?php endforeach; ?> 