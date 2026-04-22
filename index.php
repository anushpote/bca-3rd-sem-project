<?php
  session_start();

  $connect = mysqli_connect('localhost','root','','social_db');
	
  $errUser = "";
  $errPass = "";

  if($connect){
    if($_POST){
      $email = $_POST['email'];
      $password = md5($_POST['password']);
      
      $sql = "SELECT * FROM tbl_social_users WHERE email = '$email'";

      $query = $connect->query($sql);

      $current_user = $query->fetch_assoc();
      
      $sqlUsr = "SELECT * FROM tbl_social_users";
      $queryUsr = $connect->query($sqlUsr);

      $tot_friends = mysqli_num_rows($queryUsr);

      if($current_user){
        if($password == $current_user['password']){
          $_SESSION["userNo"] = $current_user['id'];
          $_SESSION["userID"] = $current_user['username'];
          $_SESSION["userEmail"] = $current_user['email'];
          $_SESSION["userPfp"] = $current_user['filename'];
          $_SESSION["userAddress"] = $current_user['address'];
          $_SESSION["userJoined"] = $current_user['joined'];
          $_SESSION["userBack"] = $current_user['background'];
          $_SESSION["userAbout"] = $current_user['about'];
          $_SESSION["userWeb"] = $current_user['web'];
          $_SESSION["userFriends"] = $tot_friends - 1;

          header('Location: home.php');
        }else{
          $errPass .= "Password Incorrect";
        }
      }else{
        $errUser .= "User does not Exist";
      }
    }
  }else{
    echo 'Could Not Connect';
  }
?>

<?php include_once('bs-links.php'); ?>

<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <title>
      Quick Meet - Login
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    rel="stylesheet">
    <link href="css/cs-login.css" rel="stylesheet">
  </head>
  <body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
    integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous"
    />
    <h1 class="text-center text-light"><b><i>Quick Meet</i></b></h1>
    <div class="container">
      <div class="row">
        <div class="col-md-11 mt-60 mx-md-auto">
          <div class="login-box bg-white pl-lg-5 pl-0">
            <div class="row no-gutters align-items-center">
              <div class="col-md-6">
                <div class="form-wrap bg-white">
                  <h4 class="btm-sep pb-3 mb-5">
                    Log In
                  </h4>
                  <form class="form" method="post" enctype="multipart/form-data" name="form-login">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group position-relative">
                          <span class="zmdi zmdi-account">
                          </span>
                          <input type = "email" name = "email" class = "form-control" placeholder="Email Address" required>
                          <span class="text-danger"><?php echo $errUser; ?></span>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group position-relative">
                          <span class="zmdi zmdi-email">
                          </span>
                          <input type = "password" name = "password" class = "form-control" placeholder="Password" required>
                          <span class="text-danger"><?php echo $errPass; ?></span>
                        </div>
                      </div>
                      <div class="col-12 text-lg-right">
                        <a href="#" class="c-black">
                          Forgot password ?
                        </a>
                      </div>
                      <div class="col-12 mt-30">
                       <button type = "submit" class = "btn btn-lg btn-custom btn-dark btn-block">login</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-6">
                <div class="content text-center">
                  <div class="border-bottom pb-5 mb-5">
                    <h3 class="c-black">
                      First time here?
                    </h3>
                    <a href="signup.php" class="btn btn-custom">
                      Sign up
                    </a>
                  </div>
                  <h5 class="c-black mb-4 mt-n1">
                    Or Sign In With
                  </h5>
                  <div class="socials">
                    <a href="#" class="zmdi zmdi-facebook">
                    </a>
                    <a href="#" class="zmdi zmdi-twitter">
                    </a>
                    <a href="#" class="zmdi zmdi-google">
                    </a>
                    <a href="#" class="zmdi zmdi-instagram">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js">
    </script>
    <script type="text/javascript">
    </script>
  </body>

</html>