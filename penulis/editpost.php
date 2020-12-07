<?php 
require('db.php');
session_start();
if(!isset($_SESSION['penulis_id']))
{
	header("Location:login.php");
}
?>
<?php 
$pid = $_GET["post_id"];

if(isset($_POST['post-update']))
{
	date_default_timezone_set('Asia/Manila');
	$time = time();
	
	$title = mysqli_real_escape_string($db, $_POST['postTitle']);
	$category = mysqli_real_escape_string($db, $_POST['postCategory']);
	$content = mysqli_real_escape_string($db, $_POST['postContent']);
	$image = $_FILES['postFile']['name'];
	$author = $_SESSION['idpenulis'];
	$dateTime = strftime('%Y-%m-%d', $time);
	$updateImage = $image;
	if(empty($image)){
		$updateImage = $_POST['currentImage'];
		$newImage = false;
	}
	$imageDirectory = "Upload/Image/" . basename($_FILES['postFile']['name']);
	$sql = "UPDATE post SET tgl_insert = '$dateTime', judul= '$title', idkategori = '$category', idpenulis = '$author', file_gambar = '$updateImage', isi_post = '$content' WHERE idpost = '$_POST[idFromUrl]' ";
	$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
	if($execution){
		move_uploaded_file($_FILES['postFile']['tmp_name'], $imageDirectory);
		echo '<script>alert("POST UPDATED SUCCESSFULLY")</script>';
		header("Location: dashboard.php");
	}
	else{
		echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
		header("Location: dashboard.php");
	}
}
elseif(isset($_GET['post_id'])){
	if(!empty($_GET['post_id'])){
		$sql = "SELECT * FROM post WHERE idpost = '$_GET[post_id]'";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if(mysqli_num_rows($execution)>0){
			if($result = mysqli_fetch_assoc($execution)){
				$query = "SELECT nama from kategori WHERE idkategori = '".$result['idkategori']."'";
				$nama = $db->query($query);
				$row = $nama->fetch_object();
				$namakat = $row->nama;
				$result_id = $result['idpost'];
				$result_date = $result['tgl_insert'];
				$result_title = $result['judul'];
				$result_category = $namakat;
				$result_author = $result['idpenulis'];
				$result_image = $result['file_gambar'];
				$result_content = $result['isi_post'];
			}
		}
	}
}else{
	header("Location: dashboard.php");
}

?>

<!DOCTYPE HTML>
<html lang="en">
<?php include 'head.php';?>
<body>
	<!-- Class Blog = Main Div Except Footer -->
	<div class="blog">

		<!-- Sidebar -->
		<div class="container-fluid">
			<div class="sidebar">
			<h1 class="sidebar-heading">Hi! <?php echo ($_SESSION['nama']) ?></h1>
				<h1 class="sidebar-heading2">Edit Post</h1>
				<div class="row">
					<!-- Navbar section -->
					<?php include 'sidemenu.php';?>

					<!-- Content Section -->
					<div class="col-sm-10 content">

						<!-- Add Post Form -->
						<h3 class="post-heading">UPDATE POST</h3>

						<form action="editpost.php" method="POST" enctype="multipart/form-data">
							<fieldset>
								<div class="form-group">
									<label for="postTitle">TITLE</label>
									<input type="text" name="postTitle" id="postname" class="form-control" placeholder="Add New Title" value="<?php echo $result_title; ?>">
								</div>

								<div class="form-group">
									<label>Current Category : <?php echo htmlentities($result_category); ?></label><br>
									<label for="postCategory">CHANGE CATEGORY</label>
									<select name="postCategory" class="form-control" id="postCategory" ng-model="postCategory" required>
										<?php 
										$sql = "SELECT idkategori, nama FROM kategori";
										$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
										$selected = "";
										while($row = mysqli_fetch_assoc($execution)){
											echo "<option>$row[idkategori] : $row[nama]</option>";
										}
										?>
									</select>
								</div>

								<div class="form-group">
									<label>Existing Image: <img src="Upload/Image/<?php echo $result_image; ?>" style="width: 250px;"></label><br>
									<label for="postFile">UPDATE IMAGE</label>
									<input type="file" name="postFile" id="postfile" class="form-control">
								</div>

								<div class="form-group">
									<label for="postContent">EXISTING CONTENT</label>
									<textarea name="postContent" id="postContent" class="form-control" cols="30" rows="10"><?php echo $result_content;?></textarea>
								</div>
								<input type="hidden" name = "idFromUrl" value="<?php echo $_GET['post_id']; ?>">
								<input type="hidden" name = "currentImage" value="<?php echo $result_image; ?>">
								<div class="form-group">
									<input type="submit" name="post-update" class="btn btn-info" value="UPDATE">
								</div>
							</fieldset>
						</form>

						<!-- Add Post Form ENDS -->
					</div>
				</div>
			</div>
		</div>
		<!-- Sidebar ENDS -->
		<?php include 'footer.php';?>
	</div>

	<script type="text/javascript">

		function IsValidPostName(postname){
			if(postname == ""){
				return false;
			}
			else{
				return true;
			}
		}
		

		function IsValidFile(file){
			var validextension = new Array("jpg", "png", "jpeg", "gif");
			var fileextension = file.split('.').pop().toLowerCase();

			for (var i = 0; i <= validextension.length; i++) {
				if (validextension[i] == fileextension) {
					return true;
				}
			}
			return false;
		}
		function IsValidPostContent(postcontent){
			if(postcontent == ""){
				return false;
			}
			else{
				return true;
			}
		}


		function ValidPost(){
			var postname = document.getElementById("postname").value;
			var file = document.getElementById("postfile").value;
			var postcontent = document.getElementById("postcontent").value;
			
			if(!IsValidPostName(postname)){
				alert("Post Title Required");
			}
			if(!IsValidFile(file)){
				alert("Invalid File selected");
			}
			if(!IsValidPostContent(postcontent)){
				alert("Content Field Empty");
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