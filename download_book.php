<?php
include 'auth_session.php'; // Your database connection

if (isset($_GET['id'])) {
    $bookId = intval($_GET['id']);
    $sql = "SELECT * FROM books WHERE id = $bookId";
    $result = $conn->query($sql);



    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
        $filePath = $book['book_file']; // Assuming 'file_path' is the column name for the file path

        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "Book not found.";
    }
} else {
    echo "Invalid request.";




}
?>
