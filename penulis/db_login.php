<?php
	$db_host='sql101.epizy.com';
	$db_username='epiz_27046967';
	$db_password='HqdzFSAU5i0bg1u';
	$db_database='epiz_27046967_db_blog';

$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){
    die("Could not connect to the database : <br/>". $db->connect_error);
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>