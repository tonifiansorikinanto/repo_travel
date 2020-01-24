<?php 
require_once 'core/system.php';
require_once 'assets/templates/header.php';

$no1 = 1;

if(isset($_SESSION["user_access"])){

$show_data_tbSiluet = show_data_tbSiluet();

// editanku
	$query_id = $_SESSION['user_access'];
	$query = "SELECT * FROM tb_admin WHERE username='$query_id'";
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_assoc($result)){
	    $nama = $row['nama'];   
	}
// end

if(isset($_GET['caritb1'])){
	$caritb1 = $_GET['caritb1'];
	$show_data_tbSiluet = search_data_tbSiluet($caritb1);	
}

if(isset($_POST['submit'])){
	$password = $_POST['pass_sv'];
}

?>

<!-- modal -->
	<div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:99999999;">
	  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Logout</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        Anda yakin ingin keluar?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Tidak</button>
	        <a href="logout.php" class="btn btn-sm btn-danger">Iya</a>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:99999999;">		  
	  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Delete Data</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        Anda yakin ingin menghapus data penumpang ini?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Tidak</button>
	        <a href="#x" class="btn btn-sm btn-danger" id="button_delete">Iya</a>
	      </div>
	    </div>
	  </div>
	</div>

	<?php if(isset($pass_sv)){ echo $pass_sv; } ?>

	<div class="modal fade" id="modalKonfirmSupervisor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:99999999;">		  
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Supervisor</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form method="post" action="" name="form_sv">
		      <div class="modal-body">
				    <input type="text" aria-label="pass_sv" name="pass_sv" class="form-control" placeholder="Masukkan password Supervisor..." id="field_password">
			      
			  	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Batal</button>
		        <button role="button" class="btn btn-sm btn-danger" id="button_edit" name="submit">Konfirmasi</button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>
<!-- modal -->

<div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
	<nav class="navbar navbar-dark default-color justify-content-between" style="position: sticky; top: 0; z-index: 9999999;">
	  <h2 class="navbar-brand h2-responsive my-0" href="#">Database Travel</h2>
		<h6 class="h6-responsive my-0 ml-auto text-white" href="#">Selamat Datang, <?= $nama; ?>!</h6>
	  <button class="btn btn-danger btn-md ml-3 my-0" type="button" data-toggle="modal" data-target="#modalLogout">logout</button>
	</nav>	

	<?php

	if(isset($_SESSION['report_message'])){
		echo $_SESSION['report_message'];
		unset($_SESSION['report_message']);
	}

	?>

	<div class="container-fluid">
		<div class="row justify-content-center mt-2 mb-4">
			<div class="col-md-12">
				<div align="center" class="mt-2">
					<a class="btn waves-effect btn-outline-primary" role="button" style="width: 190px;">Tabel Siluet</a>
					<a href="admin-liza" class="btn waves-effect btn-info" role="button" style="width: 190px;">Tabel Liza</a>
				</div>
				<div class="table-responsive mt-4">
			  		<div class="row">
			  			<div class="col-md-4">
			  				<!-- Search form -->
							<form class="form-inline active-cyan-3 active-cyan-4" method="get" action="">
							  <i class="fas fa-search" aria-hidden="true"></i>
							  <input class="form-control form-control-sm ml-3" style="width: 240px;" type="text" placeholder="Cari berdasarkan Tgl Berangkat.." aria-label="Cari berdasarkan Tgl Berangkat.." name="caritb1" autocomplete="off" spellcheck="false">
							</form>
			  			</div>
			  			<div class="col-md-4" align="center">
			  				<a href="tambah-penumpang?tb=tb1" class="h5-responsive text-info"><i class="fas fa-user-plus"></i> Tambah Penumpang</a>
			  			</div>
			  			<div class="col-md-4" align="right">
			  				<a href="print_file.php" class="h5-responsive text-success" target="_blank"><i class="fas fa-print"></i> Print Tabel</a>
			  			</div>
			  		</div>	  		
					
					<table class="table table-striped table-hover mt-2">
					  <thead>
					    <tr>
					      <th style="width: 35px;" scope="col">#</th>
					      <th scope="col">Nomer HP</th>
					      <th scope="col">Nama</th>
					      <th scope="col">Alamat</th>
					      <th scope="col">Tgl Berangkat</th>
					      <th scope="col">Jam Berangkat</th>
					      <th scope="col">Tujuan</th>					      
					      <th scope="col">Lunas / BA</th>
					      <th scope="col">Harga Khusus</th>
					      <th class="text-center" style="width: 75px;" scope="col">Aksi</th>					      
					    </tr>
					  </thead>
					  <tbody>
					  	<?php if(mysqli_num_rows($show_data_tbSiluet) > 0 ): ?>
						  	<?php while($data = mysqli_fetch_assoc($show_data_tbSiluet)): ?>
						    <tr>
						    	<?php
						    	$datatanggal 	= $data['tanggal'];
						    	$day 			= substr($datatanggal, 8, 2);
						    	$month 		= substr($datatanggal, 5, 2);
						    	$year 		= substr($datatanggal, 0, 4);

						    	$datatanggal 	= $day . "-" . $month . "-" . $year;
						    	?>
						      <th scope="row"><?= $no1++; ?></th>
						      <td><?= $data['nomer']; ?></td>
						      <td><?= $data['nama']; ?></td>
						      <td><?= $data['alamat']; ?></td>
						      <td><?= $datatanggal; ?></td>
						      <td><?= $data['jam']; ?></td>
						      <td><?= $data['tujuan']; ?></td>
						      <td>
						      	<?php 
						      	if($data['lunas'] == 1){
						      		echo "Lunas";
						      	}else if($data['lunas'] == 2){
						      		echo "BA";
						      	}
						      	?>
						      </td>
						      <td><?= $data['harga_khusus']; ?></td>
						      <td class="text-center">
						      	<a href="#x" role="button" data-toggle="modal" data-target="#modalKonfirmSupervisor" onclick="setEditParameter('tb1', '<?=$data['nomer']; ?>')"><i class="far fa-edit text-warning mr-1"></i></a>
						      	|<a href="#x" class="ml-2" data-toggle="modal" data-target="#modalDelete" onclick="setDeleteParameter('tb1', '<?=$data['nomer']; ?>')"><i class=" far fa-trash-alt red-text"></i></a>
						      </td>						      
						    </tr>	
						    <?php endwhile; ?>
						  <?php else: ?>	    
						  <tr>
						  	<td colspan="10" class="text-center"><b>Tidak ada data !</b></td>
						  </tr>
						 	<?php endif; ?>
					  </tbody>
					</table>
				</div>										
			</div>
		</div>
	</div>
</div>


<?php 
require_once 'assets/templates/footer.php'; 

}else{
	header('Location: login-admin');
}
?>