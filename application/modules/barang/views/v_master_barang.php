					<h3 class="page-title">Master Barang</h3>	
					<div class="row">		
							<div class="col-md-8">
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title"></h3>
									</div>
									<div class="panel-body">
										<table id="datatable" class="table">
											<thead>
												<tr>
												<th> No. </th>
												<th> Kode Barang </th>
												<th> Nama </th>
												<th> Harga </th>
												<th> Satuan </th>
												<th> Option </th>
												</tr>
											</thead>
											<tbody>
											<?php $no=1; foreach ($barang as $val) :?>
											<tr>
												<td><?= $no++?></td>
												<td><?= $val->kode_barang?></td>
												<td><?= $val->nama?></td>
												<td>Rp. <?= number_format($val->harga, 2,',','.')?></td>
												<td><?= $val->satuan?></td>
												<td><a href="javascript:void(0)" class="a_bn" data-id="<?= $val->kode_barang?>"><span class="lnr lnr-trash"></span></a></td>
											</tr>
											<?php endforeach;?>
											</tbody>
										</table>									
									</div>
								</div>
							</div>
						</div>

<script src="<?php echo base_url()?>assets/vendor/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/datatables/DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready( function () {
 		$('#datatable').DataTable();
	});
</script>

<script type="text/javascript">
    $(document).ready(function() {
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
</script>

 <script type="text/javascript">
      // function ask(kd){
      $(document).ready(function(){

          $(".a_bn").confirm({ 
              title: 'Apakah anda yakin?',
              content: 'Hati-hati Master Barang akan terhapus !',
              type: 'red',
              typeAnimated: true,
              buttons: {
                  tryAgain: {
                      text: 'Ya',
                      btnClass: 'btn-red',
                      action: function(){
                        var id = $(".a_bn").data("id");
                         $.ajax({  
                              url:"<?=base_url()?>barang/hapus/"+id,
                              type:'post',
                              success:function(data){  
                                $.alert({
                                    title: 'Berhasil!',
                                    content: 'Data Telah Dihapus!',
                                  });
                                 window.setTimeout(function(){
                                location.reload()},2000)
                              }  
                         });
                      }
                  },
                  close: function () {
                  }
              }
          });

      // }
});

  </script>