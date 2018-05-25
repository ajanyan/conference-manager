<!DOCTYPE html>
<html>
<head>
    <title>Econference</title>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.min.js"></script>
</head>
<body>
<?php 

if(!isset($_POST["cname"]))
{
    header("location:requestconference.php");
}
function filecopy($source, $dest)
{
    // Check for symlinks
    if (is_link($source)) {
        return symlink(readlink($source), $dest);
    }
    
    // Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }

    // Make destination directory
    if (!is_dir($dest)) {
        mkdir($dest);
    }

    // Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Deep copy directories
        filecopy("$source/$entry", "$dest/$entry");
    }

    // Clean up
    $dir->close();
    return true;
}

require("connect.php");
$cname = $_POST["cname"];
$email = $_POST["email"];
$password = $_POST["password"];
$sql1 = "INSERT INTO conference (cname) VALUES('$cname')";
//print_r($sql1);
if(mysqli_query($db1,$sql1))
{
    echo "Please wait while creating conference...........";
    if(!file_exists("conferences/$cname"))
    {
        mkdir("conferences/$cname");
    }
    filecopy("resources","conferences/$cname");
    $myfile = fopen("conferences/$cname/php/dbinfo.php", "w");
    $txt = "<?php
    \$dbname='$cname';
?>";



    fwrite($myfile, $txt);

////////////////////////////////////////////////////////

    $myfile1 = fopen("conferences/$cname/php/conferencecheck.php", "w");
    $txt1 = "<?php
    if(!isset(\$_SESSION[\"cname\"]))
    {
        header(\"location:../../../index.php\");
        
    }
    if(\$_SESSION[\"cname\"]!='$cname')
    {
        session_destroy();
       header(\"location:../../../index.php\");
 
    }
?>";


    fwrite($myfile1, $txt1);
/////////////////////////////////////////////////////////



    require("connect2.php");
    $sql2="CREATE DATABASE $cname";


    mysqli_query($db2,$sql2);
    
    require("conferences/$cname/php/connect.php");
///////////////////////////////////////////////////////////////////////////////////////////////
$filename="db/data.sql";
// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysqli_query($db,$templine) ;
    // Reset temp variable to empty
    $templine = '';
}
}
 




//////////////////////////////////////////////////////////////////////////////////////////////  

    $sql3="INSERT INTO des VALUES('$cname','$email','$password','admin')";
    mysqli_query($db,$sql3);

    echo"<script>
               swal(
                'Completed...',
                'Please wait for admin approval',
                'success'
                ).then(function() {
                window.location.href ='index.php'; 
              });
              </script>";
}
else{
    echo"<script>
               swal(
                'Error...',
                'Conference Already Exist',
                'error'
                ).then(function() {
                window.location.href ='index.php'; 
              });
              </script>";
}


 ?>
</body>
</html>