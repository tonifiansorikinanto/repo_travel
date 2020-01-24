<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'core/system.php';


if(isset($_GET['tb'])){
  $table_name = $_GET['tb'];

  if($table_name == "tb1"){
    $show_data_tb = show_data_tbSiluet();
  }else{
    $show_data_tb = show_data_tbLiza();
  }
}

if(isset($_GET['caritb1'])){
  $caritb1 = $_GET['caritb1'];
  $show_data_tb = search_data_tbSiluet($caritb1);
}else if(isset($_GET['caritb2'])){
  $caritb2 = $_GET['caritb2'];
  $show_data_tb = search_data_tbLiza($caritb2);
}
$no = 1;

$mpdf = new \Mpdf\Mpdf();

$html = '
<!DOCTYPE html>
<html>
<head>
	<link href="assets/css/print.css" rel="stylesheet">
</head>
<body>

<h1>Tabel Data Penumpang</h1>

<table cellspacing="0" cellpadding="10">
  <thead>
    <tr>
      <th>#</th>
      <th>Nomer HP</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Tgl Berangkat</th>
      <th>Jam Berangkat</th>
      <th>Tujuan</th>					      
      <th>Lunas / BA</th>
      <th>Harga Khusus</th>
    </tr>
  </thead>
 	<tbody>';

 	while($data = mysqli_fetch_assoc($show_data_tb)){
 		$html .= '
 		<tr>
 			<td> ' . $no++ . '</td>
 			<td class="text_center"> ' . $data["nomer"] . '</td>
 			<td class="text_center"> ' . $data["nama"] . '</td>
 			<td class="text_center"> ' . $data["alamat"] . '</td>
 			<td class="text_center"> ' . $data["tanggal"] . '</td>
 			<td style="text-align:center"> ' . $data["jam"] . '</td>
 			<td class="text_center"> ' . $data["tujuan"] . '</td>
 			<td class="text_center"> ' . $data["lunas"] . '</td>
 			<td class="text_center"> ' . $data["harga_khusus"] . '</td>
 		</tr>
 		';
 	}

$html .= '
 	</tbody>
 </table>

</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('Tabel Data Penumpang', 'I');



?>

