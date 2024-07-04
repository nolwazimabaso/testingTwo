<?php
// Generate unique order number and session ID (You may use your own logic)
$orderNumber = uniqid('ORDER_');
$sessionId = session_id();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
    <h1 class="heading">MY CART</h1>
    <div style='background-color: #E6F7EC; color: #008B5E; border: 1px solid #86D4A5; padding: 10px;'>
        <strong>Success:</strong> Your order with Order No. : <?php echo $orderNumber; ?> has been confirmed and is being processed. Thank you for shopping with us!;
    </div>
</div>


    <?php
include 'connect.php';
$originalQuantity = 50;
$grandTotal = 0;
$orderNumber = uniqid('ORDER_');
// Assume you have the necessary database connection and functions to handle the shopping cart

function checkout($conn,$originalQuantity,$grandTotal,$orderNumber) {
    $select_cart_products = mysqli_query($conn, "SELECT * FROM cart");

if (mysqli_num_rows($select_cart_products) > 0){
    while ($fetch_cart_products = mysqli_fetch_assoc($select_cart_products)){
        $fetch_cart_products['title'];
        $fetch_cart_products['quantity'];
        $subTotal = $fetch_cart_products['price'] * $fetch_cart_products['quantity'];   
        $quantityRemaing = $originalQuantity - $fetch_cart_products['quantity'];
        $grandTotal = $grandTotal + $subTotal;
        
        $insertQuery = "INSERT INTO orderline (title, quantity,remainingQuantity, price, date) VALUES ('{$fetch_cart_products['title']}', '{$fetch_cart_products['quantity']}',$quantityRemaing, '$subTotal', NOW())";
        mysqli_query($conn, $insertQuery);
    }
    


}
    $sql = "DELETE FROM cart";
    if (mysqli_query($conn, $sql)) {
        // Redirect the user to the login/register page
    header("refresh:5;url=index.php"); // Redirect after 5 seconds
    exit();
    } else {
        echo "Error deleting records: " . mysqli_error($conn);
    }
    
}

// Call the function when the checkout process is triggered
if (isset($_POST['checkout'])) {
    checkout($conn,$originalQuantity,$grandTotal,$orderNumber);
}
?>

    </div>
    
</body>
</html>


