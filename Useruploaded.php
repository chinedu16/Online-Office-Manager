<?php
 ob_start();
 session_start();
 require_once 'dbconnnect.php';

 if ( !isset($_SESSION['user-id'])) {
  header("Location: login.php");
  exit;
}
// select logged in users detail
$res = mysql_query("SELECT * FROM users WHERE userId ='".$_SESSION['user-id']."'");
$userRow = mysql_fetch_array($res);

$id = $userRow['userId'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>User -Welcome <?php echo $userRow['userEmail']; ?>  </title>

    <!-- Bootstrap -->
    <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="Bootstrap/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>ffice Manager</span></a>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/35348-capturegive.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $userRow['userName']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li >
                    <a href="home.php"><i class="fa fa-edit"></i> Home</a>
                  </li>
                  <li>
                    <a href="viewTask.php"><i class="fa fa-edit"></i> View task</a>
                  </li>
                  <li>
                    <a href="request.php"><i class="fa fa-edit"></i> Request/Complains</a>
                  </li>
                  <li>
                    <a href="viewQuery.php"><i class="fa fa-edit"></i> View Query</a>
                  </li>
                  <li class="active">
                    <a href="UserUploads.php"><i class="fa fa-edit"></i> Uploads Document/material</a>
                  </li>
                  <li>
                    <a href="logout.php?logout"><i class="fa fa-edit"></i> Logout</a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/35348-capturegive.png" alt=""><?php echo $userRow['userEmail']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Uploaded Files
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> download Shared Contents
                            </li>
                </ol>
            </div>
          </div>
          <table width="80%" border="1" class="table table-bordered table-hover table-striped">
             <tr>
             <th colspan="4">your uploads...<label><a href="UserUploads.php">upload new files...</a></label></th>
             </tr>
             <tr>
             <td>File Name</td>
             <td>File Type</td>
             <td>File Size(KB)</td>
             <td>View</td>
             </tr>
             <?php
          $sql="SELECT * FROM uploadin";
          $result_set=mysql_query($sql);
          while($row=mysql_fetch_array($result_set))
          {
           ?>
                 <tr>
                 <td><?php echo $row['file'] ?></td>
                 <td><?php echo $row['type'] ?></td>
                 <td><?php echo $row['size'] ?></td>
                 <td><a href="images/<?php echo $row['file'] ?>" target="_blank">view file</a></td>
                 </tr>
                 <?php
          }
          ?>
             </table>

        </div>

          <!-- /top tiles -->
    </body>
</html>
<?php
#define('UPLOADPATH','images');
if(isset($_POST['btn-upload'])){
  $file = rand(1000,100000)."-".$_FILES['file']['name'];
  $file_loc = $_FILES['file']['tmp_name'];
  $file_size = $_FILES['file']['size'];
  $file_type = $_FILES['file']['type'];
  $folder="images/";
 // new file size in KB
 $new_size = $file_size/1024;
 // new file size in KB

 // make file name in lower case
 $new_file_name = strtolower($file);
 // make file name in lower case

 $final_file=str_replace(' ','-',$new_file_name);

 if(move_uploaded_file($file_loc,$folder.$final_file)){
  $sql="INSERT INTO uploadin(file,type,size) VALUES('$final_file','$file_type','$new_size')";
  mysql_query($sql);
  ?>
  <script>
  alert('successfully uploaded');
        window.location.href='UserUploads.php?success';
        </script>
  <?php
 }
 else
 {
  ?>
  <script>
  alert('error while uploading file');
        window.location.href='UserUploads.php?fail';
        </script>
  <?php
 }
}
 ob_end_flush(); ?>
