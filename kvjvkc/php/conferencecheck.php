<?php
	if(!isset($_SESSION["cname"]))
	{
		header("location:../../index.php");
		
	}
	if($_SESSION["cname"]!='kvjvkc')
    {
       header("location:../../index.php");
 
    }
?>