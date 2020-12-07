<?php

	$server='sql101.epizy.com';
	$username='epiz_27046967';
	$password='HqdzFSAU5i0bg1u';
	$database='epiz_27046967_db_blog';
	$db = mysqli_connect($server,$username,$password,$database);
	// Check connection
	if (!$db) {
		die("Connection failed: " . mysqli_connect_error());
	}
	// else{
	// 	echo 'connected';
	// }

?>