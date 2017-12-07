					<h3 class="page-title">Tambah Master Barang</h3>	
					<div class="row">		
						<form action="<?= base_url()?>barang/add" method="POST" id="f_master">					
							<div class="col-md-4">
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title"></h3>
									</div>
									<div class="panel-body">
<!-- 										<div class="form-group">
											<label>Kode Barang</label>
											<input type="text" class="form-control" name="kode_barang" id="kode_barang" value="<?=$angka?>"required>
										</div> -->
										<div class="form-group">
											<label>Nama</label>
											<input type="text" class="form-control" name="nama_barang" id="nama_barang"  placeholder="Masukkan Nama Barang" required>
										</div>
										<div class="form-group">
											<label>Satuan</label>
											<input type="text" class="form-control" name="satuan" id="satuan"  placeholder="Masukkan Satuan Barang" required>
										</div>
										<div class="form-group">
											<label>Harga</label>
											<input type="text" class="form-control" name="harga" id="harga"  placeholder="Masukkan Harga Barang" required>
										</div>
										<div class="form-group">
											<button type="submit" name="simpan_master" id="simpan" class="btn btn-primary">Simpan</button>
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
	$("#f_master").validate();
	jQuery.extend(jQuery.validator.messages, {
	    required: "Inputan Wajib diisi",
	});
		
<?php if($this->session->flashdata('type')):?>
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

<?php endif;?>

	$('.select2').select2();	
});

$(document).ready(function () {
     $('#harga').priceFormat({
        prefix: 'Rp. ',
        thousandsSeparator: '.',
        centsLimit:0
     });
 })
</script>

