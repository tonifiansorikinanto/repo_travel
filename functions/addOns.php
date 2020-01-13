<?php

function report_message($type, $text){
	return '
		<div class="report-message">
			<img src="assets/image/icon/'. $type . '.png" class="image-report-message">
			<span>'. $text .'</span> 
		</div>';
}

?>