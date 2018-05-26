<?php
    if(!isset($_SESSION["cname"]))
    {
        header("location:../../../index.php");
        
    }
    if($_SESSION["cname"]!='a')
    {
        session_destroy();
       header("location:../../../index.php");
 
    }
?>