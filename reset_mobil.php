<?php

require_once 'core/system.php';

if(isset($_SESSION["user_access"])){

	if(isset($_GET['id_mobil']) && isset($_GET['tb'])){
		$data_tb = $_GET['tb'];
		$data_id = $_GET['id_mobil'];

		reset_data_mobil_siluet($data_id);
		if($data_tb == "tb1"){
			header('Location: data-mobil-siluet');
		}else{
			header('Location: data-mobil-liza');
		}

	}else{
		$_SESSION['report_message'] = report_message("error", "Gagal Mereset Data !");

		if($_GET['tb'] == "tb1"){
			header('Location: data-mobil-siluet');
		}else{
			header('Location: data-mobil-liza');
		}
		
	}

}

?>