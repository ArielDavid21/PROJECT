<?php include 'auth_session.php'; 
$book_id = isset($_GET['id']) ? $_GET['id'] : null;
$book = null;
$book_file_path = '';

if ($book_id) {
    // Use $conn instead of $con
    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ? AND author_id = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param('ii', $book_id, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

	
    
    if ($result === false) {
        die("Execute failed: " . $stmt->error);
    }
    
    $book = $result->fetch_assoc();
	if ($book) {
        $book_file_path = $book['book_file'];
    }
}
?>


<!DOCTYPE html>
<html lang="en">

	
<!-- Mirrored from gambolthemes.net/html-items/cursus-new-demo/create_new_course.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 15:23:56 GMT -->
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Libis - Upload New Book</title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="images/fav.png">
		
		<!-- Stylesheets -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
		<link href='vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
		<link href="css/vertical-responsive-menu1.min.css" rel="stylesheet">
		<link href="css/instructor-dashboard.css" rel="stylesheet">
		<link href="css/instructor-responsive.css" rel="stylesheet">
		<link href="css/night-mode.css" rel="stylesheet">
		<link href="css/jquery-steps.css" rel="stylesheet">
		
		<!-- Vendor Stylesheets -->
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
		<link href="vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="vendor/bootstrap-select/docs/docs/dist/css/bootstrap-select.min.css" rel="stylesheet">
		<link href="vendor/ckeditor5/sample/css/sample.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="vendor/semantic/semantic.min.css">	
		<link href="vendor/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet">	
		
		<script>
		function displayImagePreview() {
    const fileInput = document.getElementById('thumbnail');
    const imagePreview = document.getElementById('image_preview');
    const file = fileInput.files[0];
    
    console.log(file); // Check if the file is being read

    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            console.log(e.target.result); // Check the file data being read
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        }
        
        reader.readAsDataURL(file);
    } else {
        imagePreview.src = '#';
        imagePreview.style.display = 'none';
    }
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
										<h6><?php echo htmlspecialchars($_SESSION['name']); ?></h6>
										<div class="mef78" title="Verify">
											<i class='uil uil-check-circle'></i>
										</div>
									</div>
									<span><?php echo htmlspecialchars($_SESSION['email']); ?></span>
								</div>							
							</div>
							<a href="my_instructor_profile_view.html" class="dp_link_12">View Profile</a>						
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
						<a href="instructor_courses.php" class="menu--link" title="Courses">
							<i class='uil uil-book-alt menu--icon'></i>
							<span class="menu--label">My Books</span>
						</a>
					</li>
					
					<li class="menu--item">
						<a href="create_new_course.php" class="menu--link active" title="Create Course">
							<i class='uil uil-plus-circle menu--icon'></i>
							<span class="menu--label">Upload New Book</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="instructor_messages.php" class="menu--link" title="Find Books">
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
			<div class="container">			
				<div class="row">
					<div class="col-lg-12">	
						<h2 class="st_title"><i class="uil uil-analysis"></i> Upload New Book</h2>
					</div>					
				</div>				
				<div class="row">
					<div class="col-12">
						<div class="course_tabs_1">
							<div id="add-course-tab" class="step-app">
								<ul class="step-steps">
									<li class="active">
										<a href="#tab_step1">
											<span class="number"></span>
											<span class="step-name">Basic</span>
										</a>
									</li>
									
									<li>
										<a href="#tab_step2">
											<span class="number"></span>
											<span class="step-name">Media</span>
										</a>
									</li>
									<li>
										<a href="#tab_step3">
											<span class="number"></span>
											<span class="step-name">Price</span>
										</a>
									</li>
									<li>
										<a href="#tab_step4">
											<span class="number"></span>
											<span class="step-name">Publish</span>
										</a>
									</li>
								</ul>
								<div class="step-content">
									<div class="step-tab-panel step-tab-info active" id="tab_step1"> 
										<div class="tab-from-content">
											<div class="title-icon">
												<h3 class="title"><i class="uil uil-info-circle"></i>Basic Information</h3>
											</div>
											<form id="uploadBookForm" action="upload_book.php" method="post" enctype="multipart/form-data">
											<input type="hidden" name="book_id" value="<?php echo $book ? htmlspecialchars($book['id']) : ''; ?>">
												<input type="hidden" name="author_id" value="<?php echo $_SESSION['user_id']; ?>">
												
											<div class="course__form">
												<div class="general_info10">
													<div class="row">
														<div class="col-lg-12 col-md-12">															
															<div class="ui search focus mt-30 lbel25">
																<label>Book Title*</label>
																<div class="ui left icon input swdh19">
																	<input class="prompt srch_explore" type="text" placeholder="Book title here" name="title" data-purpose="edit-course-title" maxlength="100" id="main[title]" value="<?php echo $book ? htmlspecialchars($book['title']) : ''; ?>" required>															
																	<div class="badge_num">100</div>
																</div>
																<div class="help-block">(Please make this a maximum of 100 characters and unique.)</div>
															</div>									
														</div>
														<div class="col-lg-12 col-md-12">															
															<div class="ui search focus lbel25 mt-30">	
																<label>Short Description*</label>
																<div class="ui form swdh30">
																	<div class="field">
																		<textarea rows="3" name="description" id="" placeholder="Item description here..." maxlength="220" value="<?php echo $book ? htmlspecialchars($book['description']) : ''; ?>" required></textarea>
																	</div>
																</div>
																<div class="help-block">220 words</div>
															</div>								
														</div>

														
														<div class="col-lg-6 col-md-12">
															<div class="mt-30 lbel25">
																<label>Writing Level*</label>
															</div>
															<select class="selectpicker" name="writing_level" data-live-search="true">
																<option value="1">Beginner</option>
																<option value="2">Intermediate</option>
																<option value="3">Expert</option>
															</select>
														</div>
														<div class="col-lg-6 col-md-12">
															<div class="mt-30 lbel25">
																<label>Audio Language*</label>
															</div>
															<select class="selectpicker" title="Select Audio" name="audio_language" data-live-search="true">
																<option>N/A</option>
																<option>English</option>															
																<option>Español</option>
																<option>Português</option>
																<option>日本語</option>
																<option>Deutsch</option>
																<option>Français</option>
																<option>Türkçe</option>
																<option>Italiano</option>
																<option>हिन्दी</option>
																<option>Polski</option>
																<option>Tamil</option>
																<option>मराठी</option>
																<option>Telugu</option>																												
															</select>
														</div>
														<div class="col-lg-6 col-md-6">
															<div class="mt-30 lbel25">
																<label>Book language*</label>
															</div>
															<select class="selectpicker" title="Select Caption" name="book_language" data-live-search="true">
																<option>English</option>															
																<option>Español</option>
																<option>Português</option>
																<option>Italiano</option>
																<option>Français</option>
																<option>Polski</option>
																<option>Deutsch</option>
																<option>Bahasa Indonesia</option>
																<option>ภาษาไทย</option>
																<option>हिन्दी</option>
																<option>Tamil</option>
																<option>मराठी</option>
																<option>Telugu</option>														
															</select>
														</div>
														<div class="col-lg-6 col-md-6">
															<div class="mt-30 lbel25">
																<label>Category*</label>
															</div>
															<select class="selectpicker" title="Select Category" name="category" id="selectcategory" data-live-search="true" value="<?php echo htmlspecialchars($book['category'] ?? ''); ?>" required>
    <optgroup label="Business &amp; Finance">
        <option value="Taxes">Taxes</option>
        <option value="Business">Business</option>
        <option value="Finance & Accounting">Finance & Accounting</option>
        <option value="Cryptocurrency &amp; Blockchain">Cryptocurrency &amp; Blockchain</option>
        <option value="Economics">Economics</option>
        <option value="Finance">Finance</option>
        <option value="Finance Cert &amp; Exam Prep">Finance Cert &amp; Exam Prep</option>
        <option value="Financial Modeling &amp; Analysis">Financial Modeling &amp; Analysis</option>
        <option value="Investing &amp; Trading">Investing &amp; Trading</option>
        <option value="Money Management Tools">Money Management Tools</option>
    </optgroup>
    <optgroup label="Fiction">
        <option value="Fantasy">Fantasy</option>
        <option value="Romance">Romance</option>
        <option value="Fan-fiction">Fan-fiction</option>
        <option value="Comics">Comics</option>
        <option value="Other">Other</option>
    </optgroup>
    <optgroup label="Dark">
        <option value="Horror">Horror</option>
        <option value="History">History</option>
        <option value="Other">Other</option>
    </optgroup>
    <optgroup label="Office Productivity">
        <option value="Microsoft">Microsoft</option>
        <option value="Apple">Apple</option>
        <option value="Google">Google</option>
        <option value="SAP">SAP</option>
        <option value="Oracle">Oracle</option>
    </optgroup>
    <optgroup label="Personal Development">
        <option value="Personal Transformation">Personal Transformation</option>
        <option value="Productivity">Productivity</option>
        <option value="Leadership">Leadership</option>
        <option value="Personal Finance">Personal Finance</option>
        <option value="Career Development">Career Development</option>
        <option value="Parenting &amp; Relationships">Parenting &amp; Relationships</option>
        <option value="Happiness">Happiness</option>
        <option value="Religion &amp; Spirituality">Religion &amp; Spirituality</option>
        <option value="Personal Brand Building">Personal Brand Building</option>
        <option value="Creativity">Creativity</option>
        <option value="Influence">Influence</option>
        <option value="Self Esteem">Self Esteem</option>
        <option value="Stress Management">Stress Management</option>
        <option value="Memory &amp; Study Skills">Memory &amp; Study Skills</option>
        <option value="Motivation">Motivation</option>
        <option value="Other">Other</option>
    </optgroup>
    <optgroup label="Design">
        <option value="Web Design">Web Design</option>
        <option value="Graphic Design">Graphic Design</option>
        <option value="Design Tools">Design Tools</option>
        <option value="User Experience">User Experience</option>
        <option value="Game Design">Game Design</option>
        <option value="Design Thinking">Design Thinking</option>
        <option value="3D &amp; Animation">3D &amp; Animation</option>
        <option value="Fashion">Fashion</option>
        <option value="Architectural Design">Architectural Design</option>
        <option value="Interior Design">Interior Design</option>
    </optgroup>
    <optgroup label="Marketing">
        <option value="Digital Marketing">Digital Marketing</option>
        <option value="Search Engine Optimization">Search Engine Optimization</option>
        <option value="Social Media Marketing">Social Media Marketing</option>
        <option value="Branding">Branding</option>
        <option value="Marketing Fundamentals">Marketing Fundamentals</option>
        <option value="Analytics &amp; Automation">Analytics &amp; Automation</option>
        <option value="Public Relations">Public Relations</option>
        <option value="Advertising">Advertising</option>
        <option value="Video &amp; Mobile Marketing">Video &amp; Mobile Marketing</option>
        <option value="Content Marketing">Content Marketing</option>
        <option value="Growth Hacking">Growth Hacking</option>
        <option value="Affiliate Marketing">Affiliate Marketing</option>
        <option value="Product Marketing">Product Marketing</option>
    </optgroup>
    <optgroup label="Lifestyle">
        <option value="Arts &amp; Crafts">Arts &amp; Crafts</option>
        <option value="Food &amp; Beverage">Food &amp; Beverage</option>
        <option value="Beauty &amp; Makeup">Beauty &amp; Makeup</option>
        <option value="Travel">Travel</option>
        <option value="Gaming">Gaming</option>
        <option value="Home Improvement">Home Improvement</option>
        <option value="Pet Care &amp; Training">Pet Care &amp; Training</option>
    </optgroup>
    <optgroup label="Photography">
        <option value="Digital Photography">Digital Photography</option>
        <option value="Photography Fundamentals">Photography Fundamentals</option>
        <option value="Portraits">Portraits</option>
        <option value="Photography Tools">Photography Tools</option>
        <option value="Commercial Photography">Commercial Photography</option>
        <option value="Video Design">Video Design</option>
    </optgroup>
    <optgroup label="Health &amp; Fitness">
        <option value="Fitness">Fitness</option>
        <option value="General Health">General Health</option>
        <option value="Sports">Sports</option>
        <option value="Nutrition">Nutrition</option>
        <option value="Yoga">Yoga</option>
        <option value="Mental Health">Mental Health</option>
        <option value="Dieting">Dieting</option>
        <option value="Self Defense">Self Defense</option>
        <option value="Safety &amp; First Aid">Safety &amp; First Aid</option>
        <option value="Dance">Dance</option>
        <option value="Meditation">Meditation</option>
    </optgroup>
    <optgroup label="Music">
        <option value="Instruments">Instruments</option>
        <option value="Production">Production</option>
        <option value="Music Fundamentals">Music Fundamentals</option>
        <option value="Vocal">Vocal</option>
        <option value="Music Techniques">Music Techniques</option>
        <option value="Music Software">Music Software</option>
    </optgroup>
    <optgroup label="Other">
        <option value="Other">Other</option>
    </optgroup>
</select>
									
														</div>															
													</div>
												</div>
											</div>
										</div>
									</div>									
									

									

    <div class="step-tab-panel step-tab-location" id="tab_step2">
        <div class="tab-from-content">
            <div class="title-icon">
                <h3 class="title"><i class="uil uil-image"></i>Media</h3>
            </div>
            <div class="lecture-video-dt mb-30">
                <span class="video-info">Book format. (.mp3, PDF, Microsoft Word etc)</span>
                <div class="video-category">
                    <label><input type="radio" name="book_format" value="mp3"><span>Audio(mp3)</span></label>
                    <label><input type="radio" name="book_format" value="pdf" checked><span>File(PDF)</span></label>
                    <label><input type="radio" name="book_format" value="word"><span>File(WORD)</span></label>
                    <div class="mp4 intro-box" style="display: block;">
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <div class="upload-file-dt mt-30">
                                    <div class="upload-btn">                                                    
                                        <input class="uploadBtn-main-input" type="file" id="book_file" name="book_file">
                                        <label for="book_file" title="Zip">Upload File</label>
										<?php echo "<p id='file-path'>File path: " . htmlspecialchars($book_file_path) . "</p>"; ?>
                                    </div>
                                    <span class="uploaded-id"></span>
                                </div>
                            </div>                                                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="thumbnail-into">
                <div class="row">
                    <div class="col-lg-11 col-md-6">
                        <label class="label25 text-left">Book thumbnail*</label>
                        <div class="thumb-item">
                            <img id="image_preview" src="#" alt="images/thumbnail-demo.jpg" style="display: none; max-width: 200px; max-height: 200px;">
                            <div class="thumb-dt">                                                    
                                <div class="upload-btn">                                                    
								<input class="uploadBtn-main-input" type="file" id="thumbnail" name="thumbnail" onchange="previewThumbnail()">
                                    <label for="thumbnail" title="Zip">Choose Thumbnail</label>
                                </div>
                                <span class="uploadBtn-main-file">Size: 590x300 pixels. Supports: jpg, jpeg, or png</span>
								<?php
    								if (isset($_GET['error'])) {
       								 echo "<p style='color: red;'>" . htmlspecialchars($_GET['error']) . "</p>";
    									}
    								if (isset($_GET['success'])) {
       								 echo "<p style='color: green;'>" . htmlspecialchars($_GET['success']) . "</p>";
   										 }
   								 ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

			<script>
function previewThumbnail() {
    const preview = document.getElementById('thumbnail-preview');
    const file = document.getElementById('thumbnail').files[0];
    const reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = 'images/thumbnail-demo.jpg'; // Default image if no file selected
    }
}
</script>

        </div>
    </div>


									
	<div class="step-tab-panel step-tab-amenities" id="tab_step3">
    <div class="tab-from-content">
        <div class="title-icon">
            <h3 class="title"><i class="uil uil-usd-square"></i>Price</h3>
        </div>
        <div class="course__form">
            <div class="price-block">
                <div class="row">
                    <div class="col-md-12">
                        <div class="course-main-tabs">
                            <div class="nav nav-pills flex-column flex-sm-row nav-tabs" role="tablist">
                                <a class="flex-sm-fill text-sm-center nav-link active" data-bs-toggle="tab" href="#nav-free" role="tab" aria-selected="true"><i class="fas fa-tag me-2"></i>Free</a>
                                <a class="flex-sm-fill text-sm-center nav-link" data-bs-toggle="tab" href="#nav-paid" role="tab" aria-selected="false"><i class="fas fa-cart-arrow-down me-2"></i>Paid</a>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="nav-free" role="tabpanel">
                                    <div class="price-require-dt">
                                        <!-- Free book, no additional input needed -->
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-paid" role="tabpanel">
                                    <div class="license_pricing mt-30">
                                        <label class="label25">Regular Price*</label>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="loc_group">
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="text" placeholder="₦0" name="regular_price" value="<?php echo htmlspecialchars($book['regular_price'] ?? ''); ?>" >															
                                                    </div>
                                                    <span class="slry-dt">NGN</span>
                                                </div>
                                            </div>
                                        </div>																		
                                    </div>
                                    <div class="license_pricing mt-30 mb-30">
                                        <label class="label25">Discount Price*</label>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="loc_group">
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="text" placeholder="₦0" name="discount_price" value="<?php echo htmlspecialchars($book['discount_price'] ?? ''); ?>">															
                                                    </div>
                                                    <span class="slry-dt">NGN</span>
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
    </div>
</div>

									<div class="step-tab-panel step-tab-location" id="tab_step4">
										<div class="tab-from-content">
											<div class="title-icon">
												<h3 class="title"><i class="uil uil-upload"></i>Upload</h3>
											</div>
										</div>
										<div class="publish-block">
											<i class="far fa-edit"></i>
											<p>Your Book will be uploaded</p>
										</div>
										<button type="submit"  class="btn btn-default steps_btn">Submit</button>
									</div>
									
								</div>
								
									
									
								
										</form>
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
	<script src="vendor/semantic/semantic.min.js"></script>
	<script src="vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js"></script>
	<script src="vendor/ckeditor5/ckeditor.js"></script>
	<script src="vendor/jquery-ui-1.12.1/jquery-ui.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/night-mode.js"></script>
	<script src="js/jquery-steps.min.js"></script>
	<script>
		ClassicEditor.create( document.querySelector( '#editor1' ) )
		.then( editor => {
			window.editor1 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );

		ClassicEditor.create( document.querySelector( '#editor2' ) )
		.then( editor => {
			window.editor2 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
		
		ClassicEditor.create( document.querySelector( '#editor3' ) )
		.then( editor => {
			window.editor3 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
		
		ClassicEditor.create( document.querySelector( '#editor4' ) )
		.then( editor => {
			window.editor4 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
	</script> 
	<script>
		$('#add-course-tab').steps({
		  onFinish: function () {
			alert('Wizard Completed');
		  }
		});		
	</script>
	<script>
		$( function() {
			$( ".sortable" ).sortable();
			$( ".sortable" ).disableSelection();
		} );
	</script>
</body>

<!-- Mirrored from gambolthemes.net/html-items/cursus-new-demo/create_new_course.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jun 2024 15:23:57 GMT -->
</html>