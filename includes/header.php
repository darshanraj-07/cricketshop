<header>
    <div class="nav-container">
        <div class="logo">
            <a href="index.php">
                <img src="images/logo.png" alt="Cricket Store">
            </a>
        </div>
        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="cart.php">Cart <i class="fas fa-shopping-cart"></i></a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="account.php">My Account</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header> 