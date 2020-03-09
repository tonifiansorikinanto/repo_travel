<?php 
	require_once 'core/system.php';
	$currentPage = "data-mobil-liza";
	require_once 'assets/templates/header.php';

	if(isset($_SESSION["user_access"])){
		$no = 1;	
		$data_mobil = show_alldata_mobil_liza();

		$query_id = $_SESSION['user_access'];
		$query = "SELECT * FROM tb_admin WHERE username='$query_id'";
		$result = mysqli_query($connect, $query);
		while($row = mysqli_fetch_assoc($result)){
		    $nama = $row['nama'];   
		}

		$sum_seat_mobil_liza = sum_seat_mobil_liza();

	if (isset($_POST['add_mobil'])){
		$mobil = $_POST['mobil'];
		$plat = $_POST['plat'];
		$seat = $_POST['seat'];

		if (!empty(trim($mobil)) && !empty(trim($plat)) && !empty(trim($seat))){
			if (add_mobil_liza($mobil, $plat, $seat)){
				$_SESSION['report_message'] = report_message("success", "Berhasil Menambahkan Data ke Tabel Mobil liza");
				header("Refresh:3.1; URL=data-mobil-liza");
			} else {
				$_SESSION['report_message'] = report_message("error", "Gagal Menambahkan Data ke Tabel Mobil liza");
				header("Refresh:3.1; URL=data-mobil-liza");
			}
		} else {
			$_SESSION['report_message'] = report_message("error", "Data harus diisi semua!");
			header("Refresh:3.1; URL=data-mobil-liza");
		}
	}

	if (isset($_POST['edit_mobil'])){
		$id = $_GET['id_edit'];
		$mobil = $_POST['mobil_edit'];
		$plat = $_POST['plat_edit'];
		$seat = $_POST['seat_edit'];

		if (!empty(trim($id)) && !empty(trim($mobil)) && !empty(trim($plat)) && !empty(trim($seat))){
			if (edit_mobil_liza($id, $mobil, $plat, $seat)){
				$_SESSION['report_message'] = report_message("success", "Berhasil edit mobil" . $mobil);
				header("Refresh:3.1; URL=data-mobil-liza");
			} else {
				$_SESSION['report_message'] = report_message("error", "Gagal edit mobil" . $mobil);
				header("Refresh:3.1; URL=data-mobil-liza");
			}
		} else {
			$_SESSION['report_message'] = report_message("error", "Data harus diisi semua!");
			header("Refresh:3.1; URL=data-mobil-liza");
		}
	}
?>

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
        <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Tidak</button>
        <a href="logout.php" class="btn btn-sm btn-danger">Iya</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAddMobil" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:99999999;">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Mobil liza</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="container">
      		<form method="post" action="">
	      	<div class="row justify-content-center">
	      		<div class="col-md-10">
	      			<div class="row">	      				
			      		<div class="col-md-6">
			      			<h4 class="h4-responsive">Mobil</h4>
			      		</div>
			      		<div class="col-md-3">
			      			<h4 class="h4-responsive">Plat</h4>
			      		</div>
			      		<div class="col-md-3">
			      			<h4 class="h4-responsive">Seat</h4>
			      		</div>			      		
			      		<div class="col-md-6">
			      			<input type="text" aria-label="mobil" name="mobil" id="mobil" class="form-control z-depth-1" autocomplete="off">
			      		</div>
			      		<div class="col-md-3">
			      			<input type="text" aria-label="plat" name="plat" id="plat" class="form-control z-depth-1" autocomplete="off">
			      		</div>
			      		<div class="col-md-3">
			      			<input type="number" aria-label="seat" name="seat" id="seat" class="form-control z-depth-1" autocomplete="off">
			      		</div>			      		
			      	</div>
			    </div>
	      	</div>
	    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" name="add_mobil" class="btn btn-md btn-info">Tambah</button>       
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditMobil" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:99999999;">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Mobil Liza</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="container">
      		<form method="post" action="">
	      	<div class="row justify-content-center">
	      		<div class="col-md-10">
	      			<div class="row">	      				
			      		<div class="col-md-6">
			      			<h4 class="h4-responsive">Mobil</h4>
			      		</div>
			      		<div class="col-md-3">
			      			<h4 class="h4-responsive">Plat</h4>
			      		</div>
			      		<div class="col-md-3">
			      			<h4 class="h4-responsive">Seat</h4>
			      		</div>			      		
			      		<div class="col-md-6">
			      			<input type="text" aria-label="mobil" name="mobil_edit" id="mobil_edit" class="form-control z-depth-1" autocomplete="off">
			      		</div>
			      		<div class="col-md-3">
			      			<input type="text" aria-label="plat" name="plat_edit" id="plat_edit" class="form-control z-depth-1" autocomplete="off">
			      		</div>
			      		<div class="col-md-3">
			      			<input type="number" aria-label="seat" name="seat_edit" id="seat_edit" class="form-control z-depth-1" autocomplete="off">
			      		</div>			      		
			      	</div>
			    </div>
	      	</div>
	    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-md btn-info" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-md btn-info" name="edit_mobil">Simpan</button>       
        </form>
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
        Anda yakin ingin menghapus data mobil ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Tidak</button>
        <a href="#x" class="btn btn-sm btn-danger" id="button_delete">Iya</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalReset" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:99999999;">		  
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Reset Data Penumpang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Anda yakin ingin mereset data penumpang di mobil <?php if(isset($_GET['id_mobil'])){ echo $_GET['id_mobil']; } ?> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Tidak</button>
        <a href="#x" class="btn btn-sm btn-danger" id="button_reset">Iya</a>
      </div>
    </div>
  </div>
</div>

<?php

if(isset($_SESSION['report_message'])){
	echo $_SESSION['report_message'];
	unset($_SESSION['report_message']);
}

?>

<div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">

	<nav class="navbar navbar-dark info-color justify-content-between" style="position: sticky; top: 0; z-index: 10; padding-right: 25px;">
	  <h2 class="navbar-brand h2-responsive my-0" href="#">Data Mobil</h2>
		<h6 class="h6-responsive my-0 ml-auto text-white" href="#">Selamat Datang, <?= $nama; ?>!</h6>
	  <button class="btn btn-danger btn-md mx-3 my-0" type="button" data-toggle="modal" data-target="#modalLogout">logout</button>
	  <a role="button" class="btn btn-primary btn-md my-0" href="admin-liza">Data Travel</a>
	</nav>

	<div align="center" class="mt-4">
		<a class="btn waves-effect btn-warning" href="data-mobil-siluet" role="button" style="width: 190px;">Siluet</a>
		<a href="data-mobil-liza" class="btn waves-effect btn-outline-info" role="button" style="width: 190px;">Liza</a>
	</div>

	<div class="row my-4 justify-content-center text-center">
		<div class="col-md-4 text-info">

			<h5 class="h5-responsive">Total Seat (<?= $sum_seat_mobil_liza; ?>)</h5>
		</div>
		<div class="col-md-4">
			<a class="h5-responsive text-info" data-toggle="modal" data-target="#modalAddMobil"><i class="fas fa-car"></i> Tambah Mobil</a>
		</div>
	</div>

	<div class="row my-4 mx-2">	

		<div class="container" align="center">
			<table class="table" style="width: 60%;">
			  <thead class="<?php if($currentPage == "data-mobil-liza"){
			  	echo('info-color');
			  }else{
			  	echo('info-color');
			  }?>
			  white-text">
			    <tr>
			      <th scope="col" style="vertical-align: middle;" width="10px">#</th>
			      <th scope="col" style="vertical-align: middle;">Mobil</th>
			      <th scope="col" style="vertical-align: middle;">Plat</th>
			      <th scope="col" style="vertical-align: middle; text-align: center;" width="10px">Total Seat</th>
			      <th scope="col" style="vertical-align: middle; text-align: center;" width="10px">Seat Kosong</th>
			      <th scope="col" style="vertical-align: middle; text-align: center;">Aksi</th>
			    </tr>
			  </thead>
			  <tbody>
				      <?php
			      		if(mysqli_num_rows($data_mobil) > 0){
			      			while($data = mysqli_fetch_assoc($data_mobil)){		
				      ?>
				      <tr>
				      <th scope="row"><?=$no++;?></th>
				      <td><?=$data['mobil'];?></td>
				      <td><?=$data['plat_nomor'];?></td>
				      <td class="text-center"><?=$data['penumpang'];?></td>
				      <td class="text-center"><?=$data['sisa_seat'];?></td>
				      <td class="text-center" style="width: 100px;">
				      	<?php if($data['id_mobil'] != 5): ?>
					      	 <a href="#x" role="button" class="text-warning" data-toggle="modal" data-target="#modalEditMobil" onclick="setEditParameterMobil('<?=$data['mobil']; ?>', '<?=$data['plat_nomor']; ?>', '<?=$data['penumpang']; ?>', 'tb2', '<?=$data['id_mobil']; ?>')">Edit</i></a>
							  | <a href="#x" role="button" class="text-danger" data-toggle="modal" data-target="#modalDelete"  onclick="setDeleteParameterMobil('tb2', '<?=$data['id_mobil']; ?>')">Hapus</a>
							  <a href="#x" role="button" class="text-info" data-toggle="modal" data-target="#modalReset"  onclick="setResetParameterMobil('tb2', '<?=$data['id_mobil']; ?>')">Reset</a>
						  <?php endif; ?>
						</td>
					  </tr>
					  <?php } } else { ?>
					  	<tr>
						 <td colspan="5" class="text-center"><b>Tidak ada data !</b></td>
						 </tr>
					  <?php } ?>
			  </tbody>
			</table>
		</div>

	</div>

</div>

<?php 
require_once 'assets/templates/footer.php'; 

} else {
	header('Location: login-admin');
} 
?>