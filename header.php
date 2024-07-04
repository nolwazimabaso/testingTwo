<header class="header">
<div class="header_body">
    <a href="index.MsaBooksTrade" class="logo" >MSABOOKSTRADE</a>
    <nav class="navbar">
        <a href="index.php">Add Products</a>
        <a href="shop_products.php">Shop it</a>
    </nav>
    <!--select query-->
    <?php 
    $select_product = mysqli_query($conn, "select * from cart") or die("query fialed");
    $select_product_wishList = mysqli_query($conn, "select * from cart") or die("query fialed");
    $row_count= mysqli_num_rows($select_product);
    $row_count1= mysqli_num_rows($select_product_wishList);
    ?>
    <!--Shopping cart icon-->
    <a href="wishlist.php" class="cart"><i class="fa-solid fa-heart"></i><span><sup><?php echo $row_count1 ?></sup></span></a>
    <a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i><span><sup><?php echo $row_count ?></sup></span></a>
    <a href="search.php"class="cart"><i class="fa-solid fa-magnifying-glass"></i></a>
    </div>
</header>