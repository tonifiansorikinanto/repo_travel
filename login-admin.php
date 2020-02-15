<?php

require_once 'core/system.php';

if(!isset($_SESSION["user_access"])){

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(!empty(trim($username)) && !empty(trim($password))){
		if(login_admin($username, $password)){
			$_SESSION["user_access"] = $username;
			$_SESSION['report_message'] = report_message("success", "Berhasil Masuk");
			header('Location: admin-siluet');
		}else{
			// echo '<script>alert("Hello! I am an alert box!!");</script>';
			$_SESSION['report_message'] = report_message("error", "Data tidak terdaftar");
		}
	}else{
		$_SESSION['report_message'] = report_message("error", "Data Harus Terisi !");
	}
}

?>


<!DOCTYPE html>
	<html lang="en">

	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta http-equiv="x-ua-compatible" content="ie=edge">
	  <title>Magi | Web Developer | Admin</title>
	  <!-- Font Awesome -->
	  <link href="assets/css/all.css" rel="stylesheet">
	  <!-- Bootstrap core CSS -->
	  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
	  <!-- Material Design Bootstrap -->
	  <link href="assets/css/mdb.min.css" rel="stylesheet">
	  <!-- Your custom styles (optional) -->
	  <link href="assets/css/style.css" rel="stylesheet">

	  <link rel="shortcut icon" type="image/png" href="assets/image/logo/icon.png"/>

	</head>

<body style="background: #aa4b6b;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #3b8d99, #6b6b83, #aa4b6b);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #3b8d99, #6b6b83, #aa4b6b); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
">
<style>
  .border-crew {
    border-style: solid;
    border-width: 1.5px;    
    border-color: #E94ADC;
    border-radius: 15px;
  }
  .mt-ghost{
  	margin-top: 0px;
  }
  .img-size{
  	width: 70%;
  	height: 70%;
  }
  @media (max-width: 768px){        
    .mt-ghost{margin-top: 50px;}	
  }  
  .mid{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);    
  }       
</style>
	<div class="container-fluid mid">
	   <div class="row justify-content-center">
	     <div class="col-md-10">
		  	<div class="row justify-content-center align-items-center">	           
          <div class="col-md-4 py-5 border-crew z-depth-2">
          	<form class="text-center p-3" action="" method="post">
          	<!-- header -->
						<i class="fas fa-user-cog fa-7x text-white mb-4"></i>
						<p class="h4 mb-4 white-text">Login Admin</p>
						<!-- header -->

						<input style=" border-radius: 15px;" type="text" id="defaultLoginFormEmail" class="form-control mb-4 text-center" placeholder="User" name="username" autocomplete="off" spellcheck="false" maxlength="50">
						<input type="password" id="defaultLoginFormPassword" style=" border-radius: 15px;" class="form-control mb-4 text-center" placeholder="Password" name="password" spellcheck="false" maxlength="50">
						<button name="submit" class="btn btn-secondary btn-md" style="width: 130px; border-radius: 40px;" type="submit">Login</button>											    
						</form>
					</div>
	      </div>                
	     </div>
	   </div>
	</div>

<?php

if(isset($_SESSION['report_message'])){
	echo $_SESSION['report_message'];
	unset($_SESSION['report_message']);
}

?>

<?php 

}else{
	header('Location: admin-siluet');
}

?>