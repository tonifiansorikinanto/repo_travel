<?php 
require_once 'core/system.php';
$currentPage = "edit";
require_once 'assets/templates/header.php';



$table_name = $_GET['tb'];

if(isset($_SESSION["user_access"])){

if(isset($_SESSION["pass_supervisor"])){

if(isset($_GET['id_edit']) && isset($_GET['tb'])){
	$nomer = $_GET['id_edit'];

	if($table_name == "tb1"){
		$data_perNomer = show_data_onID_tbSiluet($nomer);
	}else{
		$data_perNomer = show_data_onID_tbLiza($nomer);
	}

	$status_tujuan = false;

	while($data = mysqli_fetch_assoc($data_perNomer)){
		$nomerOri = $data['nomer'];
		$nama = $data['nama'];
		$alamat = $data['alamat'];
		$jemput = $data['jemput'];
		$tanggal = $data['tanggal'];
		$jam = $data['jam'];
		$ket = $data['ket'];
		$tujuan = $data['tujuan'];
		$lunas = $data['lunas'];
		$penumpang = $data['penumpang'];
		$harga_khusus = $data['harga_khusus'];
	}

	$day 			= substr($tanggal, 0, 2);
	$month 		= substr($tanggal, 3, 2);
	$year 		= substr($tanggal, 6, 4);

	$tanggal 	= $year . "-" . $month . "-" . $day;

	if ($tujuan == "Malang" || $tujuan == "Juanda" || $tujuan == "Surabaya Kota" || $tujuan == "Carter") {
		$status_tujuan = true;
	} else {
		$status_tujuan = false;
	}

}else{
	if($table_name == "tb1"){
		header('Location: admin-siluet');
	}else{
		header('Location: admin-liza');
	}
}


if(isset($_POST['edit'])){
	$nomerEdit	 			= $_POST['nomer'];
	$namaEdit 				= $_POST['nama'];
	$alamatEdit 			= $_POST['alamat'];
	$jemputEdit				= $_POST['jemput'];
	$tglEdit 					= $_POST['tgl'];
	$jamEdit 					= $_POST['jam'];
	if ($_POST['tujuan_text'] != '') {
		$tujuanEdit = $_POST['tujuan_text'];
	} else {
		$tujuanEdit = $_POST['tujuan_select'];
	}	
	$penumpangEdit		= $_POST['penumpang'];
	$lunasEdit 				= $_POST['lunas'];
	$harga_khususEdit = $_POST['harga_khusus'];
	$ketEdit 					= $_POST['ket'];

	if(!empty(trim($nomerEdit)) && !empty(trim($namaEdit)) && !empty(trim($alamatEdit)) && !empty(trim($tglEdit)) &&
	!empty(trim($jamEdit)) && !empty(trim($tujuanEdit)) && !empty(trim($penumpangEdit)) && !empty(trim($lunasEdit))){

		$day 			= substr($tglEdit, 8, 2);
  	$month 		= substr($tglEdit, 5, 2);
  	$year 		= substr($tglEdit, 0, 4);

  	$tglEdit 	= $day . "-" . $month . "-" . $year;

		if($table_name == "tb1"){
			if(edit_data_tbSiluet($nomerEdit, $namaEdit, $alamatEdit, $jemputEdit, $tglEdit, $jamEdit, $tujuanEdit, $penumpangEdit, $lunasEdit, $harga_khususEdit, $ketEdit, $nomer)){
				$_SESSION['report_message'] = report_message("success", "Berhasil Mengubah Data " . $namaEdit);
				unset($_SESSION["pass_supervisor"]);
				header('Location: admin-siluet');
			}else{
				$_SESSION['report_message'] = report_message("error", "Gagal Mengubah Data " . $namaEdit);
				header('Location: edit-penumpang?tb=' . $table_name . '&nomer=' . $nomer . '');
			}
		}else{
			if(edit_data_tbLiza($nomerEdit, $namaEdit, $alamatEdit, $jemputEdit, $tglEdit, $jamEdit, $tujuanEdit, $penumpangEdit, $lunasEdit, $harga_khususEdit, $ketEdit, $nomer)){
				$_SESSION['report_message'] = report_message("success", "Berhasil Mengubah Data " . $namaEdit);
				unset($_SESSION["pass_supervisor"]);
				header('Location: admin-liza');
			}else{
				$_SESSION['report_message'] = report_message("error", "Gagal Mengubah Data " . $namaEdit);
				header('Location: edit-penumpang?tb=' . $table_name . '&nomer=' . $nomer . '');
			}
		}

	}else{
		$_SESSION['report_message'] = report_message("error", "Data selain alamat jemput harus diisi !");
	}
}

?>

<?php

if(isset($_SESSION['report_message'])){
	echo $_SESSION['report_message'];
	unset($_SESSION['report_message']);
}

?>


<div class="container">
	<div class="row justify-content-center mt-3
	 <?php
		if ($table_name =='tb1') {
			echo "text-warning";
		} else {
			echo "text-info";
		}
	?>">
		<div class="col-md-11">
			<h1 class="h1-responsive">Edit Data Client <?= $nama; ?> | Database 
			<?php
				if ($table_name =='tb1') {
					echo "Siluet";
				} else {
					echo "Liza";
				}
			?></h1>
            
			<form method="post" action="">
				<div class="row mt-4">
					<div class="col-md-12">
						<div class="row justify-content-center">
							<div class="col-md-5">
								<h2 class="h2-responsive">Data Primer</h2>
								<div class="row">
									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Nomer HP</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nomer" name="nomer" id="nomer" class="form-control z-depth-1" autocomplete="off" value="<?= $nomerOri; ?>">
									</div>

									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Nama</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nama" name="nama" id="nama" class="form-control z-depth-1" autocomplete="off" value="<?= $nama; ?>">
									</div>									

									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Alamat Tetap</h4>
									</div>									
									<div class="col-md-12 mb-2">
										<textarea class="form-control z-depth-1" name="alamat" style="height: 100px;" id="exampleFormControlTextarea6"><?= $alamat; ?></textarea>										
									</div>

									<hr class="mb-3" style="width: 95%;">

									<div class="col-md-12">
										<h4 class="h4-responsive">Alamat Jemput</h4>
									</div>
									<div class="col-md-12">
										<textarea class="form-control z-depth-1" name="jemput" style="height: 100px;" id="exampleFormControlTextarea6"><?= $jemput; ?></textarea
											>
										<small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted">
								          Isi jika client meminta dijemput di tempat yang berbeda dengan alamat tetap, kosongi jika tidak.
								        </small>
									</div>									

								</div>
							</div>
							<div class="col-md-6">
								<h2 class="h2-responsive">Data Sekunder</h2>
								<div class="row">
									<div class="col-md-6 mt-3">
										<h4 class="h4-responsive">Tanggal Berangkat</h4>
										<input type="date" aria-label="nomer" name="tgl" id="nomer" class="form-control z-depth-1"  value="<?= $tanggal; ?>">
									</div>
									<div class="col-md-3 mt-1">
										<h6 class="h6-responsive">Jam Berangkat</h6>
										<input type="text" aria-label="nomer" name="jam" id="nomer" class="form-control z-depth-1" placeholder="14:00" autocomplete="off"  value="<?= $jam; ?>">

									</div>
									<div class="col-md-3 mt-1">
										<h6 class="h6-responsive">Jumlah Penumpang</h6>
										<input type="number" aria-label="nama" name="penumpang" id="nama" class="form-control z-depth-1" autocomplete="off" value="<?= $penumpang; ?>">
									</div>
									<div class="col-md-12 mt-3 text-center">
										<h4 class="h4-responsive">Tujuan (Isi Salah Satu)</h4>
									</div>									
									<div class="col-md-6 mt-1">
										<select name="tujuan_select" id="durasi1" class="form-control z-depth-1" >
                      <option value="0">- Pilih Tujuan -</option>
                      <option value="Malang" <?php if ($status_tujuan == true && $tujuan=="Malang") echo "selected = 'selected'";?> >Malang</option>
                      <option value="Juanda" <?php if ($status_tujuan == true && $tujuan=="Juanda") echo "selected = 'selected'";?> >Juanda</option>
                      <option value="Surabaya Kota" <?php if ($status_tujuan == true && $tujuan=="Surabaya Kota") echo "selected = 'selected'";?> >Surabaya Kota</option>
                      <option value="Carter" <?php if ($status_tujuan == true && $tujuan=="Carter") echo "selected = 'selected'";?> >Carter</option>
                  	</select>
									</div>
									<div class="col-md-6 mt-1">
										<input type="text" aria-label="nama" name="tujuan_text" id="nama" class="form-control z-depth-1" autocomplete="off"  value="<?php if ($status_tujuan == false) echo $tujuan ;?>">
										<small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted">
								          Isi manual disini jika di pilihan sebelah tidak ada.
								        </small>
									</div>

									<div class="col-md-6 mt-3">
										<h4 class="h4-responsive">Lunas / BA</h4>
										<select name="lunas" id="durasi1" class="form-control z-depth-1">
	                    <option value="0">- Pilih Status Pembayaran -</option>
	                    <option value="1" <?php if($lunas == "1") echo "selected='selected'"; ?>>Lunas</option>
	                    <option value="2" <?php if($lunas == "2") echo "selected='selected'"; ?>>BA</option>
	                    <option value="3" <?php if($lunas == "3") echo "selected='selected'"; ?>>Paket</option>
	                  </select>
									</div>
									<div class="col-md-6 mt-3">
										<h4 class="h4-responsive">Special Price</h4>
										<input type="number" aria-label="nomer" name="harga_khusus" id="nomer" class="form-control z-depth-1" autocomplete="off"  value="<?= $harga_khusus; ?>">
									</div>									
									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Keterangan</h4>
									</div>
									<div class="col-md-12">
										<textarea class="form-control z-depth-1" name="ket" style="height: 100px;" id="exampleFormControlTextarea6"><?= $ket; ?></textarea>
									</div>
								</div>
							</div>		                  
						</div>
						<div align="right" class="my-4">
			  			<button type="submit" name="edit" class="btn btn-warning btn-md" style="width: 130px;" onclick="return confirm('Yakin ingin merubah data ?')">Edit Data</button>
			  			<?php if($table_name == "tb1"): ?>
			  				<a type="button" class="btn btn-info btn-md" href="admin-siluet" style="width: 130px;">Kembali</a>
			  			<?php else: ?>
			  				<a type="button" class="btn btn-info btn-md" href="admin-liza" style="width: 130px;">Kembali</a>
			  			<?php endif; ?>
			  		</div>
					</div>
				</div>				
			</form>

		</div>
	</div>
</div>

<?php 
require_once 'assets/templates/footer.php';

}else{
	if($table_name == "tb1"){
		header('Location: admin-siluet');
	}else{
		header('Location: admin-liza');
	}
}

}else{
	header('Location: login-admin');
}

?>