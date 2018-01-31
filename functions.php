<?php
session_start();
$link=mysqli_connect("localhost","id4106776_vichar","7532802088","id4106776_vichar");
if(mysqli_connect_error())
    die ("Connection Error !");
function time_since($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hr'),
        array(60 , 'min'),
        array(1 , 'sec')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
}
function displaytweets($type)
{
    $flag=false;
    global $link;
    if($type=='public')
    {
        $whereClause="";
        $flag=true;
    }
    else if($type == 'isfollowing')
    {
        $query="SELECT * FROM isfollowing WHERE follower='".$_SESSION['id']."'";
        $result=mysqli_query($link,$query);
        $whereClause="";
        while($row = mysqli_fetch_assoc($result))
        {
            if($whereClause=="")
                $whereClause = "WHERE";
            else
                $whereClause.=" OR";
            $whereClause.= " userid = ".$row['isfollowing'];
        }
        if($whereClause!="")
            $flag=true;
    }
    else if($type=='yourtweets')
    {
        $whereClause=" WHERE userid =".$_SESSION['id'];
         if($whereClause!="")
            $flag=true;
    }
    else if($type=='search')
    {
        echo "<p>Showing results for '".$_GET['q']."'</p>";
        $whereClause="WHERE tweet LIKE '%".$_GET['q']."%'";
         if($whereClause!="")
            $flag=true;
    }
    else if(is_numeric($type))
    {
        $usrquery="SELECT * FROM users WHERE id='".$type."'LIMIT 1";
        $usrresult=mysqli_query($link,$usrquery);
        $usrrow=mysqli_fetch_assoc($usrresult);
        echo "<h2>".$usrrow['email']."'s Tweets</h2>";
        $whereClause="WHERE userid = ".$type;
         if($whereClause!="")
            $flag=true;
    }
     $query="SELECT * FROM tweets ".$whereClause." ORDER BY datetime DESC LIMIT 10";
    $result=mysqli_query($link,$query);
   
       if($flag==false)
        echo "There are no tweets to show.";
    else
    {
        while($row= mysqli_fetch_assoc($result))
        {
           $usrquery="SELECT * FROM users WHERE id='".$row['userid']."'LIMIT 1";
           $usrresult=mysqli_query($link,$usrquery);
           $usrrow=mysqli_fetch_assoc($usrresult);
           echo "<div class='box'>";
           echo "<p><a href='?page=publicprofiles&userid=".$usrrow['id']."'>".$usrrow['email']."</a><span  style='color:lightgrey'>".time_since(time()-strtotime($row['datetime']))."  ago.</span></p>";
            echo "<p>".$row['tweet']."</p>";
            if(array_key_exists("id",$_SESSION)&&$_SESSION['id']>0)
            {
                $query2="SELECT * FROM isfollowing WHERE follower='".$_SESSION['id']."' AND isfollowing ='".$row['userid']."'";
                $result2=mysqli_query($link,$query2);
                if(mysqli_num_rows($result2)>0)
                      echo "<p><a href='#' class='togglefollow' data=".$row['userid']." >Unfollow</a></p>";
                else
                       echo "<p><a href='#' class='togglefollow' data=".$row['userid']." >Follow</a></p>";
            }
            else 
               echo "<p><a href='#' class='togglefollow' data=".$row['userid']." >Follow</a></p>";
            echo "</div>";
        }
    }
}
function searchtweets()
{
    if(array_key_exists("id",$_SESSION)&&$_SESSION['id']>0)
    {
        echo '<form class="form-inline" id="searchtweets">
      <label class="sr-only" for="inlineFormInputName2">Name</label>
      <input type="hidden" name="page" value="search">
      <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="q" id="inlineFormInputName2" placeholder="Search....">
      <button type="submit" class="btn btn-primary">Search Tweets</button>
    </form>';
    }
}
function posttweets()
{
    if(array_key_exists("id",$_SESSION)&&$_SESSION['id']>0)
    {
        echo '<form class="form-inline" id="post">
        <textarea class="form-control" id="tweet" rows="3" placeholder="Post...."></textarea>
      <button type="submit" class="btn btn-primary" id="postbut">Post tweet</button>
    </form>';
    }
}
function displayusers()
{
    global $link;
    $query="SELECT * FROM users LIMIT 30 ";
    $result=mysqli_query($link,$query);
    while($row=mysqli_fetch_assoc($result))
    {
        echo "<p><a href='?page=publicprofiles&userid=".$row['id']."'>".$row['email']."</a></p>";
    }
}
?>
<style type="text/css">
    body{
        background-image: url(img3.jpg);
    }
    .box{
       border-style:solid;
       border-width: thin;
       border-radius: 5px;
       margin: 7px;
      padding: 7px;
        background-color: white;
    }
    #searchtweets{
        margin-top: 70px;
        margin-bottom: 8px;
    }
    #post{
        position: relative;
        top: 15px;
    }
    #postbut{
        margin-left: 7px;
    }
</style>
