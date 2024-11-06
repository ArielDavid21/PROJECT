<?php 
include 'auth_session.php';

$sql = "SELECT * FROM books WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
