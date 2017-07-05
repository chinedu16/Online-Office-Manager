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
<html>
<head>
  <title>Upload - Access Documents</title>
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
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><b class="caret"></b></a>
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
                  <li>
                      <a href="viewanswerquery.php"><i class="fa fa-fw fa-bar-chart-o"></i> View Answered Query</a>
                  </li>
                  <li class="active">
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
            <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">
                          Upload Document <small></small>
                      </h1>
                      <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Passing information
                        </li>
                        </div>
                      </ol>
                  </div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
              <input type="file" name="file" />
                    <button type="submit" name="btn-upload">upload</button>
                  </form>
                  <?php
                  if(isset($_GET['success'])) {
                    ?>
                    <label>File Uploaded Successfully...  <a href="uploaded.php">click here to view file.</a></label>
                    <?php
                  } else if(isset($_GET['fail'])) {
                    ?>
                    <label>Problem While File Uploading !</label>
                    <?php
                  }
                  else
                  {
                    ?>
                    <label>Try to upload any files(PDF, DOC, EXE, VIDEO, MP3, ZIP,etc...)</label>
                    <?php
                  }
                  ?>

</div>
</div>
<br /><br />
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
        window.location.href='uploads.php?success';
        </script>
  <?php
 }
 else
 {
  ?>
  <script>
  alert('error while uploading file');
        window.location.href='uploads.php?fail';
        </script>
  <?php
 }
}
 ob_end_flush(); ?>
