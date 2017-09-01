<?php

include 'lib/dbConfig.php';

if ($userClass->loggedIn() == FALSE) { $userClass->Redirect($userClass->Router()); }

if (isset($_POST['postJob'])) {

  $tittle           = $userClass->CleanEntries($_POST['title']);
  $location         = $userClass->CleanEntries($_POST['location']);
  $category         = $_POST['category'];
  $overview         = $userClass->CleanEntries($_POST['overview']);
  $qualification    = $userClass->CleanEntries($_POST['qualification']);
  $responsibilities = $userClass->CleanEntries($_POST['responsibilities']);
  $requirements     = $userClass->CleanEntries($_POST['requirements']);
  $wType            = $_POST['wType'];
  $deadline         = $userClass->CleanEntries($_POST['deadline']);
  $employer_id      = $userClass->Insession("id");

  $userClass->Redirect($userClass->postJob($tittle, $overview, $qualification, $responsibilities, $requirements, $category, $wType, $location, $deadline, $employer_id));

}

include 'lib/header2.php';

?> 

<!-- Page Header Start -->
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">         
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title">Post A Job</h2>
<ol class="breadcrumb">
<li><a href="<?= SITEURL; ?>"><i class="ti-home"></i> Home</a></li>
<li class="current">Post A Job</li>
</ol>
</div>
</div>
</div>
</div>
</div>
<!-- Page Header End -->    

<!-- Content section Start --> 
<section id="content">
<div class="container">
<div class="row">
<div class="col-sm-12 col-md-9 col-md-offset-2">
<div class="page-ads box">
<form role="form" class="form-ad" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
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
    echo "<div align=\"center\" class=\"alert alert-success\">Job Submission Successful.</div>";
    break;
    case 'Failed':
    echo "<div align=\"center\" class=\"alert alert-danger\">Job Submission Failed !! please try again.</div>";
    break;
  }
}
?>
<div class="form-group">
<label class="control-label">Job Title</label>
<div class="input-icon">
<i class="ti-stamp"></i>
<input type="text" name="title" id="title" class="form-control" placeholder="e.g. Web Developer Needed." required>
</div>
</div> 
<div class="form-group">
<label class="control-label">Location</label>
<div class="search-category-container">
<label class="styled-select-location">
<select class="dropdown-product selectpicker" name="location" id="location" required>
<option selected="disabled">All Locations</option>
<option value="Baringo">Baringo</option>
<option value="Bomet">Bomet</option>
<option value="Bungoma">Bungoma</option>
<option value="Busia">Busia</option>
<option value="Elgeyo-Marakwet">Elgeyo-Marakwet</option>
<option value="Embu">Embu</option>
<option value="Garissa">Garissa</option>
<option value="Homa Bay">Homa Bay</option>
<option value="Isiolo">Isiolo</option>
<option value="Kajiado">Kajiado</option>
<option value="Kakamega">Kakamega</option>
<option value="Kericho">Kericho</option>
<option value="Kiambu">Kiambu</option>
<option value="Kilifi">Kilifi</option>
<option value="Kirinyaga">Kirinyaga</option>
<option value="Kisii">Kisii</option>
<option value="Kisumu">Kisumu</option>
<option value="Kitui">Kitui</option>
<option value="Kwale">Kwale</option>
<option value="Laikipia">Laikipia</option>
<option value="Lamu">Lamu</option>
<option value="Machakos">Machakos</option>
<option value="Makueni">Makueni</option>
<option value="Mandera">Mandera</option>
<option value="Marsabit">Marsabit</option>
<option value="Meru">Meru</option>
<option value="Migori">Migori</option>
<option value="Mombasa">Mombasa</option>
<option value="Muranga">Muranga</option>
<option value="Nairobi">Nairobi</option>
<option value="Nakuru">Nakuru</option>
<option value="Nandi">Nandi</option>
<option value="Narok">Narok</option>
<option value="Nyamira">Nyamira</option>
<option value="Nyandarua">Nyandarua</option>
<option value="Nyeri">Nyeri</option>
<option value="Samburu">Samburu</option>
<option value="Siaya">Siaya</option>
<option value="Taita-Taveta">Taita-Taveta</option>
<option value="Tana River">Tana River</option>
<option value="Tharaka-Nithi">Tharaka-Nithi</option>
<option value="Trans-Nzoia">Trans-Nzoia</option>
<option value="Turkana">Turkana</option>
<option value="Uasin Gishu">Uasin Gishu</option>
<option value="Vihiga">Vihiga</option>
<option value="Wajir">Wajir</option>
<option value="West Pokot">West Pokot</option>
</select>
</label>
</div>
</div>
<div class="form-group">
<label class="control-label">Category</label>
<div class="search-category-container">
<label class="styled-select">
<select class="dropdown-product selectpicker" name="category" id="category" required>
<option selected="disabled">All Categories</option>
<option value="Finance">Finance</option>
<option value="IT">IT & Telecoms</option>
<option value="Education">Education & Training</option>
<option value="Design">Art & Design</option>
<option value="Sales">Sale & Marketing</option>
<option value="Healthcare">Healthcare</option>
<option value="Science">Science</option>                              
<option value="Catering">Food Services</option>
<option value="Engineering">Engineering</option>
<option value="Entertainment">Entertainment</option>
</select>
</label>
</div>
</div> 
<div class="form-group">
<label class="control-label" for="textarea">Overview</label>
<div class="input-icon">
<i class="ti-info-alt"></i>
<textarea class="form-control" rows="7" name="overview" id="overview" required></textarea>
</div>
</div>
<div class="form-group">
<label class="control-label" for="textarea">Qualifications</label>
</div>  
<section id="editor">
<textarea name="qualification" id="qualification" style="margin-bottom: 30px;" required></textarea>
</section>
<br>
<div class="form-group">
<label class="control-label" for="textarea">Key responsibilities to include</label>
</div>  
<section id="editor">
<textarea name="responsibilities" id="responsibilities" style="margin-bottom: 30px;" required></textarea>
</section>
<br>
<div class="form-group">
<label class="control-label" for="textarea">Requirements</label>
</div>  
<section id="editor">
<textarea name="requirements" id="requirements" style="margin-bottom: 30px;" required></textarea>
</section>
<br>
<div class="form-group">
<label class="control-label">Job Status</label>
<div class="search-category-container">
<label class="styled-select">
<select class="dropdown-product selectpicker" name="wType" id="wType" required>
<option selected="disabled">All Types</option>
<option value="Full-Time">Full-Time</option>
<option value="Part-Time">Part-Time</option>
<option value="Contract">Contract</option>
<option value="Voluntary">Voluntary</option>
<option value="Freelance">Freelance</option>
<option value="Internship">Internship</option>
</select>
</label>
</div>
</div>

<div class="form-group">
<label class="control-label">Deadline Date</label>
<div class="input-icon">
<i class="ti-calendar"></i>
<input type="date" name="deadline" id="deadline" class="form-control" placeholder="Enter Application Deadline Date" required>
</div>
<span class="help-block"> Select date </span>
</div>

<div align="center">
<button type="submit" name="postJob" id="postJob" class="btn btn-common">Submit your job</button>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
<!-- Content section End -->         
<?php include 'lib/footer.php'; ?>