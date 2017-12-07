<style>
    .error, #log_err{
        font-size:12px;
        color:red;
    }
</style>
<div id="sidebar-nav" class="sidebar" style="background: white;">
    <div class="sidebar-scroll">
        <nav>
            <div class="row">       
                <form action="#" method="POST" id="myform">                   
                    <div class="panel" style="background: #2B333E;">
                        <div class="panel-heading" style="padding-top:0px;">
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12" style="background: #252C35; padding: 20px;">
                            <h3 class="panel-title" style="color:white">Silahkan Login!</h3><br>
                                <div class="input-group" style="margin-bottom: 2%;">
                                    <span class="input-group-addon" style="border-radius:0px;"><i class="fa fa-user"></i></span>
                                    <input class="form-control" placeholder="Username" type="text" name="username" style="border-radius:0px;">
                                </div>
                                <div id="errors_username"></div>
                                <div class="input-group" style="margin-bottom: 2%;">
                                    <span class="input-group-addon" style="border-radius:0px;"><i class="fa fa-lock"></i></span>
                                    <input class="form-control" placeholder="Password" type="password" name="password" style="border-radius:0px;">
                                </div>                 
                                <div id="errors_pass"></div>
                                <!-- <button type="submit" name="login" class="btn btn-primary btn-xs col-md-12">Login</button> -->
                                <button type="submit" style="font-weight: bold;border-radius:0px;" class="btn btn-primary btn-xs col-md-12" id="b_log"><i class="fa fa-refresh" id="tambahi" onclick="f_login()"></i> Login </button> 
                                <div id="l_info" class="col-md-12" style="padding-left:0px;"></div>
                                <div id="log_err"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                    <div class="col-md-12">
                       <div id="my-calendar" style="margin-left:0px;margin-right:0px;">            
                       </div>
            </div>
        </div>
        </nav>
    </div>
</div>
    <script src="<?php echo base_url()?>assets/vendor/jquery_validate/jquery.validate.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/calendar/zabuto_calendar.min.js"></script>

<script>
$(document).ready(function () {
    $("#my-calendar").zabuto_calendar({
            cell_border: false,
            today: true,
            show_days: false,
            weekstartson: 0,
            nav_icon: {
            prev: '<i class="fa fa-chevron-circle-left"></i>',
            next: '<i class="fa fa-chevron-circle-right"></i>'
        }
    });
});


$("#myform").validate({
    rules : {
        password :{
            required : true
        },
        username :{
            required : true
            // email : true
        }
    },

    messages :{
        password :{
            required :'Password wajib diisi'
        },
        username :{
            required :'Username wajib diisi'
        }
    },
     // if one place
     // errorPlacement: function(error, element) {
     //     error.appendTo('#errors_username');
     //   }, 
    errorPlacement: function(error, element) {
    if (element.attr("name") == "username" )
        error.insertAfter("#errors_username");
    else if  (element.attr("name") == "password" )
        error.insertAfter("#errors_pass");
    },

    submitHandler: f_login

});

function f_login(){

    $.ajax({
        url : '<?= base_url()?>auth/login',
        type:'post',
        data: $('#myform').serialize(),
        dataType :'json',

        beforeSend:function(bs){
            $('#tambahi').addClass("fa-spin");
            $(':input').prop('disabled', true);
            $('#l_info').html('<h5>Silahkan tunggu gan...</h5>');
        }, 
        success:function(data){
            if(data.message == 'ok'){
               setTimeout(function(){ window.location = data.url; }, 2000);
            }else{
                setTimeout(function(){ 
                    $('#tambahi').removeClass("fa-spin");
                    $(':input').prop('disabled', false);
                    $('#l_info').html('');
                    $("#log_err").html(data.message);
                 }, 2000);
            }
        }

    });
}



</script>