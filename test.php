<?php 

$data = "Saya mabok, Mobil = Avanza";    
$whatIWant = substr($data, strpos($data, "= ") + 1);    
echo $whatIWant;

?>