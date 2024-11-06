<?php include 'auth_session.php'; ?>
<!DOCTYPE html>
<html lang="en">

	
<!-- Mirrored from gambolthemes.net/html-items/cursus-new-demo/instructor_messages.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 15:23:57 GMT -->
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Libis - Find-books</title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="images/fav.png">
		
		<!-- Stylesheets -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
		<link href='vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
		<link href="css/vertical-responsive-menu1.min.css" rel="stylesheet">
		<link href="css/instructor-dashboard.css" rel="stylesheet">
		<link href="css/instructor-responsive.css" rel="stylesheet">
		<link href="css/night-mode.css" rel="stylesheet">
		<link href="css/jquery.mCustomScrollbar.min.css" rel="stylesheet">
		
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
			<!--<a href="index.html"><img src="images/logo.svg" alt=""></a> -->
			<a href="index.html"><img class="logo-inverse" src="images/ct_logo.svg" alt=""></a>
		</div>
		<div class="search120">
		<div class="ui search">
			  <div class="ui left icon input swdh10">
				<input class="prompt srch10" type="text" placeholder="Search for Books, Authors and more.." id="searchInput">
				<i class='uil uil-search-alt icon icon1'></i>
			  </div>
			</div>
		</div>

		<div id="searchResults"></div>

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
            email: '<?php echo htmlspecialchars($_SESSION['email']); ?>', // Replace with the user's email
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


		<div class="header_right">
			<ul>
				<li>
					<a href="create_new_course.php" class="upload_btn" title="Create New Course">Upload New Book</a>
				</li>
				
				
		
				<li class="profile-dropdown">
					<a href="#" class="opts_account" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
						<img src="images/hd_dp.jpg" alt="">
					</a>
					<div class="dropdown-menu dropdown_account drop-down dropdown-menu-end">
						<div class="channel_my">
							<div class="profile_link">
								<img src="images/hd_dp.jpg" alt="">
								<div class="pd_content">
									<div class="rhte85">
										<h6><?php echo htmlspecialchars($_SESSION['name']); ?></h6>
										<div class="mef78" title="Verify">
											<i class='uil uil-check-circle'></i>
										</div>
									</div>
									<span><?php echo htmlspecialchars($_SESSION['email']);  ?></span>
								</div>							
							</div>
							<a href="my_instructor_profile_view.html" class="dp_link_12">View Instructor Profile</a>						
						</div>
						<div class="night_mode_switch__btn">
							<a href="#" id="night-mode" class="btn-night-mode">
								<i class="uil uil-moon"></i> Night mode
								<span class="btn-night-mode-switch">
									<span class="uk-switch-button"></span>
								</span>
							</a>
						</div>
						<a href="instructor_dashboard.php" class="item channel_item">Dashboard</a>						
						
						<a href="setting.php" class="item channel_item">Setting</a>
						
						<a href="feedback.php" class="item channel_item">Send Feedback</a>
						<a href="sign_in.php" class="item channel_item">Sign Out</a>
					</div>
				</li>
			</ul>
		</div>
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
						<a href="create_new_course.php" class="menu--link" title="Upload  Book">
							<i class='uil uil-plus-circle menu--icon'></i>
							<span class="menu--label">Upload New Book</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="instructor_messages.php" class="menu--link active" title="Find Books">
							<i class='uil uil-search menu--icon'></i>
							<span class="menu--label">Find Books</span>
						</a>
					</li>
					
					
					<li class="menu--item">
						<a href="all_instructor.php" class="menu--link" title="Authors">
						  <i class='uil uil-file-alt menu--icon'></i>
						  <span class="menu--label">Authors</span>
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
	<div class="wrapper">
		<div class="sa4d25">
			<div class="container-fluid">			
				<div class="row">
					<div class="col-lg-12">	
						<h2 class="st_title"><i class="uil uil-books"></i> Find Books</h2>
					</div>					
				</div>				
				
		<div class="sa4d25">
			<div class="container-fluid">			
				<div class="row">
					
				<?php 
				$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through and display each book
    while($row = $result->fetch_assoc()) {
        $thumbnail = $row['thumbnail']; // Assuming 'thumbnail' is the column name
        $title = htmlspecialchars($row['title']);
        $price = htmlspecialchars($row['discount_price']);
        $category = htmlspecialchars($row['category']);
        $language = htmlspecialchars($row['book_language']);
        $upload_date = htmlspecialchars($row['created_at']); // Assuming 'upload_date' is the column name
		$book_id = htmlspecialchars($row['id']);
		echo '
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="section3125 mt-50">
                <div class="item">
                    <div class="fcrse_1">
                        <a href="#" class="fcrse_img">
                            <img src="' . $thumbnail . '" alt="">
                            <div class="course-overlay"></div>
                        </a>
                        <div class="fcrse_content">
                            <div class="vdtodt">
                                <span class="vdt14">' . $upload_date . '</span>
                            </div>
                            <a href="#" class="crsedt145">' . $title . '</a>
                            <div class="allvperf">
                                <div class="crse-perf-left">Price</div>
                                <div class="crse-perf-right"> NGN '  . $price . '</div>
                            </div>
                            <div class="allvperf">
                                <div class="crse-perf-left">Category</div>
                                <div class="crse-perf-right">' . $category . '</div>
                            </div>
                            <div class="allvperf">
                                <div class="crse-perf-left">Language</div>
                                <div class="crse-perf-right">' . $language . '</div>
                            </div>
                            <div class="auth1lnkprce">
							<button class="downloadBtn" onclick="payWithPaystack(' . $book_id . ', ' . $price . ')" style="background: red; color: #fff; padding: 8px; border: 0px; outline: none;">Download</button>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
} else {
    echo "No books found.";
}


				?>

				

					
					
							
					</div>

					

						</div>
						</div>
						</div>



		</div>
		<footer class="footer mt-40">
			<div class="container-fluid">
				<div class="row">					
					<div class="col-lg-12">
						<div class="item_f1">
							<a href="terms_of_use.html">Copyright Policy</a>
							<a href="terms_of_use.html">Terms</a>
							<a href="terms_of_use.html">Privacy Policy</a>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="footer_bottm">
							<div class="row">
								<div class="col-md-6">
									<ul class="fotb_left">
										<li>
											<a href="index.html">
												<div class="footer_logo">
													<img src="images/logo1.svg" alt="">
												</div>
											</a>
										</li>
										<li>
											<p>© 2024 <strong>Cursus</strong>. All Rights Reserved.</p>
										</li>
									</ul>
								</div>
								<div class="col-md-6">
									<div class="edu_social_links">
										<a href="#"><i class="fab fa-facebook-f"></i></a>
										<a href="#"><i class="fab fa-twitter"></i></a>
										<a href="#"><i class="fab fa-google-plus-g"></i></a>
										<a href="#"><i class="fab fa-linkedin-in"></i></a>
										<a href="#"><i class="fab fa-instagram"></i></a>
										<a href="#"><i class="fab fa-youtube"></i></a>
										<a href="#"><i class="fab fa-pinterest-p"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<!-- Body End -->

	<script src="js/vertical-responsive-menu.min.js"></script>
	<script src="js/jquery-3.7.1.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js"></script>
	<script src="vendor/semantic/semantic.min.js"></script>
	<script src="js/custom1.js"></script>
	<script src="js/night-mode.js"></script>
	<script src="js/jquery.mCustomScrollbar.js"></script>
			
</body>

</html>