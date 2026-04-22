<?php
  session_start();

  $connect = mysqli_connect('localhost','root','','social_db');

  if($connect){
    if(isset($_POST['upload'])){
      $id = $_SESSION['userNo'];
      $usernameCurr = $_SESSION['userID'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $about = $_POST['about'];
      $website = $_POST['web'];

      if(!empty($_FILES["uploadfile"]["name"])){        
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "./pfp/" . $filename;

        if (move_uploaded_file($tempname, $folder)) {
            // echo "Changes made successfully!";
        } else {
            // echo "Failed to make changes!";
        }
      }else{
        $filename = $_SESSION['userPfp'];
      }

      if(!empty($_FILES["uploadBack"]["name"])){        
        $background = $_FILES["uploadBack"]["name"];
        $tempname = $_FILES["uploadBack"]["tmp_name"];
        $folder = "./background/" . $background;

        if (move_uploaded_file($tempname, $folder)) {
            // echo "Changes made successfully!";
        } else {
            // echo "Failed to make changes!";
        }
      }else{
        $background = $_SESSION['userBack'];
      }


      $sqlComm = "UPDATE tbl_social_comments SET byUser = '$username', commPfp = '$filename' WHERE byUser = '$usernameCurr'";
      $sqlPost = "UPDATE tbl_posts SET user = '$username', pfp = '$filename' WHERE user = '$usernameCurr'";
      $sql = "UPDATE tbl_social_users SET username = '$username', email = '$email', address = '$address', 
              filename = '$filename', background = '$background', about = '$about', web = '$website' WHERE id = '$id'";

      mysqli_query($connect, $sqlComm);
      mysqli_query($connect, $sqlPost);
      mysqli_query($connect, $sql);
      
      $_SESSION["userID"] = $username;
      $_SESSION["userEmail"] = $email;
      $_SESSION["userPfp"] = $filename;
      $_SESSION["userAddress"] = $address;
      $_SESSION["userBack"] = $background;
      $_SESSION["userAbout"] = $about;
      $_SESSION["userWeb"] = $website;

      header('Location: home.php');
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
      <?php echo $_SESSION["userID"]; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    rel="stylesheet">
    <link href="css/cs-edit.css" rel="stylesheet">
  </head>
  
  <body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"
    rel="stylesheet">
    <div class="container bootstrap snippets bootdeys">
      <div class="row">
        <div class="col-xs-12 col-sm-9">
          <form class="form-horizontal" method="POST" enctype="multipart/form-data" name="form-edit">
            <div class="panel panel-default">
              <div class="panel-body text-center">
              	<?php if(!empty($_SESSION['userPfp'])) { ?>
	                <img src="./pfp/<?php echo $_SESSION['userPfp']; ?>" class="img-circle profile-avatar"
	                alt="User avatar">
	              <?php }else{ ?>
	                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-circle profile-avatar" alt="profile cover">
	              <?php } ?>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  User info
                </h4>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">
                    Username
                  </label>
                  <div class="col-sm-10">
                    <input type = "text" name = "username" class = "form-control" placeholder="Your Username" value="<?php echo $_SESSION['userID']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">
                    Address
                  </label>
                  <div class="col-sm-10">
                    <input type = "text" name = "address" class = "form-control" placeholder="Your Address" value="<?php echo $_SESSION['userAddress']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">
                    Email
                  </label>
                  <div class="col-sm-10">
                    <input type = "email" name = "email" class = "form-control" placeholder="Your Email" value="<?php echo $_SESSION['userEmail']; ?>" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  Personaliztion
                </h4>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">
                    Profile Picture
                  </label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="uploadfile" value="" accept="image/*">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">
                    Background Image
                  </label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="uploadBack" value="" accept="image/*">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">
                    Your Website
                  </label>
                  <div class="col-sm-10">
                    <input class="form-control" name="web" placeholder="About yourself" value=""></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">
                    About Yourself
                  </label>
                  <div class="col-sm-10">
                    <input class="form-control" placeholder="About yourself" value="<?= $_SESSION['userAbout']; ?>" name="about"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  Security
                </h4>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">
                    Current password
                  </label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">
                    New password
                  </label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-2">
                    <div class="checkbox">
                      <input type="checkbox" id="checkbox_1">
                      <label for="checkbox_1">
                        Make this account public
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-2">
                    <button type = "submit" class = "btn btn-primary mt-2" name="upload">Edit</button>
                    <button type="reset" class="btn btn-default">
                      <a href="home.php" class="text-dark">Cancel</a>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js">
    </script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    </script>
    <script type="text/javascript">
    </script>
  </body>

</html>