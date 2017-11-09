<?php 
session_start();
function session_check(){
if(!isset($_SESSION['username'])){
 header("location:index.php?action=Register & Login Today");
}
}
 ?>