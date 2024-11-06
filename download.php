<?php
include 'auth_session.php';
 // Assume db.php contains database connection code

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    $sql = "SELECT book_file FROM books WHERE id = ? AND author_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $book_id, $_SESSION['user_id']);
    $stmt->execute();
    $stmt->bind_result($book_file);
    $stmt->fetch();
    $stmt->close();

    if ($book_file && file_exists($book_file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($book_file) . '"');
        header('Content-Length: ' . filesize($book_file));
        readfile($book_file);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}

if ($con->ping()) {
    $con->close();
}
?>
