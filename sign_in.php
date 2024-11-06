<?php
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

// Function to sanitize input data
function sanitize_data($conn, $data)
{
    return mysqli_real_escape_string($conn, trim($data));
}

// Initialize error message
$error_msg = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $email = sanitize_data($conn, $_POST['emailaddress']);
    $password = sanitize_data($conn, $_POST['password']);

	$author_sql = "SELECT * FROM authors WHERE email = '$email' AND password = '$password'";
    $author_result = $conn->query($author_sql);

    if ($author_result->num_rows > 0) {
        $user = $author_result->fetch_assoc();

        // Start session to store user information
        
        $_SESSION['user_id'] = $user['S/N'];
        $_SESSION['user_type'] = 'author';

        // Redirect to author dashboard
        header("Location: instructor_dashboard.php");
        exit();
    }

    // Query database for reader
    $reader_sql = "SELECT * FROM readers WHERE email = '$email' AND password = '$password'";
    $reader_result = $conn->query($reader_sql);

    if ($reader_result->num_rows > 0) {
        $user = $reader_result->fetch_assoc();

        // Start session to store user information
       
        $_SESSION['user_id'] = $user['S/N']; // Replace 'S/N' with your actual column name for user ID
        $_SESSION['user_type'] = 'reader'; 

        // Redirect to reader dashboard
        header("Location: student_dashboard.php");
        exit();
    } else {
        $error_msg = "Invalid email or password";
    }
}

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Gambolthemes">
    <meta name="author" content="Gambolthemes">
    <title>Libis - Sign In</title>

    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="images/fav.png">

    <!-- Stylesheets -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
    <link href='vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
    <link href="css/vertical-responsive-menu.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/night-mode.css" rel="stylesheet">

    <!-- Vendor Stylesheets -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
    <link href="vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-select/docs/docs/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendor/semantic/semantic.min.css">    
</head> 

<body>

    <!-- Signup Start -->
    <div class="sign_in_up_bg">
        <div class="container">
            <div class="row justify-content-lg-center justify-content-md-center">
                <div class="col-lg-12">
                    <div class="main_logo25" id="logo">
                        <a href="index.html"><img src="images/sign_logo.png" alt=""></a>
                        <a href="index.html"><img class="logo-inverse" src="images/ct_logo.svg" alt=""></a>
                    </div>
                </div>
            
                <div class="col-lg-6 col-md-8">
                    <div class="sign_form">
                        <h2>Welcome Back</h2>
                        <p>Log In to Your Libis Account!</p>
                        
                        <form method="POST" action="">
                            <div class="ui search focus mt-15">
                                <div class="ui left icon input swdh95">
                                    <input class="prompt srch_explore" type="email" name="emailaddress" id="id_email" required="" maxlength="64" placeholder="Email Address">                                                        
                                    <i class="uil uil-envelope icon icon2"></i>
                                </div>
                            </div>
                            <div class="ui search focus mt-15">
                                <div class="ui left icon input swdh95">
                                    <input class="prompt srch_explore" type="password" name="password" id="id_password" required="" maxlength="64" placeholder="Password">
                                    <i class="uil uil-key-skeleton-alt icon icon2"></i>
                                </div>
                            </div>
							<?php
                            // Display error message if any
                            if (!empty($error_msg)) {
                                echo "<p style='color:red;'>$error_msg</p>";
                            }
                            ?>
                            <div class="ui form mt-30 checkbox_sign">
                                <div class="inline field">
                                    <div class="ui checkbox mncheck">
                                        <input type="checkbox" tabindex="0" class="hidden">
                                        <label>Remember Me</label>
                                    </div>
                                </div>
                            </div>
                            <button class="login-btn" type="submit">Sign In</button>
                            
                        </form>
                        <p class="sgntrm145">Or <a href="forgot_password.html">Forgot Password</a>.</p>
                        <p class="mb-0 mt-30 hvsng145">Don't have an account? <a href="sign_up_steps.php">Sign Up</a></p>
                    </div>
                    
                </div>                
            </div>                
        </div>                
    </div>
    <!-- Signup End -->    

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/OwlCarousel/owl.carousel.js"></script>
    <script src="vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js"></script>
    <script src="vendor/semantic/semantic.min.js"></script>
    <script src="js/custom.js"></script>    
    <script src="js/night-mode.js"></script>    
    
</body>
</html>
