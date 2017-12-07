        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand" style="padding:20px;">
                <a href="#"><img src="<?= base_url()?>assets/img/gangsar.png" class="img-responsive logo" style="font-weight: bold;color:white;height:50px; width:50px;"></a>
            </div>
            <div class="container-fluid">
                <div class="navbar-form navbar-left">
                        <h2 class="page-title" style="color:white;margin: 0px;">Sistem Pengendalian Persediaan Bahan Baku</h2>
                </div>
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="" class="img-circle" alt=""> <span><?= $this->session->userdata('username')?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)" id="b_logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR -->


           <?php if($this->session->userdata('isLogin')==FALSE){ ?>
             <script>
                $(".dropdown").hide();
            </script>
            <?php
            }
            ?>

<script>
 $(document).ready(function(){

          $("#b_logout").confirm({ 
              title: 'Apakah anda yakin keluar?',
              content: 'Anda akan keluar dari sistem',
              type: 'blue',
              typeAnimated: true,
              buttons: {
                  tryAgain: {
                      text: 'Ya',
                      btnClass: 'btn-blue',
                      action: function(){
                         $.ajax({  
                              url:"<?= base_url()?>auth/logout",
                              type:'post',
                              dataType:'json',
                              success:function(data){  
                                $.alert({
                                    title: 'Berhasil!',
                                    content: 'Anda berhasil keluar!',
                                  });
                               setTimeout(function(){ window.location = data.url; }, 2000);

                              }  
                         });
                      }
                  },
                  close: function () {
                  }
              }
          });

});
</script>