
<?php 
require('db.php');
require_once('db_login.php');
session_start();
if(!isset($_SESSION['penulis_id']) || !isset($_SESSION['penulis_id']))
{
	header("Location:login.php");
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
				<h1 class="sidebar-heading2">Dashboard</h1>
				<div class="row">
					<!-- Navbar section -->
					<?php include 'sidemenu.php';?>

					<!-- Content Section -->
					<div class="col-sm-10">

						<?php 
						
						$email = $_SESSION['email'];
						$sql ="SELECT * FROM post INNER JOIN penulis ON penulis.idpenulis=post.idpenulis  WHERE penulis.email = '".$email."' ";
						$exec = mysqli_query($db, $sql) or die(mysqli_error($db));
						$postNo = 1;
						if(mysqli_num_rows($exec) < 1){
							?>
							<p style="font-size: 20px; color: #fff; background-color: #111; padding: 15px;">You Have 0 Post for the Moment</p>
							<a href="newpost.php" class="btn btn-info">ADD POST</a>
							<?php
						}
						else
						{
							?>
							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th>Nomor Post</th>
										<th>Tanggal Post</th>
										<th>Judul</th>
										<th>Gambar</th>
										<th>Aksi</th>
										<th>Rincian</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									while ($result = mysqli_fetch_assoc($exec)){
										$post_id = $result['idpost'];
										$post_date = $result['tgl_insert'];
										$post_title = $result['judul'];
										$author = $result['idpenulis'];
										$image = $result['file_gambar'];
										?>

										<tr>
											<td><?php echo $postNo;?></td>
											<td><?php echo $post_date;?></td>
											<td>
												<?php 
												if(strlen($post_title) > 20){
													echo substr($post_title, 0, 20) . '....';
												}else{
													echo $post_title;
												}
												?></td>
											<td style="width: 150px;"><?php echo "<img src= 'Upload/Image/$image'>"?></td>
											<td><a href="editpost.php?post_id=<?php echo $post_id;?>"><button class="btn btn-warning"><i class="far fa-edit"></i></button></a> | <a href="deletepost.php?idpost=<?php echo $post_id;?>"><button class="btn btn-danger"><i class="far fa-trash-alt"></i></button></a></td>
											<td><a href="../single.php?idpost=<?php echo $post_id;?>"><button class="btn btn-info"><i class="fas fa-eye"></i>&nbsp;Live Preview</button></a></td>
										</tr>
										<?php $postNo++; 
									} ?>
									
								</tbody>
							</table>
						<?php 
					}
						
						?>

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