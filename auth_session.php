<?php
// Start the session
session_start();

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

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
    // Redirect to login page if not logged in
    header("Location: sign_in.php");
    exit();
}

// Get user id and type from session
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

// Determine the correct table based on user type
$table = $user_type === 'author' ? 'authors' : 'readers';

// Prepare the SQL statement to fetch user details and statistics
$sql_fetch_user = "SELECT fullname, email, total_sales, total_downloads, total_books, total_subscriptions FROM $table WHERE `S/N` = '$user_id'";
$result_fetch_user = $conn->query($sql_fetch_user);

if ($result_fetch_user->num_rows > 0) {
    $user_data = $result_fetch_user->fetch_assoc();
    $_SESSION['name'] = $user_data['fullname'];
    $_SESSION['email'] = $user_data['email'];
    $_SESSION['total_sales'] = $user_data['total_sales'];
    $_SESSION['total_downloads'] = $user_data['total_downloads'];
    $_SESSION['total_books'] = $user_data['total_books'];
    $_SESSION['total_subscriptions'] = $user_data['total_subscriptions'];
} else {
    $_SESSION['name'] = "Name not found";
    $_SESSION['email'] = "Email not found";
    $_SESSION['total_sales'] = 0;
    $_SESSION['total_downloads'] = 0;
    $_SESSION['total_books'] = 0;
    $_SESSION['total_subscriptions'] = 0;
}


// Close database connection

?>
