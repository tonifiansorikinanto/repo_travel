<?php 
require_once 'core/system.php';
require_once 'assets/templates/header.php'; 

if(isset($_SESSION["user_access"])){

$table_name = $_GET['tb'];

if(isset($_POST['submit'])){
	$nomer = $_POST['nomer'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$tgl = $_POST['tgl'];
	$jam = $_POST['jam'];
	$tujuan = $_POST['tujuan'];
	$lunas = $_POST['lunas'];
	$harga_khusus = $_POST['harga_khusus'];

	if(!empty(trim($nomer)) && !empty(trim($nama)) && !empty(trim($alamat)) && !empty(trim($tgl)) &&
	!empty(trim($jam)) && !empty(trim($tujuan)) && !empty(trim($lunas)) && !empty(trim($harga_khusus))){

		if($table_name == "tb1"){
			if(add_data_tbSiluet($nomer, $nama, $alamat, $tgl, $jam, $tujuan, $lunas, $harga_khusus)){
				header('Location: admin.php');
			}else{
				header('Location: tambah-penumpang.php?tb=tb1');
			}
		}else{
			if(add_data_tbLiza($nomer, $nama, $alamat, $tgl, $jam, $tujuan, $lunas, $harga_khusus)){
				header('Location: admin.php');
			}else{
				header('Location: tambah-penumpang.php?tb=tb2');
			}
		}

	}

}

?>

<div class="container">
	<div class="row justify-content-center mt-3">
		<div class="col-md-10">
			<h1 class="h1-responsive deep-purple-text">Tambah Data</h1>			
            
			<form method="post" action="">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Nomer HP</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nomer" name="nomer" id="nomer" class="form-control z-depth-1" maxlength="13">
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Nama</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nama" name="nama" id="nama" class="form-control z-depth-1" autocomplete="off">
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Alamat</h4>
									</div>
									<div class="col-md-12">
										<textarea class="form-control z-depth-1" name="alamat" style="height: 100px;" id="exampleFormControlTextarea6"></textarea>
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Tanggal Berangkat</h4>
									</div>
									<div class="col-md-12">
										<input type="date" aria-label="nomer" name="tgl" id="tgl" class="form-control z-depth-1">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Jam Berangkat</h4>
									</div>
									<div class="col-md-12">
										<input type="time" aria-label="nomer" name="jam" id="nomer" class="form-control z-depth-1" placeholder="14:00" autocomplete="off">
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Tujuan</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nama" name="tujuan" id="nama" class="form-control z-depth-1" autocomplete="off">
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Lunas / BA</h4>
									</div>
									<div class="col-md-12">
										<select name="lunas" id="durasi1" class="form-control" >
                      <option value="0">- Pilih Status Pembayaran -</option>
                      <option value="1">Lunas</option>
                      <option value="2">BA</option>					                      
                    </select>
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Harga Khusus</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nomer" name="harga_khusus" id="nomer" class="form-control z-depth-1" autocomplete="off">
									</div>
								</div>
							</div>		                  
						</div>
						<div align="right" class="my-4">
			  				<button type="submit" name="submit" class="btn btn-primary btn-md" style="width: 130px;" onclick="return confirm('Lanjut Tambah Data Penumpang ?')">Tambah Data</button>
			  				<a type="button" class="btn btn-info btn-md" href="admin.php" style="width: 130px;">Kembali</a>
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