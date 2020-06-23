<?php 

// $conn = mysqli_connect("localhost", "thedarks_movie", "thedarknight", "thedarks_movie");
$conn = mysqli_connect("localhost", "root", "", "shortlink");

function query($query){
	global $conn;
	$data = mysqli_query($conn ,$query);
	// return $data;
}



?>