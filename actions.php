<?php 
$link=mysqli_connect("localhost","id4106776_vichar","7532802088","id4106776_vichar");
if(mysqli_connect_error())
    die ("Connection Error !");
include("functions.php");
if($_GET["action"]=="loginsignup")
{
    $error="";
    if(!$_GET['email'])
        $error="email is required.";
    if(!$_GET['password'])
        $error="<p>password is required.</p>";
    if($error!="")
        echo $error;
    if($_GET['loginactive']=="0")
    {
        $query="SELECT * FROM users WHERE email='".$_GET['email']."'LIMIT 1";
        $result=mysqli_query($link,$query);
         if(mysqli_num_rows($result)>0)
           $error="This account is already taken. ";
        else
        {
            $query="INSERT INTO users (email,password) VALUES ('".$_GET['email']."','".$_GET['password']."')";
            if(mysqli_query($link,$query))
            {
                echo 1;
                $_SESSION['id']=mysqli_insert_id($link);  
            }
            else
                $error="could not sign u up!.";
        }
 
    }
    else
    {
        $query="SELECT * FROM users WHERE email='".$_GET['email']."'";
        $result=mysqli_query($link,$query);
        $row=mysqli_fetch_assoc($result);
        if($row['password']!=$_GET['password'])
            $error="please enter correct password";
        else
        {
            echo 1;
            $_SESSION['id']=$row['id'];
        }
    }
    if($error!="")
        echo $error;
}
if($_GET['action']=="togglefollow")
{
    $query="SELECT * FROM isfollowing WHERE follower=".$_SESSION['id']." AND isfollowing=".$_GET['userid']." LIMIT 1";
    $result=mysqli_query($link,$query);
    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_assoc($result);
        $query2="DELETE FROM isfollowing WHERE id=".$row['id']."";
        mysqli_query($link,$query2);
        echo 1;
    }
    else
    {
       $query3="INSERT INTO isfollowing (follower,isfollowing ) VALUES(".$_SESSION['id'].",".$_GET['userid'].")";
        mysqli_query($link,$query3);
        echo 2;
    }
}
if($_GET['action']=="posttweet")
{
    if(!$_GET['tweetcontent'])
        echo "your Vichar is empty!.";
    else if(strlen($_GET['tweetcontent'])>160)
        echo "your Vichar is too long!.";
    else
    {
        $query="INSERT INTO tweets (tweet , userid , datetime ) VALUES ('".$_GET['tweetcontent']."','".$_SESSION['id']."',NOW())";
        mysqli_query($link,$query);
        echo "1";
    }
        
}
?>
