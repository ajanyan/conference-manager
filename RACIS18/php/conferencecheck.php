<?php
    if(!isset($_SESSION["cname"]))
    {
        header("location:../../index.php");
        
    }
    if($_SESSION["cname"]!='RACIS18')
    {
       header("location:../../index.php");
 
    }
?>