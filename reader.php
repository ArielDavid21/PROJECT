<?php
// Start the session
session_start();

// Database configuration
$servername = "localhost";
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$dbname = "final_project"; // Update with your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: sign_in.php");
    exit();
}

// Get user id and type from session
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

// Determine the correct table based on user type
$table = $user_type === 'author' ? 'authors' : 'readers';

// Prepare the SQL statement to fetch user details and statistics
$sql_fetch_user = "SELECT fullname, email, purchased_books FROM $table WHERE `S/N` = '$user_id'";
$result_fetch_user = $conn->query($sql_fetch_user);

if ($result_fetch_user->num_rows > 0) {
    $user_data = $result_fetch_user->fetch_assoc();
    $_SESSION['name'] = $user_data['fullname'];
    $_SESSION['email'] = $user_data['email'];
    $_SESSION['purchased_books'] = $user_data['purchased_books'];
   
} else {
    $_SESSION['name'] = "Name not found";
    $_SESSION['email'] = "Email not found";
    $_SESSION['purchased_books'] = "No Records found";
}


// Close database connection

?>


