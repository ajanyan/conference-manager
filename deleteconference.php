<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
  </style>
  <title>Econference</title>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.min.js"></script> -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> -->
</head>
<body>


  <nav class="navbar navbar-expand-md navbar-dark bg-danger">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Welcome</a>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="adminverify.php">Requested Conferences<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="deleteconference.php">Delete Conference</a>
      </li>
    <!--   <li class="nav-item">
        <a class="nav-link" href="../php/viewsubadmin.php">Manage Reviewer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../php/acceptedpapers.php">Accepted Papers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../php/rejectedpapers.php">Rejected Papers</a>
      </li>
     <li class="nav-item">
        <a class="nav-link" href="../php/trashedpapers.php">Trash</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../php/up.php">Upload</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../php/changepassword.php">Change Password</a>
      </li> -->

    </ul>
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../design-team.html">Design Team</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
     
    </ul>

  </nav>


    

<?php
  session_start();
  if(!isset($_SESSION["adminverify"] )) 
  {
    header("location:adminlogin.php");
  }


if(isset($_POST["cname"]))
{

  require("connect.php");
  $name=$_POST["cname"];



  echo"<script>
swal({
  title: 'Are you sure?',
  text: 'Once deleted, you will not be able to recover this files',
  icon: 'warning',
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
 var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {



 swal('Conference deleted!', {
      icon: 'success',
    }).then((deleted) => {
    	if(deleted){
    		window.location.href = window.location.href;
    	}
    	}); 




     }
};
xhttp.open('GET', 'removeconference.php?cname=$name', true);
xhttp.send();



   
  } else {
    swal('Deletion Cancelled by User',{icon:'warning'});
    
   
  }
});
</script>";

  
}


require("connect.php");
$sql="SELECT * FROM conference WHERE cstatus=0";
$res=mysqli_query($db1,$sql);
echo mysqli_error($db1);





?>


<table class="table table-striped">
  <thead>
    <tr>
      <th>Conference</th>
      <th>Status</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
      if( mysqli_num_rows( $res )==0 )
      {
        echo '<tr><td colspan="2">No Conference Found</td></tr>';
      }
      else
      {
       
        while($row=mysqli_fetch_assoc($res))
        { 
          $cname=$row["cname"];
                      
          echo "<tr><td>{$row['cname']}</td>
          <td>Not Active</td>
          <td>
          <form action='deleteconference.php' method='post'>
          <input type='hidden' name ='cname' value='$cname'>
          <input type='submit' class='btn btn-default' value ='Delete' ></form>
          </td>
          </tr>";
         
        }
      }
    ?>
  </tbody>
</table>




<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<!-- <script type="text/javascript" src="../js/bootstrap.min.js"></script> -->
</body>
</html>