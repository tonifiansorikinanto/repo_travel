<?php 
	require_once 'core/system.php';
	$currentPage = "data-mobil-liza";
	require_once 'assets/templates/header.php';

	$query_id = $_SESSION['user_access'];
	$query = "SELECT * FROM tb_admin WHERE username='$query_id'";
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_assoc($result)){
	    $nama = $row['nama'];   
	}	

	if(isset($_SESSION["user_access"])){
		
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
        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Tidak</button>
        <a href="logout.php" class="btn btn-sm btn-danger">Iya</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAddMobil" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:99999999;">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Mobil Liza</h5>
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
			      			<input type="text" aria-label="seat" name="seat" id="seat" class="form-control z-depth-1" autocomplete="off">
			      		</div>			      		
			      	</div>
			    </div>
	      	</div>
	    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-md btn-warning" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-md btn-info">Tambah</button>       
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
        Anda yakin ingin menghapus data penumpang ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Tidak</button>
        <a href="#x" class="btn btn-sm btn-danger" id="button_delete">Iya</a>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">

	<nav class="navbar navbar-dark info-color justify-content-between" style="position: sticky; top: 0; z-index: 10; padding-right: 25px;">
	  <h2 class="navbar-brand h2-responsive my-0" href="#">Data Mobil</h2>
		<h6 class="h6-responsive my-0 ml-auto text-white" href="#">Selamat Datang, <?= $nama; ?>!</h6>
	  <button class="btn btn-danger btn-md mx-3 my-0" type="button" data-toggle="modal" data-target="#modalLogout">logout</button>
	  <a role="button" class="btn btn-primary btn-md my-0" href="admin-siluet">Data Travel</a>
	</nav>

	<div align="center" class="mt-4">
		<a class="btn waves-effect btn-warning" href="data-mobil-siluet" role="button" style="width: 190px;">Siluet</a>
		<a href="data-mobil-liza" class="btn waves-effect btn-outline-info" role="button" style="width: 190px;">Liza</a>
	</div>

	<div class="row my-4 justify-content-center text-center">
		<div class="col-md-4 text-info">
			<h5 class="h5-responsive">Total Seat (10)</h5>
		</div>
		<div class="col-md-4">
			<a class="h5-responsive text-info" data-toggle="modal" data-target="#modalAddMobil"><i class="fas fa-car"></i> Tambah Mobil</a>
		</div>
	</div>

	<div class="row my-4 mx-2">	

		<div class="container" align="center">
			<table class="table" style="width: 60%;">
			  <thead class="<?php if($currentPage == "data-mobil-siluet"){
			  	echo('warning-color');
			  }else{
			  	echo('info-color');
			  }?>
			  white-text">
			    <tr>
			      <th scope="col" style="vertical-align: middle;" width="10px">#</th>
			      <th scope="col" style="vertical-align: middle;">Mobil</th>
			      <th scope="col" style="vertical-align: middle;">Plat</th>
			      <th scope="col" style="vertical-align: middle; text-align: center;" width="10px">Seat</th>
			      <th scope="col" style="vertical-align: middle; text-align: center;">Aksu</th>					      
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row">1</th>
			      <td>Mark</td>
			      <td>Otto</td>
			      <td class="text-center">Otto</td>
			      <td class="text-center" style="width: 100px;"><a href="#x" role="button" class="text-warning" data-toggle="modal" data-target="#modalAddMobil" onclick="setEditParameter('tb1', '<?=$data['id']; ?>')">Edit</i></a>
				  | <a href="#x" role="button" class="text-danger" data-toggle="modal" data-target="#modalDelete" onclick="setDeleteParameter('tb1', '<?=$data['id']; ?>')">Hapus</a></td>					      
			    </tr>					    
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