<?php 
 session_start();
  if(!isset($_SESSION["adminverify"] )) 
  {
    header("location:adminlogin.php");
  }
  if(!isset($_REQUEST["cname"]))
  {
	header("location:adminlogin.php");
  }
	$cname=$_REQUEST["cname"];
	require ("connect.php");
	$sql="DELETE FROM conference WHERE cname='$cname'";
	mysqli_query($db1,$sql);
	require("connect2.php");
	$dname="con_".$cname;
	$sql1="DROP DATABASE $dname";
	mysqli_query($db2,$sql1);
	echo mysqli_error($db2);
	//////////////////////////////////////////////////////////////////
	function deleteDirectory($dirPath) {
    if (is_dir($dirPath)) {
        $objects = scandir($dirPath);
        foreach ($objects as $object) {
            if ($object != "." && $object !="..") {
                if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
                    deleteDirectory($dirPath . DIRECTORY_SEPARATOR . $object);
                } else {
                    unlink($dirPath . DIRECTORY_SEPARATOR . $object);
                }
            }
        }
    reset($objects);
    rmdir($dirPath);
    }
}


 if(file_exists("conferences/$cname"))
 {
        deleteDirectory("conferences/$cname");
 }


///////////////////////////////////////////////////////////////////////////////
echo json_encode(array('status'=>'success'));



 ?>