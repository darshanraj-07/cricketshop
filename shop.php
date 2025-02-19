<?php
require_once 'config/database.php';
session_start();

// Get filters
$category = isset($_GET['category']) ? $_GET['category'] : null;
$brand = isset($_GET['brand']) ? $_GET['brand'] : null;
$price_min = isset($_GET['price_min']) ? $_GET['price_min'] : null;
$price_max = isset($_GET['price_max']) ? $_GET['price_max'] : null;
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';

// Build query
$query = "SELECT * FROM products WHERE 1=1";
if ($category) $query .= " AND category = :category";
if ($brand) $query .= " AND brand = :brand";
if ($price_min) $query .= " AND price >= :price_min";
if ($price_max) $query .= " AND price <= :price_max";

// Add sorting
switch($sort) {
    case 'price_low':
        $query .= " ORDER BY price ASC";
        break;
    case 'price_high':
        $query .= " ORDER BY price DESC";
        break;
    case 'rating':
        $query .= " ORDER BY rating DESC";
        break;
    default:
        $query .= " ORDER BY created_at DESC";
}

$stmt = $conn->prepare($query);
if ($category) $stmt->bindParam(':category', $category);
if ($brand) $stmt->bindParam(':brand', $brand);
if ($price_min) $stmt->bindParam(':price_min', $price_min);
if ($price_max) $stmt->bindParam(':price_max', $price_max);

$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Cricket Equipment Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="shop-page">
        <div class="shop-container">
            <!-- Filters Sidebar -->
            <aside class="filters-sidebar">
                <div class="filter-section">
                    <h3>Categories</h3>
                    <ul>
                        <li><a href="?category=bats" class="<?php echo $category == 'bats' ? 'active' : ''; ?>">Cricket Bats</a></li>
                        <li><a href="?category=balls" class="<?php echo $category == 'balls' ? 'active' : ''; ?>">Cricket Balls</a></li>
                        <li><a href="?category=jerseys" class="<?php echo $category == 'jerseys' ? 'active' : ''; ?>">Cricket Jerseys</a></li>
                        <li><a href="?category=shoes" class="<?php echo $category == 'shoes' ? 'active' : ''; ?>">Cricket Shoes</a></li>
                    </ul>
                </div>

                <div class="filter-section">
                    <h3>Price Range</h3>
                    <form class="price-filter" method="GET">
                        <div class="price-inputs">
                            <input type="number" name="price_min" placeholder="Min" value="<?php echo $price_min; ?>">
                            <input type="number" name="price_max" placeholder="Max" value="<?php echo $price_max; ?>">
                        </div>
                        <button type="submit">Apply</button>
                    </form>
                </div>

                <div class="filter-section">
                    <h3>Brands</h3>
                    <ul>
                        <li><a href="?brand=mrf">MRF</a></li>
                        <li><a href="?brand=kookaburra">Kookaburra</a></li>
                        <li><a href="?brand=sg">SG</a></li>
                        <li><a href="?brand=nike">Nike</a></li>
                        <li><a href="?brand=adidas">Adidas</a></li>
                        <li><a href="?brand=puma">Puma</a></li>
                    </ul>
                </div>
            </aside>

            <!-- Products Grid -->
            <section class="products-section">
                <div class="products-header">
                    <h1><?php echo $category ? ucfirst($category) : 'All Products'; ?></h1>
                    <div class="sort-filter">
                        <select onchange="window.location.href=this.value">
                            <option value="?sort=default">Latest</option>
                            <option value="?sort=price_low">Price: Low to High</option>
                            <option value="?sort=price_high">Price: High to Low</option>
                            <option value="?sort=rating">Top Rated</option>
                        </select>
                    </div>
                </div>

                <div class="products-grid">
                    <?php 
                    // Repeat products to fill the grid symmetrically (12 cards per page)
                    $productsToShow = array_slice($products, 0, 4); // Get first 4 unique products
                    $repeatedProducts = array_merge($productsToShow, $productsToShow, $productsToShow); // Repeat to get 12 items
                    
                    foreach($repeatedProducts as $product): 
                    ?>
                        <div class="product-card category-<?php echo $product['category']; ?>">
                            <div class="product-image">
                                <span class="category-badge"><?php echo ucfirst($product['category']); ?></span>
                                <?php if($product['discount_percent'] > 0): ?>
                                    <span class="badge discount">-<?php echo $product['discount_percent']; ?>%</span>
                                <?php endif; ?>
                                <?php if($product['stock'] < 5): ?>
                                    <span class="badge limited">Limited Stock</span>
                                <?php endif; ?>
                                <div class="image-container">
                                    <img 
                                        src="images/placeholder.jpg" 
                                        data-src="<?php echo htmlspecialchars($product['image']); ?>" 
                                        alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                        loading="lazy"
                                    >
                                    <div class="loading-spinner"></div>
                                </div>
                                <div class="product-actions">
                                    <button class="action-btn quick-view" data-id="<?php echo $product['id']; ?>" title="Quick View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn add-to-cart" data-id="<?php echo $product['id']; ?>" title="Add to Cart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                    <button class="action-btn add-to-wishlist" data-id="<?php echo $product['id']; ?>" title="Add to Wishlist">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="brand"><?php echo htmlspecialchars($product['brand']); ?></div>
                                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                                <div class="rating">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star<?php echo $i <= $product['rating'] ? '' : '-empty'; ?>"></i>
                                    <?php endfor; ?>
                                    <span>(<?php echo $product['reviews_count']; ?>)</span>
                                </div>
                                <div class="price-container">
                                    <?php if($product['discount_percent'] > 0): ?>
                                        <span class="original-price">₹<?php echo number_format($product['price']); ?></span>
                                        <span class="discounted-price">₹<?php echo number_format($product['price'] * (1 - $product['discount_percent']/100)); ?></span>
                                    <?php else: ?>
                                        <span class="price">₹<?php echo number_format($product['price']); ?></span>
                                    <?php endif; ?>
                                </div>
                                <a href="product.php?id=<?php echo $product['id']; ?>" class="view-details">View Details</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="js/shop.js"></script>
</body>
</html> 