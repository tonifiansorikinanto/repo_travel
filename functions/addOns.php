<?php

function report_message($type, $text){
	return '
		<div class="report-message">
			<img src="assets/image/icon/'. $type . '.png" class="image-report-message">
			<span>'. $text .'</span> 
		</div>';
}

function escape($data){
	global $connect;
	$data = htmlentities($data);
	return mysqli_real_escape_string($connect, $data);
}

?>