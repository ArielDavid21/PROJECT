<?php
include 'author_config.php';

$columns_to_add = [
    'category' => 'VARCHAR(255)',
    'book_format' => 'VARCHAR(10)',
    'external_url' => 'VARCHAR(255)',
];

foreach ($columns_to_add as $column => $data_type) {
    $query = "ALTER TABLE books ADD COLUMN IF NOT EXISTS $column $data_type";
    if ($conn->query($query) === TRUE) {
        echo "Column $column added successfully.<br>";
    } else {
        echo "Error adding column $column: " . $conn->error . "<br>";
    }
}

$conn->close();
?>