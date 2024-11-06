<?php
		session_start();
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user_email = filter_var($_POST['emailaddress'], FILTER_SANITIZE_EMAIL);
			$feedback = htmlspecialchars($_POST['description']);
			$user_id = $_SESSION['user_id'];
			
			$to = 'davidonyemenam21@gmail.com'; // Replace with your designated email
			$subject = 'User Feedback';
			$message = "User ID: $user_id\n";
			$message .= "User Email: $user_email\n";
			$message .= "Feedback: $feedback\n";
			
			$headers = "From: no-reply@yourdomain.com";
		
			// Check if a file was uploaded
			if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] == UPLOAD_ERR_OK) {
				$file = $_FILES['screenshot']['tmp_name'];
				$file_name = $_FILES['screenshot']['name'];
				$file_type = $_FILES['screenshot']['type'];
				$file_size = $_FILES['screenshot']['size'];
				
				$boundary = md5(uniqid(time()));
				
				$headers .= "\r\nMIME-Version: 1.0\r\n";
				$headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"";
				
				$message = "--{$boundary}\r\n";
				$message .= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
				$message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
				$message .= "User ID: $user_id\n";
				$message .= "User Email: $user_email\n";
				$message .= "Feedback: $feedback\n";
				
				$message .= "--{$boundary}\r\n";
				$message .= "Content-Type: {$file_type}; name=\"{$file_name}\"\r\n";
				$message .= "Content-Disposition: attachment; filename=\"{$file_name}\"\r\n";
				$message .= "Content-Transfer-Encoding: base64\r\n\r\n";
				$message .= chunk_split(base64_encode(file_get_contents($file))) . "\r\n";
				$message .= "--{$boundary}--\r\n";
			}
		
			if (mail($to, $subject, $message, $headers)) {
				echo "Feedback sent successfully.";
			} else {
				echo "Failed to send feedback.";
			}
		}
		?>
		

<!DOCTYPE html>
<html lang="en">

	
<!-- Mirrored from gambolthemes.net/html-items/cursus-new-demo/feedback.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 15:23:57 GMT -->
<head>
		<meta charset="utf-8">	
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Libis - Feedback</title>
		
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
			<!--<a href="index.html"><img src="images/logo.svg" alt=""></a> -->
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
				
			
				<li class="profile-dropdown">
					<a href="#" class="opts_account" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
						<img src="images/hd_dp.jpg" alt="">
					</a>
					
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
						<a href="student_dashboard.php" class="menu--link" title="Dashboard">
							<i class="uil uil-apps menu--icon"></i>
							<span class="menu--label">Dashboard</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="student_courses.html" class="menu--link" title="Courses">
							<i class='uil uil-book-alt menu--icon'></i>
							<span class="menu--label">Purchased Books</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="student_messages.html" class="menu--link" title="Find Books">
							<i class='uil uil-search menu--icon'></i>
							<span class="menu--label">Find Books</span>
						</a>
					</li>
					
					<li class="menu--item">
						<a href="student_notifications.php" class="menu--link" title="Authors">
						  <i class='uil uil-pen menu--icon'></i>
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
						<a href="feedback.html" class="menu--link active" title="Send Feedback">
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
						<h2 class="st_title"><i class="uil uil-comment-info-alt"></i> Send Feedback</h2>
						<div class="row">
							<div class="col-lg-6 col-md-8">
								<form action="feedback.php" method="POST" enctype="multipart/form-data">
								<div class="ui search focus">
									<div class="ui left icon input swdh11 swdh19">
									<input class="prompt srch_explore" type="email" name="emailaddress" required="" maxlength="64" placeholder="Email address">															
									</div>
								</div>
								<div class="ui search focus mt-30">																
									<div class="ui form swdh30">
										<div class="field">
										<textarea rows="6" name="description" placeholder="Describe your issue or share your ideas"></textarea>
										</div>
									</div>
								</div>
								<div class="form-group1 mt-30">
									<label for="file5">Add Screenshots</label>
									<div class="image-upload-wrap">
									<input class="file-upload-input" id="file5" type="file" name="screenshot" accept="image/*">
										<div class="drag-text">
										  <i class="fas fa-cloud-upload-alt"></i>
										  <h4>Select screenshots to upload</h4>
										  <p>or drag and drop screenshots</p>
										</div>
									</div>															
								</div>
								<button class="save_btn" type="submit">Send Feedback</button>
							</form>
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

<!-- Mirrored from gambolthemes.net/html-items/cursus-new-demo/feedback.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 15:23:57 GMT -->
</html>