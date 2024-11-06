<?php
include 'auth_session.php';
// Get the author ID
$author_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$author_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($author_id > 0) {
    // Fetch author details from the database
    $sql_author = "SELECT * FROM authors WHERE `S/N` = $author_id";
    $result_author = $conn->query($sql_author);

    if ($result_author->num_rows > 0) {
        $author = $result_author->fetch_assoc();
    } else {
        echo "Author not found.";
        exit;
    }

    // Fetch author's books from the database
    $sql_books = "SELECT * FROM books WHERE author_id = $author_id";
    $result_books = $conn->query($sql_books);

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid author ID.";
    exit;
}



// Close the database connection

?>

<!DOCTYPE html>
<html lang="en">

	
<!-- Mirrored from gambolthemes.net/html-items/cursus-new-demo/my_instructor_profile_view.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 15:23:57 GMT -->
<head>
		<meta charset="utf-8">		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">
		<title>Cursus - My Instructor Profile View</title>
		
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
				<input class="prompt srch10" type="text" placeholder="Search for Books, Authors and more..">
				<i class='uil uil-search-alt icon icon1'></i>
			  </div>
			</div>
		</div>
		<div class="header_right">
			<ul>
				<li>
					<a href="create_new_course.html" class="upload_btn" title="Create New Course">Upload New Book</a>
				</li>
				<li>
					<a href="shopping_cart.html" class="option_links" title="cart"><i class='uil uil-shopping-cart-alt'></i><span class="noti_count">2</span></a>
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
						<a href="instructor_dashboard.html" class="item channel_item">Cursus dashboard</a>						
						<a href="membership.html" class="item channel_item">Paid Memberships</a>
						<a href="setting.html" class="item channel_item">Setting</a>
						<a href="help.html" class="item channel_item">Help</a>
						<a href="feedback.html" class="item channel_item">Send Feedback</a>
						<a href="sign_in.html" class="item channel_item">Sign Out</a>
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
						<a href="instructor_payout.php" class="menu--link" title="Payout">
						  <i class='uil uil-wallet menu--icon'></i>
						  <span class="menu--label">Payout</span>
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
    <div class="_216b01">
        <div class="container-fluid">            
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <div class="section3125 rpt145">                            
                        <div class="row">                        
                            <div class="col-lg-6">
                                
                                <div class="dp_dt150">                        
                                    <div class="img148">
                                        <img src="<?php echo htmlspecialchars($author['thumbnail'] ?? 'images/hd_dp.jpg'); ?>" alt="">
                                    </div>
                                    <div class="prfledt1">
                                        <h2><?php echo htmlspecialchars($author['fullname']); ?></h2>
                                        <span><?php echo htmlspecialchars($author['title']); ?></span>
                                    </div>                                        
                                </div>
                                <ul class="_ttl120">
                                    
                                    <li>
                                        <div class="_ttl121">
                                            <div class="_ttl122">Books</div>
                                            <div class="_ttl123"><?php echo $result_books->num_rows; ?></div>
                                        </div>
                                    </li>
                                    
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                
                                <div class="rgt-145">
                                    <ul class="tutor_social_links">
                                        <li><a href="<?php echo htmlspecialchars($author['facebook_link']); ?>" class="fb"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="<?php echo htmlspecialchars($author['twitter_link']); ?>" class="tw"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="<?php echo htmlspecialchars($author['linkedin_link']); ?>" class="ln"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="<?php echo htmlspecialchars($author['youtube_link']); ?>" class="yu"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                                
                                
                            </div>                                                    
                        </div>                            
                    </div>                            
                </div>                                                        
            </div>
        </div>
    </div>
    <div class="_215b15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">                        
                    <div class="course_tabs">
                        <nav>
                            <div class="nav nav-tabs tab_crse" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-about-tab" data-bs-toggle="tab" href="#nav-about" role="tab" aria-selected="true">About</a>
                                <a class="nav-item nav-link" id="nav-courses-tab" data-bs-toggle="tab" href="#nav-courses" role="tab" aria-selected="false">Books</a>
                                
                            </div>
                        </nav>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="_215b17">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="course_tab_content">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-about" role="tabpanel">
                                <div class="_htg451">
                                    <div class="_htg452">
                                        <h3>About Me</h3>
                                        <p><?php echo htmlspecialchars($author['about']); ?></p>
                                    </div>                                                                    
                                </div>                            
                            </div>
							<div class="tab-pane fade" id="nav-courses" role="tabpanel">
                                    <div class="crse_content">
                                        <h3>My Books (<?php echo $result_books->num_rows; ?>)</h3>
                                        <div class="_14d25">
                                            <div class="row">
                                                <?php while ($book = $result_books->fetch_assoc()): ?>
                                                <div class="col-lg-3 col-md-4">
                                                    <div class="fcrse_1 mt-30">
                                                        <a href="book_detail_view.php?id=<?php echo $book['id']; ?>" class="fcrse_img">
														<img src="<?php echo $book['thumbnail']; ?>" alt="thumbnail">
                                                            <div class="course-overlay">
                                                                <div class="badge_seller">Bestseller</div>
                                                                
                                                                
                                                            </div>
                                                        </a>
                                                        <div class="fcrse_content">
                                                            <div class="eps_dots more_dropdown">
                                                                <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                                                                                                                                               
                                                            </div>
                                                            
                                                            <a href="book_detail_view.php?id=<?php echo $book['id']; ?>" class="crse14s"><?php echo htmlspecialchars($book['title']); ?></a>
                                                            <a href="#" class="crse-cate"><?php echo htmlspecialchars($book['category']); ?></a>
															<a href="#" class="crse-cate"><?php echo htmlspecialchars($book['description']); ?></a>
                                                            <div class="auth1lnkprce">
                                                                <p class="cr1fot">By <a href="#"><?php echo htmlspecialchars($author['fullname']); ?></a></p>
                                                                <div class="prce142">₦<?php echo $book['discount_price']; ?></div>
                                                                <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>
                                                <?php endwhile; ?>
                                            
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
		<footer class="footer mt-30">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-6">
						<div class="item_f1">
							<a href="about_us.html">About</a>
							<a href="our_blog.html">Blog</a>
							<a href="career.html">Careers</a>
							<a href="press.html">Press</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6">
						<div class="item_f1">
							<a href="help.html">Help</a>
							<a href="coming_soon.html">Advertise</a>
							<a href="coming_soon.html">Developers</a>
							<a href="contact_us.html">Contact Us</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6">
						<div class="item_f1">
							<a href="terms_of_use.html">Copyright Policy</a>
							<a href="terms_of_use.html">Terms</a>
							<a href="terms_of_use.html">Privacy Policy</a>
							<a href="sitemap.html">Sitemap</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6">
						<div class="item_f3">
							
							<div class="lng_btn">
								<div class="ui language bottom right pointing dropdown floating" id="languages" data-content="Select Language">
									<a href="#"><i class='uil uil-globe lft'></i>Language<i class='uil uil-angle-down rgt'></i></a>
									<div class="menu">
										<div class="scrolling menu">
											<div class="item" data-percent="100" data-value="en" data-english="English">
												<span class="description">English</span>
												English
											</div>
											<div class="item" data-percent="94" data-value="da" data-english="Danish">
												<span class="description">dansk</span>
												Danish
											</div>
											<div class="item" data-percent="94" data-value="es" data-english="Spanish">
												<span class="description">Español</span>
												Spanish
											</div>
											<div class="item" data-percent="34" data-value="zh" data-english="Chinese">
												<span class="description">简体中文</span>
												Chinese
											</div>
											<div class="item" data-percent="54" data-value="zh_TW" data-english="Chinese (Taiwan)">
												<span class="description">中文 (臺灣)</span>
												Chinese (Taiwan)
											</div>
											<div class="item" data-percent="79" data-value="fa" data-english="Persian">
												<span class="description">پارسی</span>
												Persian
											</div>
											<div class="item" data-percent="41" data-value="fr" data-english="French">
												<span class="description">Français</span>
												French
											</div>
											<div class="item" data-percent="37" data-value="el" data-english="Greek">
												<span class="description">ελληνικά</span>
												Greek
											</div>
											<div class="item" data-percent="37" data-value="ru" data-english="Russian">
												<span class="description">Русский</span>
												Russian
											</div>
											<div class="item" data-percent="36" data-value="de" data-english="German">
												<span class="description">Deutsch</span>
												German
											</div>
											<div class="item" data-percent="23" data-value="it" data-english="Italian">
												<span class="description">Italiano</span>
												Italian
											</div>
											<div class="item" data-percent="21" data-value="nl" data-english="Dutch">
												<span class="description">Nederlands</span>
												Dutch
											</div>
											<div class="item" data-percent="19" data-value="pt_BR" data-english="Portuguese">
												<span class="description">Português(BR)</span>
												Portuguese
											</div>
											<div class="item" data-percent="17" data-value="id" data-english="Indonesian">
												<span class="description">Indonesian</span>
												Indonesian
											</div>
											<div class="item" data-percent="12" data-value="lt" data-english="Lithuanian">
												<span class="description">Lietuvių</span>
												Lithuanian
											</div>
											<div class="item" data-percent="11" data-value="tr" data-english="Turkish">
												<span class="description">Türkçe</span>
												Turkish
											</div>
											<div class="item" data-percent="10" data-value="kr" data-english="Korean">
												<span class="description">한국어</span>
												Korean
											</div>
											<div class="item" data-percent="7" data-value="ar" data-english="Arabic">
												<span class="description">العربية</span>
												Arabic
											</div>
											<div class="item" data-percent="6" data-value="hu" data-english="Hungarian">
												<span class="description">Magyar</span>
												Hungarian
											</div>
											<div class="item" data-percent="6" data-value="vi" data-english="Vietnamese">
												<span class="description">tiếng Việt</span>
												Vietnamese
											</div>
											<div class="item" data-percent="5" data-value="sv" data-english="Swedish">
												<span class="description">svenska</span>
												Swedish
											</div>
											<div class="item" data-precent="4" data-value="pl" data-english="Polish">
												<span class="description">polski</span>
												Polish
											</div>
											<div class="item" data-percent="6" data-value="ja" data-english="Japanese">
												<span class="description">日本語</span>
												Japanese
											</div>
											<div class="item" data-percent="0" data-value="ro" data-english="Romanian">
												<span class="description">românește</span>
												Romanian
											</div>										
										</div>
									</div>
								</div>
							</div>
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
	<script src="js/custom.js"></script>	
	<script src="js/night-mode.js"></script>	
	
</body>

<!-- Mirrored from gambolthemes.net/html-items/cursus-new-demo/my_instructor_profile_view.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 15:23:57 GMT -->
</html>