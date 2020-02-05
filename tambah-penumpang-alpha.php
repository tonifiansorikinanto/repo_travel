<?php 
require_once 'core/system.php';
require_once 'assets/templates/header.php'; 

if(isset($_SESSION["user_access"])){

$table_name = $_GET['tb'];

if(isset($_GET['cari-data'])){
	$cari_data = $_GET['cari-data'];
	$data_nomer = show_data_onNomer_tbSiluet($cari_data);

	if(mysqli_num_rows($data_nomer) > 0){

		while($data = mysqli_fetch_assoc($data_nomer)):
			$nomerOri 				= $data['nomer'];
			$namaOri					= $data['nama'];
			$alamatOri				= $data['alamat'];
			$jemputOri				= $data['jemput'];
			$tglOri 					= $data['tanggal'];
			$jamOri 					= $data['jam'];
			$tujuanOri 				= $data['tujuan'];
			$penumpangOri			= $data['penumpang'];
			$lunasOri 				= $data['lunas'];
			$harga_khususOri 	= $data['harga_khusus'];
			$ketOri 					= $data['ket'];
		endwhile;

		$day 			= substr($tglOri, 0, 2);
		$month 		= substr($tglOri, 3, 2);
		$year 		= substr($tglOri, 6, 4);

		$tglOri 	= $year . "-" . $month . "-" . $day;

	}else{
		
	}
}


// pengaturan submit data

if(isset($_POST['submit'])){
	$nomer 				= $_POST['nomer'];
	$nama 				= $_POST['nama'];
	$alamat 			= $_POST['alamat'];
	$jemput 			= $_POST['jemput'];
	$tgl 					= $_POST['tgl'];
	$jam 					= $_POST['jam'];
	$tujuan 			= $_POST['tujuan'];
	$penumpang 		= $_POST['penumpang'];
	$lunas 				= $_POST['lunas'];
	$harga_khusus = $_POST['harga_khusus'];
	$ket 					= $_POST['ket'];

	if(!empty(trim($nomer)) && !empty(trim($nama)) && !empty(trim($alamat)) && !empty(trim($jemput)) && !empty(trim($tgl)) && !empty(trim($jam)) && !empty(trim($tujuan)) && !empty(trim($penumpang)) && !empty(trim($lunas)) && !empty(trim($harga_khusus)) && !empty(trim($ket))){

  	$day 		= substr($tgl, 8, 2);
  	$month 		= substr($tgl, 5, 2);
  	$year 		= substr($tgl, 0, 4);

  	$tgl 	= $day . "-" . $month . "-" . $year;

		if($table_name == "tb1"){
			if(add_data_tbSiluet($nomer, $nama, $alamat, $jemput, $tgl, $jam, $tujuan, $penumpang, $lunas, $harga_khusus, $ket)){
				$_SESSION['report_message'] = report_message("success", "Berhasil Menambahkan Data ke Tabel Siluet");
				header('Location: admin-siluet');
			}else{
				$_SESSION['report_message'] = report_message("error", "Gagal Menambahkan Data !");
				header('Location: tambah-penumpang?tb=tb1');
			}
		}else{
			if(add_data_tbLiza($nomer, $nama, $alamat, $jemput, $tgl, $jam, $tujuan, $penumpang, $lunas, $harga_khusus, $ket)){
				$_SESSION['report_message'] = report_message("success", "Berhasil Menambahkan Data ke Tabel Liza");
				header('Location: admin-liza');
			}else{
				$_SESSION['report_message'] = report_message("error", "Gagal Menambahkan Data !");
				header('Location: tambah-penumpang?tb=tb2');
			}
		}

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
	<div class="row justify-content-center mt-3">
		<div class="col-md-10">
			<h1 class="h1-responsive <?php
						if ($table_name =='tb1') {
							echo "text-warning";
						} else {
							echo "text-info";
						}
					?>">
					Edit / Tambah Penumpang 
					<?php
						if ($table_name =='tb1') {
							echo "Siluet";
						} else {
							echo "Liza";
						}
					?>					
				</h1>

			<div class="row mt-4 justify-content-center">
	  			<div align="center" class="col-md-4">
						<h4 class="h4-responsive">Cari Nomer HP</h4>

						<input class="form-control z-depth-1 text-center" type="text" aria-label="" name="cari-data" autocomplete="off" spellcheck="false" placeholder="input nomer.." style="width: 100%;" maxlength="13" id="cari_nomer" value="<?php if(isset($cari_data)){ echo $cari_data; }?>">
	  			</div>
		  	</div>			
            
			<form method="post" action="">
				<div class="row justify-content-center <?php
						if ($table_name =='tb1') {
							echo "text-warning";
						} else {
							echo "text-info";
						}
					?>">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">

								<div class="row">
									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Nomer HP</h4>
									</div>
									<div class="col-md-12">											
										<input type="text" aria-label="nomer" name="nomer" id="nomer" class="form-control z-depth-1" maxlength="13" value="<?php if(isset($cari_data) && isset($nomerOri)){ echo $nomerOri; } ?>">
									</div>

									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Nama</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nama" name="nama" id="nama" class="form-control z-depth-1" autocomplete="off"  value="<?php if(isset($cari_data) && isset($namaOri)){ echo $namaOri; } ?>">
									</div>

									<div class="col-md-6 mt-3">
										<h4 class="h4-responsive">Alamat Tetap</h4>
									</div>
									<div class="col-md-6 mt-3">
										<h4 class="h4-responsive">Alamat Jemput</h4>
									</div>
									<div class="col-md-6">
										<textarea class="form-control z-depth-1" name="alamat" style="height: 100px;" id="exampleFormControlTextarea6"><?php if(isset($cari_data) && isset($alamatOri)){ echo $alamatOri; } ?></textarea>
									</div>
									<div class="col-md-6">
										<textarea class="form-control z-depth-1" name="jemput" style="height: 100px;" id="exampleFormControlTextarea6"><?php if(isset($cari_data) && isset($jemputOri)){ echo $jemputOri; } ?></textarea>
									</div>
									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Tanggal Berangkat</h4>
									</div>
									<div class="col-md-12">
										<input type="date" aria-label="nomer" name="tgl" id="tgl" class="form-control z-depth-1" value="<?php if(isset($cari_data) && isset($tglOri)){ echo $tglOri; } ?>">
									</div>

									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Keterangan</h4>
									</div>
									<div class="col-md-12">
										<textarea class="form-control z-depth-1" name="ket" style="height: 100px;" id="exampleFormControlTextarea6"><?php if(isset($cari_data) && isset($ketOri)){ echo $ketOri; } ?></textarea>
									</div>

								</div>
							</div>

							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Jam Berangkat</h4>
									</div>
									<div class="col-md-12">
										<input type="time" aria-label="nomer" name="jam" id="nomer" class="form-control z-depth-1" placeholder="14:00" autocomplete="off" value="<?php if(isset($cari_data) && isset($jamOri)){ echo $jamOri; } ?>">
									</div>

									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Tujuan</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nama" name="tujuan" id="nama" class="form-control z-depth-1" autocomplete="off" value="<?php if(isset($cari_data) && isset($tujuanOri)){ echo $tujuanOri; } ?>">
									</div>

									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Jumlah Penumpang</h4>
									</div>
									<div class="col-md-12">
										<input type="number" aria-label="nama" name="penumpang" id="nama" class="form-control z-depth-1" autocomplete="off" value="<?php if(isset($cari_data) && isset($penumpangOri)){ echo $penumpangOri; } ?>">
									</div>

									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Lunas / BA</h4>
									</div>
									<div class="col-md-12">
										<select name="lunas" id="durasi1" class="form-control" >
                      <option value="0">- Pilih Status Pembayaran -</option>
                      <option value="1" <?php if($lunasOri == "1") echo "selected='selected'"; ?>>Lunas</option>
                      <option value="2" <?php if($lunasOri == "2") echo "selected='selected'"; ?>>BA</option>
                  	</select>
									</div>

									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Harga Khusus</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nomer" name="harga_khusus" id="nomer" class="form-control z-depth-1" autocomplete="off" value="<?php if(isset($cari_data) && isset($harga_khususOri)){ echo $harga_khususOri; } ?>">
									</div>

								</div>
							</div>		                  
						</div>
						
						<div align="right" class="mt-5 mb-4">
			  			<button type="submit" name="submit" class="btn btn-primary btn-md" style="width: 130px;" onclick="return confirm('Lanjut Tambah Data Penumpang ?')">Tambah Data</button>
			  			<button type="submit" name="edit" class="btn btn-warning btn-md" style="width: 130px;" onclick="return confirm('Lanjut Edit Data Penumpang ?')">Edit Data</button>
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
	header('Location: login-admin.php');
}

?>