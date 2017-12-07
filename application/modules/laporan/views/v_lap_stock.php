					<h3 class="page-title">Laporan Safety Stock</h3>	
					<div class="row">		
							<div class="col-md-12">
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title"></h3>
									</div>
									<div class="panel-body">
										<a href="<?= base_url()?>laporan/cetak_laporan_safety" type="submit" name="print" id="print" class="btn btn-primary" style="float:right;" target="blank" >Print</a>
										<div id="b_print">
											<table id="datatable" class="table">
												<thead>
													<tr>
													<th> No. </th>
													<th> Kode Barang </th>
													<th> Nama Barang</th>
													<th> Jumlah stok </th>
													<th> Stok Aman </th>
													<th> Stok warning </th>
													</tr>
												</thead>
												<tbody>
												<?php $no=1; foreach ($b_stock as $val) :?>
												<tr>
													<td><?= $no++?></td>
													<td><?= $val->id_barang?></td>
													<td><?= $val->nama_barang?></td>
													<td><?= $val->stok?></td>
													<td><?= $val->stok_aman?></td>
													<td><?= $val->stok_warning?></td>
												</tr>
												<?php endforeach;?>
												</tbody>
											</table>	
										</div>								
									</div>
								</div>
							</div>
						</div>

<script src="<?php echo base_url()?>assets/vendor/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/datatables/DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready( function () {
 		$('#datatable').DataTable(
			{
				"dom": '<l<t>ip>'
	        }
 		);
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