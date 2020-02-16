<?php 

$data = "Saya mabok, Mobil = Avanza";    
$whatIWant = substr($data, strpos($data, "= ") + 1);
echo $whatIWant;

echo str_replace("11223344", "", "REGISTER 11223344 here");

?>