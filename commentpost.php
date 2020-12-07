
<?php 
session_start();
require('db.php');

if(isset($_POST['submit'])){
	if(!empty($_POST['submit'])){
		date_default_timezone_set('Asia/Manila');
		$time = time();
		$dateTime = strftime('%Y-%m-%d %H:%M:%S ',$time);
		$postid = $_GET['id'];
		$comment = $_POST['comment'];

		$query = " SELECT idpenulis FROM penulis WHERE email='".$_SESSION['email']."'";
		$result = $db->query($query);
		$row = $result->fetch_object();
		$idpenulis = $row->idpenulis;

		if($idpenulis == ""){
			$idpenulis = 0;
		}
		$sql = "INSERT INTO komentar (idpenulis, tgl_update, isi, idpost, email, status) VALUES ('$idpenulis', '$dateTime','$comment', '$postid', '".$_SESSION['email']."', 'approved')";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			header("Location: single.php?idpost=$postid");
		}
		else{
			echo '<script>alert("Something Went Wrong!!!")</script>';
		}

	}
}
?>