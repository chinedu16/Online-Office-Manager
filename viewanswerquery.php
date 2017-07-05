<?php
 ob_start();
 session_start();
 require_once 'dbconnnect.php';
 if (!isset($_SESSION['user-id'])!="" ) {
  header("Location: login.php");
  exit;
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
                    <li>
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
                    <li class="active">
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
                <?php  $res = mysql_query("SELECT * FROM answer_query");?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            View Answered Queries <small></small>
                        </h1>
                        <ol class="breadcrumb">
                          <li class="active">
                              <i class="fa fa-dashboard"></i> From Staffs
                          </li>
                          </div>
                        </ol>
                    </div>
                    <?php
                    while ($userRow = mysql_fetch_array($res)) {
                    $first = $userRow['staffName'];
                     $second = $userRow['date_answer'];
                     $third = $userRow['answer_text'];

                     echo "<div class='jumbotron'>";
                     echo "From:<label> $first</label><br/>";
                     echo "Subject: <label value='Query'> Query Reply </label><br/>";
                     echo "Date:<label for='date'> $second</label><br/>";
                     echo "Query Body: <label>$third </label><br/>";
                     echo "<p><a class='btn btn-primary btn-xl' onclick='window.print()' role='button'>Print</a>";
                     echo "</div>";
                    }
                     ?>



                    </div>
                </div>

                <!-- /.row -->

        <!-- /.row -->
      </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    <!-- /#wrapper -->
</body>
</html>
