<?php

require_once 'core/system.php';

if(isset($_SESSION["user_access"])){

if(isset($_GET['nomer']) && isset($_GET['tb'])){

	$table_name = $_GET['tb'];
	$nomer 			= $_GET['nomer'];

	if($table_name == 'tb1'){
		delete_data_tbSiluet($nomer);
		header('Location: admin.php');
	}else{
		delete_data_tbLiza($nomer);
		header('Location: admin.php');
	}
}

}else{
	header('Location: login-admin.php');
}

?>