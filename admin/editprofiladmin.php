<?php 
require('db.php');
session_start();
if(!isset($_SESSION['admin_id']))
{
	header("Location:login.php");
}
?>
<?php 
$pid = $_GET["idadmin"];

if(isset($_POST['admin-update']))
{
	
	$nama = mysqli_real_escape_string($db, $_POST['namaAdmin']);
	$author = $_SESSION['idadmin'];

	$sql = "UPDATE admin SET nama = '$nama'   WHERE idadmin = '$author' ";
	$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
	if($execution){
		echo '<script>alert("DATA UPDATED SUCCESSFULLY")</script>';
		header("Location: editprofil.php");
	}
	else{
		echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
		header("Location: dashboard.php");
	}
}
elseif(isset($_GET['idadmin'])){
	if(!empty($_GET['idadmin'])){
		$sql = "SELECT * FROM admin WHERE idadmin = '$_GET[idadmin]'";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if(mysqli_num_rows($execution)>0){
			if($result = mysqli_fetch_assoc($execution)){
				$result_id = $result['idadmin'];
				$result_nama = $result['nama'];
				$result_password = $result['password']; 
			}
		}
	}
}else{
	header("Location: login.php");
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
			<h1 class="sidebar-heading">Writer's Page</h1>
				<h1 class="sidebar-heading2">Edit Profil</h1>
				<div class="row">
					<!-- Navbar section -->
					<?php include 'sidemenu.php';?>

					<!-- Content Section -->
					<div class="col-sm-10 content">

						<!-- Add Post Form -->
						<h3 class="post-heading">UPDATE PROFIL</h3>

						<form action="" method="POST" enctype="multipart/form-data">
							<fieldset>
								<div class="form-group">
									<label for="namaAdmin">Nama</label>
									<input type="text" name="namaAdmin" id="namaAdmin" class="form-control" placeholder="Masukan Nama" value="<?php echo $result_nama; ?>">
								</div>

								<input type="hidden" name = "idFromUrl" value="<?php echo $_GET['idadmin']; ?>">

								<div class="form-group">
									<input type="submit" name="admin-update" class="btn btn-info" value="UPDATE">
								</div>
							</fieldset>
						</form>

						<!-- Add Post Form ENDS -->

						<?php include 'footer.php';?>
					</div>
				</div>
			</div>
		</div>
		<!-- Sidebar ENDS -->
		
	</div>

	<script type="text/javascript">

		function IsValidNamaAdmin(namaAdmin){
			if(namaAdmin == ""){
				return false;
			}
			else{
				return true;
			}
		}
		

		function ValidAdmin(){
			var namaAdmin = document.getElementById("namaAdmin").value;

			if(!IsValidNamaAdmin(namaAdmin)){
				alert("Nama tidak boleh kosong.");
			}

			}
			if(!IsValidaEmail(emailAdmin)){
				alert("Email tidak boleh kosong.");
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