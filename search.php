<?php
include'connect.php';
if(isset($_GET['submit'])){
    // Handling user input (search term)
$searchTerm = $_GET['search'];

// SQL query to search in a table called 'your_table_name'
$sql = "SELECT * FROM books WHERE title LIKE '%$searchTerm%'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Outputting data found
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Name: " . $row["title"]. "<br>";
    }
} else {
    echo "0 results";
}
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Example</title>
</head>
<body>
    <form action="search.php" method="GET"> <!-- Replace "search.php" with your PHP script file name -->
        <label for="search">Search:</label>
        <input type="text" id="search" name="search">
        <input type="submit" value="Search" name="submit">
    </form>
</body>
</html>

