<!DOCTYPE html>
<html>
<head>
	<title>Econference</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.min.js"></script>
</head>
<body>
<?php 
	if(!isset($_POST["email"]))
	{
		header("location:adminlogin.php");
	}
	$user=$_POST["email"];
	$pass=$_POST["password"];
	print_r($_POST); 	
	require("connect.php");
	$sql="SELECT * FROM admin WHERE username='$user' AND password='$pass'";
	$res=mysqli_query($db1,$sql);
	$num=mysqli_num_rows($res);
	echo mysqli_error($db1);
	echo $sql;
	if($num==1)
	{
		session_start();
		$_SESSION["adminverify"]=$user;
		header("location:adminverify.php");

	}
	else
	{
	//	 echo"<script>
      //         swal(
        //        'Oops...',
          //      'Username and Password does not match',
            //    'warning'
              //  ).then(function() {
                //window.location.href ='adminlogin.php'; 
              //});
           //   </script>";
	}



 ?>
</body>
</html>