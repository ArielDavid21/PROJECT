<?php
// Database configuration
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'final_project';

// Connect to database
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query
$query = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

if (!empty($query)) {
    // Search books and authors
    $sql = "SELECT 'book' AS type, id, title AS name, thumbnail AS image_path 
            FROM books 
            WHERE title LIKE '%$query%' 
            UNION 
            SELECT 'author' AS type, `S/N` AS id, fullname AS name, NULL AS image_path 
            FROM authors 
            WHERE fullname LIKE '%$query%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $type = htmlspecialchars($row['type']);
            $name = htmlspecialchars($row['name']);
            $image_path = htmlspecialchars($row['image_path'] ?? 'default.jpg');
            $id = htmlspecialchars($row['id']);
            
            echo '<div class="search-result">';
            if ($type === 'book') {
               
            }
            echo '<div class="search-info">';
            echo '<span class="search-type">' . ucfirst($type) . '</span>';
            echo '<a href="' . ($type === 'book' ? 'book.php?id=' : 'author.php?id=') . $id . '">' . $name . '</a>';
            echo '</div></div>';
        }
    } else {
        echo 'No results found.';
    }
} else {
    echo 'Please enter a search term.';
}

// Close the database connection
$conn->close();
?>
