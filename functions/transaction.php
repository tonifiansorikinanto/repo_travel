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

	$query 	= "SELECT * FROM tb_siluet WHERE tanggal LIKE '%$caritb1%'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function search_data_tbLiza($caritb2){
	global $connect;

	$caritb2 = escape($caritb2);

	$query 	= "SELECT * FROM tb_liza WHERE tanggal LIKE '%$caritb2%'";
	$result = mysqli_query($connect, $query);

	return $result;
}



function add_data_tbSiluet($nomer, $nama, $alamat, $tgl, $jam, $tujuan, $lunas, $harga_khusus){
	global $connect;

	$nomer 				= escape($nomer);
	$nama 				= escape($nama);
	$alamat 			= escape($alamat);
	$tgl 					= escape($tgl);
	$jam 					= escape($jam);
	$tujuan 			= escape($tujuan);
	$lunas 				= escape($lunas);
	$harga_khusus = escape($harga_khusus);

	$query = "INSERT INTO tb_siluet (nomer, nama, alamat, tanggal, jam, tujuan, lunas, harga_khusus) VALUES 
						('$nomer', '$nama', '$alamat', '$tgl', '$jam', '$tujuan', '$lunas', '$harga_khusus')";
	$result = mysqli_query($connect, $query);

	return $result;
}

function add_data_tbLiza($nomer, $nama, $alamat, $tgl, $jam, $tujuan, $lunas, $harga_khusus){
	global $connect;

	$nomer 				= escape($nomer);
	$nama 				= escape($nama);
	$alamat 			= escape($alamat);
	$tgl 					= escape($tgl);
	$jam 					= escape($jam);
	$tujuan 			= escape($tujuan);
	$lunas 				= escape($lunas);
	$harga_khusus = escape($harga_khusus);

	$query = "INSERT INTO tb_liza (nomer, nama, alamat, tanggal, jam, tujuan, lunas, harga_khusus) VALUES 
						('$nomer', '$nama', '$alamat', '$tgl', '$jam', '$tujuan', '$lunas', '$harga_khusus')";
	$result = mysqli_query($connect, $query);

	return $result;
}


function edit_data_tbSiluet($nomer, $namaEdit, $alamatEdit, $tglEdit, $jamEdit, $tujuanEdit, $lunasEdit, $harga_khususEdit){
	global $connect;

	$nomer 						= escape($nomer);
	$namaEdit 				= escape($namaEdit);
	$alamatEdit 			= escape($alamatEdit);
	$tglEdit 					= escape($tglEdit);
	$jamEdit 					= escape($jamEdit);
	$tujuanEdit 			= escape($tujuanEdit);
	$lunasEdit 				= escape($lunasEdit);
	$harga_khususEdit = escape($harga_khususEdit);

	$query = "UPDATE tb_siluet SET nama='$namaEdit', alamat='$alamatEdit', tanggal='$tglEdit', jam='$jamEdit',
						tujuan='$tujuanEdit', lunas='$lunasEdit', harga_khusus='$harga_khususEdit' WHERE nomer='$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function edit_data_tbLiza($nomer, $namaEdit, $alamatEdit, $tglEdit, $jamEdit, $tujuanEdit, $lunasEdit, $harga_khususEdit){
	global $connect;

	$nomer 						= escape($nomer);
	$namaEdit 				= escape($namaEdit);
	$alamatEdit 			= escape($alamatEdit);
	$tglEdit 					= escape($tglEdit);
	$jamEdit 					= escape($jamEdit);
	$tujuanEdit 			= escape($tujuanEdit);
	$lunasEdit 				= escape($lunasEdit);
	$harga_khususEdit = escape($harga_khususEdit);

	$query = "UPDATE tb_liza SET nama='$namaEdit', alamat='$alamatEdit', tanggal='$tglEdit', jam='$jamEdit',
						tujuan='$tujuanEdit', lunas='$lunasEdit', harga_khusus='$harga_khususEdit' WHERE nomer='$nomer'";
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

?>