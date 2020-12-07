<?php 
session_start();
require('db.php');
if(isset($_GET['idpost'])){
	$post_id = $_GET['idpost'];
	$post_title = "";
	$sql = "SELECT * FROM post WHERE idpost = '$post_id'";
	$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
	if($title = mysqli_fetch_assoc($execution)){
		$post_title = $title['judul'];
	}
}
?>

<!DOCTYPE HTML>
<html lang="en" ng-app="single">
<head>
	<meta charset="UTF-8">
	<title><?php echo $post_title; ?> - Oopsie Movie</title>

	<!-- Bootstrap Files -->
	<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Stylesheet -->
	<link rel="stylesheet" href="stylesheetss.css">
	<!-- Fontawesome -->
	<script src="https://kit.fontawesome.com/ca0905f6a5.js"></script>
	<!-- TechSavvy Font -->
	<link href="https://fonts.googleapis.com/css?family=Saira+Stencil+One&display=swap" rel="stylesheet">
	<!-- Headings Blog -->
	<link href="https://fonts.googleapis.com/css?family=Acme&display=swap" rel="stylesheet">
	<!-- Paragraph Blog -->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
	<link href="css/jquery-ui.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

</head>
<body>
	<!-- Class Blog = Main Div Except Footer -->
    <header>
        <div class="container">
            <div class="header-left">
                <a  href="home.php" ><img class="logo" src="images/oopsie movie.png"></a>
            </div>
            <div class="header-right">
				<?php
				if(isset($_SESSION['penulis_id'])){
					echo '<a href="penulis/logout.php" class="login">Log out</a>
						</div>
						<div class="header-right mr-3">
						<a href="penulis/dashboard.php" class="login">Dashboard</a>
						</div>';
				}
				else if(isset($_SESSION['admin_id'])){
					echo '<a href="admin/logout.php" class="login">Log out</a>
						</div>
						<div class="header-right mr-3">
						<a href="admin/dashboard.php" class="login">Dashboard</a>
						</div>';
				}
				else{
					echo '<a href="penulis/login.php" class="login">Log in</a>
							</div>';
				}
			?>
      </div>
	</header>
	<div class="top-wrapper">
        <div class="container">
            <div class="btn-wrapper">
            </div>
        </div>
    </div>

		<!-- Navbar Ends -->

		<!-- Main Section -->

		<!-- BLOG - Left Panel -->
		<div class="lesson-wrapper">
            <div class="heading" style="color: #eaeff3;"> 
                <h2><b>Cari Film</b></h2>
			</div>
            <form action="home.php" method="GET" class="form-inline my-2 my-lg-0 center">
		      <input class="form-control mr-sm-2" id="autocomplete" type="text" name="search" placeholder="Search" aria-label="Search" style="width:600px;">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" ><i class="fas fa-search"></i></button>
			</form>
			<br><br><br>
		<div class="container">
			<!-- BLOG - Left Bottom Panel -->
				<div class="row">
					<?php 
					if(isset($_GET['idpost'])){
						$query = "SELECT * FROM post WHERE idpost = '$_GET[idpost]'";
						$execution = mysqli_query($db, $query) or die(mysqli_error($db));
						if(mysqli_num_rows($execution)>0){
							while($result = mysqli_fetch_assoc($execution)){
								$query = "SELECT nama from kategori WHERE idkategori = '".$result['idkategori']."'";
								$nama = $db->query($query);
								$row = $nama->fetch_object();
								$namakat = $row->nama;
								$query = "SELECT nama from penulis WHERE idpenulis= '".$result['idpenulis']."'";
								$pen = $db->query($query);
								$row = $pen->fetch_object();
								$penulis = $row->nama;
								$result_author = $penulis;
								$id = $result['idpost'];
								$postDate = $result['tgl_insert'];
								$title = $result['judul'];
								$category = $namakat;
								$image = $result['file_gambar'];
								$content = $result['isi_post'];
								?>
								<div class="card blog_single">
									<img src="penulis/Upload/Image/<?php echo $image; ?>" class="card-img-top blog-img" alt="">
									<div class="card-body">
										<h3 class="card-title"><?php echo htmlentities($title); ?></h3>
										<p href="#" class="card-text extraText"><span><i class="far fa-edit"></i> <?php echo htmlentities($category); ?></span> <span>|</span> <span><i class="far fa-calendar-alt"></i>  <?php echo htmlentities($postDate); ?></span><span><br><i class="fas fa-user"></i> <?php echo htmlentities($result_author); ?></span></p> <br>
										<p class="card-text blogPara"><?php echo htmlentities($content); ?></p>

										<!-- <a href="#" class="card-link btn btn-info readMore"><i class="fas fa-hand-point-right"></i> Read More</a> -->
									</div>
								</div>
								<?php
							}
						}
					}
					?>
									
						<div class="comments" style="margin-left:30px">
							<div class="container">
								<?php 	
								$sql = "SELECT * FROM komentar WHERE idpost = '$_GET[idpost]' AND status = 'approved'";
								$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
								if(mysqli_num_rows($execution)>0){
									while($comment = mysqli_fetch_assoc($execution)){
										$c_email = $comment['email'];
										$c_comment = $comment['isi'];
										?>
										<div class="row comment-1">
											<div class="col-md-12">
												<p class="comments-mail"><?php echo $c_email; echo ' : ';  echo $c_comment; ?></p>
											</div>
										</div>
									<?php
									}
								}else{
									echo "<p class='comments-body' style='color: #fff;'>No Comments Yet</p>";
								}
								?>
								
							</div>
						</div>
						<div class="comment-section" style="margin-left:30px">
							<form method="POST" action="commentpost.php?id=<?php echo $_GET['idpost']; ?>" name="comment">
								<fieldset>
									<legend class="legend">Your thoughts about this post</legend>
									

									<div class="form-group">
										<textarea name="comment" id="comment" placeholder="Comment..." class="form-control" cols="20" rows="5" ng-model="cocontent" required></textarea> <span style="color:red; font-weight: bold;" ng-show="comment.cocontent.$error.required">Required</span>
									</div>
									<div class="form-group">
										<button type="submit" name="submit" value="Post" class="btn btn-info submit" <?php if(!isset($_SESSION['penulis_id'])){ echo "disabled";}?>>Submit</button>
									</div>
								</fieldset>
							</form>
						</div>
				</div>
				

			<!-- BLOG - Left Bottom Panel ENDS -->
		</div>
		<!-- BLOG - Left Panel ENDS -->


		<!-- Main Section Ends -->

		<footer class="container-fluid">
			<p>COPYRIGHT © Oopsie Movie</p>
		</footer>
	</div>

	<script>
		var single = angular.module("single", []);
	</script>
	<script src="external/jquery/jquery.js"></script>
	<script src="jquery-ui.js"></script>
	<script>
		var availableTags = [
			"Laptop",
			"Lenovo",
			"Laptop1",
			"Laptop2",
			"Hardware",
			"Hardware1",
			"Hardware2",
			"Hardware3",
		];
		$( "#autocomplete" ).autocomplete({
			source: availableTags
		});
	</script>

	<script type="text/javascript">

		function IsValidName(name){
			if(name == ""){
				return false;
			}
			else{
				return true;
			}
		}
		
		function IsValidEmail(email){
			//Check minimum valid length of an Email.
            if (email.length <= 2) {
                return false;
            }
            //If whether email has @ character.
            if (email.indexOf("@") == -1) {
                return false;
            }

            var parts = email.split("@");
            var dot = parts[1].indexOf(".");
            var len = parts[1].length;
            var dotSplits = parts[1].split(".");
            var dotCount = dotSplits.length - 1;


            //Check whether Dot is present, and that too minimum 1 character after @.
            if (dot == -1 || dot < 2 || dotCount > 2) {
                return false;
            }

            //Check whether Dot is not the last character and dots are not repeated.
            for (var i = 0; i < dotSplits.length; i++) {
                if (dotSplits[i].length == 0) {
                    return false;
                }
            }

            return true;
		};

		
		function IsValidMessage(message){
			if(message == ""){
				return false;
			}
			else{
				return true;
			}
		}


		function ValidContact(){
			var name = document.getElementById("name").value;
			var email = document.getElementById("email").value;
			var message = document.getElementById("comment").value;
			
			if(!IsValidName(name)){
				alert("Name Required");
			}
			if(!IsValidEmail(email)){
				alert("Invalid Email");
			}
			
			if(!IsValidMessage(message)){
				alert("Message Field Empty");
			}
			
			else{
				alert("Thankyou");
			}
		}
	</script>

	<!-- Script Files -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>