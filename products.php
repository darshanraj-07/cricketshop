<?php
require_once 'config/database.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Cricket Equipment Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="products-page">
        <div class="products-container">
            <!-- Filters Section -->
            <aside class="filters">
                <h3>Categories</h3>
                <ul>
                    <li><a href="?category=bats">Cricket Bats</a></li>
                    <li><a href="?category=balls">Cricket Balls</a></li>
                    <li><a href="?category=protection">Protection Gear</a></li>
                    <li><a href="?category=clothing">Cricket Clothing</a></li>
                </ul>

                <h3>Price Range</h3>
                <form class="price-filter">
                    <input type="range" min="0" max="50000" step="1000">
                    <div class="price-inputs">
                        <input type="number" placeholder="Min">
                        <input type="number" placeholder="Max">
                    </div>
                    <button type="submit">Apply</button>
                </form>
            </aside>

            <!-- Products Grid -->
            <section class="products-grid">
                <div class="products-header">
                    <h2>All Products</h2>
                    <select class="sort-select">
                        <option value="default">Default Sorting</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="newest">Newest First</option>
                    </select>
                </div>

                <div class="product-grid">
                    <?php include 'includes/product_list.php'; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">Next</a>
                </div>
            </section>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="js/main.js"></script>
</body>
</html> 