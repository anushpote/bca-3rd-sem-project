<?php
  session_start();
  $id = $_GET['id'];
  $id_curr = $_SESSION["userNo"];
  
  $connect = mysqli_connect('localhost','root','','social_db');

  $errIns = "";

  if($connect){
    $sql = "SELECT * FROM tbl_social_users WHERE id = '$id'";
    $sqlUsr = "SELECT * FROM tbl_social_users";

    $sqlMsgUser = "SELECT * FROM tbl_social_messages WHERE (userID = '$id_curr' AND toUser = '$id') OR (userID = '$id' AND toUser = '$id_curr')";

    $queryUsr = $connect->query($sqlUsr);

    $query = $connect->query($sql);
    $user = $query->fetch_assoc();

    $username = $user['username'];
    $email = $user['email'];
    $address = $user['address'];
    $date = $user['joined'];
    $pfp = $user['filename'];
    $back = $user['background'];
    $about = $user['about'];

    $sqlMsg = "SELECT * FROM tbl_posts WHERE user = '$username' ORDER BY id DESC";
    
    $msg = $connect->query($sqlMsg);
    
    $messages = $connect->query($sqlMsgUser);
    
    if(isset($_POST['msgsubmit'])){
      $dateandtime = date('d-m-Y h:i:s');
      $messageCurr = $_POST['message'];
      $sqlInsert = "INSERT INTO tbl_social_messages(userID,message,dateandtime,toUser) VALUES ('$id_curr','$messageCurr','$dateandtime','$id')";

      mysqli_query($connect, $sqlInsert);
    	$messages = $connect->query($sqlMsgUser);
    }
  }else{
    echo 'Could not connect';
  }
?>

<?php include_once('bs-links.php'); ?>

<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <title>
      QuickMeet - Message
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"
    rel="stylesheet">
    <link href="css/cs-message.css"
    rel="stylesheet">
  </head>
  
  <body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"
    rel="stylesheet">
    <div class="container bootstrap snippets bootdey">
      <div class="tile tile-alt" id="messages-main">
        <div class="ms-menu">
          <div class="ms-user clearfix">
            <?php if(!empty($_SESSION['userPfp'])){ ?>
              <img src="./pfp/<?= $_SESSION['userPfp']; ?>" alt class="img-avatar pull-left">
            <?php }else{ ?>
              <img class="img-avatar pull-left" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt>
            <?php } ?>
            <div>
              Signed in as
              <br>
              <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="ddb0f0b5b2b1b1bcaabca49dbab0bcb4b1f3beb2b0">
                <?php echo $_SESSION['userEmail']; ?>
              </a>
            </div>
          </div>
          <div class="p-15">
            <div class="dropdown">
              <a class="btn btn-primary btn-block" href data-toggle="dropdown">
                Messages
                <i class="caret m-l-5">
                </i>
              </a>
              <ul class="dropdown-menu dm-icon w-100">
                <li>
                  <a href>
                    <i class="fa fa-envelope">
                    </i>
                    Messages
                  </a>
                </li>
                <li>
                  <a href>
                    <i class="fa fa-users">
                    </i>
                    Contacts
                  </a>
                </li>
                <li>
                  <a href>
                    <i class="fa fa-format-list-bulleted">
                    </i>
                    Todo Lists
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="list-group lg-alt">
            <?php while($friends = $queryUsr->fetch_assoc()){ ?>
              <a class="list-group-item media" href="message.php?id=<?= $friends['id']; ?>">
                <div class="pull-left">
                  <?php if(!empty($friends['filename'])){ ?>
                    <img src="./pfp/<?= $friends['filename']; ?>" alt class="img-avatar">
                  <?php }else{ ?>
                    <img class="img-avatar" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt>
                  <?php } ?>
                </div>
                <div class="media-body">
                  <small class="list-group-item-heading">
                    <?php echo $friends['username']; ?>
                  </small>
                  <small class="list-group-item-text c-gray">
                    <!-- Fierent fastidii recteque ad pro -->
                  </small>
                </div>
              </a>
            <?php } ?>
          </div>
        </div>
        <div class="ms-body">
          <div class="action-header clearfix">
            <div class="visible-xs" id="ms-menu-trigger">
              <i class="fa fa-bars">
              </i>
            </div>
            <div class="pull-left hidden-xs">
              <?php if(!empty($pfp)){ ?>
                <img src="./pfp/<?= $pfp; ?>" alt class="img-avatar m-r-10">
              <?php }else{ ?>
                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt class="img-avatar m-r-10">
              <?php } ?>

              <div class="lv-avatar pull-left">
              </div>
              <span>
                <?php echo $username; ?>
              </span>
            </div>
            <ul class="ah-actions actions">
              <li>
                <a href>
                  <i class="fa fa-trash">
                  </i>
                </a>
              </li>
              <li>
                <a href>
                  <i class="fa fa-check">
                  </i>
                </a>
              </li>
              <li>
                <a href>
                  <i class="fa fa-clock-o">
                  </i>
                </a>
              </li>
              <li class="dropdown">
                <a href data-toggle="dropdown" aria-expanded="true">
                  <i class="fa fa-sort">
                  </i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li>
                    <a href>
                      Latest
                    </a>
                  </li>
                  <li>
                    <a href>
                      Oldest
                    </a>
                  </li>
                </ul>
              </li>
              <li class="dropdown">
                <a href data-toggle="dropdown" aria-expanded="true">
                  <i class="fa fa-bars">
                  </i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li>
                    <a href="home.php">
                      Go back home
                    </a>
                  </li>
                  <li>
                    <a href>
                      Message Settings
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

          <div id="messageDiv">
            <?php while($messageAll = $messages->fetch_assoc()){ ?>
              <?php if($messageAll['userID'] == $id_curr){ ?>
                <div class="message-feed media">
                  <div class="pull-left">
                    <img src="./pfp/<?= $_SESSION['userPfp']; ?>" alt class="img-avatar">
                  </div>
                  <div class="media-body">
                    <div class="mf-content">
                      <?php echo $messageAll['message']; ?>
                    </div>
                    <small class="mf-date">
                      <i class="fa fa-clock-o">
                      </i>
                      <?php echo $messageAll['dateandtime']; ?>
                    </small>
                  </div>
                </div>
              <?php }else{ ?>
                <div class="message-feed right">
                  <div class="pull-right">
                    <img src="./pfp/<?= $pfp; ?>" alt class="img-avatar">
                  </div>
                  <div class="media-body">
                    <div class="mf-content">
                      <?php echo $messageAll['message']; ?>
                    </div>
                    <small class="mf-date">
                      <i class="fa fa-clock-o">
                      </i>
                      <?php echo $messageAll['dateandtime']; ?>
                    </small>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
          <div class="msb-reply">
            <form method="POST" enctype="multipart/form-data" name="form-message">
              <textarea placeholder="What's on your mind..." rows="3" name="message" required>
              </textarea>
              <button type="submit" name="msgsubmit">
                <i class="fa fa-paper-plane-o">
                </i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
    </script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js">
    </script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js">
    </script>
    <script type="text/javascript">
      $(function() {
        if ($('#ms-menu-trigger')[0]) {
          $('body').on('click', '#ms-menu-trigger',
          function() {
            $('.ms-menu').toggleClass('toggled');
          });
        }
      });
    </script>

    <script type="text/javascript">
      function updateDiv(){ 
        $('#messageDiv').load(document.URL +  ' #messageDiv');
      }

      setInterval(updateDiv, 10000);
      
    </script>
  </body>

</html>