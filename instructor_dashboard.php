<?php include 'auth_session.php'; 

// Initialize statistics
$total_sales = 0;
$total_downloads = 0;
$total_books = 0;
$your_downloads = 0;

// Fetch total sales
$query = "SELECT SUM(amount) AS total_sales FROM payments WHERE `author_id` = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['author_id']);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $total_sales = $row['total_sales'];
}

// Fetch total downloads
$query = "SELECT COUNT(*) AS total_downloads FROM auth_downloads WHERE `author_id` = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['author_id']);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $total_downloads = $row['total_downloads'];
}

// Fetch total books
$query = "SELECT COUNT(*) AS total_books FROM books WHERE `id` = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['author_id']);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $total_books = $row['total_books'];
}

// Fetch your downloads
$query = "SELECT COUNT(*) AS your_downloads FROM downloads WHERE `reader_id` = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['reader_id']);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $your_downloads = $row['your_downloads'];
}

// Store in session
$_SESSION['total_sales'] = $total_sales;
$_SESSION['total_downloads'] = $total_downloads;
$_SESSION['total_books'] = $total_books;
$_SESSION['total_subscriptions'] = $your_downloads;

?>



<!DOCTYPE html>
<html lang="en">

	
<!-- Mirrored from gambolthemes.net/html-items/cursus-new-demo/instructor_dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 15:23:57 GMT -->
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Libis - Dashboard</title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="images/fav.png">
		
		<!-- Stylesheets -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
		<link href='vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
		<link href="css/vertical-responsive-menu1.min.css" rel="stylesheet">
		<link href="css/instructor-dashboard.css" rel="stylesheet">
		<link href="css/instructor-responsive.css" rel="stylesheet">
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
            <i class="uil uil-search-alt icon icon1"></i>
        </div>
    </div>
</div>

<div id="searchResults"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchInput').on('input', function() {
            var query = $(this).val();
            if (query.length > 2) {
                $.ajax({
                    url: 'search.php',
                    method: 'GET',
                    data: { q: query },
                    success: function(data) {
                        $('#searchResults').html(data);
                    }
                });
            } else {
                $('#searchResults').html('');
            }
        });
    });
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
									<h6> <?php echo htmlspecialchars($_SESSION['name']); ?></h6>
										<div class="mef78" title="Verify">
											<i class='uil uil-check-circle'></i>
										</div>
									</div>
									<span><?php echo htmlspecialchars($_SESSION['email']); ?></span>
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
						<a href="instructor_dashboard.php" class="menu--link active" title="Dashboard">
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
						<h2 class="st_title"><i class="uil uil-apps"></i>Dashboard</h2>
					</div>






					 <!-- <div class="col-xl-3 col-lg-6 col-md-6">
						<div class="card_dash">
							<div class="card_dash_left">
								<h5>Total Sales</h5>
								<h2>₦ <?php echo htmlspecialchars($_SESSION['total_sales']); ?></h2>
								<span class="crdbg_1">View</span>
							</div>
							<div class="card_dash_right">
								<img src="images/dashboard/achievement.svg" alt="">
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6">
						<div class="card_dash">
							<div class="card_dash_left">
								<h5>Total Downloads</h5>
								<h2><?php echo htmlspecialchars($_SESSION['total_downloads']); ?></h2>
								<span class="crdbg_2">View</span>
							</div>
							<div class="card_dash_right">
								<img src="images/dashboard/graduation-cap.svg" alt="">
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6">
						<div class="card_dash">
							<div class="card_dash_left">
								<h5>Total Books</h5>
								<h2><?php echo htmlspecialchars($_SESSION['total_books']); ?></h2>
								<span class="crdbg_3">view</span>
							</div>
							<div class="card_dash_right">
								<img src="images/dashboard/online-course.svg" alt="">
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6">
						<div class="card_dash">
							<div class="card_dash_left">
								<h5>Your Downloads</h5>
								<h2><?php echo htmlspecialchars($_SESSION['total_subscriptions']); ?></h2>
								<span class="crdbg_4">View</span>
							</div>
							<div class="card_dash_right">
								<img src="images/dashboard/knowledge.svg" alt="">
							</div>
						</div>
					</div>  -->

					<div class="col-md-12">
						<div class="card_dash1">
							<div class="card_dash_left1">
								<i class="uil uil-book-alt"></i>
								<h1>Jump Into Book Uploads</h1>
							</div>
							<div class="card_dash_right1">
								<button class="create_btn_dash" onclick="window.location.href = 'create_new_course.php';">Upload Your Book</button>
							</div>
						</div>
					</div>					
				</div>
				<div class="row">
					<div class="col-xl-4 col-lg-6 col-md-6">
						<div class="section3125 mt-50">
							<h4 class="item_title">Latest Book Uploads</h4>
							<div class="la5lo1">
								<div class="owl-carousel courses_performance owl-theme">
								<?php
            $stmt = $conn->prepare("SELECT * FROM books WHERE author_id = ?");
            $stmt->bind_param('i', $_SESSION['user_id']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
					$thumbnail_path = htmlspecialchars($row['thumbnail']);
                    echo '<div class="item">';
                    echo '    <div class="fcrse_1">';
                    echo '        <a href="#" class="fcrse_img">';
                    echo '            <img src="' . $thumbnail_path . '" alt="thumbnail">';
                    echo '            <div class="course-overlay"></div>';
                    echo '        </a>';
                    echo '        <div class="fcrse_content">';
                    echo '            <div class="vdtodt">';
                    echo '                <span class="vdt14">' . htmlspecialchars($row['created_at']) . '</span>';
                    echo '            </div>';
                    echo '            <a href="#" class="crsedt145">' . htmlspecialchars($row['title']) . '</a>';
                    echo '            <div class="allvperf">';
                    echo '                <div class="crse-perf-left">Price</div>';
                    echo '                <div class="crse-perf-right">' . htmlspecialchars($row['regular_price']) . '</div>';
                    echo '            </div>';
                    echo '            <div class="allvperf">';
                    echo '                <div class="crse-perf-left">Category</div>';
                    echo '                <div class="crse-perf-right">' . htmlspecialchars($row['category']) . '</div>';
                    echo '            </div>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No books uploaded yet.</p>';
            }
            ?>
									</div>
		</div>
		</div>
					</div>					
					<div class="col-xl-4 col-lg-6 col-md-6">
						<div class="section3125 mt-50">
							<h4 class="item_title">News</h4>
							<div class="la5lo1">
								<div class="owl-carousel edututs_news owl-theme">
									<div class="item">
										<div class="fcrse_1">
											<a href="#" class="fcrse_img">
												<img src="images/courses/news-1.jpg" alt="">												
											</a>
											<div class="fcrse_content">
												<a href="#" class="crsedt145 mt-15">COVID-19 Updates & Resources</a>
												<p class="news_des45">See the latest updates to coronavirus-related content, including changes to monetization, and access new Creator support resources</p>
												<div class="auth1lnkprce">
													<a href="#" class="cr1fot50">Learn More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="fcrse_1">
											<a href="#" class="fcrse_img">
												<img src="images/courses/news-2.jpg" alt="">												
											</a>
											<div class="fcrse_content">
												<a href="#" class="crsedt145 mt-15">Watch: Edututs+ interview Mr. Joginder</a>
												<p class="news_des45">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac eleifend ante. Duis ac pulvinar felis. Sed a nibh ligula. Mauris eget tortor id mauris tristique accumsan.</p>
												<div class="auth1lnkprce">
													<a href="#" class="cr1fot50">Watch Now</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="fcrse_1">
											<a href="#" class="fcrse_img">
												<img src="images/courses/news-1.jpg" alt="">												
											</a>
											<div class="fcrse_content">
												<a href="#" class="crsedt145 mt-15">COVID-19 Updates - April 7</a>
												<p class="news_des45">Ut porttitor mi vel orci cursus, nec elementum neque malesuada. Phasellus imperdiet quam gravida pharetra aliquet. Integer vel ligula eget nisl dignissim hendrerit.</p>
												<div class="auth1lnkprce">
													<a href="#" class="cr1fot50">Learn More</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
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
	
</body>

</html>