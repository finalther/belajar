<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
					<h3 class="page-title">Laporan Barang Masuk</h3>	
					<div class="row">		
							<div class="col-md-12">
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title"></h3>
									</div>
									<div class="panel-body">
										<a href="<?= base_url()?>laporan/cetak_laporan_masuk" type="submit" name="print" id="print" class="btn btn-primary" style="float:right;" target="blank" >Print</a>
										<div id="b_print">
											<table id="datatable" class="table">
												<thead>
													<tr>
													<th> No. </th>
													<th> No. Nota </th>
													<th> Kode Barang </th>
													<th> Nama Barang</th>
													<th> Nama Suplier</th>
													<th> Harga (Rp. ) </th>
													<th> Jumlah stok </th>
													<th> Total harga (Rp. )</th>
													<th> Tanggal  </th>
													</tr>
												</thead>
												<tbody>
												<?php $no=1; foreach ($b_masuk as $val) :?>
												<tr>
													<td><?= $no++?></td>
													<td><?= $val->id_transaksi?></td>
													<td><?= $val->kode_barang?></td>
													<td><?= $val->nama_barang?></td>
													<td><?= $val->nama_suplier?></td>
													<td>Rp. <?= number_format($val->harga, 2,',','.')?></td>
													<td><?= $val->jumlah?></td>
													<td>Rp. <?= number_format($val->total_harga, 2,',','.')?></td>
													<td><?= $val->tanggal?></td>
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