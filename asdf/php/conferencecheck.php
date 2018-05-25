<?php
	if(!isset($_SESSION["cname"]))
	{
		header("location:../../index.php");
		
	}
	if($_SESSION["cname"]!='asdf')
    {
       header("location:../../index.php");
 
    }
?>