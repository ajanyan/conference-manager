<?php
    if(!isset($_SESSION["cname"]))
    {
        header("location:../../../index.php");
        
    }
    if($_SESSION["cname"]!='aaaa')
    {
        session_destroy();
       header("location:../../../index.php");
 
    }
?>