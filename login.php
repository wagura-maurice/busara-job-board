<?php

include 'lib/dbConfig.php';

if ($userClass->loggedIn() == TRUE) { $userClass->Redirect($userClass->Router()); }

if (isset($_POST['doLogin'])) {

	// email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$error[] = 'Please enter a valid email address';
	} else {
		$email = $_POST['email'];
	}

	// if no errors have been created carry on
	if(!isset($error)) {
		$userClass->Redirect($userClass->Login($email, md5($_POST['password'])));
	}
}

if (isset($_POST['register'])) {

    // company validation
    if(!empty($userClass->validator("company", $userClass->CleanEntries($_POST['company'])))) {
			$error[] = 'Company name provided is invalid or already in use.';
		} else {
			$company = $userClass->CleanEntries($_POST['company']);
		}

    // email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$error[] = 'Please enter a valid email address';
	} else {
      
		if(!empty($userClass->validator("email", $_POST['email']))) {
			$error[] = 'Email address provided is invalid or already in use.';
		} else {
			$email = $_POST['email'];
		}
	}

    // Company cover logo processing
    $imgFile   = $_FILES['companyLogo']['name'];
	$tmpDIR    = $_FILES['companyLogo']['tmp_name'];
	$imgSize   = $_FILES['companyLogo']['size'];
	$uploadDIR = 'uploads/logos/';
	$imgExt    = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
	$validExt  = array('jpeg', 'jpg', 'png');
	$companyLogo = rand(10000,1000000)."-".$company.".jpg";
	if(in_array($imgExt, $validExt)) {   
		if($imgSize < 5000000) {
			move_uploaded_file($tmpDIR,$uploadDIR.$companyLogo);
		} else {
			$error[] = 'Image is above 5mbs in size';
		}
	} else {
		$error[] = 'Please provide a valid image file';
	}
    
    // if no errors have been created carry on
	if(!isset($error)) {
		$userClass->Redirect($userClass->register($email, md5($_POST['password']), $company, $companyLogo, 'active'));
	}
}



include 'lib/header2.php';

?>

<!-- Page Header Start -->
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">         
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title">My Account</h2>
<ol class="breadcrumb">
<li><a href="<?= SITEURL; ?>"><i class="ti-home"></i> Home</a></li>
<li class="current">My Account</li>
</ol>
</div>
</div>
</div>
</div>
</div>
<!-- Page Header End -->   

<div id="content" class="my-account">
<div class="container">
<div class="row">
<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-6 cd-user-modal">
<?php
//check for any errors
if(isset($error)) {
	foreach($error as $error) {
		echo "<div align=\"center\" class=\"alert alert-danger\">".$error."</div>";
	}
}

if(isset($_GET['action'])) {
	switch ($_GET['action']) {
		case 'Success':
		echo "<div align=\"center\" class=\"alert alert-success\">Registration successful, please log in.</div>";
		break;
		case 'Failed':
		echo "<div align=\"center\" class=\"alert alert-danger\">Registration failed, please try again.</div>";
		break;
	}
}
?>
<div class="my-account-form">
<ul class="cd-switcher">
<li><a class="selected" href="#0">LOGIN</a></li>
<li><a href="#0">REGISTER</a></li>
</ul>
<!-- Login -->
<div id="cd-login" class="is-selected">
<div class="page-login-form">
<form role="form" class="login-form" method="POST" accept-charset="UTF-8">
<?php
if(isset($_GET['login'])) {
	switch ($_GET['login']) {
		case 'invalid':
		echo "<div class=\"alert alert-danger\">Invalid Username / Password Combination, please try again.</div>";
		break;
	}
}
?>
<div class="form-group">
<div class="input-icon">
<i class="ti-email"></i>
<input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
</div>
</div> 
<div class="form-group">
<div class="input-icon">
<i class="ti-lock"></i>
<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
</div>
</div> 
<button type="submit" name="doLogin" id="doLogin" class="btn btn-common log-btn">Login</button>
<div class="checkbox-item">
<div class="checkbox">
<!-- <label for="rememberme" class="rememberme">
<input name="rememberme" id="rememberme" value="forever" type="checkbox"> Remember Me</label> -->
</div>                        
<!-- <p class="cd-form-bottom-message"><a href="#0">Lost your password?</a></p> -->
</div> 
</form>
</div>
</div>

<!-- Register -->
<div id="cd-signup">
<div class="page-login-form register">
<form role="form" class="login-form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
<div class="form-group">
<div class="input-icon">
<i class="ti-world"></i>
<input type="text" id="company" name="company" class="form-control" placeholder="Company Name" required>
</div>
</div> 
<div class="form-group">
<div class="input-icon">
<i class="ti-email"></i>
<input type="email" id="email" class="form-control" name="email" placeholder="Email Address" required>
</div>
</div> 
<div class="form-group">
<div class="input-icon">
<i class="ti-lock"></i>
<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
</div>
</div> 
<div class="form-group">
<div class="button-group">
<div class="action-buttons">
<div class="upload-button" align="center">
<button class="btn btn-common">Choose a Company Logo</button>
<input id="cover_img_file" type="file" name="companyLogo" id="companyLogo" accept="image/png, image/jpg, image/jpeg" required
</div>
</div>
</div>
</div>
</div>
<button type="submit" name="register" id="register" class="btn btn-common log-btn">Register</button> 
</form>
</div>
</div>
<div class="page-login-form" id="cd-reset-password"> <!-- reset password form -->
<p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>
<form class="cd-form">
<div class="form-group">
<div class="input-icon">
<i class="ti-email"></i>
<input type="text" id="sender-email" class="form-control" name="email" placeholder="Email">
</div>
</div> 
<p class="fieldset">
<button class="btn btn-common log-btn" type="submit">Reset password</button> 
</p>
</form>
<p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
</div> <!-- cd-reset-password -->
</div>
</div>
</div>
</div>
</div>     
<?php include 'lib/footer.php'; ?>