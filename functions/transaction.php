<?php

function cek_mobil_siluet($jam_modal, $tgl_cari){
	global $connect;

	$query 	= "SELECT * FROM tb_jadwal_siluet, tb_mobil_siluet WHERE tb_jadwal_siluet.tanggal LIKE '%$tgl_cari%' AND tb_jadwal_siluet.jam LIKE '%$jam_modal%' 
				AND tb_jadwal_siluet.id_mobil = tb_mobil_siluet.id_mobil";
	$result = mysqli_query($connect, $query);

	return $result;
}

function cek_mobil_kosong_siluet($jam_modal, $tgl_cari){
	global $connect;

	$query 	= "SELECT * FROM tb_jadwal_siluet, tb_mobil_siluet WHERE  tb_jadwal_siluet.id_mobil != tb_mobil_siluet.id_mobil";
	$result = mysqli_query($connect, $query);

	return $result;
}

function cek_mobil_kosong_liza($jam_modal, $tgl_cari){
	global $connect;

	$query 	= "SELECT * FROM tb_jadwal_liza, tb_mobil_liza WHERE  tb_jadwal_liza.id_mobil != tb_mobil_liza.id_mobil";
	$result = mysqli_query($connect, $query);

	return $result;
}

function cek_mobil_liza($jam_modal, $tgl_cari){
	global $connect;

	$query 	= "SELECT * FROM tb_jadwal_liza, tb_mobil_liza WHERE tb_jadwal_liza.tanggal LIKE '%$tgl_cari%' AND tb_jadwal_liza.jam LIKE '%$jam_modal%' 
				AND tb_jadwal_liza.id_mobil = tb_mobil_liza.id_mobil";
	$result = mysqli_query($connect, $query);

	return $result;
}


function edit_mobil_siluet($id, $mobil, $plat, $seat){
	global $connect;

	$id = escape($id);
	$mobil = escape($mobil);
	$plat = escape($plat);
	$seat = escape($seat);

	$query = "UPDATE tb_mobil_siluet SET mobil='$mobil', plat_nomor='$plat', penumpang='$seat' WHERE id_mobil='$id'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function edit_mobil_liza($id, $mobil, $plat, $seat){
	global $connect;

	$id = escape($id);
	$mobil = escape($mobil);
	$plat = escape($plat);
	$seat = escape($seat);

	$query = "UPDATE tb_mobil_liza SET mobil='$mobil', plat_nomor='$plat', penumpang='$seat' WHERE id_mobil='$id'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function delete_data_mobilSiluet($id_mobil){
	global $connect;

	$id_mobil = escape($id_mobil);
	$query 	= "DELETE FROM tb_mobil_siluet WHERE id_mobil = '$id_mobil'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function delete_data_mobilLiza($id_mobil){
	global $connect;

	$id_mobil = escape($id_mobil);
	$query 	= "DELETE FROM tb_mobil_liza WHERE id_mobil = '$id_mobil'";
	$result = mysqli_query($connect, $query);

	return $result;

}

function add_mobil_siluet($mobil, $plat, $penumpang){
	global $connect;

	$mobil = escape($mobil);
	$plat = escape($plat);
	$seat = escape($penumpang);

	$query = "INSERT INTO tb_mobil_siluet (mobil, plat_nomor, penumpang) VALUES ('$mobil', '$plat', '$seat')";
	$result = mysqli_query($connect, $query);
	return $result;
}

function add_mobil_liza($mobil, $plat, $penumpang){
	global $connect;

	$mobil = escape($mobil);
	$plat = escape($plat);
	$seat = escape($penumpang);

	$query = "INSERT INTO tb_mobil_liza (mobil, plat_nomor, penumpang) VALUES ('$mobil', '$plat', '$seat')";
	$result = mysqli_query($connect, $query);
	return $result;
}


function sum_seat_use_mobil_siluet($jam_modal, $tgl_cari){
	global $connect;

	$jam_modal = escape($jam_modal);
	$tgl_cari = escape($tgl_cari);

	$query 	= "SELECT SUM(seat_use) FROM tb_jadwal_siluet WHERE tanggal = '$tgl_cari' AND jam = '$jam_modal'";
	$result = mysqli_query($connect, $query);

	while($data = mysqli_fetch_assoc($result)){
		$dataOper = $data['SUM(seat_use)'];
	}

	return $dataOper;
}

function sum_seat_use_mobil_liza($jam_modal, $tgl_cari){
	global $connect;

	$jam_modal = escape($jam_modal);
	$tgl_cari = escape($tgl_cari);

	$query 	= "SELECT SUM(seat_use) FROM tb_jadwal_liza WHERE tanggal = '$tgl_cari' AND jam = '$jam_modal'";
	$result = mysqli_query($connect, $query);

	while($data = mysqli_fetch_assoc($result)){
		$dataOper = $data['SUM(seat_use)'];
	}

	return $dataOper;
}

function sum_seat_mobil_siluet(){
	global $connect;

	$query 	= "SELECT SUM(penumpang) FROM tb_mobil_siluet";
	$result = mysqli_query($connect, $query);

	while($data = mysqli_fetch_assoc($result)){
		$dataOper = $data['SUM(penumpang)'];
	}

	return $dataOper;
}

function sum_seat_mobil_liza(){
	global $connect;

	$query 	= "SELECT SUM(penumpang) FROM tb_mobil_liza";
	$result = mysqli_query($connect, $query);

	while($data = mysqli_fetch_assoc($result)){
		$dataOper = $data['SUM(penumpang)'];
	}

	return $dataOper;
}

function show_alldata_mobil_siluet(){
	global $connect;

	$query 	= "SELECT * FROM tb_mobil_siluet";
	$result = mysqli_query($connect, $query);

	return $result;
}

function show_alldata_mobil_liza(){
	global $connect;

	$query 	= "SELECT * FROM tb_mobil_liza";
	$result = mysqli_query($connect, $query);

	return $result;
}

function show_data_mobil($data){
	global $connect;

	$query 	= "SELECT * FROM tb_mobil WHERE id_mobil='$data'";
	$result = mysqli_query($connect, $query);

	while($data_mobil = mysqli_fetch_assoc($result)){
		$mobil = $data_mobil['mobil'];
	}

	return $mobil;
}

function show_data_tbSiluet(){
	global $connect;

	$query 	= "SELECT * FROM tb_siluet WHERE status_print = 0 ORDER BY tanggal, jam ASC";
	$result = mysqli_query($connect, $query);

	return $result;
}

function show_data_tbLiza(){
	global $connect;

	$query 	= "SELECT * FROM tb_liza WHERE status_print = 0 ORDER BY tanggal, jam ASC";
	$result = mysqli_query($connect, $query);

	return $result;
}

function show_data_onNomer_tbSiluet($nomer){
	global $connect;

	$nomer = escape($nomer);

	$query 	= "SELECT * FROM tb_siluet WHERE nomer='$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function show_data_onNomer_tbLiza($nomer){
	global $connect;

	$nomer = escape($nomer);

	$query 	= "SELECT * FROM tb_liza WHERE nomer='$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function show_data_onID_tbSiluet($nomer){
	global $connect;

	$nomer = escape($nomer);

	$query 	= "SELECT * FROM tb_siluet WHERE id='$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;	
}

function show_data_onID_tbLiza($nomer){
	global $connect;

	$nomer = escape($nomer);

	$query 	= "SELECT * FROM tb_liza WHERE id='$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;	
}

function show_dataPrint_tbSiluet($id_parameter){
	global $connect;

	$id_parameter = escape($id_parameter);

	$id_parameter = explode("-", $id_parameter);
	$id_parameter = implode(",", $id_parameter);

	// if($id_parameter == ''){
	//   $id_parameter = "''";
	// }

	$query 	= "SELECT * FROM tb_siluet WHERE id IN (". $id_parameter .") ORDER BY jam ASC";
	$result = mysqli_query($connect, $query);

	return $result;
}

function show_dataPrint_tbLiza($id_parameter){
	global $connect;

	$id_parameter = escape($id_parameter);

	$id_parameter = explode("-", $id_parameter);
	$id_parameter = implode(",", $id_parameter);

	$query 	= "SELECT * FROM tb_liza WHERE id IN (". $id_parameter .") ORDER BY jam ASC";
	$result = mysqli_query($connect, $query);

	return $result;
}

function search_data_tbSiluet($caritb1){
	global $connect;

	$caritb1 = escape($caritb1);

	$query 	= "SELECT * FROM tb_siluet WHERE tanggal LIKE '%$caritb1%' AND status_print = '0' ORDER BY jam ASC";
	$result = mysqli_query($connect, $query);

	return $result;
}

function search_data_tbLiza($caritb2){
	global $connect;

	$caritb2 = escape($caritb2);

	$query 	= "SELECT * FROM tb_liza WHERE tanggal LIKE '%$caritb2%' AND status_print = '0' ORDER BY jam ASC";
	$result = mysqli_query($connect, $query);

	return $result;
}



function add_data_tbSiluet($nomer, $nama, $alamat, $jemput, $tgl, $jam, $tujuan, $penumpang, $lunas, $harga_khusus, $ket){
	global $connect;

	$nomer 				= escape($nomer);
	$nama 				= escape($nama);
	$alamat 			= escape($alamat);
	$jemput 			= escape($jemput);
	$tgl 					= escape($tgl);
	$jam 					= escape($jam);
	$tujuan 			= escape($tujuan);
	$penumpang 		= escape($penumpang);
	$lunas 				= escape($lunas);
	$harga_khusus = escape($harga_khusus);
	$ket 					= escape($ket);

	if($penumpang > 1){

		for($x = 1; $x <= $penumpang; $x++){
			$query = "INSERT INTO tb_siluet (nomer, nama, alamat, jemput, tanggal, jam, tujuan, penumpang, lunas, harga_khusus, ket) VALUES 
			('$nomer', '$nama', '$alamat', '$jemput', '$tgl', '$jam', '$tujuan', '$penumpang', '$lunas', '$harga_khusus', '$ket')";

			mysqli_query($connect, $query);
		}

		return true;

	}else{

		$query = "INSERT INTO tb_siluet (nomer, nama, alamat, jemput, tanggal, jam, tujuan, penumpang, lunas, harga_khusus, ket) VALUES 
		('$nomer', '$nama', '$alamat', '$jemput', '$tgl', '$jam', '$tujuan', '$penumpang', '$lunas', '$harga_khusus', '$ket')";
		$result = mysqli_query($connect, $query);

		return $result;

	}
}

function add_data_tbLiza($nomer, $nama, $alamat, $jemput, $tgl, $jam, $tujuan, $penumpang, $lunas, $harga_khusus, $ket){
	global $connect;

	$nomer 				= escape($nomer);
	$nama 				= escape($nama);
	$alamat 			= escape($alamat);
	$jemput 			= escape($jemput);
	$tgl 					= escape($tgl);
	$jam 					= escape($jam);
	$tujuan 			= escape($tujuan);
	$penumpang 		= escape($penumpang);
	$lunas 				= escape($lunas);
	$harga_khusus = escape($harga_khusus);
	$ket 					= escape($ket);

	if($penumpang > 1){

		for($x = 1; $x <= $penumpang; $x++){
			$query = "INSERT INTO tb_liza (nomer, nama, alamat, jemput, tanggal, jam, tujuan, penumpang, lunas, harga_khusus, ket) VALUES 
			('$nomer', '$nama', '$alamat', '$jemput', '$tgl', '$jam', '$tujuan', '$penumpang', '$lunas', '$harga_khusus', '$ket')";

			mysqli_query($connect, $query);
		}

		return true;

	}else{

		$query = "INSERT INTO tb_liza (nomer, nama, alamat, jemput, tanggal, jam, tujuan, penumpang, lunas, harga_khusus, ket) VALUES ('$nomer', '$nama', '$alamat', '$jemput', '$tgl', '$jam', '$tujuan', '$penumpang', '$lunas', '$harga_khusus', '$ket')";
		$result = mysqli_query($connect, $query);

		return $result;

	}
}


function edit_data_tbSiluet($nomerEdit, $namaEdit, $alamatEdit, $jemputEdit, $tglEdit, $jamEdit, $tujuanEdit, $penumpangEdit, $lunasEdit, $harga_khususEdit, $ketEdit, $nomer){
	global $connect;

	$nomerEdit 				= escape($nomerEdit);
	$namaEdit 				= escape($namaEdit);
	$alamatEdit 			= escape($alamatEdit);
	$jemputEdit				= escape($jemputEdit);
	$tglEdit 					= escape($tglEdit);
	$jamEdit 					= escape($jamEdit);
	$tujuanEdit 			= escape($tujuanEdit);
	$penumpangEdit		= escape($penumpangEdit);
	$lunasEdit 				= escape($lunasEdit);
	$harga_khususEdit = escape($harga_khususEdit);
	$ketEdit 					= escape($ketEdit);

	$query = "UPDATE tb_siluet SET nomer='$nomerEdit', nama='$namaEdit', alamat='$alamatEdit', jemput='$jemputEdit', tanggal='$tglEdit', jam='$jamEdit',
						tujuan='$tujuanEdit', penumpang='$penumpangEdit', lunas='$lunasEdit', harga_khusus='$harga_khususEdit', ket='$ketEdit' WHERE id='$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function edit_data_tbLiza($nomerEdit, $namaEdit, $alamatEdit, $jemputEdit, $tglEdit, $jamEdit, $tujuanEdit, $penumpangEdit, $lunasEdit, $harga_khususEdit, $ketEdit, $nomer){
	global $connect;

	$nomerEdit 				= escape($nomerEdit);
	$namaEdit 				= escape($namaEdit);
	$alamatEdit 			= escape($alamatEdit);
	$jemputEdit				= escape($jemputEdit);
	$tglEdit 					= escape($tglEdit);
	$jamEdit 					= escape($jamEdit);
	$tujuanEdit 			= escape($tujuanEdit);
	$penumpangEdit		= escape($penumpangEdit);
	$lunasEdit 				= escape($lunasEdit);
	$harga_khususEdit = escape($harga_khususEdit);
	$ketEdit 					= escape($ketEdit);

	$query = "UPDATE tb_liza SET nomer='$nomerEdit', nama='$namaEdit', alamat='$alamatEdit', jemput='$jemputEdit', tanggal='$tglEdit', jam='$jamEdit',
						tujuan='$tujuanEdit', penumpang='$penumpangEdit', lunas='$lunasEdit', harga_khusus='$harga_khususEdit', ket='$ketEdit' WHERE id='$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}



function delete_data_tbSiluet($nomer){
	global $connect;

	$nomer = escape($nomer);

	$query 	= "DELETE FROM tb_siluet WHERE id = '$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function delete_data_tbLiza($nomer){
	global $connect;

	$nomer = escape($nomer);

	$query 	= "DELETE FROM tb_liza WHERE id = '$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function search_data_user($cari_data, $tb){
	global $connect;
	$cari_data = escape($cari_data);
	$tb = escape($tb);

	if($tb == "tb1"){
		$tb_cari = "tb_siluet";
	} else if ($tb == "tb2"){
		$tb_cari = "tb_liza";
	}

	$query 	= "SELECT * FROM $tb_cari WHERE nomer LIKE '%$cari_data%'";
	$result = mysqli_query($connect, $query);
	return $result;

}



function setKeteranganSiluet($text_mobil, $id_nomer){
	global $connect;

	$text_mobil = escape($text_mobil);
	$id_nomer 	= escape($id_nomer);

	$id_nomer = explode("-", $id_nomer);

	for($x = 0; $x < count($id_nomer); $x){

		while($data = mysqli_fetch_assoc(show_data_onID_tbSiluet($id_nomer[$x]))){					

			$query = "UPDATE tb_siluet SET mobil='$text_mobil' WHERE id='$id_nomer[$x]'";
			
			mysqli_query($connect, $query);

			$x++;
		}
	}

	return true;
}

function setKeteranganLiza($text_mobil, $id_nomer){
	global $connect;

	$text_mobil = escape($text_mobil);
	$id_nomer 	= escape($id_nomer);

	$id_nomer = explode("-", $id_nomer);

	for($x = 0; $x < count($id_nomer); $x){

		while($data = mysqli_fetch_assoc(show_data_onID_tbLiza($id_nomer[$x]))){

			$query = "UPDATE tb_liza SET mobil='$text_mobil' WHERE id='$id_nomer[$x]'";
			
			mysqli_query($connect, $query);

			$x++;
		}
	}

	return true;
}

function ubahStatusPrint_tbSiluet($id_nomer){
	global $connect;

	$id_nomer 	= escape($id_nomer);

	$id_nomer = explode("-", $id_nomer);

	for($x = 0; $x < count($id_nomer); $x){

		while($data = mysqli_fetch_assoc(show_data_onID_tbSiluet($id_nomer[$x]))){			

			$query = "UPDATE tb_siluet SET status_print='1' WHERE id='$id_nomer[$x]'";
			
			mysqli_query($connect, $query);

			$x++;
		}
	}
}

function ubahStatusPrint_tbLiza($id_nomer){
	global $connect;

	$id_nomer 	= escape($id_nomer);

	$id_nomer = explode("-", $id_nomer);

	for($x = 0; $x < count($id_nomer); $x){

		while($data = mysqli_fetch_assoc(show_data_onID_tbLiza($id_nomer[$x]))){			

			$query = "UPDATE tb_liza SET status_print='1' WHERE id='$id_nomer[$x]'";
			
			mysqli_query($connect, $query);

			$x++;
		}
	}
}

?>