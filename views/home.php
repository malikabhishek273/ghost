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
        <h1 id="rt">Recents Vichar</h1>
        <?php displaytweets('public'); ?>
    </div>
    <div class="col-md-4">
    <?php  searchtweets(); ?>
    <?php  posttweets(); ?>
    </div>
  </div>
</div>