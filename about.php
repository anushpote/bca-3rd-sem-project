<?php 
  error_reporting(0);
	session_start();

  $connect = mysqli_connect('localhost','root','','social_db');
?>

<?php include_once('bs-links.php'); ?>

<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <title>
      Quick Meet - About
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
                  <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center active">
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
                  <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                    <a href="photos.php">
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
                    </a>
                    <a class="pt-1px d-none d-md-block" href="photos.php">
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
        <div class="row profile-body">
          <div class="col-md-auto col-xl-auto w-100">
            <div class="card rounded">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <h6 class="card-title mb-0">
                    About
                  </h6>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" class="feather feather-more-horizontal icon-lg text-muted pb-3px">
                        <circle cx="12" cy="12" r="1">
                        </circle>
                        <circle cx="19" cy="12" r="1">
                        </circle>
                        <circle cx="5" cy="12" r="1">
                        </circle>
                      </svg>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item d-flex align-items-center" href="user-edit.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-edit-2 icon-sm mr-2">
                          <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                          </path>
                        </svg>
                        <span class>
                          Edit
                        </span>
                      </a>
                      <a class="dropdown-item d-flex align-items-center" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-git-branch icon-sm mr-2">
                          <line x1="6" y1="3" x2="6" y2="15">
                          </line>
                          <circle cx="18" cy="6" r="3">
                          </circle>
                          <circle cx="6" cy="18" r="3">
                          </circle>
                          <path d="M18 9a9 9 0 0 1-9 9">
                          </path>
                        </svg>
                        <span class>
                          Update
                        </span>
                      </a>
                      <a class="dropdown-item d-flex align-items-center" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-eye icon-sm mr-2">
                          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                          </path>
                          <circle cx="12" cy="12" r="3">
                          </circle>
                        </svg>
                        <span class>
                          View all
                        </span>
                      </a>
                      <a class="dropdown-item d-flex align-items-center" href="logout.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                          <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                        </svg>
                        <span class>
                          Logout
                        </span>
                      </a>
                    </div>
                  </div>
                </div>
                <p>
                  <?php if(!empty($_SESSION['userAbout'])) { ?>
                    <?php echo $_SESSION['userAbout']; ?>
                  <?php }else{ ?>
                     Hi! I'm <?php echo $_SESSION['userID']; ?>.
                  <?php } ?>
                </p>
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">
                    Joined:
                  </label>
                  <p class="text-muted">
                    <?php echo $_SESSION['userJoined']; ?>
                  </p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">
                    Lives:
                  </label>
                  <p class="text-muted">
                    <?php echo $_SESSION['userAddress']; ?>
                  </p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">
                    Email:
                  </label>
                  <p class="text-muted">
                    <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="731e16331d1c111f16061a5d101c1e">
                      <?php echo $_SESSION['userEmail']; ?>
                    </a>
                  </p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">
                    Website:
                  </label>
                  <p class="text-muted">
                      <?php if(!empty($_SESSION['userWeb'])) { ?>
                        <a href="<?php echo $_SESSION['userWeb']; ?>" class="text-muted"><?php echo $_SESSION['userWeb']; ?></a>
                      <?php }else{ ?>
                        www.example.com 
                      <?php } ?>
                  </p>
                </div>
                <div class="mt-3 d-flex social-links">
                  <a href="javascript:;" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon github">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-github" data-toggle="tooltip"
                    title data-original-title="github.com/nobleui">
                      <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                      </path>
                    </svg>
                  </a>
                  <a href="javascript:;" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-twitter" data-toggle="tooltip"
                    title data-original-title="twitter.com/nobleui">
                      <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                      </path>
                    </svg>
                  </a>
                  <a href="javascript:;" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-instagram" data-toggle="tooltip"
                    title data-original-title="instagram.com/nobleui">
                      <rect x="2" y="2" width="20" height="20" rx="5" ry="5">
                      </rect>
                      <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z">
                      </path>
                      <line x1="17.5" y1="6.5" x2="17.51" y2="6.5">
                      </line>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
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