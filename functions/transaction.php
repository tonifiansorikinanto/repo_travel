<?php

function show_data_tbSiluet(){
	global $connect;

	$query 	= "SELECT * FROM tb_siluet";
	$result = mysqli_query($connect, $query);

	return $result;
}

function show_data_tbLiza(){
	global $connect;

	$query 	= "SELECT * FROM tb_liza";
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

function search_data_tbSiluet($caritb1){
	global $connect;

	$caritb1 = escape($caritb1);

	$query 	= "SELECT * FROM tb_siluet WHERE tanggal LIKE '%$caritb1%' ORDER BY jam ASC";
	$result = mysqli_query($connect, $query);

	return $result;
}

function search_data_tbLiza($caritb2){
	global $connect;

	$caritb2 = escape($caritb2);

	$query 	= "SELECT * FROM tb_liza WHERE tanggal LIKE '%$caritb2%' ORDER BY jam ASC";
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

	$query = "INSERT INTO tb_siluet (nomer, nama, alamat, jemput, tanggal, jam, tujuan, penumpang, lunas, harga_khusus, ket) VALUES 
	('$nomer', '$nama', '$alamat', '$jemput', '$tgl', '$jam', '$tujuan', '$penumpang', '$lunas', '$harga_khusus', '$ket')";
	$result = mysqli_query($connect, $query);

	return $result;
}

function add_data_tbLiza($nomer, $nama, $alamat, $jemput, $tgl, $jam, $tujuan, $penumpang, $lunas, $harga_khusus, $ket){
	global $connect;

	$nomer 				= escape($nomer);
	$nama 				= escape($nama);
	$alamat 			= escape($alamat);
	$tgl 					= escape($tgl);
	$jam 					= escape($jam);
	$tujuan 			= escape($tujuan);
	$lunas 				= escape($lunas);
	$harga_khusus = escape($harga_khusus);

	$query = "INSERT INTO tb_liza (nomer, nama, alamat, jemput, tanggal, jam, tujuan, penumpang, lunas, harga_khusus, ket) VALUES ('$nomer', '$nama', '$alamat', '$jemput', '$tgl', '$jam', '$tujuan', '$penumpang', '$lunas', '$harga_khusus', '$ket')";
	$result = mysqli_query($connect, $query);

	return $result;
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
						tujuan='$tujuanEdit', penumpang='$penumpangEdit', lunas='$lunasEdit', harga_khusus='$harga_khususEdit', ket='$ketEdit' WHERE nomer='$nomer'";
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
						tujuan='$tujuanEdit', penumpang='$penumpangEdit', lunas='$lunasEdit', harga_khusus='$harga_khususEdit', ket='$ketEdit' WHERE nomer='$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}



function delete_data_tbSiluet($nomer){
	global $connect;

	$nomer = escape($nomer);

	$query 	= "DELETE FROM tb_siluet WHERE nomer = '$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function delete_data_tbLiza($nomer){
	global $connect;

	$nomer = escape($nomer);

	$query 	= "DELETE FROM tb_liza WHERE nomer = '$nomer'";
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

?>