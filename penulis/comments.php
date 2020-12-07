<?php 
require('db.php');
session_start();
if(!isset($_SESSION['penulis_id']))
{
	header("Location:login.php");
}
?>

<?php 
if(isset($_GET['Approve_ID'])){
	if(!empty($_GET['Approve_ID'])){
		$sql = "UPDATE komentar SET status = 'approved' WHERE idkomentar = '$_GET[Approve_ID]'";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			echo '<script>alert("COMMENT APPROVED")</script>';
			header("Location: comments.php");
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
			header("Location: comments.php");
		}
	}
	else{
		header("Location: comments.php");
	}
}

if(isset($_GET['Unapprove_ID'])){
	if(!empty($_GET['Unapprove_ID'])){
		$sql = "UPDATE komentar SET status = 'unapprove' WHERE idkomentar = '$_GET[Unapprove_ID]'";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			echo '<script>alert("COMMENT UNAPPROVED")</script>';
			header("Location: comments.php");
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
			header("Location: comments.php");
		}
	}
	else{
		header("Location: comments.php");
	}
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
				<h1 class="sidebar-heading2">Manage Comments</h1>
				<div class="row">
					<!-- Navbar section -->
					<?php include 'sidemenu.php';?>

					<!-- Content Section -->
					<div class="col-sm-10 content">

						<!-- Approve Comments -->
						<?php 
                        $sql = "SELECT * FROM komentar INNER JOIN post ON komentar.idpost=post.idpost WHERE komentar.status = 'approved' AND post.idpenulis='".$_SESSION['penulis_id']."' ORDER BY komentar.tgl_update";
						$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
						$postNo = 1;
						?>
							<h3 class="post-heading">Approved</h3>

							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th>No.</th>
                                        <th>Post</th>
										<th>Comment</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while($result = mysqli_fetch_assoc($execution)){
										$query = "SELECT judul from post WHERE idpost = '".$result['idpost']."'";
										$nama = $db->query($query);
										$row = $nama->fetch_object();
										$judul = $row->judul;
										$commentid = $result['idkomentar'];
                                        $title = $judul;
										$commentcontent = $result['isi'];
										$commentstatus = $result['status'];
										?>
										<tr>
											<td><?php echo $postNo; ?></td>
                                            <td><?php echo $title; ?></td>
											<td><?php echo $commentcontent; ?></td>
											<td><?php echo $commentstatus; ?></td>
											<td><a href="comments.php?Unapprove_ID=<?php echo $commentid;?>"><button class="btn btn-danger"><i class="far fa-thumbs-down"></i></button></a></td>
										</tr>
										<?php
										$postNo++;
									}?>
						

								</tbody>
							</table>
						<!-- Approve Comments ENDS -->

						<!-- Approve Comments -->
						<?php 
                        $sql = "SELECT * FROM komentar INNER JOIN post ON komentar.idpost=post.idpost WHERE komentar.status = 'unapprove' AND post.idpenulis='".$_SESSION['penulis_id']."' ORDER BY komentar.tgl_update";
						$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
						$postNo = 1;
						?>
							<h3 class="post-heading">Unapproved Comments</h3>

							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th>No.</th>
										<th>Post</th>
										<th>Comment</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while($result = mysqli_fetch_assoc($execution)){
										$query = "SELECT judul from post WHERE idpost = '".$result['idpost']."'";
										$nama = $db->query($query);
										$row = $nama->fetch_object();
										$judul = $row->judul;
										$commentid = $result['idkomentar'];
										$title = $judul;
										$commentcontent = $result['isi'];
										$commentstatus = $result['status'];
				
										?>
										<tr>
											<td><?php echo $postNo; ?></td>
											<td><?php echo $title; ?></td>
											<td><?php echo $commentcontent; ?></td>
											<td><?php echo $commentstatus; ?></td>
											<td><a href="comments.php?Approve_ID=<?php echo $commentid;?>"><button class="btn btn-success"><i class="far fa-thumbs-up"></i></button></a></td>
										</tr>
										<?php
										$postNo++;
									}?>
						

								</tbody>
							</table>
						<!-- Approve Comments ENDS -->
						


						<?php include 'footer.php';?>
					</div>
				</div>
			</div>
		</div>
		<!-- Sidebar ENDS -->
		
	</div>


	<!-- Script Files -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>