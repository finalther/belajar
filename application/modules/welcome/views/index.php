     <style>
#slideshow { 
    position: relative; 
    width: 100%; 
    height: 520px; 
    padding: 10px; 
}

#slideshow > div { 
    position: absolute; 
    top: 10px; 
    left: 10px; 
    right: 10px; 
    bottom: 10px; 
}
     </style>
<div class="panel panel-profile">
                        <div class="clearfix">                        
                                <div id="slideshow" >                        
                                    <div>
                                        <img src="<?= base_url()?>assets/img/back1.jpg" class="img-responsive" style="height: 500px; width:100%;">
                                    </div>
                                    <div>
                                        <img src="<?= base_url()?>assets/img/back2.jpg" class="img-responsive" style="height: 500px; width:100%;">
                                    </div>                                        
                                    <div>
                                        <img src="<?= base_url()?>assets/img/back3.png" class="img-responsive" style="height: 500px; width:100%;">
                                    </div>
                                </div>
                            </div>
                    </div>

                         


<script>
$("#slideshow > div:gt(0)").hide();
setInterval(function() {
  $('#slideshow > div:first')
    .fadeOut(5000)
    .next()
    .fadeIn(5000)
    .end()
    .appendTo('#slideshow');
}, 10000);
</script>

