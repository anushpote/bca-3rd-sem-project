<?php
  session_start();

  $connect = mysqli_connect('localhost','root','','social_db');

	$errPass = '';

  if($connect){
    if(isset($_POST['upload'])){
      $username = $_POST['username'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $password = md5($_POST['password']);
      $confirm = md5($_POST['confirm']);
      
      $filename = $_FILES["uploadfile"]["name"];
      $tempname = $_FILES["uploadfile"]["tmp_name"];
      $folder = "./pfp/" . $filename;
      $date = date('d-m-Y');

      if($confirm == $password){
        $sql = "INSERT INTO tbl_social_users(username,email,password,filename,address,joined) VALUES ('$username','$email','$password','$filename','$address','$date')";

	      if (move_uploaded_file($tempname, $folder)) {
	          // echo "<h3>&nbsp; Profile Successfully Created!</h3>";
	      } else {
	          // echo "<h3>&nbsp; Failed to create Account!</h3>";
	      }

        mysqli_query($connect, $sql);
        header('Location:index.php');
      }else{
        $errPass .= 'Passwords do not match';
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
      Quick Meet - Signup
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
                    Sign Up
                  </h4>
                  <form class="form" method="post" enctype="multipart/form-data" name="form-signup">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group position-relative">
                          <span class="zmdi zmdi-account">
                          </span>
                          <input type = "text" name = "username" class = "form-control" placeholder="Username" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group position-relative">
                          <span class="zmdi zmdi-email">
                          </span>
                          <input type = "email" name = "email" class = "form-control" placeholder="Email Address" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group position-relative">
                          <span class="zmdi zmdi-balance">
                          </span>
                          <input type = "text" name = "address" class = "form-control" placeholder="Your Address" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group position-relative">
                          <span class="zmdi zmdi-pin">
                          </span>
                          <input type = "password" name = "password" class = "form-control" placeholder="password" required>
                        </div>
                        <span class="text-danger"><?php echo $errPass ?></span>
                      </div>
                      <div class="col-12">
                        <div class="form-group position-relative">
                          <span class="zmdi zmdi-pin-drop">
                          </span>
                          <input type = "password" name = "confirm" class = "form-control" placeholder="Repeat Password" required>
                        </div>
                        <span class="text-danger"><?php echo $errPass ?></span>
                      </div>
                      <div class="col-12">
                        <div class="form-group position-relative">
                          <span class="zmdi zmdi-camera-add">
                          </span>
                          <input class="form-control ml-5 w-100" type="file" name="uploadfile" value="" accept="image/*">
                        </div>
                      </div>
                      <div class="col-12 text-lg-right">
                        <a href="#" class="c-black">
                          Forgot password ?
                        </a>
                      </div>
                      <div class="col-12 mt-30">
                       <button type = "submit" class = "btn btn-lg btn-custom btn-dark btn-block" name="upload">Sign Up</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-6">
                <div class="content text-center">
                  <div class="border-bottom pb-5 mb-5">
                    <h3 class="c-black">
                      Already signed up?
                    </h3>
                    <a href="index.php" class="btn btn-custom">
                      Log in
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