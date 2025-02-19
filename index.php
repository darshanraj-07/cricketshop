<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Equipment Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Premium Cricket Equipment</h1>
                <p>Get the best cricket gear for your game</p>
                <a href="#products" class="cta-button">Shop Now</a>
            </div>
        </section>

        <!-- Featured Categories -->
        <section class="categories">
            <h2>Shop By Category</h2>
            <div class="category-grid">
                <div class="category-card">
                    <img src="images/bats.jpg" alt="Cricket Bats">
                    <h3>Cricket Bats</h3>
                </div>
                <div class="category-card">
                    <img src="images/balls.jpg" alt="Cricket Balls">
                    <h3>Cricket Balls</h3>
                </div>
                <div class="category-card">
                    <img src="images/protection.jpg" alt="Protection Gear">
                    <h3>Protection Gear</h3>
                </div>
            </div>
        </section>

        <!-- Featured Products -->
        <section id="products" class="products">
            <h2>Featured Products</h2>
            <div class="product-grid">
                <?php include 'includes/product_list.php'; ?>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="js/main.js"></script>
</body>
</html> 