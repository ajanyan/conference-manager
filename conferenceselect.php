<!DOCTYPE html>
<html>
<head>
	<title>Econference</title>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.min.js"></script>
</head>
<body>

<?php 
if(!isset($_POST["conf"]))
{
	header("location:index.php");
}
$cname=$_POST["conf"];
session_start();
require("connect.php");
$sql="SELECT cstatus FROM conference";
$res=mysqli_query($db1,$sql);
$row=mysqli_fetch_assoc($res);
if($row["cstatus"]==1)
{
	$_SESSION["cname"]=$cname;
	header("location:$cname/index.php");
}
else
{
	          echo"<script>
               swal(
                'Request Pending',
                'Please contact admin',
                'warning'
                ).then(function() {
                window.location.href ='index.php'; 
              });
              </script>";
}
 ?>



</body>
</html>