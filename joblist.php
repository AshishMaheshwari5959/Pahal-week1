<?php
session_start();
include('database_connection.php');
if(!isset($_SESSION['user_id']))
{
  header('location:login.php');
}
$user_id = $_SESSION['user_id'];
$stmt = $pdo->query("select * from user where user_id='$user_id;'");

$row = $stmt->fetch();

$userPicture = !empty($row[17])?$row[17]:'assets/img/user.jpg';
$userPictureURL = $userPicture;
$username = $row[1];
// var_dump($row);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Jobs | Pahal</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Farro&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.3/css/foundation.min.css'> -->

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/linearicons.css">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/job-listing.css">
  <link rel="stylesheet" href="assets/css/dashboard.css">
  <link rel="stylesheet" href="assets/css/dash-image.css">

</head>

<body>

  <!-- Start post Area -->
	<section class="post-area section-gap">
		<div class="container">
			<div class="row justify-content-center d-flex">
				<div class="col-lg-8 post-list">
					<ul class="cat-list">
						<li><a>Recent</a></li>
						<li><a>Full Time</a></li>
						<li><a>Intern</a></li>
						<li><a>Part Time</a></li>
					</ul>

					<?php  
					  $stmt = $pdo->query('SELECT j.job_role, j.vaccancies, o.org_name, j.job_state, j.job_city, o.org_logo, j.job_desc, j.job_skills, j.job_nature, j.min_salary, j.max_salary FROM job j INNER JOIN organization o ON j.org_id=o.org_id ORDER BY apply_by desc;');
					  $rows = $stmt->fetch();
					  // var_dump($rows);
					  $n = sizeof($rows);
					  $t = gettype($n);
					  $stmt = $pdo->query('SELECT j.job_role, j.vaccancies, o.org_name, j.job_state, j.job_city, o.org_logo, j.job_desc, j.job_skills, j.job_nature, j.min_salary, j.max_salary FROM job j INNER JOIN organization o ON j.org_id=o.org_id ORDER BY apply_by desc;');
					  if ($n > 1) {
					    while($row = $stmt->fetch()){
					    	$abc = explode(",",$row[7]);
					?>

					<div class="single-post d-flex flex-row">
						<div class="thumb">
							<img src="<?php echo $row[5]; ?>" alt="">
							<div class="vacancy"><?php echo $row[1]; ?> Vacancies</div>
						</div>
						<div class="details">
							<div class="title d-flex flex-row justify-content-between">
								<div class="titles">
									<a href="single.html">
										<h4><?php echo $row[0]; ?></h4>
									</a>
									<h6><?php echo $row[2]; ?>, <?php echo $row[4]; ?>, <?php echo $row[3]; ?></h6>
								</div>
								<ul class="btns">
									<!-- <li class="fav"><a href="#"><span class="lnr lnr-heart"></span></a></li> -->
									<li class="apply"><a href="#">Apply</a></li>
								</ul>
							</div>
							<p><?php echo $row[6]; ?></p>
							<div class="bottom-info" style="display: flex; justify-content: space-between;">
								
								<h5 class="job-type"><?php echo $row[8]; ?></h5>
								<p class="address"><span class="lnr lnr-database"></span> <?php echo $row[9]; ?>-<?php echo $row[10]; ?></p>
								</div>
								
								<ul class="tags">
									<?php 
									$i = 0;
									foreach ($abc as $xyz) {
										echo "<li style='margin-right: 10px;'><a>".$abc[$i]."</a></li>";
										$i++;
									}
									?>
								</ul>
						</div>
					</div>
					<?php 
					}} else { echo "string"; }
					?>


					<a class="loadmore-btn mx-auto d-block" href="category.html">Explore more</a>

				</div>
				<div class="col-lg-4 sidebar">
					<div class="single-slidebar">
						<h4>Jobs by Location</h4>
						<ul class="cat-list">
							<li><a class="justify-content-between d-flex">
									<p>Mumbai</p><span>37</span>
								</a></li>
							<li><a class="justify-content-between d-flex">
									<p>Delhi</p><span>57</span>
								</a></li>
							<li><a class="justify-content-between d-flex">
									<p>Bangalore</p><span>33</span>
								</a></li>
							<li><a class="justify-content-between d-flex">
									<p>Jaipur</p><span>36</span>
								</a></li>
							<li><a class="justify-content-between d-flex">
									<p>Hyderabad</p><span>47</span>
								</a></li>
							<li><a class="justify-content-between d-flex">
									<p>Ayodhya</p><span>27</span>
								</a></li>
							<li><a class="justify-content-between d-flex">
									<p>Lucknow</p><span>17</span>
								</a></li>
						</ul>
					</div>
					<div class="single-slidebar">
						<h4>Jobs by Category</h4>
						<ul class="cat-list">
							<li><a class="justify-content-between d-flex">
									<p>Technology</p><span>37</span>
								</a></li>
							<li><a class="justify-content-between d-flex">
									<p>Media & News</p><span>57</span>
								</a></li>
							<li><a class="justify-content-between d-flex">
									<p>Goverment</p><span>33</span>
								</a></li>
							<li><a class="justify-content-between d-flex">
									<p>Medical</p><span>36</span>
								</a></li>
							<li><a class="justify-content-between d-flex">
									<p>Restaurants</p><span>47</span>
								</a></li>
							<li><a class="justify-content-between d-flex">
									<p>Developer</p><span>27</span>
								</a></li>
							<li><a class="justify-content-between d-flex">
									<p>Accounting</p><span>17</span>
								</a></li>
						</ul>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- End post Area -->
  <div class="s-layout">
    <div class="s-layout__sidebar">
      <a class="s-sidebar__trigger" href="#0">
        <i class="fa fa-bars"></i>
      </a>

      <nav class="s-sidebar__nav" id="sidebar">
          <div class="sidebar-header">
            
            <div class="circle" id="circlediv" style="background-image: url(<?php echo $userPicture; ?>);">
              <div class="p-image">
                <center><i class="fa fa-camera fa-2x upload-button" style="color: orangered"></i></center>
                <input class="file-upload" name="file" id="file" type="file" accept="image/*"/>
              </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
            <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script>
            $(document).ready(function(){
             $(document).on('change', '#file', function(){
              var name = document.getElementById("file").files[0].name;
              var form_data = new FormData();
              var ext = name.split('.').pop().toLowerCase();
              if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
              {
               alert("Invalid Image File");
              }
              var oFReader = new FileReader();
              oFReader.readAsDataURL(document.getElementById("file").files[0]);
              var f = document.getElementById("file").files[0];
              var fsize = f.size||f.fileSize;
              if(fsize > 2000000)
              {
               alert("Image File Size is very big");
              }
              else
              {
               form_data.append("file", document.getElementById('file').files[0]);
               $.ajax({
                url:"dpupload.php",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                 $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                },   
                success:function(data)
                {
                 $('#uploaded_image').html(data);
                }
               });
              }
             });
            });
            </script>

            <div class="user-info">
              <center><span class="user-name"><?php echo $username; ?></span></center>
            </div>
          </div>
          <hr>
          <div class="sidebar-menu">
            <ul>
              <li class="sidebar-dropdown">
                <a href="user_profile.php"><i class="fa fa-user"></i><span>Profile</a>
              </li>
              <li class="sidebar-dropdown">
                <a href="user-feed.php"><i class="far fa-newspaper"></i><span>News Feed</span></a>
              </li>
              <li class="sidebar-dropdown">
                <a href="writeBlog.php"><i class="fa fa-file-alt"></i><span>Write a blog</span></a>
              </li>
              <li class="sidebar-dropdown">
                <a href="myblogs.php"><i class="fa fa-th-large"></i><span>My Blogs</span></a>
              </li>
              <li class="sidebar-dropdown">
                <a href="training.php"><i class="fas fa-graduation-cap"></i><span>Training</span></a>
              </li>
              <li class="sidebar-dropdown">
                <a href="chat.php"><i class="fas fa-comments"></i><span>Inbox</span></a>
              </li>
              <li class="sidebar-dropdown active-tab">
                <a href="joblist.php"><i class="fas fa-briefcase"></i><span>Explore Jobs</span></a>
              </li>
              <li class="sidebar-dropdown">
                <a href="applications.php"><i class="fa fa-thumbtack"></i><span>Application Tracking</span></a>
              </li>
              <li class="sidebar-dropdown">
                <a href="index.php"><i class="fas fa-home"></i><span>Back to Home</span></a>
              </li>
              <li class="sidebar-dropdown">
                <a href="index.php#contact"><i class="fas fa-headphones"></i><span>Feedback</span></a>
              </li>
              <li class="sidebar-dropdown"><a href="logout.php"><i class="fa fa-power-off"></i><span>Logout</span></a></li>
            </ul>
          </div>
          <hr style="height: 1px; margin-bottom: 0;">
          <div class="sidebar-footer">
            <center>
            <div class="copyright">
              <strong><span>pahal.in&copy; </span></strong>2021<br>
              Designed by <a>Code Smashers</a><br>
            </div>
          </center>
          </div>
        </nav>
    </div>
  </div>
<!-- partial -->
<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script  src="assets/js/dash-image.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

</body>

</html>