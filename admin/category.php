
<?php 
require('db.php');
session_start();
if(!isset($_SESSION['admin_id']))
{
	header("Location:login.php");
}
?>
<?php 
if(isset($_POST['submit']))
{
	date_default_timezone_set('Asia/Manila');
	$time = time();
	$dateTime = strftime('%Y-%m-%d', $time);
	$category = mysqli_real_escape_string($db, $_POST['categoryName']);
	$categoryLength = strlen[$category];
	$admin = $_SESSION['idadmin'];

	if(empty($category)){
		echo '<script>alert("All Fields must be fill out")</script>';
		header("Location: category.php");
	}
	
	else{
		$query = "INSERT INTO kategori (nama) VALUES ('$category')";
		$execution = mysqli_query($db, $query) or die(mysqli_error($db));
		if($execution){
			echo '<script>alert("CATEGORY ADDED SUCCESSFULLY")</script>';
			header("Location: category.php");
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
			header("Location: category.php");
		}
	}
}

if(isset($_GET['delete_attempt'])){
	if(!empty($_GET['delete_attempt'])){
		$sql = "DELETE FROM kategori WHERE idkategori = $_GET[delete_attempt]";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			echo '<script>alert("CATEGORY DELETED SUCCESSFULLY")</script>';
			header("Location: category.php");
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
			header("Location: category.php");
		}
	}
}
?>

<!DOCTYPE HTML>
<html lang="en" ng-app>
<?php include 'head.php';?>
<body>
	<!-- Class Blog = Main Div Except Footer -->
	<div class="blog">

		<!-- Sidebar -->
		<div class="container-fluid">
			<div class="sidebar">
			<h1 class="sidebar-heading">Hi! <?php echo ($_SESSION['nama']) ?></h1>
				<h1 class="sidebar-heading2">Manage Categories</h1>
				<div class="row">
					<!-- Navbar section -->
					<?php include 'sidemenu.php';?>

					<!-- Content Section -->
					<div class="col-sm-10 content">

						<!-- Add Category -->
						<h3 class="post-heading">MANAGE CATEGORY</h3>

						<form action="category.php" method="POST" enctype="multipart/form-data" name="categoryform">
							<fieldset>
								<div class="form-group">
									<label for="postTitle">NAME</label>
									<input type="text" name="categoryName" id="categoryName" class="form-control" placeholder="Add New Title" ng-model="user.categoryName" required> <span style="color:red; font-weight: bold;" ng-show="categoryform.categoryName.$error.required">Required</span>
								</div>

								<div class="form-group">
									<input type="submit" name="submit" class="btn btn-info" value="ADD" ng-disabled = "categoryform.$invalid">
								</div>
							</fieldset>
						</form>
						<!-- Add Category ENDS -->

						<h3 class="post-heading">CATEGORY LIST</h3>
						<table class="table">
							<thead class="thead-dark">
								<tr>
									<th>No.</th>
									<th>Name</th>
									<th>Jumlah</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$num = 1;
								$sql = "SELECT * FROM kategori ORDER BY idkategori ASC";
								$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
								while($result = mysqli_fetch_assoc($execution)){
									$cat_id = $result['idkategori'];
									$cat_name = $result['nama'];
									$query = " SELECT idkategori FROM kategori WHERE nama='".$cat_name."'";
									$result = $db->query($query);
									$row = $result->fetch_object();
									$idkategori = $row->idkategori;
									$query_kat= "SELECT count(idpost) as jumlah FROM post WHERE idkategori='".$idkategori."' ";
									$result_kat = $db->query($query_kat);
									$row_kat = $result_kat->fetch_object();
									$jumlahkat = $row_kat->jumlah;  
									echo "
										<tr>
											<td>$num</td>
											<td>$cat_name</td>
											<td>$jumlahkat</td>
											<td><a href='category.php?delete_attempt=$cat_id'><button class='btn btn-danger'><i class='far fa-trash-alt'></i></button></a></td>
										</tr>
									";
									$num++;
								}
								?>

							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
		<!-- Sidebar ENDS -->
		<?php include 'footer.php';?>
		
	</div>

	<script type="text/javascript">

		function IsValidCatName(catname){
			if(catname == ""){
				return false;
			}
			else{
				return true;
			}
		}
		

		function ValidCat(){
			var catname = document.getElementById("catname").value;
			
			if(!IsValidCatName(catname)){
				alert("Category Title Required");
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