<?php
 ob_start();
 session_start();
 require_once 'dbconnnect.php';
 //
 $query = "SELECT * FROM users";
 $res = mysql_query($query);
 $row = mysql_fetch_array($res);

 $_SESSION['user-id'] = $row['userId'];
 $_SESSION['user-name'] = $row['StaffName'];

 // it will never let you open index(login) page if session is set
 if ( isset($_SESSION['userId'])) {
  echo "Session is running". $_SESSION['userId'];
  exit;
 }

 $error = false;

 if( isset($_POST['btn-login']) ) {

  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs

  if(empty($email)){
   $error = true;
   $emailError = "Please enter your email address.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  }

  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }

  // if there's no error, continue to login
  if (!$error) {

   $password = hash('sha256', $pass); // password hashing using SHA256

   $res = mysql_query("SELECT userId, userName, userPass,userType FROM users WHERE userEmail='$email'");
   $row = mysql_fetch_array($res);
   $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row

   if( $count == 1 && $row['userPass']==$password && $row['userType']== 2  ) {
     $_SESSION['user'] = $row['userId'];
     header("Location: home.php");
   } elseif ($count == 1 && $row['userPass'] == $password && $row['userType']== 1 ) {
     # code...
     $_SESSION['user'] = $row['userId'];
     header("Location: AdminDashboard.php");
   } else {
     $errMSG = "Incorrect Credentials, Try again...";
   }
 }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login - User</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet" type ="text/css" href ="Bootstrap/css/styleLogin.css" >
<link rel = "stylesheet" type ="text/css" href ="Bootstrap/css/bootstrap.min.css" >
<!-- <script src="Bootstrap/js/script.js"></script> -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
 <div class="container">
    <div class="row">
     <div class="col-md-6 col-md-offset-3">
       <div class="panel panel-login">
         <div class="panel-body">
           <div class="row">
             <div class="col-lg-12">
               <form  method= "post" id="login-form" role="form" style="display: block;" action= "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                 <h2>LOGIN</h2>
                 <?php if ( isset($errMSG) ) { ?>
                   <?php } ?>
                   <div class= "form-group">
                     <input type="email" name="email" id="username" tabindex="1" class="form-control" placeholder="Email" value="">
                     <span class="text-danger"><?php echo $emailError; ?></span>
                   </div>
                   <div class="form-group">
                     <input type="password" name="pass" id="password" tabindex="2" class="form-control" placeholder="Password">
                     <span class="text-danger"><?php echo $passError; ?></span>
                   </div>
                   <div class="col-xs-6 form-group pull-left checkbox">
                     <input id="checkbox1" type="checkbox" name="remember">
                     <label for="checkbox1">Remember Me</label>
                   </div>
                   <div class="col-xs-6 form-group pull-right">
                     <input type="submit" name="btn-login" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                   </div>
               </form>
             </div>
           </div>
         </div>
         <div class="panel-heading">
           <div class="row">
             <div class="col-xs-6 tabs">
               <a href="login.php"  id="login-form-link"><div class="login">LOGIN</div></a>
             </div>
             <div class="col-xs-6 tabs">
               <a href="register.php" id="register-form-link"><div class="register">REGISTER</div></a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
 <footer>
     <div class="container">
         <div class="col-md-10 col-md-offset-1 text-center">
         </div>
     </div>
 </footer>

</body>
</html>
<?php ob_end_flush(); ?>
