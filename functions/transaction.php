<?php

function show_data_tbSiluet(){
	global $connect;

	$query = "SELECT * FROM tb_siluet";
	$result = mysqli_query($connect, $query);

	return $result;
}

function show_data_tbLiza(){
	global $connect;

	$query = "SELECT * FROM tb_liza";
	$result = mysqli_query($connect, $query);

	return $result;
}

function show_data_onNomer_tbSiluet($nomer){
	global $connect;

	$query = "SELECT * FROM tb_siluet WHERE nomer='$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function show_data_onNomer_tbLiza($nomer){
	global $connect;

	$query = "SELECT * FROM tb_liza WHERE nomer='$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function search_data_tbSiluet($caritb1){
	global $connect;

	$query = "SELECT * FROM tb_siluet WHERE nomer LIKE '%$caritb1%'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function search_data_tbLiza($caritb2){
	global $connect;

	$query = "SELECT * FROM tb_liza WHERE nomer LIKE '%$caritb2%'";
	$result = mysqli_query($connect, $query);

	return $result;
}



function add_data_tbSiluet($nomer, $nama, $alamat, $tgl, $jam, $tujuan, $lunas, $harga_khusus){
	global $connect;

	$query = "INSERT INTO tb_siluet (nomer, nama, alamat, tanggal, jam, tujuan, lunas, harga_khusus) VALUES 
						('$nomer', '$nama', '$alamat', '$tgl', '$jam', '$tujuan', '$lunas', '$harga_khusus')";
	$result = mysqli_query($connect, $query);

	return $result;
}

function add_data_tbLiza($nomer, $nama, $alamat, $tgl, $jam, $tujuan, $lunas, $harga_khusus){
	global $connect;

	$query = "INSERT INTO tb_liza (nomer, nama, alamat, tanggal, jam, tujuan, lunas, harga_khusus) VALUES 
						('$nomer', '$nama', '$alamat', '$tgl', '$jam', '$tujuan', '$lunas', '$harga_khusus')";
	$result = mysqli_query($connect, $query);

	return $result;
}


function edit_data_tbSiluet($nomer, $namaEdit, $alamatEdit, $tglEdit, $jamEdit, $tujuanEdit, $lunasEdit, $harga_khususEdit){
	global $connect;

	$query = "UPDATE tb_siluet SET nama='$namaEdit', alamat='$alamatEdit', tanggal='$tglEdit', jam='$jamEdit',
						tujuan='$tujuanEdit', lunas='$lunasEdit', harga_khusus='$harga_khususEdit' WHERE nomer='$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function edit_data_tbLiza($nomer, $namaEdit, $alamatEdit, $tglEdit, $jamEdit, $tujuanEdit, $lunasEdit, $harga_khususEdit){
	global $connect;

	$query = "UPDATE tb_liza SET nama='$namaEdit', alamat='$alamatEdit', tanggal='$tglEdit', jam='$jamEdit',
						tujuan='$tujuanEdit', lunas='$lunasEdit', harga_khusus='$harga_khususEdit' WHERE nomer='$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}



function delete_data_tbSiluet($nomer){
	global $connect;

	$query = "DELETE FROM tb_siluet WHERE nomer = '$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function delete_data_tbLiza($nomer){
	global $connect;

	$query = "DELETE FROM tb_liza WHERE nomer = '$nomer'";
	$result = mysqli_query($connect, $query);

	return $result;
}

?>