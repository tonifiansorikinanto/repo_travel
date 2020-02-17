<?php

require_once 'core/system.php';

if(isset($_SESSION["user_access"])){

if(isset($_GET['nomer']) && isset($_GET['tb'])){

	$table_name = $_GET['tb'];
	$nomer 			= $_GET['nomer'];

	$_SESSION['report_message'] = report_message("success", "Berhasil Menghapus Data!");

	if($table_name == 'tb1'){
		delete_data_tbSiluet($nomer);
		header('Location: admin-siluet');
	}else{
		delete_data_tbLiza($nomer);
		header('Location: admin-liza');
	}
}else{
	header('Location: login-admin');
}

}else{
	header('Location: login-admin');
}

?>