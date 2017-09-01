<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">    
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="author" content="<?= AUTHOUR; ?>">
<title><?= APPNAME; ?></title>    
<!-- Favicon -->
<link rel="shortcut icon" href="assets/img/favicon.png">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">    
<link rel="stylesheet" href="assets/css/jasny-bootstrap.min.css" type="text/css">  
<link rel="stylesheet" href="assets/css/bootstrap-select.min.css" type="text/css">
<!-- Material CSS -->
<link rel="stylesheet" href="assets/css/material-kit.css" type="text/css">
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css" type="text/css"> 
<link rel="stylesheet" href="assets/fonts/themify-icons.css"> 
<!-- Color Switcher -->
<link rel="stylesheet" href="assets/css/color-switcher.css" type="text/css"> 
<!-- Animate CSS -->
<link rel="stylesheet" href="assets/extras/animate.css" type="text/css">
<!-- Owl Carousel -->
<link rel="stylesheet" href="assets/extras/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/extras/owl.theme.css" type="text/css">
<!-- Rev Slider CSS -->
<link rel="stylesheet" href="assets/extras/settings.css" type="text/css"> 
<!-- Editor -->
<link rel="stylesheet" href="assets/froala_editor/css/froala_editor.min.css" type="text/css"> 
<link rel="stylesheet" href="assets/froala_editor/css/froala_editor.pkgd.css" type="text/css">
<link rel="stylesheet" href="assets/froala_editor/css/froala_style.min.css" type="text/css"> 
<!-- Slicknav js -->
<link rel="stylesheet" href="assets/css/slicknav.css" type="text/css">
<!-- Main Styles -->
<link rel="stylesheet" href="assets/css/main.css" type="text/css">
<!-- Responsive CSS Styles -->
<link rel="stylesheet" href="assets/css/responsive.css" type="text/css">
<!-- Color CSS Styles  -->
<link rel="stylesheet" type="text/css" href="assets/css/colors/red.css" media="screen" />
</head>
<body>  
<!-- Header Section Start -->
<div class="header">    
<div class="logo-menu">
<nav class="navbar navbar-default main-navigation" role="navigation" data-spy="affix" data-offset-top="50">
<div class="container">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand logo" href="<?= SITEURL; ?>"><img src="assets/img/logo.png" alt="<?= APPNAME; ?>"></a>
</div>
<div class="collapse navbar-collapse" id="navbar">              
<ul class="nav navbar-nav navbar-right float-right">
<?php
if ($userClass->loggedIn() == TRUE) {
	echo "<li class=\"right\"><a href=\"#\"> ". strtoupper($userClass->Insession('company')) ."<i class=\"fa fa-angle-down\"></i></a>
	<ul class=\"dropdown\" style=\"background: transparent;\">
	<li><a href=\"post-job.php\">Add Job</a></li>
	<li><a href=\"applications.php\">Job Applicants</a></li>
	<li><a href=\"logout.php\">Logout</a></li>
	</ul>
	</li>";
} elseif ($userClass->loggedIn() == FALSE) {
	echo "<li class=\"left\"><a href=\"post-job.php\"><i class=\"ti-pencil-alt\"></i> POST A JOB</a></li>";
}
?>
</ul>
</div>
</div>
<!-- Mobile Menu Start -->
<ul class="wpb-mobile-menu">
<?php
if ($userClass->loggedIn() == TRUE) {
	echo "<li class=\"btn-m\"><a href=\"#\"> ". strtoupper($userClass->Insession('company')) ."<i class=\"fa fa-angle-down\"></i></a>
	<ul class=\"dropdown\" style=\"background: transparent;\">
	<li><a href=\"post-job.php\">Add Job</a></li>
	<li><a href=\"applications.php\">Job Applicants</a></li>
	<li><a href=\"logout.php\">Logout</a></li>
	</ul>
	</li>";
} elseif ($userClass->loggedIn() == FALSE) {
	echo "<li class=\"btn-m\"><a href=\"post-job.php\"><i class=\"ti-pencil-alt\"></i> POST A JOB</a></li>";
}
?>         
</ul>
<!-- Mobile Menu End --> 
</nav>
</div>
</div>
<!-- Header Section End -->