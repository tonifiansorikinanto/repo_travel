<?php

// Berfungsi untuk login user ke halaman admin
function login_admin($username, $password){
	global $connect;

	$password = md5($password);

	$query = "SELECT * FROM tb_admin WHERE username='$username' AND password='$password'";
	$result = mysqli_query($connect, $query);
	
	if(mysqli_num_rows($result) != 0)return true;
	else return false;
}

function cek_user_supervisor($password){
	global $connect;

	$password = md5($password);

	$query = "SELECT * FROM tb_supervisor WHERE password='$password'";
	$result = mysqli_query($connect, $query);
	
	if(mysqli_num_rows($result) != 0)return true;
	else return false;
}

function cek_user_cs($password){
	global $connect;

	$password = md5($password);

	$query = "SELECT * FROM tb_cs WHERE password='$password'";
	$result = mysqli_query($connect, $query);
	
	if(mysqli_num_rows($result) != 0)return true;
	else return false;
}

?>