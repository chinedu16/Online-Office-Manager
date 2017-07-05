<?php
 ob_start();
 session_start();
 if( isset($_SESSION['userId'])!="" ){
  header("Location: home.php");
 }
 include_once 'dbconnnect.php';

 $error2 = false;

 if ( isset($_POST['register-submit']) ) {

  // clean user inputs to prevent sql injections
  $name2 = trim($_POST['username']);
  $name2 = strip_tags($name2);
  $name2 = htmlspecialchars($name2);

  $email2 = trim($_POST['email2']);
  $email2 = strip_tags($email2);
  $email2 = htmlspecialchars($email2);

  $pass2 = trim($_POST['password']);
  $pass2 = strip_tags($pass2);
  $pass2 = htmlspecialchars($pass2);

  // basic name validation
  if (empty($name2)) {
   $error2 = true;
   $name2Error = "Please enter your full name.";
  } else if (strlen($name2) < 3) {
   $error2 = true;
   $name2Error = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name2)) {
   $error2 = true;
   $name2Error = "Name must contain alphabets and space.";
  }

  //basic email validation
  if ( !filter_var($email2,FILTER_VALIDATE_EMAIL) ) {
   $error2 = true;
   $email22Error = "Please enter valid email address.";
  } else {
   // check email exist or not
   $query = "SELECT userEmail FROM users WHERE userEmail='$email2'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=0){
    $error2 = true;
    $email22Error = "Provided Email is already in use.";
   }
  }
  // password validation
  if (empty($pass2)){
   $error2 = true;
   $pass22Error = "Please enter password.";
  } else if(strlen($pass2) < 6) {
   $error2 = true;
   $pass22Error = "Password must have atleast 6 characters.";
  }

  // password encrypt using SHA256();
  $pass2word = hash('sha256', $pass2);

  // if there's no error, continue to signup
  if( !$error2 ) {

   $query = "INSERT INTO users(userName,userEmail,userPass,userType) VALUES('$name2','$email2','$pass2word',2)";
   $res = mysql_query($query);

   if ($res) {
    $err2Typ = "success";
    $err2MSG = "Successfully registered, you may login now";
    unset($name2);
    unset($email2);
    unset($pass2);
   } else {
    $err2Typ = "danger";
    $err2MSG = "Something went wrong, try again later...";
   }

  }


 }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration- Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet" type ="text/css" href ="Bootstrap/css/styleLogin.css" >
<link rel = "stylesheet" type ="text/css" href ="Bootstrap/css/bootstrap.min.css" >
</head>
<body>
  <div class="container">
     <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form id="register-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" style="display: block;">
                  <h2>REGISTER</h2>
                  <?php if ( isset($err2MSG) ) { ?>
                    <div class="form-group">
                      <div class="alert alert-<?php echo ($err2Typ=="success") ? "success" : $err2Typ; ?>">
                        <span class="glyphicon glyphicon-info-sign"></span> <?php echo $err2MSG; ?>
                      </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                      <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                      <span class="text-danger"><?php echo $nameError; ?></span>
                    </div>
                    <div class="form-group">
                      <input type="email" name="email2" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                      <span class="text-danger"><?php echo $email2Error; ?></span>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                          <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                        </div>
                      </div>
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
