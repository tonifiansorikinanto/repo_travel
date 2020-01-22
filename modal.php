<?php require_once 'assets/templates/header.php';require_once 'assets/templates/footer.php';?>

<!-- modal logout -->
	<!-- button -->
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalLogout">
		  Logout
		</button>
	<!-- button -->
	<!-- Modal -->
		<div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">		  
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
		        <button type="button" class="btn btn-sm btn-danger">Iya</button>
		      </div>
		    </div>
		  </div>
		</div>
	<!-- modal -->
<!-- modal logout end -->
	
<!-- modal delete -->
	<!-- button -->
		<a role="button" class="ml-2" data-toggle="modal" data-target="#modalDelete"><i class=" far fa-trash-alt red-text"></i></a>
	<!-- button -->
	<!-- Modal -->
		<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">		  
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
		        <button type="button" class="btn btn-sm btn-danger">Iya</button>
		      </div>
		    </div>
		  </div>
		</div>
	<!-- modal -->
<!-- modal delete end -->

<!-- modal KonfirmSupervisor -->
	<!-- button -->
		<a role="button" class="ml-2" data-toggle="modal" data-target="#modalKonfirmSupervisor"><i class="far fa-edit text-warning mr-1"></i></a>
	<!-- button -->
	<!-- Modal -->
		<div class="modal fade" id="modalKonfirmSupervisor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">		  
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Supervisor</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
			      <form method="post" action="">
				      <input type="password" aria-label="pass_sv" name="pass_sv" id="pass_sv" class="form-control" placeholder="Masukkan password Supervisor...">
			      </form>
			  </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Batal</button>
		        <button type="button" class="btn btn-sm btn-danger">Konfirmasi</button>
		      </div>
		    </div>
		  </div>
		</div>
	<!-- modal -->
<!-- modal KonfirmSupervisor end -->