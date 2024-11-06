<?php
include 'auth_session.php'; // Your database connection details

header('Content-Type: application/json');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!isset($data['reference']) || !isset($data['bookId'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    exit();
}

$reference = $data['reference'];
$bookId = $data['bookId'];

$paystack_secret_key = 'sk_test_9c0d3775e019293dcfed5667199db63d4b1ac342'; // Replace with your secret key

// Retrieve the book details from the database
$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $bookId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $book = $result->fetch_assoc();
    $download_url = $book['book_file']; // Assuming you have a column 'book_file'
    $price = $book['discount_price']; // Assuming 'regular_price' is the column name for the book price

    if (empty($price) || $price == 0) {
        // If the book is free, allow direct download
        echo json_encode(['status' => 'success', 'download_url' => $download_url]);
        exit();
    }

    // If the book is not free, verify the payment with Paystack
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.paystack.co/transaction/verify/" . $reference);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer " . $paystack_secret_key]);

    $response = curl_exec($ch);
    curl_close($ch);

    $response_data = json_decode($response, true);

    if ($response_data['status'] && $response_data['data']['status'] === 'success') {
        // Successful payment
        echo json_encode(['status' => 'success', 'download_url' => $download_url]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Payment verification failed']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Book not found']);
}
?>
