<?php

include 'lib/dbConfig.php';

include 'lib/header.php';

?>

<!-- Find Job Section Start -->
<section class="find-job section">
<div class="container">
<h2 class="section-title">Current Jobs</h2>
<div class="row">
<div class="col-md-12">
<?= $userClass->jobs(NULL, NULL); ?>
</div>
<!-- <div class="col-md-12">
<div class="showing pull-left">
<a href="#">Showing <span>6-10</span> Of 24 Jobs</a>
</div>                    
<ul class="pagination pull-right">              
<li class="active"><a href="#" class="btn btn-common" ><i class="ti-angle-left"></i> prev</a></li>
<li><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li class="active"><a href="#" class="btn btn-common">Next <i class="ti-angle-right"></i></a></li>
</ul>
</div> -->
</div>
</div>
</section>
<!-- Find Job Section End -->

<?php include 'lib/footer.php'; ?>