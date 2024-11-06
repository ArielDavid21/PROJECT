<!DOCTYPE html>
<html lang="en">

	
<!-- Mirrored from gambolthemes.net/html-items/cursus-new-demo/sign_up_steps.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 15:23:58 GMT -->
<head>
		<meta charset="utf-8">		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">
		<title>Libis - Sign Up Next Step</title>
		
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
					<div class="sign_form basic_form">
						<div class="main-tabs">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a href="#instructor-signup-tab" id="instructor-tab" class="nav-link active" data-bs-toggle="tab">Author Sign Up</a>
								</li>
								<li class="nav-item">
									<a href="#student-signup-tab" id="student-tab" class="nav-link" data-bs-toggle="tab">Reader Sign Up</a>
								</li>																				
							</ul>									
						</div>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="instructor-signup-tab" role="tabpanel" aria-labelledby="instructor-tab">
								<p>Sign Up and Start Writing!</p>
								<form method="POST" action="sign_up_process.php">
								<input type="hidden" name="user_type" value="author">
								<select class="selectpicker" name="category_id">
    <option value="">Select Category</option>
    <option value="Self-Development">Self-Development</option>
    <option value="Business">Business</option>
    <option value="Finance & Accounting">Finance & Accounting</option>
    <option value="IT & Software">IT & Software</option>
    <option value="Office Productivity">Office Productivity</option>
    <option value="Romance">Romance</option>
    <option value="Religious">Religious</option>
    <option value="Marketing">Marketing</option>
    <option value="Lifestyle">Lifestyle</option>
    <option value="Comics">Comics</option>
    <option value="Health & Fitness">Health & Fitness</option>
    <option value="Educational">Educational</option>
    <option value="Fantasy">Fantasy</option>
    <option value="Other">Other</option>
</select>

									<div class="ui search focus mt-15">																
										
											<div class="ui search focus">
												<div class="ui left icon input swdh11 swdh19">
													<input class="prompt srch_explore" type="text" name="fullname" value="" id="id_fullname" required="" maxlength="64" placeholder="Full Name">															
												</div>
											</div>
											<div class="ui search focus mt-15">
												<div class="ui left icon input swdh11 swdh19">
													<input class="prompt srch_explore" type="email" name="emailaddress" value="" id="id_email" required="" maxlength="64" placeholder="Email Address">															
												</div>
											</div>
											<div class="ui search focus mt-15">
												<div class="ui left icon input swdh11 swdh19">
													<input class="prompt srch_explore" type="password" name="password" value="" id="id_password" required="" maxlength="64" placeholder="Password">															
												</div>
											</div>
											<div class="ui form mt-30 checkbox_sign">
												<div class="inline field">
													<div class="ui checkbox mncheck">
														<input type="checkbox" tabindex="0" class="hidden">
														<label>I’m in for emails with exciting discounts and personalized recommendations</label>
													</div>
												</div>
											</div>
											<button class="login-btn" type="submit">Sign-Up</button>
										
									</div>							
								</form>
							</div>
							<div class="tab-pane fade" id="student-signup-tab" role="tabpanel" aria-labelledby="student-tab">
								<p>Sign Up and Start Reading!</p>
								<form method="POST" action="sign_up_process.php">
								<input type="hidden" name="user_type" value="reader">
									<div class="ui search focus mt-15">																
										<div class="ui form swdh30">
											<form>
												<div class="ui search focus">
													<div class="ui left icon input swdh11 swdh19">
														<input class="prompt srch_explore" type="text" name="fullname" value="" id="id_fullname" required="" maxlength="64" placeholder="Full Name">															
													</div>
												</div>
												<div class="ui search focus mt-15">
													<div class="ui left icon input swdh11 swdh19">
														<input class="prompt srch_explore" type="email" name="emailaddress" value="" id="id_email" required="" maxlength="64" placeholder="Email Address">															
													</div>
												</div>
												<div class="ui search focus mt-15">
													<div class="ui left icon input swdh11 swdh19">
														<input class="prompt srch_explore" type="password" name="password" value="" id="id_password" required="" maxlength="64" placeholder="Password">															
													</div>
												</div>
												<div class="ui form mt-30 checkbox_sign">
													<div class="inline field">
														<div class="ui checkbox mncheck">
															<input type="checkbox" tabindex="0" class="hidden">
															<label>I’m in for emails with exciting discounts and personalized recommendations</label>
														</div>
													</div>
												</div>
												<button class="login-btn" type="submit">Sign-Up</button>
											
										</div>
									</div>
								</form>
							</div>
						</div>
						<p class="mb-0 mt-30">Already have an account? <a href="sign_in.php">Log In</a></p>
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

<!-- Mirrored from gambolthemes.net/html-items/cursus-new-demo/sign_up_steps.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 15:23:58 GMT -->
</html>