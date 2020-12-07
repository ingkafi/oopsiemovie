<?php 
require_once('db.php');
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Oopsie Movie</title>
        <link rel="stylesheet" href="stylesheets.css">
		<link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/ca0905f6a5.js"></script>
    </head>
    <body>
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
    </div>
    <div class="lesson-wrapper">
            <div class="heading" style="color: #eaeff3;"> 
                <h2><b>Cari Film</b></h2>
			</div>
            <form action="home.php" method="GET" class="form-inline my-2 my-lg-0 center">
		      <input class="form-control mr-sm-2" id="autocomplete" type="text" name="search" placeholder="Search" aria-label="Search" style="width:600px;">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" ><i class="fas fa-search"></i></button>
			</form>
			<br>
			<div>

			</div>
			<div class="panel-body">
				<a href="home.php"  > <button class="btn signup">Semua Kategori </button> </a>
				<?php 
				$sql = "SELECT nama FROM kategori";
				$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
				while($category = mysqli_fetch_assoc($execution)){
					?>
					<a href="home.php?kategori=<?php echo $category['nama'];?>" class="btn signup" ><?php echo $category['nama']; ?></a>
					<?php
				}
				?>
			</div>
			<div class="heading"></div>
            <div class="row">
			<br><br><br><br><br>
				<div>
					<?php 
					$page = 1;
					$query = "";
					if(isset($_GET['search'])){
						if(empty($_GET['search'])){
							header("Location: home.php");
						}else{
							$search = $_GET['search'];
							$query = "SELECT * FROM post WHERE tgl_insert LIKE '%$search%' OR judul LIKE '%$search%' OR '$category' LIKE '%$search%' ";
						}
					}elseif(isset($_GET['kategori'])){
						$query = "SELECT * FROM post INNER JOIN kategori ON post.idkategori=kategori.idkategori WHERE kategori.nama = '$_GET[kategori]'";				}
					else{
						$query = "SELECT * FROM post ORDER BY tgl_insert DESC";
					}
					$execution = mysqli_query($db, $query) or die(mysqli_error($db));
					if($execution){
						if(mysqli_num_rows($execution) > 0){
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
								$result_id = $result['idpost'];
								$result_date = $result['tgl_insert'];
								$result_title = $result['judul'];
								$result_category = $namakat;
								$result_image = $result['file_gambar'];
								$result_content = substr($result['isi_post'], 0,100) . '.....';
								?>
								<div class="card blog_post">
									<img src="penulis/Upload/Image/<?php echo $result_image; ?>" class="card-img-top blog-img" alt="">
									<div class="card-body">
										<h3 class="card-title"><?php echo htmlentities($result_title); ?></h3>
										<p class="card-text extraText"><span><i class="far fa-edit"></i> <?php echo htmlentities($result_category); ?></span><span><br><i class="far fa-calendar-alt"></i> <?php echo htmlentities($result_date); ?></span><span><br><i class="fas fa-user"></i> <?php echo htmlentities($result_author); ?></span></p>
										<p class="card-text blogPara"><?php echo htmlentities($result_content); ?></p>
										<a href="single.php?idpost=<?php echo $result_id;?>" class="card-link btn btn-info readMore"><i class="fas fa-hand-point-right"></i> Read More</a>
									</div>
								</div>
								
								<?php
							}
						}else{
							echo "<span class='lead ml-3' style='color:white; font-weight:bold;'>No results Found !!!</span>";
						}
					}else{

                    }
					?>
				</div>
				<br><br><br><br><br>
			</div>
			
		<footer class="container-fluid">
			<p>COPYRIGHT © Oopsie Movie</p>
		</footer>
	</div>
   </body>
</html>