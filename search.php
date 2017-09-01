<?php

include 'lib/dbConfig.php';
include 'lib/header2.php';

if ($_GET) {

    if (isset($_GET['keyword']) && isset($_GET['location']) && isset($_GET['category'])) {

      $keyword  = '%' . $userClass->CleanEntries($_GET['keyword']) . '%';
      $location = '%' . $userClass->CleanEntries($_GET['location']) . '%';
      $category = '%' . $userClass->CleanEntries($_GET['category']) . '%';

      $sql = "SELECT * FROM `job` WHERE `tittle` LIKE '$keyword' || `overview` LIKE '$keyword' AND `category` = '$category' AND `location` = '$location' ORDER BY `id` DESC";

      $jobsQuery = $userClass->jobs(NULL, $sql);

    }

    if (isset($_GET['keyword'])) {

      $keyword  = '%' . $userClass->CleanEntries($_GET['keyword']) . '%';
      $sql = "SELECT * FROM `job` WHERE `tittle` LIKE '$keyword' || `overview` LIKE '$keyword' ORDER BY `id` DESC";

      $jobsQuery = $userClass->jobs(NULL, $sql);

    }

    if (isset($_GET['group'])) {

      $group = '%' . $userClass->CleanEntries($_GET['group']) . '%';

      $sql = "SELECT * FROM `job` WHERE `category` LIKE '$group' || `wType` LIKE '$group' || `location` LIKE '$group' ORDER BY `id` DESC";

      $jobsQuery = $userClass->jobs(NULL, $sql);

    }

  } else {

    $jobsQuery = $userClass->jobs(NULL, NULL);
  
  }

?>

<!-- Page Header Start -->
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">         
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title">Browse Job</h2>
<ol class="breadcrumb">
<li><a href="<?= SITEURL; ?>"><i class="ti-home"></i> Home</a></li>
<li class="current">Browse Job</li>
</ol>
</div>
</div>
</div>
</div>
</div>
<!-- Page Header End -->      

<!-- Job Browse Section Start -->  
<section class="job-browse section">
<div class="container">
<div class="row">
<div class="col-md-9 col-sm-8">
<?= $jobsQuery; ?>
</div>
<div class="col-md-3 col-sm-4">
<aside>
<div class="sidebar">
<div class="inner-box">
<h3>Categories</h3>
<ul class="cat-list">
<?= $userClass->jobGroups("category");?>
</ul>
</div>
<div class="inner-box">
<h3>Job Status</h3>
<ul class="cat-list">
<?= $userClass->jobGroups("wType");?>
</ul>
</div>
<div class="inner-box">
<h3>Locations</h3>
<ul class="cat-list">
<?= $userClass->jobGroups("location");?>
</ul>
</div>
</div>
</aside>
</div>
</div>
</div>
</section>
<!-- Job Browse Section End -->

<?php include 'lib/footer.php'; ?>