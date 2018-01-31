<?php
//session_start();
?>
<style type="text/css">
    body{
        background-image: url(img3.jpg);
    }
    #maintxt{
        font-family:cursive;
        font-size: 200%;
        color: burlywood;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php" id="maintxt">Vichar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="?page=yourtimeline">Your timeline</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="?page=yourtweets">Your's Vichar.</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="?page=publicprofiles">Public Profiles</a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
    <?php if(array_key_exists('id',$_SESSION)&& $_SESSION['id']) 
        { ?>
           <a href="logout.php"><button class="btn btn-outline-success my-2 my-sm-0" >Logout.</button></a>
           
       <?php }
        else
        {?>
            <button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#exampleModal">Login/Signup</button>
        <?php }?>
    </div>
  </div>
</nav>