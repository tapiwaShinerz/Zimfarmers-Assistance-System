<?php 
include_once'inc/connector.php';
include_once'inc/session_handler.php';
session_check();
 $time=time();
 $current_date = date("F j,Y,g:i a",$time);
 ?>
<!DOCTYPE html>
<html>
<head>
<title>ZimFarmer Officer|Welcome</title>
<?php include_once'main.php';?>
</head>
<body>
<div class="container-fluid">
<div class="row"><div class="col-sm-12" style="background-image:url(images/1.jpg);background-size: cover;">
<?php include_once'head.php'; ?>

<nav class="navbar" role="navigation" style="border-radius:0px;background-color: transparent;border-style: none;">
			<div class="container">
		
				</div>
		</nav>
</div></div></div>

<div class="container-fluid" style="margin-left:10px;margin-bottom: 5px;border-bottom: 2px solid #060">
<div class="row">
<div class="col-sm-3" style="margin-left: 0px">
	<div class="row" style="padding-left:2px">
 <span style="background-color:#000;color: #FFF"><strong>AGRICULTURAL HELPER PROFILE</strong></span><br>
    <a href="#" class="thumbnail pull-left">
      <img src="images/nopicture.jpg" alt="my profile" height="55" width="55" style="border-radius:70%">
    </a>
 <strong>You are logged as<br> <span style="color:#060"><u><?php echo strtoupper($_SESSION['username']);?></u></span></strong><br>
 <?php if ($_SESSION['username']) {
    $username=($_SESSION['username']);
    $num=0;
    $result = $pdo->prepare("SELECT * FROM helpers WHERE username='$username'");
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
      $num++;
      if ($num==2){
      break;  
      }?>
 <strong>Agric Assistant from<br> <span style="color:#060"><u> <?php echo strtoupper($row['location']);?></u></span></strong>
 <?php
  }}
  ?> 
</div>
	<hr>
<?php include_once'bar1.php';?>
<hr>

<div class="row">
    <h4><strong>ACTIONS</strong></h4>
 <a id="link" style="color:#000" href="helper_forum.php"><span  style="font-size: 18px;color:#060" class="glyphicon glyphicon-comment"></span> <strong>Join Discussion Forum</strong> </a><hr>
   <a id="link" style="color:#000" href="helper_desk.php#advertbyfarmers"><span  style="font-size: 18px;color:#060" class="glyphicon glyphicon-usd"></span> <strong>Farmers sales</strong> </a><hr>
	<a id="link" style="color:#000"  href="helper_desk.php#questionsbyfarmers"><span style="font-size: 18px;color:#060" class="glyphicon glyphicon-envelope"></span> <strong>Messages</strong> </a><hr>
                      <a id="link" style="color: #000" href="inc/logout.php"><strong>LOGOUT NOW</strong></a>
 
    </div>
          
</div>
<div class="col-sm-6" style="border:2px solid #CCC;background-image:url(images/gmb.jpg);background-size: cover;background-attachment: fixed;background-position: center;">

<form name="bulk_action_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return changeConfirm();" enctype="multipart/form-data" style="background-color: #CCC;padding: 5px;margin-top:3px;border-radius: 3px">
	<h5 class="text-center"><strong><marquee scrolldelay="200">Help Farmers Now by Posting Tip Of The Day</marquee></strong></h5>
	 <div class="form-group">
	 	<input type="hidden" name="size" value="1000000" >
<span style="color: #060" class="glyphicon glyphicon-picture"></span><strong>Select Picture</strong><input type="file" id="image" name="image" class="form-control"/>
 <span style="color: #060" class="glyphicon glyphicon-pencil"></span><label style="color: #000" for="inputinfo">
 What are you thinking?</label> 

           <textarea name="message" class="form-control" placeholder="Say something today" id="inputinfo" rows="4">

		   </textarea>
		   
        </div>
  
  <button type="submit" name="helpers_tip"  class="btn btn-success"><span style="color:#FFF">Post Now</span></button>          
</form>
<div class="row">
<hr>
<div class="col-sm-12" style="background-color: #CCC;">
<h4 class="text-center"><a href=""> Recent Updates</a></h4>

<?php 
$num=0;
    $result = $pdo->prepare("SELECT * FROM tips ORDER BY id DESC");
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
      $num++;
      if ($num==3){
      break;  
      }
  ?>

<div class="alert alert-success" role="alert">
<p  style="color:#f00"><span style="color:#f00"
 class="glyphicon glyphicon-user"></span> <?php echo strtoupper($row['username']); ?></p>

<p><span style="color:#f00"
 class="glyphicon glyphicon-time"></span> <?php echo date("F j,Y - g:i a",strtotime($row['time'])); ?></p>
<hr>
<p><?php echo "<img  alt='no picture uploaded for this post' height='100px' width='30%' src='statuses/".$row['image']."' >" ?></p>
<p style="font-weight:bold;color:#000"><?php echo strtolower($row['message']); ?> <span style="color:#000"
 class="glyphicon glyphicon-thumbs-up"></span> </p> 
 </div>
 <?php
    }
  ?> 

</div>
</div>

</div>


<div class="col-sm-3">
	
<h4 class="text-success" style="background-color: #CCC;padding:3px"><strong>Nearby Farmers</strong></h4>
<?php 
$num=0;
    $result = $pdo->prepare("SELECT * FROM farmers ORDER BY id DESC");
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
      $num++;
      if ($num==6){
      break;  
      }
  ?>
 <div class="alert alert-success" role="alert">
<p><span class="glyphicon glyphicon-user"></span> <?php echo strtoupper($row['name']); ?></p>
<p><span class="glyphicon glyphicon-map-marker"></span>From: <?php echo strtoupper($row['location']); ?></p>
<p><span style="color:#000"><?php echo strtoupper($row['hectares']); ?> Hectares Farming land</span></p>
</div>
<?php
    }
  ?> 
<hr style="border:1px dotted #060">
<h5 class="text-success" style="background-color: #CCC;padding:3px"><strong>ACTIVE AGRICULTURAL HELPERS</strong></h5>
<?php 
$num=0;
    $result = $pdo->prepare("SELECT * FROM helpers ORDER BY id DESC");
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
      $num++;
      if ($num==6){
      break;  
      }
  ?>
 <div class="alert alert-success" role="alert">
<p><span class="glyphicon glyphicon-user"></span> <?php echo strtoupper($row['name']); ?></p>
<p><span class="glyphicon glyphicon-phone"></span> <?php echo strtoupper($row['phone']); ?></p>
<p><span class="glyphicon glyphicon-map-marker"></span>From: <?php echo strtoupper($row['location']); ?></p>
<p><span style="color:#000"><?php echo strtoupper($row['farming_level']); ?> Helper</span></p>
</div>
<?php
    }
  ?> 
<hr style="border:1px dotted #060">




</div>
</div>
</div>
<div class="container-fluid"
<div class="row">
<?php require_once'footer.php';?>
</div>
</div>

<?php
//farmer adverts
if(isset($_POST['helpers_tip'])){
$target="statuses/".basename($_FILES["image"]["name"]);
$username=($_SESSION['username']);
$image=$_FILES["image"]["name"];
$message= trim(filter_input(INPUT_POST,"message",FILTER_SANITIZE_SPECIAL_CHARS));
 if (empty($message)) {
   echo '<script> alert("Please provide your farming tip");</script>;window.location=("helper.php")</script>';
 }

 else{
$pdoQuery = "INSERT INTO `tips`(`username`,`image`,`message`)VALUES (?,?,?)"; 
$pdoResult = $pdo->prepare($pdoQuery);
$array=array($username,$image,$message);
$pdoExec = $pdoResult->execute($array);
   
   if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {
        echo '<script>alert("Your tip posted successfully");window.location=("helper.php")</script>';
   }

   else if ($pdoExec)
    { 
     echo '<script>alert("Your tip posted successfully");window.location=("helper.php")</script>';  
    
   } else
     { echo '<script>alert("Sorry our network is down");window.location=("helper.php")</script>'; 
     }
      } 
  }

//




?>

</body>
</html>