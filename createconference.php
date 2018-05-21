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
if(mysqli_query($db,$sql1))
{
	echo "Please wait while creating conference...........";
	if(!file_exists("$cname"))
	{
		mkdir("$cname");
	}
	filecopy("resources","$cname");
	$myfile = fopen("$cname/php/dbinfo.php", "w");
	$txt = "<?php
	\$dbname='$cname';
?>";



	fwrite($myfile, $txt);
	echo "Completed";
}
else
echo mysqli_error($db);

 ?>