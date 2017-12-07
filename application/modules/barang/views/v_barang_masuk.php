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
<h3 class="page-title">Proses Barang Masuk</h3>
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <form action="<?= base_url()?>barang/barang_masuk" method="POST" id="f_bm">
                <div class="col-md-4">
<!--                     <div class="form-group">
                        <label>Nomor Nota</label>
                        <input type="text" class="form-control" name="nota" id="nota">
                    </div> -->
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label>ID Suplier</label><span class="label label-info" id="namasup" style="float:right"></span>
                        <select class="select2 form-control" title="Ketikkan ID Suplier" data-live-search="true" id="id_suplier" name="id_suplier" autocomplete="off" style="height:34px; border-radius:0px;border:1px solid #ccc; border-color:#eaeaea; background-color:#fcfcfc" required>
                            <option>Silahkan Ketik ID Suplier</option>
                            <?php foreach( $suplier as $val){ ?>
                                <option value="<?php echo $val->id_suplier; ?>">
                                    <?php echo $val->id_suplier; ?>
                                </option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ID Barang</label>
                        <select class="select2 form-control" title="Ketikkan ID Suplier" data-live-search="true" id="id_barang" name="id_barang" autocomplete="off" required>
                            <option>Silahkan Ketik ID Barang</option>
                            <?php foreach( $barang as $val){ ?>
                                <option value="<?php echo $val->kode_barang; ?>">
                                    <?php echo $val->kode_barang; ?>
                                </option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Harga(Rp.)</label>
                        <input type="text" class="form-control" name="harga" id="harga" readonly>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan Keterangan Barang" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Stok</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Masukkan Stok Barang" onkeyup="showTotal(this.value)" required>
                    </div>
                    <div class="form-group">
                        <label>Total Harga</label>
                        <input type="text" class="form-control" name="total_harga" id="total_harga" readonly required>
                    </div>
                </div>
        	</div>
	        <div class="row">
	            <div class="col-md-4">
	                <div class="form-group">
	                    <button type="submit" name="proses_masuk" id="simpan" class="btn btn-primary">Simpan</button>
	                    <button type="reset" class="btn btn-warning">Batal</button>
	                </div>
	            </div>
	        </div>
        </form>
   		</div>
	</div>

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

<script>
    $(document).ready(function() {
        //Datakan Nama Suplier
        $('#id_suplier').change(function() {
            var id_suplier = $(this).val();
            $.ajax({
                url: "<?= base_url()?>barang/get_suplier/" + id_suplier,
                method: "POST",
                dataType: 'json',
                beforeSend: function() {
                    $('#status').show();
                    $('#preloader').show();
                },
                success: function(data) {
                    $('#namasup').html(data.nama);
                    $('#status').hide();
                    $('#preloader').hide();
                }
            });
        });

        //Datakan Data Barang
        $('#id_barang').change(function() {
            var id_barang = $(this).val();
            $.ajax({
                url: "<?= base_url()?>barang/get_barang/" + id_barang,
                method: "POST",
                dataType: 'json',
                beforeSend: function() {
                    $('#status').show();
                    $('#preloader').show();
                },
                success: function(data) {
                    $('#nama_barang').val(data.nama);
                    $('#harga').val(data.harga);
                    $('#harga').blur();
                    $('#status').hide();
                    $('#preloader').hide();
                }
            });
        });

    });

    function showTotal(juml) {
        var juml = parseInt(juml);
        var harga = $('#harga').unmask();
        var total = parseInt(harga * juml);
        $('#total_harga').val(total);
        $('#total_harga').blur();

    }

    $(function($){
   		$("#harga").priceFormat({
            prefix: 'Rp. ',
            thousandsSeparator: '.',
            centsLimit:0
   		});

   		$("#total_harga").priceFormat({
            prefix: 'Rp. ',
            thousandsSeparator: '.',
            centsLimit:0
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
    $("#f_bm").validate();
    jQuery.extend(jQuery.validator.messages, {
        required: "Inputan Wajib diisi",
    });
});
</script>