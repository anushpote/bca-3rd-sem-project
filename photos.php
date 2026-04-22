<?php 
  error_reporting(0);
	session_start();

  $connect = mysqli_connect('localhost','root','','social_db');

  if($connect){
    $sql = "SELECT * FROM tbl_posts";

    $query = $connect->query($sql);
  }
?>

<?php include_once('bs-links.php'); ?>

<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <title>
      Quick Meet - Photos
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/cs-home.css" rel="stylesheet">
  </head>
  
  <body>
    <div class="container">
      <div class="profile-page tx-13">
        <div class="row">
          <div class="col-12 grid-margin">
            <div class="profile-header">
              <div class="cover">
                <div class="gray-shade">
                </div>
                <figure>
                  <?php if(!empty($_SESSION['userBack'])) { ?>
                    <img src="./background/<?php echo $_SESSION['userBack']; ?>" class="img-fluid" alt="profile cover">
                  <?php }else{ ?>
                    <img src="https://bootdey.com/img/Content/bg1.jpg" class="img-fluid" alt="profile cover">
                  <?php } ?>
                </figure>
                <div class="cover-body d-flex justify-content-between align-items-center">
                  <div>
                    <?php if(!empty($_SESSION['userPfp'])) { ?>
                      <img class="profile-pic" src="./pfp/<?php echo $_SESSION['userPfp']; ?>"
                      alt="https://bootdey.com/img/Content/avatar/avatar6.png">
                    <?php }else{ ?>
                      <img class="profile-pic" src="https://bootdey.com/img/Content/avatar/avatar6.png" 
                      alt="https://bootdey.com/img/Content/avatar/avatar6.png">
                    <?php } ?>
                    <span class="profile-name">
                    	<?php echo $_SESSION['userID']; ?>
                    </span>
                  </div>
                  <div class="d-none d-md-block">
                    <button class="btn btn-danger btn-icon-text btn-edit-profile">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" class="feather feather-edit btn-icon-prepend">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                        </path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                        </path>
                      </svg>
                      <a href = "user-edit.php" class="text-white">Edit profile</a>
                    </button>
                  </div>
                </div>
              </div>
              <div class="header-links">
                <ul class="links d-flex align-items-center mt-3 mt-md-0">
                  <li class="header-link-item d-flex align-items-center">
                    <a href="home.php">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" class="feather feather-columns mr-1 icon-md">
                        <path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18">
                        </path>
                      </svg>
                    </a>
                    <a class="pt-1px d-none d-md-block" href="home.php">
                      Timeline
                    </a>
                  </li>
                  <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                    <a href="about.php">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" class="feather feather-user mr-1 icon-md">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2">
                        </path>
                        <circle cx="12" cy="7" r="4">
                        </circle>
                      </svg>
                    </a>
                    <a class="pt-1px d-none d-md-block" href="about.php">
                      About
                    </a>
                  </li>
                  <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                    <a href="friends.php">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" class="feather feather-users mr-1 icon-md">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2">
                        </path>
                        <circle cx="9" cy="7" r="4">
                        </circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87">
                        </path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75">
                        </path>
                      </svg>
                    </a>
                    <a class="pt-1px d-none d-md-block" href="friends.php">
                      Friends
                      <span class="text-muted tx-12">
                        <?php echo $_SESSION['userFriends']; ?>
                      </span>
                    </a>
                  </li>
                  <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-image mr-1 icon-md">
                      <rect x="3" y="3" width="18" height="18" rx="2" ry="2">
                      </rect>
                      <circle cx="8.5" cy="8.5" r="1.5">
                      </circle>
                      <polyline points="21 15 16 10 5 21">
                      </polyline>
                    </svg>
                    <a class="pt-1px d-none d-md-block" href="#">
                      Photos
                    </a>
                  </li>
                  <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                    <a href="videos.php">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" class="feather feather-video mr-1 icon-md">
                        <polygon points="23 7 16 12 23 17 23 7">
                        </polygon>
                        <rect x="1" y="5" width="15" height="14" rx="2" ry="2">
                        </rect>
                      </svg>
                    </a>
                    <a class="pt-1px d-none d-md-block" href="videos.php">
                      Videos
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        
        <div class="container-fluid p-4" id="products">
          <div class="card-columns">
            <?php while($pics = $query->fetch_assoc()){ ?>
              <?php if(!empty($pics['filename'])){ ?>
                <?php 
                  $file_parts = pathinfo($pics['filename']);
                  $file_extension = strtolower($file_parts['extension']); 
                  $file_url = "./image/" . htmlspecialchars($pics['filename']);
                ?>

                <?php if (in_array($file_extension, ['jpeg', 'jpg', 'png'])): ?>
                    <div class="col">
                      <a href="<?php echo $file_url; ?>"> 
                        <div class="card bg-dark text-white">
                          <img class="card-img" src="<?php echo $file_url; ?>" alt="Card image">
                          <div class="card-img-overlay">
                           <h5 class="card-title"><?= $pics['content'] ?></h5>
                           <p class="card-text"><?= $pics['postTime']; ?></p>
                          </div>
                        </div>
                      </a>
                    </div>

                <?php endif; ?>
              <?php } ?>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>

    <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
        </svg>
    </button>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
    </script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="top.js">
    </script>
    <script type="text/javascript">
    </script>
	  <script type="text/javascript">
    	/*function updateDiv(){ 
  			$('#posts').load(document.URL +  ' #posts');
  		}

		  setInterval(updateDiv, 10000);
      */
	  </script>
  </body>
</html>