<?php

include 'lib/dbConfig.php';

if (isset($_GET['x']) && isset($_GET['y'])) {

  $id = $userClass->CleanEntries($_GET['x']);
  $em = $userClass->CleanEntries($_GET['y']);

} else {

  $userClass->Redirect(SITEURL);

}

if (isset($_POST['apply'])) {

  $fname = $userClass->CleanEntries($_POST['fname']);
  $lname = $userClass->CleanEntries($_POST['lname']);

  // email validation
  if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $error[] = 'Please enter a valid email address';
  } else {
    if(!empty($userClass->applyValid($id, $_POST['email']))) {
      $error[] = 'Email address provided has already applied.';
    } else {
      $email = $_POST['email'];
    }
  }

  // CV processing
  $imgFile   = $_FILES['CV']['name'];
  $tmpDIR    = $_FILES['CV']['tmp_name'];
  $imgSize   = $_FILES['CV']['size'];
  $uploadDIR = 'uploads/resume/';
  $imgExt    = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
  $validExt  = array('pdf');
  $CV = ucfirst($fname) . " " . ucfirst($lname) . " - " . ucwords($userClass->jobDetail($id, "tittle")) . " - (" . rand(10000,1000000) . ").pdf";
  if(in_array($imgExt, $validExt)) {   
    if($imgSize < 5000000) {
      move_uploaded_file($tmpDIR,$uploadDIR.$CV);
    } else {
      $error[] = 'resume file is above 5mbs in size';
    }
  } else {
    $error[] = 'Please provide a valid resume pdf file';
  }

  // if no errors have been created carry on
  if(!isset($error)) {
    $userClass->Redirect($userClass->apply($em, $id, $fname, $lname, $email, $CV));
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
<h2 class="product-title">Job Details</h2>
<ol class="breadcrumb">
<li><a href="<?= SITEURL; ?>"><i class="ti-home"></i> Home</a></li>
<li class="current">Job Details</li>
</ol>
</div>
</div>
</div>
</div>
</div>
<!-- Page Header End -->      

<!-- Job Detail Section Start -->  
<section class="job-detail section">
<div class="container">
<div class="row">
<div class="col-md-9 col-sm-8">
<div class="content-area">
<h2 class="medium-title">Job Information</h2>
<div class="box">
<div class="text-left">
<h3><a href="#"><?= ucwords($userClass->jobDetail($id, "tittle")); ?></a></h3>
<p><a href="#"><strong><?= strtoupper($userClass->employer($userClass->jobDetail($id, "employer_id"), "company")); ?></a></p>
<div class="meta">
<span><a href="#"><i class="ti-location-pin"></i> <?= ucwords($userClass->jobDetail($id, "location")); ?></a></span>
<span><a href="#"><i class="ti-calendar"></i> <?= (new DateTime ($userClass->jobDetail($id, "postDate"))) -> format('M, dS Y'); ?> — <?= (new DateTime ($userClass->jobDetail($id, "deadline"))) -> format('M, dS Y'); ?></a></span>
<span><a href="#"><i class="ti-briefcase"></i> <?= ucwords($userClass->jobDetail($id, "category")); ?></a></span>
<span><a href="#"><i class="ti-announcement"></i> <?= ucwords($userClass->jobDetail($id, "wType")); ?></a></span>
</div>
</div>                
<div class="clearfix">
<h4>Overview</h4>
<p><?= ucwords($userClass->jobDetail($id, "overview")); ?></p>
<h4>Qualification</h4>
<?= htmlspecialchars_decode($userClass->jobDetail($id, "qualification")); ?>
<h4>Key responsibilities to include</h4>
<?= htmlspecialchars_decode($userClass->jobDetail($id, "responsibilities")); ?>
<h4>Requirements</h4>
<?= htmlspecialchars_decode($userClass->jobDetail($id, "requirements")); ?>
</div>
</div>
</div>
</div>
<div class="col-md-3 col-sm-4">
<aside>
<div class="sidebar">
<h2 class="medium-title">Apply For This Job</h2>
<div class="box" align="center">
<div class="thumb">
<img src="uploads/logos/<?= $userClass->employer($userClass->jobDetail($id, "employer_id"), "logo"); ?>" alt="img">
</div>
<div class="text-box">
<h4><a href="#"><?= strtoupper($userClass->employer($userClass->jobDetail($id, "employer_id"), "company")); ?></a></h4>
</div>
</div>
<div class="box">
<div class="text-box"> 
<form role="form" class="login-form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
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
    echo "<div align=\"center\" class=\"alert alert-success\">Application Submission Successful.</div>";
    break;
    case 'Failed':
    echo "<div align=\"center\" class=\"alert alert-danger\">Application Submission Failed !! please try again.</div>";
    break;
  }
}
?>
<div class="form-group">
<div class="input-icon">
<i class="ti-user"></i>
<input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required <?php if ($userClass->loggedIn() == TRUE) { echo "readonly"; } ?>>
</div>
<?php if ($userClass->loggedIn() == TRUE) { echo "<span class=\"help-block\"> Logout to appy</span>"; } ?>
</div>
<div class="form-group">
<div class="input-icon">
<i class="ti-user"></i>
<input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required <?php if ($userClass->loggedIn() == TRUE) { echo "readonly"; } ?>>
</div>
<?php if ($userClass->loggedIn() == TRUE) { echo "<span class=\"help-block\"> Logout to appy</span>"; } ?>
</div> 
<div class="form-group">
<div class="input-icon">
<i class="ti-email"></i>
<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required <?php if ($userClass->loggedIn() == TRUE) { echo "readonly"; } ?>>
</div>
<?php if ($userClass->loggedIn() == TRUE) { echo "<span class=\"help-block\"> Logout to appy</span>"; } ?>
</div> 
<div class="form-group">
<div class="button-group">
<div class="action-buttons">
<div class="upload-button" align="center">
<button class="btn btn-common">UPLOAD CV</button>
<input id="cover_img_file" type="file" name="CV" id="CV" accept="application/pdf" required <?php if ($userClass->loggedIn() == TRUE) { echo "readonly"; } ?>>
</div>
</div>
</div>
<?php if ($userClass->loggedIn() == TRUE) { echo "<span class=\"help-block\"> Logout to appy</span>"; } ?>
</div>
</div>
<div align="center">
<button type="submit" name="apply" id="apply" class="btn btn-common log-btn">SUBMIT APPLICATION</button>
</div>
</form> 
</div>
</div>
</div>
</aside>
</div>
</div>
</div>
</section>
<!-- Job Detail Section End --> 
<?php include 'lib/footer.php'; ?>