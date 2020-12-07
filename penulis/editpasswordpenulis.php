<?php 
require('db.php');
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

    $password_lama = mysqli_real_escape_string($db, $_POST['currentPassword']);
	$password_baru = mysqli_real_escape_string($db, $_POST['newPassword']);
	$konfirmasi_password = mysqli_real_escape_string($db, $_POST['confirmPassword']);

	$author = $_SESSION['idpenulis'];

	$sql = "SELECT password FROM penulis WHERE idpenulis = '$author' ";
    $result = $db->query($sql);
	
	if(!$result){
        echo '<div class="alert alert-danger alert-dismissible">
                <strong>Error!</strong> Could not query the database<br>'.$db->error. '<br>query = '.$query.'</div>';
    }
    else{
        $row = $result->fetch_object();
        if($password_lama == "" || $password_baru == "" || $konfirmasi_password == ""){
            echo '<div class="alert alert-danger alert-dismissible">
                    <strong>Error!</strong> Please fill all the fields.<br>
                    </div>';
        }
        else if($password_lama != $row->password){
            echo '<div class="alert alert-danger alert-dismissible">
                    <strong>Error!</strong> Password lama anda salah.<br>
                    </div>';
        }
        else if($password_baru != $konfirmasi_password){
            echo '<div class="alert alert-danger alert-dismissible">
                    <strong>Error!</strong> Konfirmasi password anda salah.<br>
                    </div>';
        }
        else{
            $query = " UPDATE penulis SET password='".$password_baru."' WHERE idpenulis='".$author."' ";
            $result = $db->query($query);
            if(!$result){
                echo '<div class="alert alert-danger alert-dismissible">
                        <strong>Error!</strong> Could not query the database<br>'.$db->error. '<br>query = '.$query.'</div>';
            }
            else{
                echo '<div class="alert alert-success alert-dismissible">
                        <div class="mb-2"><strong>Success!</strong> Data has been saved.</div>
                        <button type="submit" class="btn btn-sm btn-primary">OK</button>
                    </div>';
            }
        }
	}
}
    $db->close();
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
				<h1 class="sidebar-heading2">Edit Password</h1>
				<div class="row">
					<!-- Navbar section -->
					<?php include 'sidemenu.php';?>

					<!-- Content Section -->
					<div class="col-sm-10 content">

						<!-- Add Post Form -->
						<h3 class="post-heading">UPDATE PASSWORD</h3>

						<form action="" method="POST" enctype="multipart/form-data">
							<fieldset>
								<div class="form-group">
									<label for="currentPassword">Password Lama</label>
									<input type="text" name="currentPassword" id="currentPassword" class="form-control" placeholder="Masukan Password Lama" >
								</div>

								<div class="form-group">
									<label for="newPassword">Password Baru</label>
									<input type="text" name="newPassword" id="newPassword" class="form-control" placeholder="Masukan Password Baru" >
								</div>		

                                <div class="form-group">
									<label for="confirmPassword">Konfirmasi Password Baru</label>
									<input type="text" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Konfirmasi Password Baru" >
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

	

	<!-- Script Files -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>