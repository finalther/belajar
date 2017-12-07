 <div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="<?=base_url()?>home" class="<?= ($this->uri->segment(1)=='home') ? "active" : ''; ?>"><i class="lnr lnr-home"></i> <span>Beranda</span></a></li>
                <li>
                    <a href="#subPagesOne" data-toggle="collapse" class="<?= ($this->uri->segment(2)=='add' || $this->uri->segment(2)=='set_safety' || $this->uri->segment(2)=='add_supplier' || $this->uri->segment(2)=='master') ? "active" : 'collapsed'; ?> " id="master_barang"><i class="lnr lnr-inbox"></i> <span>Master Barang</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPagesOne" class="collapse <?= ($this->uri->segment(2)=='add' || $this->uri->segment(2)=='set_safety' || $this->uri->segment(2)=='add_supplier' || $this->uri->segment(2)=='master') ? "in" : ''; ?>">
                        <ul class="nav">
                            <li><a href="<?=base_url()?>barang/master" class="<?= ($this->uri->segment(2)=='master') ? "active" : ''; ?>">Master Barang </a></li>
                             <li><a href="<?=base_url()?>barang/add" class="<?= ($this->uri->segment(2)=='add') ? "active" : ''; ?>">Tambah Barang </a></li>
                            <li><a href="<?=base_url()?>barang/set_safety" class="<?= ($this->uri->segment(2) == 'set_safety') ? "active" : '';  ?>">Set Safety Stok</a></li>
                            <li><a href="<?=base_url()?>barang/add_supplier" class="<?= ($this->uri->segment(2) == 'add_supplier') ? "active" : '';  ?>">Tambah Supplier</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#subPages" data-toggle="collapse" class="<?= ($this->uri->segment(2)=='barang_masuk' || $this->uri->segment(2)=='barang_keluar') ? "active" : 'collapsed';?>" id="in_out"><i class="lnr lnr-sync"></i> <span>Proses</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse <?= ($this->uri->segment(2)=='barang_masuk' || $this->uri->segment(2)=='barang_keluar') ? "in" : ''; ?>">
                        <ul class="nav">
                            <li><a href="<?= base_url()?>barang/barang_masuk" class="<?= ($this->uri->segment(2)=='barang_masuk') ? "active" : ''; ?>">Barang Masuk</a></li>
                            <li><a href="<?= base_url()?>barang/barang_keluar" class="<?= ($this->uri->segment(2)=='barang_keluar') ? "active" : ''; ?>">Barang Keluar</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#subPages3" data-toggle="collapse" class="<?= ($this->uri->segment(2)=='lap_masuk' || $this->uri->segment(2)=='lap_keluar' || $this->uri->segment(2)=='lap_stock') ? "active" : 'collapsed'; ?>" id="laporan"><i class="lnr lnr-book"></i> <span>Laporan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages3" class="collapse <?= ($this->uri->segment(2)=='lap_masuk' || $this->uri->segment(2)=='lap_keluar' || $this->uri->segment(2)=='lap_stock') ? "in" : ''; ?>">
                        <ul class="nav">
                            <li><a href="<?= base_url()?>laporan/lap_masuk" class="<?= ($this->uri->segment(2)=='lap_masuk') ? "active" : ''; ?>">Laporan Barang Masuk</a></li>
                            <li><a href="<?= base_url()?>laporan/lap_keluar" class="<?= ($this->uri->segment(2)=='lap_keluar') ? "active" : ''; ?>">Laporan Barang Keluar</a></li>
                            <li><a href="<?= base_url()?>laporan/lap_stock" class="<?= ($this->uri->segment(2)=='lap_stock') ? "active" : ''; ?>"> Laporan Safety Stock</a></li>
                        </ul>
                    </div>
                </li>
            </ul>

        </nav>
    </div>
</div>

           <?php if($this->session->userdata('role')==2){ ?>
             <script>
                $("#laporan").show();
                $("#in_out").hide();
                $("#master_barang").hide();
            </script>
            <?php
            }elseif($this->session->userdata('role')==3){ ?>
             <script>
                $("#laporan").hide();
                $("#in_out").show();
                $("#master_barang").hide();
            </script>
            <?php
            }elseif($this->session->userdata('role')==1){ ?>
             <script>
                $("#laporan").show();
                $("#in_out").show();
                $("#master_barang").show();
            </script>
                <?php } ?> 


