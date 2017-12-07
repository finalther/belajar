<style>
    .select2-container--default .select2-selection--single {
        display: block;
        width: 100%;
        height: 34px;
        font-size: 14px;
        -moz-box-shadow: 0px 1px 2px 0 rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 1px 2px 0 rgba(0, 0, 0, 0.1);
        box-shadow: 0px 1px 2px 0 rgba(0, 0, 0, 0.1);
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        border-color: #eaeaea;
        background-color: #fcfcfc;
    }
</style>
					<h3 class="page-title">Proses Barang Keluar</h3>	
					<div class="row">		
						<form action="<?= base_url()?>barang/barang_keluar" method="POST" id="f_qu">					
							<div class="col-md-4">
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title"></h3>
									</div>
									<div class="panel-body">
										<div class="form-group">
											<label>Nama Barang</label><span class="label label-info" id="kode" style="float:right;"></span>
										<select class="select2 form-control" title="Ketikkan ID Suplier" data-width="100%" data-live-search="true" id="id_barang" name="id_barang" 
									        	autocomplete="off" required>
									        	<option>Silahkan Ketik Nama Barang</option>
													<?php foreach( $barang as $val){ ?>
									                     <option value="<?php echo $val->id_barang; ?>"><?php echo $val->nama; ?></option>  
									                <?php } ?>
							                   	</select>
										</div>
										<div class="form-group">
											<label>Tanggal</label>
											<input type="date" class="form-control" name="tanggal" required>
										</div>									
										<div class="form-group">
											<label>Keterangan</label>
											<input type="text" class="form-control" name="keterangan" id="keterangan"  placeholder="Masukkan Keterangan Barang" required>
										</div>
										<div class="form-group">
											<label>Jumlah (Stok Keluar) </label> <span class="label label-info" id="stok" style="float:right;"></span>
											<input type="number" class="form-control" name="jumlah" id="jumlah"  placeholder="Masukkan Stok Barang" required>
										</div>
										<div class="form-group">
											<button type="submit" name="proses_keluar" id="simpan" class="btn btn-primary">Simpan</button>
											<button type="reset" class="btn btn-warning">Batal</button>
										</div>
									</div>
								</div>
							</form>
							</div>
						</div>

<script type="text/javascript">
$(document).ready(function(){
<?php if($this->session->flashdata('type')):?>
	var message = "<?php echo $this->session->flashdata('message') ?>";
<?php if($this->session->flashdata('type')=="error"):?>
	toastr["error"](message)
<?php endif; ?>
<?php if($this->session->flashdata('type')=="success"):?>
	toastr["success"](message)
<?php endif;?>
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

</script>

<script>  
 $(document).ready(function(){  
      
     //Datakan Data Barang
      $('#id_barang').change(function(){
      	var id = $(this).val();
           $.ajax({  
                url:"<?= base_url()?>barang/get_stok/"+id,  
                method:"POST",  
                dataType:'json',  
                beforeSend:function(){
		            $('#status').show(); 
		            $('#preloader').show();
                },
                success:function(data){  
                	$("#stok").html("Sisa Stok : "+data.stok);
			        $('#kode').html("Kode : "+id);
 		            $('#status').hide(); 
		            $('#preloader').hide();
                }  
           });    
      });

 });  


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
	$("#f_qu").validate();
	jQuery.extend(jQuery.validator.messages, {
	    required: "Inputan Wajib diisi",
	});
});
 </script>  
