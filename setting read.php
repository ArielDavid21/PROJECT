<?php
include 'db_connect.php';

// Get user details based on role
if ($user_type === 'author') {
    $sql = "SELECT * FROM authors WHERE `S/N` = $user_id";
} else {
    $sql = "SELECT * FROM readers WHERE `S/N` = $user_id";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

// Update user details if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $headline = $conn->real_escape_string($_POST['headline']);
    $description = $conn->real_escape_string($_POST['description']);
    $site = $conn->real_escape_string($_POST['site']);
    $facebooklink = $conn->real_escape_string($_POST['facebooklink']);
    $twitterlink = $conn->real_escape_string($_POST['twitterlink']);
    $linkedinlink = $conn->real_escape_string($_POST['linkedinlink']);
    $youtubelink = $conn->real_escape_string($_POST['youtubelink']);

    if ($user_type === 'author') {
        $sql = "UPDATE authors SET fullname='$name', title='$headline', about='$description', site='$site', facebook_link='$facebooklink', twitter_link='$twitterlink', linkedin_link='$linkedinlink', youtube_link='$youtubelink' WHERE `S/N` = $user_id";
    } else {
        $sql = "UPDATE readers SET fullname='$name', title='$headline', about='$description', site='$site', facebook_link='$facebooklink', twitter_link='$twitterlink', linkedin_link='$linkedinlink', youtube_link='$youtubelink' WHERE `S/N` = $user_id";
    }

	if ($conn->query($sql) === TRUE) {
        $message = "Record updated successfully";
    } else {
        $message = "Error updating record: " . $conn->error;
    }
}


// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from gambolthemes.net/html-items/cursus-new-demo/setting.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 15:23:57 GMT -->
<head>
		<meta charset="utf-8">	
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Libis - Setting</title>
		
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

		<script>
        function showMessage(message) {
            if (message !== '') {
                alert(message);
            }
        }
    </script>
		
	</head>

<body>
	<!-- Header Start -->
	<header class="header clearfix">
		
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
										
									</div>
									<span><?php echo htmlspecialchars($_SESSION['email']); ?></span>
								</div>	
													
						</div>
						<div class="night_mode_switch__btn">
							<a href="#" id="night-mode" class="btn-night-mode">
								<i class="uil uil-moon"></i> Night mode
								<span class="btn-night-mode-switch">
									<span class="uk-switch-button"></span>
								</span>
							</a>
						</div>
						
					</div>
				</li>
			</ul>
		</div>
	</header>
	<!-- Header End -->
	<!-- Left Sidebar Start -->
	
	<!-- Left Sidebar End -->
	<!-- Body Start -->
	<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="st_title"><i class='uil uil-cog'></i> Setting</h2>
                    <div class="setting_tabs">
                        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-account-tab" data-bs-toggle="pill" href="#pills-account" role="tab" aria-selected="true">Account</a>
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link" id="pills-closeaccount-tab" data-bs-toggle="pill" href="#pills-closeaccount" role="tab" aria-selected="false">Close Account</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab">
                            <div class="account_setting">
                                <h4>Your Libis Account</h4>
                                <p>This is your public presence on Libis. You need a account to upload your paid books, comment on books, purchased by readers, or earning.</p>
                                <form action="setting.php" method="POST">
                                    <div class="basic_profile">
                                        <div class="basic_ptitle">
                                            <h4>Basic Profile</h4>
                                            <p>Add information about yourself</p>
                                        </div>
                                        <div class="basic_form">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="ui search focus mt-30">
                                                                <div class="ui left icon input swdh11 swdh19">
                                                                    <input class="prompt srch_explore" type="text" name="name" value="<?php echo htmlspecialchars($user['fullname']); ?>" id="id[name]" required="" maxlength="64" placeholder="First Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-12">
                                                            <div class="ui search focus mt-30">
                                                                <div class="ui left icon input swdh11 swdh19">
                                                                    <input class="prompt srch_explore" type="text" name="headline" value="<?php echo htmlspecialchars($user['title']); ?>" id="id_headline" required="" maxlength="60" placeholder="Headline">
                                                                    <div class="form-control-counter" data-purpose="form-control-counter">36</div>
                                                                </div>
                                                                <div class="help-block">Add a professional headline like Engineer or Architect</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="ui search focus mt-30">
                                                                <div class="ui form swdh30">
                                                                    <div class="field">
                                                                        <textarea rows="3" name="description" id="id_about" placeholder="Write a little description about you..."><?php echo htmlspecialchars($user['about']); ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="help-block">Links and coupon codes are not permitted in this section.</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="divider-1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="basic_profile1">
                                        <div class="basic_ptitle">
                                            <h4>Profile Links</h4>
                                        </div>
                                        <div class="basic_form">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="ui search focus mt-30">
                                                                <div class="ui left icon labeled input swdh11 swdh31">
                                                                    <div class="ui label lb12">https://</div>
                                                                    <input class="prompt srch_explore" type="text" name="site" value="<?php echo htmlspecialchars($user['site']); ?>" id="id_site"  maxlength="64" placeholder="yoursite.com">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="ui search focus mt-30">
                                                                <div class="ui left icon labeled input swdh11 swdh31">
                                                                    <div class="ui label lb12">http://facebook.com/</div>
                                                                    <input class="prompt srch_explore" type="text" name="facebooklink" value="<?php echo htmlspecialchars($user['facebook_link']); ?>" id="id_facebook" required="" maxlength="64" placeholder="Facebook Profile">
                                                                </div>
                                                                <div class="help-block">Add your Facebook username (e.g. johndoe).</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="ui search focus mt-30">
                                                                <div class="ui left icon labeled input swdh11 swdh31">
                                                                    <div class="ui label lb12">http://twitter.com/</div>
                                                                    <input class="prompt srch_explore" type="text" name="twitterlink" value="<?php echo htmlspecialchars($user['twitter_link']); ?>" id="id_twitter" required="" maxlength="64" placeholder="Twitter Profile">
                                                                </div>
                                                                <div class="help-block">Add your Twitter username (e.g. johndoe).</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="ui search focus mt-30">
                                                                <div class="ui left icon labeled input swdh11 swdh31">
                                                                    <div class="ui label lb12">http://www.linkedin.com/</div>
                                                                    <input class="prompt srch_explore" type="text" name="linkedinlink" value="<?php echo htmlspecialchars($user['linkedin_link']); ?>" id="id_linkedin" required="" maxlength="64" placeholder="Linkedin Profile">
                                                                </div>
                                                                <div class="help-block">Input your LinkedIn resource id (e.g. in/johndoe).</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="ui search focus mt-30">
                                                                <div class="ui left icon labeled input swdh11 swdh31">
                                                                    <div class="ui label lb12">http://www.youtube.com/</div>
                                                                    <input class="prompt srch_explore" type="text" name="youtubelink" value="<?php echo htmlspecialchars($user['youtube_link']); ?>" id="id_youtube" required="" maxlength="64" placeholder="Youtube Profile">
                                                                </div>
                                                                <div class="help-block">Input your Youtube username (e.g. johndoe).</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="save_btn" type="submit">Save Changes</button>
                                </form>
								</div>
							</div>
							
							<div class="tab-pane fade" id="pills-closeaccount" role="tabpanel" aria-labelledby="pills-closeaccount-tab">
								<div class="account_setting">
									<h4>Close Account</h4>
									<p>If you close your account, you will will lose access forever.</p>
									<form action="your_php_script.php" method="POST">
										<div class="basic_profile">
											<div class="basic_form">
												<div class="nstting_content">
													<div class="ui form">
														<div class="field">
															<label>Please explain why you want to close your account:</label>
															<div class="ui search focus mt-30">																
																<div class="ui form swdh30">
																	<div class="field">
																		<textarea rows="3" name="reason" id="id_reason" placeholder="Please explain in detail"></textarea>
																	</div>
																</div>
															</div>
														</div>
														<div class="ui form mt-30 checkbox_sign c-sign1">
															<div class="inline field">
																<div class="ui checkbox">
																	<input type="checkbox" tabindex="0" class="hidden">
																	<label>I understand by closing my account I will lose access to purchased books, materials and my account details.</label>
																</div>
															</div>
														</div>
														<button class="save_btn" type="submit">Close Account</button>
													</div>											
												</div>
											</div>
										</div>								
									</form>
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
	<script src="vendor/semantic/semantic.min.js"></script>
	<script src="vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/night-mode.js"></script>
	
</body>

<!-- Mirrored from gambolthemes.net/html-items/cursus-new-demo/setting.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 15:23:57 GMT -->
</html>