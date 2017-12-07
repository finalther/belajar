<div class="container-fluid">
                    <h3 class="page-title">SELAMAT DATANG <?= $this->session->userdata('username')?></h3>
                    <div class="row">
                        <div class="col-md-8">
                            <!-- PANEL HEADLINE -->
                            <div class="panel panel-headline">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Silahkan Menggunakan Akses Anda..</h3>
                                    <p class="panel-subtitle">Anda login dengan hak akses sebagai <?= $this->session->userdata('username')?></p>
                                </div>
                                <div class="panel-body">
                                    <h4>Ini merupakan halaman dashboard anda.</h4>
                                    <p>Gunakan sistem sesuai dengan izin yang diberikan oleh superadministrator</p>
                                </div>
                            </div>
                            <!-- END PANEL HEADLINE -->
                        </div>
                        
                    </div>
                
                </div>      