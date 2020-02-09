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
    <tr style="background-color:#4C4C4C;">
      <th style="color:#FFFFFF;">#</th>
      <th style="color:#FFFFFF;">Nomer HP</th>
      <th style="color:#FFFFFF;">Nama</th>
      <th style="color:#FFFFFF;">Alamat Jemput</th>
      <th style="color:#FFFFFF;">Tgl Berangkat</th>
      <th style="color:#FFFFFF;">Jam Berangkat</th>
      <th style="color:#FFFFFF;">Tujuan</th>
      <th style="color:#FFFFFF;">Jumlah Penumpang</th>
      <th style="color:#FFFFFF;">Lunas / BA</th>
      <th style="color:#FFFFFF;">Harga Khusus</th>
    </tr>
  </thead>
 	<tbody>';

 	while($data = mysqli_fetch_assoc($show_data_tb)){
    $dataLunas = $data["lunas"];

    if($dataLunas == 1){
      $dataLunas = "Lunas";
    }else{
      $dataLunas = "BA";
    }

 		$html .= '
 		<tr>
 			<td> ' . $no++ . '</td>
 			<td class="text_center"> ' . $data["nomer"] . '</td>
 			<td class="text_center"> ' . $data["nama"] . '</td>
 			<td class="text_center"> ' . $data["jemput"] . '</td>
 			<td class="text_center"> ' . $data["tanggal"] . '</td>
 			<td style="text-align:center"> ' . $data["jam"] . '</td>
 			<td class="text_center"> ' . $data["tujuan"] . '</td>
      <td class="text_center"> ' . $data["penumpang"] . '</td>
 			<td class="text_center"> ' . $dataLunas . '</td>
 			<td class="text_center"> ' . $data["harga_khusus"] . '</td>
 		</tr>

    <tr style="background-color:#D5D5D5">
      <td colspan="1"></td>
      <td class="text_center"><b>Keterangan</b></td>
      <td colspan="10" align="left"> ' . $data["ket"] . '</td>
    </tr>
 		';
 	}

$html .= '
 	</tbody>
 </table>

</body>
</html>';

$mpdf->AddPage('L');
$mpdf->WriteHTML($html);
$mpdf->Output('Tabel Data Penumpang', 'I');



?>

