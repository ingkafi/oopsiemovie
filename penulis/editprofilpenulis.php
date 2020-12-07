<?php 
require('db.php');
require_once('db_login.php');
session_start();
if(!isset($_SESSION['penulis_id']))
{
	header("Location:login.php");
}
?>
<?php 
$pid = $_GET["idpenulis"];

if(isset($_POST['penulis-update']))
{
	
	$nama = mysqli_real_escape_string($db, $_POST['namaPenulis']);
	$alamat = mysqli_real_escape_string($db, $_POST['alamatPenulis']);
	$kota = mysqli_real_escape_string($db, $_POST['kotaPenulis']);
	$no_telp = mysqli_real_escape_string($db, $_POST['noPenulis']);

	$author = $_SESSION['penulis_id'];

	$sql = "UPDATE penulis SET nama = '$nama', alamat= '$alamat', kota = '$kota',  no_telp = '$no_telp' WHERE idpenulis = '$author' ";
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
elseif(isset($_GET['idpenulis'])){
	if(!empty($_GET['idpenulis'])){
		$sql = "SELECT * FROM penulis WHERE idpenulis = '$_GET[idpenulis]'";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if(mysqli_num_rows($execution)>0){
			if($result = mysqli_fetch_assoc($execution)){
				$result_id = $result['idpenulis'];
				$result_nama = $result['nama'];
				$result_password = $result['password'];
				$result_alamat = $result['alamat'];
				$result_kota = $result['kota'];
				$result_no_telp = $result['no_telp'];

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
			<h1 class="sidebar-heading">Writer's Page</h1>
				<h1 class="sidebar-heading2">Edit Profil</h1>
				<div class="row">
					<!-- Navbar section -->
					<?php include 'sidemenu.php';?>

					<!-- Content Section -->
					<div class="col-sm-10 content">

						<!-- Add Post Form -->
						<h3 class="post-heading">UPDATE PROFIL</h3>

						<form method="POST" enctype="multipart/form-data">
							<fieldset>
								<div class="form-group">
									<label for="namaPenulis">Nama</label>
									<input type="text" name="namaPenulis" id="namaPenulis" class="form-control" placeholder="Masukan Nama" value="<?php echo $result_nama; ?>">
								</div>

								<div class="form-group">
									<label for="alamatPenulis">Alamat</label>
									<textarea name="alamatPenulis" id="alamatPenulis" class="form-control" cols="30" rows="10"><?php echo $result_alamat;?></textarea>
								</div>

								<div class="form-group">
									<label for="kotaPenulis">Kota</label>
									<input type="text" name="kotaPenulis" id="kotaPenulis" class="form-control" placeholder="Masukan Kota" value="<?php echo $result_kota; ?>">
								</div>


								<div class="form-group">
									<label for="noPenulis">No. Telp</label>
									<input type="text" name="noPenulis" id="noPenulis" class="form-control" placeholder="Masukan No. Penulis" value="<?php echo $result_no_telp; ?>">
								</div>

								<input type="hidden" name = "idFromUrl" value="<?php echo $_GET['idpenulis']; ?>">

								<div class="form-group">
									<input type="submit" name="penulis-update" class="btn btn-info" value="UPDATE">
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

		function IsValidNamaPenulis(namaPenulis){
			if(namaPenulis == ""){
				return false;
			}
			else{
				return true;
			}
		}

		function IsValidAlamat(alamatPenulis){
			if(alamatPenulis == ""){
				return false;
			}
			else{
				return true;
			}
		}

		function IsValidKota(kotaPenulis){
			if(kotaPenulis == ""){
				return false;
			}
			else{
				return true;
			}
		}




		function IsValidNo(noPenulis){
			if(noPenulis == ""){
				return false;
			}
			else{
				return true;
			}
		}


		function ValidPost(){
			var namaPenulis = document.getElementById("namaPenulis").value;
			var alamatPenulis = document.getElementById("alamatPenulis").value;
			var kotaPenulis = document.getElementById("kotaPenulis").value;
			var emailPenulis = document.getElementById("emailPenulis").value;
			var noPenulis = document.getElementById("noPenulis").value;




			if(!IsValidNamaPenulis(namaPenulis)){
				alert("Nama tidak boleh kosong.");
			}
			if(!IsValidaAlamat(alamatPenulis)){
				alert("Alamat tidak boleh kosong.");
			}
			if(!IsValidaKota(kotaPenulis)){
				alert("Kota tidak boleh kosong.");
			}
			if(!IsValidaNo(noPenulis)){
				alert("No. Telp tidak boleh kosong.");
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