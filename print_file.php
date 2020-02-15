<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'core/system.php';


$id_parameter = $_GET['id'];

if(isset($_GET['tb'])){
  $table_name = $_GET['tb'];

  if($table_name == "tb1"){
    $show_data_tb = show_dataPrint_tbSiluet($id_parameter);
  }else{
    $show_data_tb = show_dataPrint_tbLiza($id_parameter);
  }
}

$no = 1;

$mpdf = new \Mpdf\Mpdf();

$html = '
<!DOCTYPE html>
<html>
<head>
	<link href="assets/css/print.css" rel="stylesheet">

  <style>
    body{
      font-size:10px;
    }

    table{
      letter-spacing:1.01px;
    }

    tr:nth-child(even){
      background-color: #6D6D6D;
      
    }
    tr:nth-child(even) td{
      color: #f1f1f1;
    }
  </style>
</head>
<body>

<h1>Tabel Data Penumpang</h1>

<table cellspacing="0" cellpadding="10">
  <thead>
    <tr style="background-color:#4C4C4C;">
      <th style="color:#FFFFFF;">#</th>
      
      <th style="color:#FFFFFF; width: 10px;">Tgl Berangkat</th>
      <th style="color:#FFFFFF; width: 10px;">Jam Berangkat</th>
      <th style="color:#FFFFFF;">Tujuan</th>
      <th style="color:#FFFFFF; width: 10px;">Jumlah Pnmpg</th>
      <th style="color:#FFFFFF;">Nama</th>
      <th style="color:#FFFFFF;">Alamat Jemput</th>
      <th style="color:#FFFFFF;">Nomer HP</th>
      <th style="color:#FFFFFF; width: 10px;">Lunas / BA</th>
      <th style="color:#FFFFFF;">Harga Khusus</th>
      <th style="color:#FFFFFF;">Keterangan</th>
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
 		<tr class="row_table">
 			<td> ' . $no++ . '</td>
      <td> ' . $data["tanggal"] . '</td>
      <td> ' . $data["jam"] . '</td>
      <td> ' . $data["tujuan"] . '</td>
 			<td> ' . $data["penumpang"] . '</td>
 			<td> ' . $data["nama"] . '</td>
 			<td style="text-align: left;"> ' . $data["jemput"] . '</td>
      <td> ' . $data["nomer"] . '</td>
 			<td> ' . $dataLunas . '</td>
 			<td> ' . $data["harga_khusus"] . '</td>
      <td style="text-align: left;"> ' . $data["ket"] . '</td>
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

