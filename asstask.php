<?php
 ob_start();
 session_start();
 require_once 'dbconnnect.php';
 if (!isset($_SESSION['user-id'])!="" ) {
  header("Location: login.php");
  exit;

  $error = false;
  $noerror =False;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Welcome - <?php echo $userRow['userEmail']; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="Bootstrap/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Officer Manager Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['userName'];?> <b class="caret"></b></a>
                  </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="AdminDashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="asstask.php"><i class="fa fa-fw fa-bar-chart-o"></i> Assign Task</a>
                    </li>
                    <li>
                        <a href="viewtaskStats.php"><i class="fa fa-fw fa-bar-chart-o"></i> View Task Progress</a>
                    </li>
                    <li>
                        <a href="viewrequestAdmin.php"><i class="fa fa-fw fa-bar-chart-o"></i> View Request/Complains</a>
                    </li>
                    <li>
                        <a href="giveQuery.php"><i class="fa fa-fw fa-table"></i> Give Query</a>
                    </li>
                    <li>
                        <a href="viewanswerquery.php"><i class="fa fa-fw fa-bar-chart-o"></i> View Answered Query</a>
                    </li>
                    <li>
                        <a href="uploads.php"><i class="fa fa-fw fa-bar-chart-o"></i> Upload Documents</a>
                    </li>
                    <li>
                        <a href="logout.php?logout"><i class="fa fa-fw fa-bar-chart-o"></i> Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Assign Task <small></small>
                        </h1>
                        <?php if (isset($errMSG) ) { ?>
                        <ol class="breadcrumb">
                          <li class="active">
                              <i class="fa fa-dashboard"></i> Task
                          </li>
                          </div>
                        </ol>
                    </div>
                </div>
                <?php } ?>
                <!-- /.row -->
                <form role="form" name="register" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <div class="form-group">
                    <?php
                    $sql = "SELECT userName,userId FROM users order by userName";
                    $result = mysql_query($sql);
                    echo "<select name='student'>";
                    while ($row = mysql_fetch_array($result)){
                    echo "<option> $row[userName] </option>";
                  }
                  echo "</select>";
                  ?>
                  <p class="help-block">Pick Staff</p>
              </div>
              <div class="form-group">
                <label>Task Descrription</label>
                <textarea class="form-control" name =" description" rows="7" required="required"></textarea>
              </div>
              <div class="form-group">
                <label>Deadline</label>
                <input name="deadline" class="form-control" required="required">
              </div>
              <button name="submit" type="submit" class="btn btn-default">Assign Task</button>
              <button type="reset" class="btn btn-default">Reset</button>
            </form>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>
</html>
<?php
   if( isset($_POST['submit']) ) {
     $des = $_POST['description'];
     $dead = $_POST['deadline'];

     //dis gets the userName
     $deada = $_POST['student'];

    $query = "INSERT INTO task_db(staffName,descripion,deadline,completed) VALUES ('$deada','$des','$dead','No')";
    $res = mysql_query($query);
    //
    if (!$res){
      echo "<div class='alert alert-danger'><strong>Did Not Submit Data? Something Went Wrong</strong> </div>";

    } else {
      echo "<div class='alert alert-success'><strong>Success</strong> </div>";

      unset($des);
      unset($dead);
       }
     }
ob_end_flush(); ?>
