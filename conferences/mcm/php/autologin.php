<?php 
	session_start();
	require ("conferencecheck.php");
	if(!isset($_SESSION["user"] ) && !isset($_SESSION["email"]) && !isset($_SESSION["id"]))
	{
		header("location:../index.php");
	}
		$role=$_SESSION["role"];

		if( $role=="admin" )
		{
			header('Location:../php/viewpapers.php');
		}
		elseif ($role=="subadmin") 
		{
			header('Location:../php/subadminprofile.php');
		}
		else
		{
			header('Location:../php/userprofile.php');
		}







 ?>