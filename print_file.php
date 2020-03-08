<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'core/system.php';

$id_parameter = "";

if(isset($_GET['id']) && $_GET['id'] != ""){
  $id_parameter = $_GET['id'];

  if ($_GET['tb'] == "tb1"){
    $nama_tabel = "Siluet";
  } else {
    $nama_tabel = "Liza";
  }

  if(isset($_GET['tb'])){
    $table_name = $_GET['tb'];

    if($table_name == "tb1"){
      $show_data_tb = show_dataPrint_tbSiluet($id_parameter);

      while($data_cek = mysqli_fetch_assoc($show_data_tb)){
        $id_mobil = $data_cek['id_mobil'];
        if ($id_mobil == ''){
         $_SESSION['report_message'] = report_message("error", "Ada client yang tidak mendapatkan mobil!");
         header('Location: admin-siluet');
        }
      }

      ubahStatusPrint_tbSiluet($id_parameter);

    }else{
      $show_data_tb = show_dataPrint_tbLiza($id_parameter);

      while($data_cek = mysqli_fetch_assoc($show_data_tb)){
        $id_mobil = $data_cek['id_mobil'];
        if ($id_mobil == ''){
         $_SESSION['report_message'] = report_message("error", "Ada client yang tidak mendapatkan mobil!");
         header('Location: admin-liza');
        }
      }

      ubahStatusPrint_tbLiza($id_parameter);

    }
  }
}

while($data1 = mysqli_fetch_assoc($show_data_tb)){
  $id_mobil = $data1['id_mobil'];
}

$panggil_mobil = show_ondata_mobil_siluet($id_mobil);

while($data2 = mysqli_fetch_assoc($panggil_mobil)){
  $nama_mobil = $data2['mobil'];
  $plat = $data2['plat_nomor'];  
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

    .row{
      display: flex;
      margin-top: 10px;
    }

    .row-ttd{
      flex: 30%;
    }
  </style>

</head>
<body>
<h1>Tabel Data Penumpang ' . $nama_tabel . ' • ' . $nama_mobil . ' • ' . $plat . '</h1>

<table cellspacing="0" cellpadding="10" style="width:100%">
  <thead>
    <tr style="background-color:#4C4C4C;">
      <th style="color:#FFFFFF; width: 10px;">#</th>
      
      <th style="color:#FFFFFF; width: 10px;">Tgl Berangkat</th>
      <th style="color:#FFFFFF; width: 10px;">Jam Berangkat</th>
      <th style="color:#FFFFFF;">Tujuan</th>
      <th style="color:#FFFFFF; width: 10px;">Jumlah Pnmpg</th>
      <th style="color:#FFFFFF;">Nama</th>
      <th style="color:#FFFFFF;">Alamat Jemput</th>
      <th style="color:#FFFFFF; width: 10px;">Nomer HP</th>
      <th style="color:#FFFFFF; width: 10px;">Lunas / BA</th>
      <th style="color:#FFFFFF; width: 10px;">Harga Khusus</th>
      <th style="color:#FFFFFF;">Keterangan</th>
    </tr>
  </thead>
 	<tbody>';

  if(isset($_GET['id']) && $_GET['id'] != "" && isset($_GET['tb']) && $_GET['tb'] != ""){

   	while($data = mysqli_fetch_assoc($show_data_tb)){
      $dataLunas = $data["lunas"];

      if($dataLunas == 1){
        $dataLunas = "Lunas";
      }else{
        $dataLunas = "BA";
      }

      $data_alamat = $data['jemput'];

      if ($data['jemput'] != ''){
        $data_alamat =  $data['jemput'];
      } else {
        $data_alamat = $data['alamat'];
      }

   		$html .= '
   		<tr class="row_table">
   			<td> ' . $no++ . '</td>
        <td> ' . $data["tanggal"] . '</td>
        <td> ' . $data["jam"] . '</td>
        <td> ' . $data["tujuan"] . '</td>
   			<td> ' . $data["penumpang"] . '</td>
   			<td> ' . $data["nama"] . '</td>
   			<td style="text-align: left;"> ' . $data_alamat . '</td>
        <td> ' . $data["nomer"] . '</td>
   			<td> ' . $dataLunas . '</td>
   			<td> ' . $data["harga_khusus"] . '</td>
        <td style="text-align: left;">' . $data["ket"] . '</td>
   		</tr>
   		';
   	}
  }else{
    $html .= '
    <tr class="row_table">
      <td colspan="11"><b>Tidak ada data yang dipilih</b></td>
    </tr>
    ';
  }

$html .= '
 	</tbody>
 </table>';

$html .= '
  <table cellspacing="0" cellpadding="10" style="width:100%; margin-top:40px;">
  <thead>
    <tr style="background-color:#4C4C4C;">
      <th style="color:#FFFFFF; width: 10px;">#</th>
      
      <th style="color:#FFFFFF; width: 10px;">Tgl Berangkat</th>
      <th style="color:#FFFFFF; width: 10px;">Jam Berangkat</th>
      <th style="color:#FFFFFF;">Tujuan</th>
      <th style="color:#FFFFFF; width: 10px;">Jumlah Pnmpg</th>
      <th style="color:#FFFFFF;">Nama</th>
      <th style="color:#FFFFFF;">Alamat Jemput</th>
      <th style="color:#FFFFFF; width: 100px;">Nomer HP</th>
      <th style="color:#FFFFFF; width: 10px;">Lunas / BA</th>
      <th style="color:#FFFFFF; width: 70px;">Harga Khusus</th>
      <th style="color:#FFFFFF;">Keterangan</th>
    </tr>
  </thead>
  <tbody>
    <tr class="row_table">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: left; height:20px;"></td>
    </tr>
    <tr class="row_table">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: left; height:20px;"></td>
    </tr>
    <tr class="row_table">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: left; height:20px;"></td>
    </tr>

    ';

    if($nama_tabel == "Liza"){

    $html .= '
    <tr class="row_table">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: left; height:20px;"></td>
    </tr>
    <tr class="row_table">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: left; height:20px;"></td>
    </tr>';
  }

$html .= '
  </tbody>
 </table>
';

$html .= '
  <table cellspacing="0" cellpadding="10" style="width:100%; margin-top:40px;">
  <thead>
    <tr style="background-color:#4C4C4C;">
      <th style="color:#FFFFFF; width: 10px;">#</th>
      
      <th style="color:#FFFFFF; width: 10px;">Tgl Berangkat</th>
      <th style="color:#FFFFFF; width: 10px;">Jam Berangkat</th>
      <th style="color:#FFFFFF;">Tujuan</th>
      <th style="color:#FFFFFF; width: 10px;">Jumlah Pnmpg</th>
      <th style="color:#FFFFFF;">Nama</th>
      <th style="color:#FFFFFF;">Alamat Jemput</th>
      <th style="color:#FFFFFF; width: 100px;">Nomer HP</th>
      <th style="color:#FFFFFF; width: 10px;">Lunas / BA</th>
      <th style="color:#FFFFFF; width: 70px;">Harga Khusus</th>
      <th style="color:#FFFFFF;">Keterangan</th>
    </tr>
  </thead>
  <tbody>
    <tr class="row_table">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: left; height:20px;"></td>
    </tr>
    <tr class="row_table">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: left; height:20px;"></td>
    </tr>
  </tbody>
 </table>
';


$html .= '<div class="row">
  <div class="col-ttd" align="center">
    <h3>Malang, ___ ____________ _____</h3>
    <h3 style="margin-bottom: 80px; margin-top: 1px; padding-top: 1px;">Petugas Penerima</h3>
    <h3>(_______________________________)</h3>
  </div>
 </div>

</body>
</html>';

$mpdf->AddPage('L');
$mpdf->WriteHTML($html);
$mpdf->Output('Tabel Data Penumpang', 'I');



?>

