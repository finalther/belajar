					<h3 class="page-title">Tambah Data Suplier</h3>	
					<div class="row">		
						<form action="<?= base_url()?>barang/add_supplier" method="POST" id="f_supl">					
							<div class="col-md-4">
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title"></h3>
									</div>
									<div class="panel-body">
										<div class="form-group">
											<label>Nama </label>
											<input type="text" class="form-control" placeholder="Masukkan nama Suplier" name="nama" id="nama" required>
										</div>
<!-- 										<div class="form-group">
											<label>ID Suplier</label>
											<input type="text" class="form-control" name="id_sup" id="id_sup">
										</div> -->
										<div class="form-group">
											<label>Alamat</label>
											<input type="text" class="form-control" placeholder="Masukkan Alamat" name="alamat" id="alamat" required>
										</div>

										<div class="form-group">
											<label>No. Telepon</label>
											<input type="number" class="form-control" placeholder="Masukkan No. telepon" name="telp" required>
										</div>
										<div class="form-group">
											<button type="submit" name="savesuplier" class="btn btn-primary">Tambah</button>
											<button type="reset" class="btn btn-warning">Batal</button>
										</div>
									</div>
								</div>
							</form>
							</div>
						</div>
<script type="text/javascript">
$(document).ready(function(){
// set validator
	$.validator.setDefaults({
	    errorClass: 'help-block',
	    highlight: function(element) {
	        $(element)
	            .closest('.form-group')
	            .addClass('has-error');
	    },
	    unhighlight: function(element) {
	        $(element)
	            .closest('.form-group')
	            .removeClass('has-error')
	            .addClass('has-success');
	    }
	});
	$("#f_supl").validate();
	jQuery.extend(jQuery.validator.messages, {
	    required: "Inputan Wajib diisi",
	});
});

<?php if($this->session->flashdata('type')):?>
$(document).ready(function(){
	var message = "<?php echo $this->session->flashdata('message') ?>";
	toastr["success"](message)

		toastr.options = {
			  "closeButton": true,
			  "debug": false,
			  "newestOnTop": false,
			  "progressBar": false,
			  "positionClass": "toast-top-right",
			  "preventDuplicates": false,
			  "onclick": null,
			  "showDuration": "300",
			  "hideDuration": "1000",
			  "timeOut": "5000",
			  "extendedTimeOut": "1000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
		}
	});
<?php endif;?>

</script>
