<?php
include 'auth_session.php';


if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    $sql = "DELETE FROM books WHERE id = ? AND author_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $book_id, $_SESSION['user_id']);
    if ($stmt->execute()) {
        header("Location: instructor_courses.php?msg=Book deleted successfully");
    } else {
        echo "Error deleting book.";
    }
    $stmt->close();
} else {
    echo "Invalid request.";
}

if ($con->ping()) {
    $con->close();
}
?>
