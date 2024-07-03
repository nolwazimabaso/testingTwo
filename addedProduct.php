<?php
// Your database connection logic and other necessary includes
include 'connect.php';

if (isset($_GET['approve'])) {
    // Retrieve the book ID
    $bookId = $_GET['approve'];

    $selectBook = "SELECT * FROM books WHERE id = '$bookId'";
    $bookResult = mysqli_query($conn, $selectBook);

    if ($bookResult && mysqli_num_rows($bookResult) > 0) {
        $bookData = mysqli_fetch_assoc($bookResult);

        // Insert book details into the addbooks table
        $insert = "INSERT INTO addbooks (title, price, image) 
                   VALUES ('" . $bookData['title'] . "', '" . $bookData['price'] . "', '" . $bookData['image'] . "')";
        $insertResult = mysqli_query($conn, $insert);

        if ($insertResult) {
            echo "Book added successfully";
            
        } else {
            echo "Error adding the book.";
        }
    } else {
        echo "Book not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Books</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/styles.css">
    
</head>
<body>
    <div class="container">
        <section class="display_product">
        <h2>Approved Books</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Here you'd dynamically generate the table rows using PHP -->
            <?php
            // PHP logic to fetch approved books from the database and populate the table
            include 'connect.php'; // Include your database connection file
            
            $approvedBooksQuery = "SELECT * FROM addbooks"; // Modify this query to fetch approved books
            $result = mysqli_query($conn, $approvedBooksQuery);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td><img src='images/" . $row['image'] . "' alt='" . $row['title'] . "' width='100'></td>";
                    echo "<td><button onclick='addToCart()'>Add to Cart</button></td>";
                    echo "<td><button onclick='showCart()'>Show Cart</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No approved books found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
        </section>
    </div>
    
</body>
</html>

