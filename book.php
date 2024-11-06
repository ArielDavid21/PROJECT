<?php
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

// Retrieve book ID from the URL
$book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch book details
$book = null;
if ($book_id > 0) {
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

	
<!-- Mirrored from gambolthemes.net/html-items/cursus-new-demo/course_detail_view.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 15:23:58 GMT -->
<head>
		<meta charset="utf-8">		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">
		<title>Libis - Course Detail View</title>
		
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


		<script src="https://js.paystack.co/v1/inline.js"></script>
		<script>
				function verifyTransaction(reference, bookId, price) {
    fetch('verify_transaction.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ reference: reference, bookId: bookId, price: price }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            window.location.href = data.download_url;
        } else {
            alert('Payment verification failed: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

		</script>

		
		
	</head> 

<body>
	<!-- Video Model Start -->
	<div class="modal vd_mdl fade" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-body">
					<iframe  src="https://www.youtube.com/embed/Ohe_JzKksvA" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				
			</div>
		</div>
	</div>
	<!-- Video Model End -->
	<!-- Header Start -->
	<header class="header clearfix">
		<button type="button" id="toggleMenu" class="toggle_menu">
		  <i class='uil uil-bars'></i>
		</button>
		<button id="collapse_menu" class="collapse_menu">
			<i class="uil uil-bars collapse_menu--icon "></i>
			<span class="collapse_menu--label"></span>
		</button>
		<div class="main_logo" id="logo">
			<a href="index.html"><img src="images/logo.svg" alt=""></a>
			<a href="index.html"><img class="logo-inverse" src="images/ct_logo.svg" alt=""></a>
		</div>
		<div class="search120">
			<div class="ui search">
			  <div class="ui left icon input swdh10">
				<input class="prompt srch10" type="text" placeholder="Search for Tuts Videos, Tutors, Tests and more..">
				<i class='uil uil-search-alt icon icon1'></i>
			  </div>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   function payWithPaystack(bookId, price) {
    if (price <= 0) {
        // Direct download if the price is zero
        verifyPayment('', bookId);
    } else {
        // Initiate Paystack payment
        var handler = PaystackPop.setup({
            key: 'pk_test_cd5fcd5fe3f6fd5198efe98c0ae78f9f37b7a678', // Replace with your public key
            email: 'user@example.com', // Replace with the user's email
            amount: price * 100, // Amount in kobo
            currency: 'NGN',
            ref: 'PS_' + Math.floor((Math.random() * 1000000000) + 1), // Unique reference number
            callback: function (response) {
                // Payment was successful
                verifyPayment(response.reference, bookId);
            },
            onClose: function () {
                alert('Payment window closed.');
            }
        });
        handler.openIframe();
    }
}

function verifyPayment(reference, bookId) {
    fetch('verify_transaction.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            reference: reference,
            bookId: bookId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Redirect to download URL
            window.location.href = data.download_url;
        } else {
            alert('Payment verification failed: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

</script>

		
	</header>
	<!-- Header End -->
	<!-- Left Sidebar Start -->
	<nav class="vertical_nav">
		<div class="left_section menu_left" id="js-menu" >
			<div class="left_section">
				<ul>
					<li class="menu--item">
						<a href="instructor_dashboard.php" class="menu--link" title="Dashboard">
							<i class="uil uil-apps menu--icon"></i>
							<span class="menu--label">Dashboard</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="instructor_courses.php" class="menu--link" title="My Books">
							<i class='uil uil-book-alt menu--icon'></i>
							<span class="menu--label">My Books</span>
						</a>
					</li>
					
					<li class="menu--item">
						<a href="create_new_course.php" class="menu--link" title="Upload New Book">
							<i class='uil uil-plus-circle menu--icon'></i>
							<span class="menu--label">Upload New Book</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="instructor_messages.php" class="menu--link" title="Find books">
							<i class='uil uil-search menu--icon'></i>
							<span class="menu--label">Find Books</span>
						</a>
					</li>
					
					
					<li class="menu--item">
						<a href="all_instructor.php" class="menu--link active" title="Authors">
						  <i class='uil uil-file-alt menu--icon'></i>
						  <span class="menu--label">Authors</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="course_detail_view.php" class="menu--link" title="Book">
						  <i class='uil uil-wallet menu--icon'></i>
						  <span class="menu--label">Book</span>
						</a>
					</li>
					
					
				</ul>
			</div>
			<div class="left_section pt-2">
				<ul>
					<li class="menu--item">
						<a href="setting.php" class="menu--link" title="Setting">
							<i class='uil uil-cog menu--icon'></i>
							<span class="menu--label">Setting</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="feedback.php" class="menu--link" title="Send Feedback">
							<i class='uil uil-comment-alt-exclamation menu--icon'></i>
							<span class="menu--label">Send Feedback</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Left Sidebar End -->
	<!-- Body Start -->

	


	<div class="wrapper _bg4586">
        <div class="_215b01">
            <div class="container-fluid">			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section3125">							
                            <div class="row justify-content-center">						
                                <div class="col-xl-4 col-lg-5 col-md-6">						
                                    <div class="preview_video">						
                                        <a href="#" class="fcrse_img" data-bs-toggle="modal" data-bs-target="#videoModal">
                                            <img src="<?php echo htmlspecialchars($book['thumbnail']); ?>" alt="">
                                            <div class="course-overlay">
                                                <div class="badge_seller">Bestseller</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="_215b10">										
                                        <a href="#" class="_215b12">										
                                            <span><i class="uil uil-windsock"></i></span>Report abuse
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-lg-7 col-md-6">
                                    <div class="_215b03">
                                        <h2><?php echo htmlspecialchars($book['title']); ?></h2>
										<h3 style="color:#fff;"><?php echo htmlspecialchars($book['discount_price']); ?></h3>
                                        <span class="_215b04"><?php echo htmlspecialchars($book['description']); ?></span>
                                    </div>
                                    <div class="_215b06">										
                                        <div class="_215b07">										
                                            <span><i class='uil uil-comment'></i></span>
                                            English
                                        </div>
                                    </div>
                                    <div class="_215b05">										
                                        Uploaded <?php echo htmlspecialchars($book['created_at']); ?>
                                    </div>
                                    <ul class="_215b31">										
                                        <li><button class="downloadBtn" onclick="payWithPaystack(' . $book_id . ', ' . $discount_price . ')" style="background: red; padding: 8px; color: #fff; outline: none; border: 0px;">Buy Now</button></li>
                                    </ul>
                                </div>							
                            </div>							
                        </div>							
                    </div>															
                </div>
            </div>
        </div>
        
    </div>
	<!-- Body End -->

	<script src="js/vertical-responsive-menu.min.js"></script>
	<script src="js/jquery-3.7.1.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js"></script>
	<script src="vendor/semantic/semantic.min.js"></script>
	<script src="js/custom.js"></script>	
	<script src="js/night-mode.js"></script>	
	
</body>

<!-- Mirrored from gambolthemes.net/html-items/cursus-new-demo/course_detail_view.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 15:23:58 GMT -->
</html>