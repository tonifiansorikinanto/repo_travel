<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'core/system.php';

$show_data_tbSiluet = show_data_tbSiluet();
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

 	while($data = mysqli_fetch_assoc($show_data_tbSiluet)){
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

