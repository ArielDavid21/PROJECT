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

// Function to sanitize input data
function sanitize_data($conn, $data) {
    return mysqli_real_escape_string($conn, trim($data));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $fullname = sanitize_data($conn, $_POST['fullname']);
    $email = sanitize_data($conn, $_POST['emailaddress']);
    $password = sanitize_data($conn, $_POST['password']);
    $user_type = sanitize_data($conn, $_POST['user_type']);

    // Additional processing based on user_type
    if ($user_type === 'author') {
        $category_id = sanitize_data($conn, $_POST['category_id']);
        // Insert into authors table
        $sql = "INSERT INTO authors (fullname, email, password, category_id) VALUES ('$fullname', '$email', '$password', '$category_id')";
        $redirect_page = 'instructor_dashboard.php'; // Redirect author to dashboard
    } elseif ($user_type === 'reader') {
        // Insert into readers table
        $sql = "INSERT INTO readers (fullname, email, password) VALUES ('$fullname', '$email', '$password')";
        $redirect_page = 'student_dashboard.php'; // Redirect reader to dashboard
    } else {
        // Handle invalid user_type (optional)
        die("Invalid user type");
    }

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        // Get user ID
        $user_id = $conn->insert_id;

        // Start session to store user information
        session_start();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_type'] = $user_type;

        // Redirect to respective dashboard
        header("Location: $redirect_page");
        exit();
    } else {
        // Handle SQL error (optional)
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
