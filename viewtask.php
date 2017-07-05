<?php
 ob_start();
 session_start();
 require_once 'dbconnnect.php';

 // if session is not set this will redirect to login page
 if(!isset($_SESSION['user-id']) ) {
   header("Location: login.php");
   exit;
 }
 $res1 = mysql_query("SELECT * FROM users WHERE userId ='".$_SESSION['user-id']."'");
 $userRow1 = mysql_fetch_array($res1);

 // select logged in users detail
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>User -Welcome <?php echo $userRow1['userEmail']; ?>  </title>
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
                <h2><?php echo $userRow1['userName']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li>
                    <a href="home.php"><i class="fa fa-edit"></i> Home</a>
                  </li>
                  <li class="active">
                    <a href="viewTask.php"><i class="fa fa-edit"></i> View task</a>
                  </li>
                  <li>
                    <a href="request.php"><i class="fa fa-edit"></i> Request/Complains</a>
                  </li>
                  <li  >
                    <a href="viewQuery.php"><i class="fa fa-edit"></i> View Query</a>
                  </li>
                  <li>
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
                    View task
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> from HOD
                    </li>
                </ol>
            </div>
          </div>
          <?php
          $var = $userRow1['userName'];
          $query = "SELECT * FROM task_db WHERE staffName = '$var'";
          $result = mysql_query($query);
            echo "<table class='table table-bordered table-hover table-striped'>
            <thead>
                  <tr>
                      <th>Staff Names</th>
                      <th>Task Description</th>
                      <th>Deadline</th>
                      <th>Status</th>
                  </tr>
              </thead>";
              while ($row = mysql_fetch_array($result)) {
                $testing = $row[userName];
                $names = $row[staffName];
                $date = $row[descripion];
                $status = $row[deadline];
                $part_id = $row[taskID];
                echo "<tbody>";
                echo "<tr>";
                echo "<td> $names</td>";
                echo "<td> $date </td>";
                echo "<td> $status </td>";
                echo "<td> <a href='fixed.php?userDetails=$part_id'>Completed</a><br/> <a href='notfixed.php?userDetails=$part_id'>Not Completed</a></td>";
                echo "</tr>";
                echo "</tbody>";
              }
             ?>


             </table>
        </div>
          <!-- /top tiles -->
    </body>
</html>
<?php ob_end_flush(); ?>
