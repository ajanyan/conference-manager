<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
  </style>
  <title>Econference</title>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.min.js"></script>
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
      <li class="nav-item active">
        <a class="nav-link" href="adminverify.php">Requested Conferences<span class="sr-only">(current)</span></a>
      </li>
  <!--     <li class="nav-item">
        <a class="nav-link" href="../php/completedpapers.php">Completed Papers</a>
      </li>
      <li class="nav-item">
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


if(isset($_POST["cstatus"]))
{

  require("connect.php");
  $name=$_POST["cname"];
  if($_POST["cstatus"]==1)
  {
    $val=0;
  }
  else
  {
    $val=1;
  }
  $sql1="UPDATE conference SET cstatus='$val' WHERE cname='$name'";
  if(mysqli_query($db1,$sql1))
  {
    if($val==0)
    {
      echo "<script>
        swal(
        'Deactivated',
        'You can activate when required',
       'warning'
            )
        </script>";
      }
      else
      {
        echo "<script>
        swal(
        'Approved',
        'You can deactivate when required',
       'warning'
            )
        </script>";

      }
    }
  }







require("connect.php");
$sql="SELECT * FROM conference ";
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
          if ($row['cstatus'] == 1) 
          {
              $status="Approved";
              $cstatus=1;
              $button="Deactivate";
          }
          elseif ($row['cstatus']== 0)
          {
              $status="Not approved";
              $cstatus=0;
              $button="Approve";
          }
         
          else
          {
            $status="Error";
          }         
          echo "<tr><td>{$row['cname']}</td>
          <td>$status</td>


          <td>
          <form action=adminverify.php method='post'>
          <input type='hidden' name ='cstatus' value='$cstatus'>
          <input type='hidden' name ='cname' value='$cname'>
          <input type='submit' class='btn btn-default' value ='$button' ></form>
          </td>
          </tr>";
         
        }
      }
    ?>
  </tbody>
</table>






<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>