<?php

include 'lib/dbConfig.php';

if ($userClass->loggedIn() == FALSE) { $userClass->Redirect($userClass->Router()); }

if (isset($_POST['mail'])) {

  $x           = ucfirst($userClass->CleanEntries($_POST['x']));
  $y           = $userClass->CleanEntries($_POST['y']);
  $email       = $userClass->CleanEntries($_POST['email']);
  $subject     = $userClass->CleanEntries($_POST['subject']);
  $message     = $userClass->CleanEntries($_POST['message']);
  $employer_id = $userClass->Insession("id");
  $sql         = "UPDATE `apply` SET `status` = '$x' WHERE `employer_id` = '$employer_id' AND `job_ID` = '$y'";

  $userClass->Redirect($userClass->interview($sql, $email, $subject, $message));

}


include 'lib/header2.php';

?> 

<!-- Page Header Start -->
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">         
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title">Manage Applications</h2>
<ol class="breadcrumb">
<li><a href="<?= SITEURL; ?>"><i class="ti-home"></i> Home</a></li>
<li class="current">Manage Applications</li>
</ol>
</div>
</div>
</div>
</div>
</div>
<!-- Page Header End --> 

<!-- Start Content -->
<div id="content">
<div class="container"> 
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
    echo "<div align=\"center\" class=\"alert alert-success\">Job Application Processing Successful.</div>";
    break;
    case 'Failed':
    echo "<div align=\"center\" class=\"alert alert-danger\">Job Application Processing Failed !! please try again.</div>";
    break;
  }
}
?>       
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="job-alerts-item">
<h2 class="section-title">Current Job Applications</h2>
<?php

$employer_id = $userClass->Insession("id");
$sql = "SELECT * FROM `apply` WHERE `employer_id` = '$employer_id' AND `status` = 'Processing'";

echo $userClass->applications($sql);
?>
</div>
</div>
</div>
</div>      
</div>
<!-- End Content -->

<?php include 'lib/footer.php'; ?>