<?php
    if(!isset($_SESSION["cname"]))
    {
        header("location:../../../index.php");
        
    }
    if($_SESSION["cname"]!='mcm')
    {
        session_destroy();
       header("location:../../../index.php");
 
    }
?>