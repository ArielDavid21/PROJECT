<?php
include 'author_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = isset($_POST['book_id']) ? $_POST['book_id'] : null;
    $author_id = $_POST['author_id'];
    $book_title = $_POST['title'];
    $description = $_POST['description'];
    $writing_level = $_POST['writing_level'];
    $audio_language = $_POST['audio_language'];
    $book_language = $_POST['book_language'];
    $category = $_POST['category'];
    $book_format = $_POST['book_format'];
    
    $regular_price = $_POST['regular_price'];
    $discount_price = $_POST['discount_price'];
    
    $allowed_file_types = ['pdf', 'word', 'mp3'];
    $allowed_image_types = ['jpg', 'jpeg', 'png'];

    $book_file = $_FILES['book_file'];
    $thumbnail = $_FILES['thumbnail'];

    $upload_dir_books = 'uploads/books/';
    $upload_dir_thumbnails = 'uploads/thumbnails/';

    // Check if the directories exist, if not, create them
    if (!file_exists($upload_dir_books)) {
        mkdir($upload_dir_books, 0777, true);
    }

    if (!file_exists($upload_dir_thumbnails)) {
        mkdir($upload_dir_thumbnails, 0777, true);
    }

    if ($book_id) {
        // Update existing book
        $sql = "UPDATE books SET title = ?, regular_price = ?, discount_price = ?, category = ?, updated_at = NOW()";
        if ($thumbnail) {
            $sql .= ", thumbnail = ?";
        }
        $sql .= " WHERE id = ? AND author_id = ?";
        $stmt = $conn->prepare($sql);
        if ($thumbnail) {
            $stmt->bind_param('ssssiii', $title, $regular_price, $discount_price, $category, $thumbnail, $book_id, $author_id);
        } else {
            $stmt->bind_param('sssiis', $title, $regular_price, $discount_price, $category, $book_id, $author_id);
        }
    } else {
        // Insert new book
        $stmt = $conn->prepare("INSERT INTO books (author_id, title, regular_price, discount_price, category, thumbnail, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param('isssss', $author_id, $title, $regular_price, $discount_price, $category, $thumbnail);
    }

    // Validate and move book file
    $book_file_ext = strtolower(pathinfo($book_file['name'], PATHINFO_EXTENSION));
    if (in_array($book_file_ext, $allowed_file_types)) {
        $book_file_path = $upload_dir_books . basename($book_file['name']);
        move_uploaded_file($book_file['tmp_name'], $book_file_path);
        

    } else {
        header("Location: create_new_course.php?error=Unsupported book file type.");
        exit;
    }

    // Validate and move thumbnail
    $thumbnail_ext = strtolower(pathinfo($thumbnail['name'], PATHINFO_EXTENSION));
    if (in_array($thumbnail_ext, $allowed_image_types)) {
        $thumbnail_path = $upload_dir_thumbnails . basename($thumbnail['name']);
        move_uploaded_file($thumbnail['tmp_name'], $thumbnail_path);
    } else {
        header("Location: create_new_course.php?error=Unsupported thumbnail file type.");
        exit;
    }

    $sql = "INSERT INTO books (title, description, writing_level, audio_language, book_language, category, book_format, book_file, thumbnail, regular_price, discount_price, author_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssssddi', $book_title, $description, $writing_level, $audio_language, $book_language, $category, $book_format, $book_file_path, $thumbnail_path, $regular_price, $discount_price, $author_id);
    if ($stmt->execute()) {
        header("Location: create_new_course.php?success=Book uploaded successfully.");
    } else {
        header("Location: create_new_course.php?error=Failed to upload book.");
    }
    exit;
}
?>
