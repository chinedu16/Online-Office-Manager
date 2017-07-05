<?php
 ob_start();
 session_start();
 require_once 'dbconnnect.php';

 if ( !isset($_SESSION['user-id'])!="" ) {
  header("Location: login.php");
  exit;
 }

 if ( isset($_POST['btn-Request']) ) {
   // clean user inputs to prevent sql injections
   $days = trim($_POST['days']);
   $reasons = trim($_POST['reasons']);
   if (!empty($days) && !empty($reasons)) {
     //getting users name
     $res = mysql_query("SELECT * FROM users WHERE userId =".$_SESSION['user']);
     $row = mysql_fetch_array($res);
     $theusername = $row[userName];
      if(!empty($row)){
       $query = "INSERT INTO request_db(request_id,userName,days,reason,status) VALUES ('NULL','$theusername','$days','$reasons','Not Attended to')";
       $notice = mysql_query($query);
       ?>
       <script>
       alert('Request/Complain And successfully');
             window.location.href='request.php?success';
             </script>
       <?php
     } else {
       ?>
       <script>
       alert('error while sending Request/Complain');
             window.location.href='request.php?fail';
             </script>
       <?php
     }
   }
}else {
  echo "could not get input";# code...
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>User -Welcome <?php echo $userRow['userEmail']; echo $theusername; ?>  </title>

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
                  <li>
                    <a href="home.php"><i class="fa fa-edit"></i> Home</a>
                  </li>
                  <li>
                    <a href="viewTask.php"><i class="fa fa-edit"></i> View task</a>
                  </li>
                  <li class="active">
                    <a href="request.php"><i class="fa fa-edit"></i> Request/Complains</a>
                  </li>
                  <li>
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
                    Make Request or Lay Complains
                   </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Head of Department
                    </li>
                </ol>
            </div>
          </div>
          <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Fill Form <small>click submit when done</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Request/Complains title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="days" type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Details <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control" name="reasons" required="reuired" rows="6" placeholder=''></textarea>
                        </div>
                      </div>
                    <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="btn-Request" class="btn btn-success">Submit</button>
                          <button type="submit" class="btn btn-primary">Cancel</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="row tile_count">
              <div class="col-lg-12">
                  <h1 class="page-header">
                      View Status
                     </h1>
                  <ol class="breadcrumb">
                      <li class="active">
                          <i class="fa fa-dashboard"></i> Scroll Down
                      </li>
                  </ol>
              </div>
              <?php
              $query = "SELECT * FROM request_db";
              $result = mysql_query($query);
                echo "<table class='table table-bordered table-hover table-striped'>
                <thead>
                      <tr>
                          <th>Staff Names</th>
                          <th>Requests or Complains</th>
                          <th>Reasons</th>
                          <th>Status</th>
                      </tr>
                  </thead>";
                  while ($row = mysql_fetch_array($result)) {
                    $testing = $row[status];
                    $names = $row[userName];
                    $date = $row[days];
                    $status = $row[reason];
                    $part_id = $row[request_id];
                    echo "<tbody>";
                    echo "<tr>";
                    echo "<td> $names</td>";
                    echo "<td> $date </td>";
                    echo "<td> $status </td>";
                    echo "<td> $testing</td>";
                    echo "</tr>";
                    echo "</tbody>";
                  }
                 ?>

               </table>


            </div>
        </div>
          <!-- /top tiles -->
    </body>
</html>
<?php ob_end_flush(); ?>
