<?php
//session_start();
include("jquery.php");
?>
<style type="text/css">
.footer{ 
       position: fixed;     
       text-align: left;    
       bottom: 0px; 
       width: 100%;
       background-color:azure;
    }
    #alert{
        display: none;
    }
    body{
        background-image: url(img3.jpg);
    }
</style>
<footer class="footer">
<p>&copy; Abhishek Malik's website.</p>
</footer>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModal">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form>
                <div class="alert alert-danger" role="alert" id="alert">
                </div>
                <input type="hidden" name="loginactive"  id="loginactive" value="1">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email"  placeholder="Enter email">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
              </div>
            </form>
      </div>
      <div class="modal-footer">
       <a href="#" onclick="return false;" id="togglelogin">Sign up</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="loginsignupbut">Login</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$("#togglelogin").click(function(){
  if($("#loginactive").val()=="1")
      {
          $("#loginModal").html("Signup");
          $("#togglelogin").html("Login");
          $("#loginsignupbut").html("Signup");
          $("#loginactive").val("0");
      }
    else
     {
          $("#loginModal").html("Login");
          $("#togglelogin").html("Signup");
          $("#loginsignupbut").html("Login");
          $("#loginactive").val("1");  
     }
});
 $("#loginsignupbut").click(function(){
    $.ajax({
    type: "GET",
    url: "actions.php?action=loginsignup",
    data: "email="+$("#email").val()+"&password="+$("#password").val()+"&loginactive="+$("#loginactive").val(),
    success: function(result){
        if(result[result.length-1] == "1")
             {
                  window.location.assign("index.php");
             }
        else
             { 
                 $("#alert").html(result).show();  
             }
    }
    });
 });

    $(".togglefollow").click(function(){
        var id=$(this).attr("data");
    $.ajax({
    type: "GET",
    url: "actions.php?action=togglefollow",
    data: "userid="+id,
    success: function(result){
      if(result[result.length-1]=="1")
          {
              $("a[data='"+ id +"']").html("Follow");
          }
      else if(result[result.length-1]=="2")
          {
              $("a[data='"+ id +"']").html("Unfollow");
          }
    }
    });
    });
    $("#postbut").click(function(){
       $.ajax({
    type: "GET",
    url: "actions.php?action=posttweet",
    data: "tweetcontent="+$("#tweet").val(),
    success: function(result){
      if(result[result.length-1]=="1")
          alert("Successfully posted");
        else
          alert("Something went wrong please try again later");
    }
    });  
    });
</script>
