
<!doctype html>
<html lang="en">

<head>
    <title><?= $template['title']?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/linearicons/style.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main.css">

    <!-- DATATABLES -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/datatables/DataTables-1.10.16/css/dataTables.bootstrap.css">

    <!-- TOASTR -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/toastr/toastr.min.css">
    <!-- SELECT2 -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/select2/css/select2.min.css">
    <!-- JQUERY CONFIRM -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/jquery_confirm/jquery-confirm.min.css">

    <!-- calendar -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/calendar/zabuto_calendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/mycustom.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url()?>assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>

    
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <div id="preloader">
            <div id="status">
                <div class="sk-circle">
                  <div class="sk-circle1 sk-child"></div>
                  <div class="sk-circle2 sk-child"></div>
                  <div class="sk-circle3 sk-child"></div>
                  <div class="sk-circle4 sk-child"></div>
                  <div class="sk-circle5 sk-child"></div>
                  <div class="sk-circle6 sk-child"></div>
                  <div class="sk-circle7 sk-child"></div>
                  <div class="sk-circle8 sk-child"></div>
                  <div class="sk-circle9 sk-child"></div>
                  <div class="sk-circle10 sk-child"></div>
                  <div class="sk-circle11 sk-child"></div>
                  <div class="sk-circle12 sk-child"></div>
                </div>
            </div>
        </div>
        <!-- NAVBAR -->
      <?php $this->load->view('layouts/partials/backend/top_nav.php') ?>
        <!-- END NAVBAR -->

        <!-- LEFT SIDEBAR -->
      <?php if($this->session->userdata('isLogin')){ ?>
          <?php $this->load->view('layouts/partials/backend/left_sidebar.php') ?>
      <?php } else { ?>
          <?php $this->load->view('layouts/partials/backend/v_login.php') ?>
      <?php } ?>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <?=$template['body']?>
                </div>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->
        <div class="clearfix"></div>
        <?php $this->load->view('layouts/partials/backend/footer.php')?>
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    
    <!-- Toaster -->
    <script src="<?php echo base_url()?>assets/vendor/toastr/toastr.min.js"></script>
    <!-- Jquery validate -->
    <script src="<?php echo base_url()?>assets/vendor/jquery_validate/jquery.validate.min.js"></script>
    >
    <!-- Jquery priceFormat -->
    <script src="<?php echo base_url()?>assets/vendor/currency/jquery.priceformat.min.js"></script>
    
    <!-- Jquery confirm  -->
    <script src="<?php echo base_url()?>assets/vendor/jquery_confirm/jquery-confirm.min.js"></script>

    <script src="<?php echo base_url()?>assets/vendor/select2/js/select2.min.js"></script>
    <script src="<?php echo base_url()?>assets/scripts/klorofil-common.js"></script>
    <script type="text/javascript">
        $(window).load(function() { // makes sure the whole site is loaded
            $('#status').fadeOut(); // will first fade out the loading animation
            $('#preloader').delay(250).fadeOut('slow'); // will fade out the white DIV that covers the website.
            $('body').delay(250).css({'overflow':'visible'});
        });
    </script>
</body>
</html>
