<?php
?>
<style type="text/css">
    #rt{
        padding: 10px;
    }
    body{
        background-image: url(img3.jpg);
    }
</style>
<div class="container">
  <div class="row">
    <div class="col-md-8">
        <h1 id=rt>Public Profile.</h1>
        <?php 
        if(array_key_exists('id',$_SESSION)&&$_SESSION['id']>0){
         if(array_key_exists('userid',$_GET)&&$_GET['userid']) {
         displaytweets($_GET['userid']); 
         } 
        else {
         displayusers('public');
         }
        }
        else
            echo "Please login , to use this function."
        ?>
    </div>
    <div class="col-md-4">
    <?php  searchtweets(); ?>
    <?php  posttweets(); ?>
    </div>
  </div>
</div>