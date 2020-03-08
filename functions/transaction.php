<?php

// function setIDJadwalSiluet($id_mobil){
// 	global $connect;
	
// 	$query = "UPDATE "
// }

function cek_mobil_siluet($jam_modal, $tgl_cari){
	global $connect;

	$query 	= "SELECT * FROM tb_jadwal_siluet, tb_mobil_siluet WHERE tb_jadwal_siluet.tanggal LIKE '%$tgl_cari%' AND tb_jadwal_siluet.jam LIKE '%$jam_modal%' 
				AND tb_jadwal_siluet.id_mobil = tb_mobil_siluet.id_mobil";
	$result = mysqli_query($connect, $query);

	return $result;
}

function cek_mobil_kosong_siluet($jam_modal, $tgl_cari){
	global $connect;

	$query 	= "SELECT * FROM tb_jadwal_siluet, tb_mobil_siluet WHERE  tb_jadwal_siluet.id_mobil != tb_mobil_siluet.id_mobil AND tb_jadwal_siluet.tanggal LIKE '%$tgl_cari%' AND tb_jadwal_siluet.jam LIKE '%$jam_modal%'";
	$result = mysqli_query($connect, $query);	
	if (mysqli_num_rows($result) > 0){
		return $result;
	} else {
		$query2 = "SELECT * FROM tb_mobil_siluet";
		$result2 = mysqli_query($connect, $query2);	
		return $result2;
	}
}

function cek_mobil_kosong_liza($jam_modal, $tgl_cari){
	global $connect;

	$query 	= "SELECT * FROM tb_jadwal_liza, tb_mobil_liza WHERE  tb_jadwal_liza.id_mobil != tb_mobil_liza.id_mobil AND tb_jadwal_liza.tanggal LIKE '%$tgl_cari%' AND tb_jadwal_liza.jam LIKE '%$jam_modal%'";
	$result = mysqli_query($connect, $query);	
	if (mysqli_num_rows($result) > 0){
		return $result;
	} else {
		$query2 = "SELECT * FROM tb_mobil_liza";
		$result2 = mysqli_query($connect, $query2);	
		return $result2;
	}
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

function reset_data_mobil_siluet($data_id){
	global $connect;

	$id_mobil = escape($data_id);

	$show_mobil = show_ondata_mobil_siluet($id_mobil);

	while($data = mysqli_fetch_assoc($show_mobil)){
		$penumpang = $data['penumpang'];
	}

	$query = "UPDATE tb_mobil_siluet SET sisa_seat='$penumpang' WHERE id_mobil = '$id_mobil'";
	$result = mysqli_query($connect, $query);
	
	return $result;
}

function reset_data_mobil_liza($data_id){
	global $connect;

	$id_mobil = escape($data_id);

	$show_mobil = show_ondata_mobil_liza($id_mobil);

	while($data = mysqli_fetch_assoc($show_mobil)){
		$penumpang = $data['penumpang'];
	}

	$query = "UPDATE tb_mobil_liza SET sisa_seat='$penumpang' WHERE id_mobil = '$id_mobil'";
	$result = mysqli_query($connect, $query);
	
	print_r($result);
	return $result;
}

function add_mobil_siluet($mobil, $plat, $penumpang){
	global $connect;

	$mobil = escape($mobil);
	$plat = escape($plat);
	$seat = escape($penumpang);

	$query = "INSERT INTO tb_mobil_siluet (mobil, plat_nomor, penumpang, sisa_seat) VALUES ('$mobil', '$plat', '$seat', '$seat')";
	mysqli_query($connect, $query);
	return true;
}

function add_mobil_liza($mobil, $plat, $penumpang){
	global $connect;

	$mobil = escape($mobil);
	$plat = escape($plat);
	$seat = escape($penumpang);

	$query = "INSERT INTO tb_mobil_liza (mobil, plat_nomor, penumpang, sisa_seat) VALUES ('$mobil', '$plat', '$seat', '$seat')";
	mysqli_query($connect, $query);
	return true;
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

function show_ondata_mobil_siluet($id){
	global $connect;

	$query 	= "SELECT * FROM tb_mobil_siluet WHERE id_mobil = '$id'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function show_ondata_mobil_liza($id){
	global $connect;

	$query 	= "SELECT * FROM tb_mobil_liza WHERE id_mobil = '$id'";
	$result = mysqli_query($connect, $query);

	return $result;
}

function show_data_mobil($data1, $data2){
	global $connect;

	if($data2 == "tb1"){
		$query 	= "SELECT * FROM tb_mobil_siluet WHERE id_mobil='$data1'";
	}else{
		$query 	= "SELECT * FROM tb_mobil_liza WHERE id_mobil='$data1'";
	}
	
	$result = mysqli_query($connect, $query);

	while($data_mobil = mysqli_fetch_assoc($result)){
		$mobil = $data_mobil['mobil'];
	}

	return $mobil;
}

function show_mobil_available_siluet_order($id){
	global $connect;

	$queryCari = "SELECT * FROM tb_siluet WHERE id = '$id[0]'";
	$resultCari = mysqli_query($connect, $queryCari);

	while ($data = mysqli_fetch_assoc($resultCari)) {
		$tgl = $data['tanggal'];
		$jam = $data['jam'];
	}

	$query 	= "SELECT * FROM tb_mobil_siluet WHERE tb_mobil_siluet.sisa_seat > 0";
	
	$result = mysqli_query($connect, $query);
	return $result;
}

function show_mobil_idle_siluet(){
	global $connect;

	$query 	= "SELECT * FROM tb_mobil_siluet WHERE sisa_seat = penumpang";
	
	$result = mysqli_query($connect, $query);
	return $result;
}

function show_mobil_idle_liza(){
	global $connect;

	$query 	= "SELECT *, tb_mobil_liza.id_mobil FROM tb_mobil_liza, tb_jadwal_liza WHERE tb_mobil_liza.status = 0 AND tb_mobil_liza.id_mobil != tb_jadwal_liza.id_mobil";
	
	$result = mysqli_query($connect, $query);
	return $result;
}

function show_mobil_available_liza_order($id){
	global $connect;

	$queryCari = "SELECT * FROM tb_liza WHERE id = '$id[0]'";
	$resultCari = mysqli_query($connect, $queryCari);

	while ($data = mysqli_fetch_assoc($resultCari)) {
		$tgl = $data['tanggal'];
		$jam = $data['jam'];
	}

	$query 	= "SELECT * FROM tb_mobil_liza WHERE tb_mobil_liza.sisa_seat > 0";
	
	$result = mysqli_query($connect, $query);
	return $result;
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

	switch (strlen($caritb1)) {
		case 10:
			$day_data 	= substr($caritb1, 0, 2);
			$month_data = substr($caritb1, 5, 2);
			$year_data 	= substr($caritb1, 8, 4);
			$tglData 	= $year_data . "-" . $month_data . "-" . $day_data;
			break;
		case 5:
			$day_data 	= substr($caritb1, 0, 2);
			$month_data = substr($caritb1, 5, 2);			
			$tglData 	= $month_data . "-" . $day_data;
			break;
		case 2:			
			$tglData 	= $caritb1;
			break;
		case 1:			
			$tglData 	= $caritb1;
			break;		
		default:
			$tglData 	= $caritb1;
			break;
	}
	

	$query 	= "SELECT * FROM tb_siluet WHERE tanggal LIKE '%$tglData%' AND status_print = '0' ORDER BY jam ASC";
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
	$id_jadwal = uniqid();

	if($penumpang > 1){
		
		for($x = 1; $x <= $penumpang; $x++){
			

			$query = "INSERT INTO tb_siluet (nomer, nama, alamat, jemput, tanggal, jam, tujuan, penumpang, lunas, harga_khusus, ket, same_id) VALUES 
			('$nomer', '$nama', '$alamat', '$jemput', '$tgl', '$jam', '$tujuan', '$penumpang', '$lunas', '$harga_khusus', '$ket', '$id_jadwal')";

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

function add_data_tbJadwalSiluet($tgl, $jam, $penumpang){
	global $connect;

	$tgl = escape($tgl);
	$jam = escape($jam);
	$penumpang = escape($penumpang);

	$query = "INSERT INTO tb_jadwal_siluet(tanggal, jam, seat_use) VALUES ('$tgl', '$jam', '$penumpang')";

	mysqli_query($connect, $query);
	return true;
}

function add_data_tbJadwalLiza($tgl, $jam, $penumpang){
	global $connect;

	$tgl = escape($tgl);
	$jam = escape($jam);
	$penumpang = escape($penumpang);

	$query = "INSERT INTO tb_jadwal_siluet(tgl, jam, penumpang) VALUES ('$tgl', '$jam', '$penumpang')";

	mysqli_query($connect, $query);
	return true;
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
	$count_user = count($id_nomer);

	$show_data_mobil = show_ondata_mobil_siluet($text_mobil);
	while($data = mysqli_fetch_assoc($show_data_mobil)){
		$data_penumpang = $data['penumpang'];
		$data_sisa = $data['sisa_seat'];
	}

	if($data_sisa != $data_penumpang){
		$data_hasil = $data_sisa - $count_user;

		$query_mobil = "UPDATE tb_mobil_siluet SET sisa_seat='$data_hasil' WHERE id_mobil='$text_mobil'";
		mysqli_query($connect, $query_mobil);

		for($x = 0; $x < count($id_nomer); $x){
			//die(print_r($id_nomer));

			while($data = mysqli_fetch_assoc(show_data_onID_tbSiluet($id_nomer[$x]))){					

				$query = "UPDATE tb_siluet SET mobil='$text_mobil' WHERE id='$id_nomer[$x]'";
				
				mysqli_query($connect, $query);

				$x++;
			}

		}
	}else{
		$data_hasil_0 = $data_sisa - $count_user;
		
		$data_hasil = $data_sisa - $count_user;

		$query_mobil = "UPDATE tb_mobil_siluet SET sisa_seat='$data_hasil' WHERE id_mobil='$text_mobil'";
		mysqli_query($connect, $query_mobil);

		for($y = 0; $y < count($id_nomer); $y){
			while($data = mysqli_fetch_assoc(show_data_onID_tbSiluet($id_nomer[$y]))){					
				$query = "UPDATE tb_siluet SET mobil='$text_mobil' WHERE id='$id_nomer[$y]'";
				mysqli_query($connect, $query);

				$y++;
			}
		}
	}

	return true;
}

function add_tbjadwal_siluet($id_mobil, $id_nomer){
	global $connect;

	$id_mobil = escape($id_mobil);
	$id_nomer 	= escape($id_nomer);

	$id_nomer = explode("-", $id_nomer);

	$data_tampil_siluet = show_data_onID_tbSiluet($id_nomer[0]);

	while($data1 = mysqli_fetch_assoc($data_tampil_siluet)){
		$tgl = $data1['tanggal'];
		$jam = $data1['jam'];			
	}

	if($id_mobil != 5){

		$x = 0;

		$data_hasil = count($id_nomer);

		$id_user = implode(",", $id_nomer);

		$query1 = "INSERT INTO tb_jadwal_siluet (tanggal, jam, id_mobil, seat_use, id_user) VALUES ('$tgl', '$jam', '$id_mobil', '$data_hasil', '$id_user')";
		mysqli_query($connect, $query1);

	} else {
		$id_user = implode(",", $id_nomer);

		$query1 = "INSERT INTO tb_jadwal_siluet (tanggal, jam, id_mobil, seat_use, id_user) VALUES ('$tgl', '$jam', '$id_mobil', 1 , '$id_user')";
		mysqli_query($connect, $query1);

		$query2 = "UPDATE tb_mobil_siluet SET sisa_seat = 1 WHERE id_mobil='$id_mobil'";		
		$result = mysqli_query($connect, $query2);
	}
	return $result;
}

function setKeteranganLiza($text_mobil, $id_nomer){
	global $connect;

	$text_mobil = escape($text_mobil);
	$id_nomer 	= escape($id_nomer);

	$id_nomer = explode("-", $id_nomer);
	$count_user = count($id_nomer);

	$show_data_mobil = show_ondata_mobil_liza($text_mobil);
	while($data = mysqli_fetch_assoc($show_data_mobil)){
		$data_penumpang = $data['penumpang'];
		$data_sisa = $data['sisa_seat'];
	}

	if($data_sisa != $data_penumpang){
		$data_hasil = $data_sisa - $count_user;

		$query_mobil = "UPDATE tb_mobil_liza SET sisa_seat='$data_hasil' WHERE id_mobil='$text_mobil'";
		mysqli_query($connect, $query_mobil);

		for($x = 0; $x < count($id_nomer); $x){
			//die(print_r($id_nomer));

			while($data = mysqli_fetch_assoc(show_data_onID_tbLiza($id_nomer[$x]))){					

				$query = "UPDATE tb_liza SET mobil='$text_mobil' WHERE id='$id_nomer[$x]'";
				
				mysqli_query($connect, $query);

				$x++;
			}

		}
	}else{
		$data_hasil_0 = $data_sisa - $count_user;
		
		$data_hasil = $data_sisa - $count_user;

		$query_mobil = "UPDATE tb_mobil_liza SET sisa_seat='$data_hasil' WHERE id_mobil='$text_mobil'";
		mysqli_query($connect, $query_mobil);

		for($y = 0; $y < count($id_nomer); $y){
			while($data = mysqli_fetch_assoc(show_data_onID_tbLiza($id_nomer[$y]))){					
				$query = "UPDATE tb_liza SET mobil='$text_mobil' WHERE id='$id_nomer[$y]'";
				mysqli_query($connect, $query);

				$y++;
			}
		}
	}

	return true;
}

function add_tbjadwal_liza($id_mobil, $id_nomer){
	global $connect;

	$id_mobil = escape($id_mobil);
	$id_nomer 	= escape($id_nomer);

	$id_nomer = explode("-", $id_nomer);
	$data_tampil_liza = show_data_onID_tbLiza($id_nomer[0]);

	while($data1 = mysqli_fetch_assoc($data_tampil_liza)){
		$tgl = $data1['tanggal'];
		$jam = $data1['jam'];			
	}

	if($id_mobil != 5){

		$x = 0;

		$data_hasil = count($id_nomer);

		$id_user = implode(",", $id_nomer);

		$query1 = "INSERT INTO tb_jadwal_liza (tanggal, jam, id_mobil, seat_use, id_user) VALUES ('$tgl', '$jam', '$id_mobil', '$data_hasil', '$id_user')";
		mysqli_query($connect, $query1);


		$show_data_mobil1 = show_ondata_mobil_liza($id_mobil);

	} else {
		$id_user = implode(",", $id_nomer);

		$query1 = "INSERT INTO tb_jadwal_liza (tanggal, jam, id_mobil, seat_use, id_user) VALUES ('$tgl', '$jam', '$id_mobil', 1 , '$id_user')";
		mysqli_query($connect, $query1);

		$query2 = "UPDATE tb_mobil_liza SET sisa_seat = 1 WHERE id_mobil='$id_mobil'";		
		$result = mysqli_query($connect, $query2);
	}
	return $result;
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