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

    .help-block{
        color:darkred;
    }
</style>
					<h3 class="page-title">Set Safety Stok</h3>	
					<div class="row">		
						<form action="<?= base_url()?>barang/set_safety" method="POST" id="f_valid">					
							<div class="col-md-4">
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title"></h3>
									</div>
									<div class="panel-body">
										<div class="form-group">
											<label>Cari Barang</label><span class="label label-info" style="float:right">Stok : <b><span id="tampilstok"></span></b></span>
												<select class="select2 form-control" data-live-search="true" id="find" name="id_barang" 
									        	autocomplete="off" required>
									        	<option></option>
													<?php foreach( $result_barang as $val){ ?>
									                     <option value="<?php echo $val->id_barang; ?>"><?php echo $val->nama; ?></option>  
									                <?php } ?>
							                   	</select>
										</div> <div id="e_select" class="help-block" style="padding-top:0px;"> </div>
										<div class="form-group">
											<label>Stok Aman</label>
											<input type="number" class="form-control" name="stok_aman" id="stok_aman" required>
										</div><div id="e_sa" class="help-block"> </div>
										<div class="form-group">
											<label>Stok Warning</label>
											<input type="number" class="form-control" name="stok_warning" id="stok_warning" required>
										</div><div id="e_sw" class="help-block"> </div>
										<div class="form-group">
											<button type="submit" name="safetystock" id="simpan" class="btn btn-primary">Simpan</button>
											<button type="submit" class="btn btn-warning">Batal</button>
										</div>
									</div>
								</div>
							</form>
							</div>
						</div>

<script type="text/javascript">
      //Buat Nota Otomatis
     var nota = new Date().getTime();
      $('#kode_barang').val(nota);

$(document).ready(function(){

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
	$("#f_valid").validate({
		messages :{
	        id_barang :{
	            required :'Silahkan pilih barang!'
	        }
	    },
    errorPlacement: function(error, element) {
    if (element.attr("name") == "id_barang" )
        error.insertAfter("#e_select");
    else if  (element.attr("name") == "stok_aman" )
        error.insertAfter("#e_sa");
    else if  (element.attr("name") == "stok_warning" )
        error.insertAfter("#e_sw");
    },
	});
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

	$('.select2').select2({
		placeholder:'Silahkan Pilih',
	});	

});

</script>

<script type="text/javascript">
	 $(document).ready(function(){  
      $('#find').change(function(){  
           var id = $(this).val();  
           $.ajax({  
                url:"<?= base_url()?>barang/search_barang/"+id,  
                method:"POST",  
                dataType:'json',
                beforeSend:function(){
		            $('#status').show(); 
		            $('#preloader').show();
                },
                success:function(data){  
                     $('#tampilstok').html(data.stok);  
                     $('#stok_aman').val(data.stok_aman);  
                     $('#stok_warning').val(data.stok_warning);  
  		             $('#status').hide();
  		             $('#preloader').hide();
                }  
           });
           });  
       });
 
</script>