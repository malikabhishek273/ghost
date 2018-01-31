<?php
include("functions.php");
include("views/header.php");
if(array_key_exists('page',$_GET)&&$_GET['page']=='yourtimeline')
    include("views/timeline.php");
else if(array_key_exists('page',$_GET)&&$_GET['page']=='yourtweets')
    include("views/yourtweets.php");
else if(array_key_exists('page',$_GET)&&$_GET['page']=='search')
    include("views/search.php");
else if(array_key_exists('page',$_GET)&&$_GET['page']=='publicprofiles')
    include("views/publicprofiles.php");
else
    include("views/home.php");
include("views/footer.php");
?>
<style type="text/css">
    body{
        background-image: url(img3.jpg);
    }
</style>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("jquery.php"); ?>
    <?php include("bootstrapupper.php"); ?>
      <style type="text/css">
      </style>
    </head>
<body>
 <?php include("bootstraplower.php"); ?>
      <script type="text/javascript">
      
      </script>
  </body>
</html>