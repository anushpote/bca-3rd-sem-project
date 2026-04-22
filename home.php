<?php 
  error_reporting(0);
	session_start();

  $connect = mysqli_connect('localhost','root','','social_db');
	
	$errPost = '';
  $errConn = '';
  $errImag = '';

  function refreshPosts(){
    header('Location: home.php');
  }

  function like($id, $conn){
    $sqlLike = "UPDATE tbl_posts SET likes = likes + 1 WHERE id='$id'";

    mysqli_query($conn, $sqlLike);
    refreshPosts();
  }

  function deletePost($id, $conn){
    $sqlDelete = "DELETE FROM tbl_posts WHERE id ='$id'";

    mysqli_query($conn, $sqlDelete);
    refreshPosts();
  }

  function sendRequest($sid, $rid, $sname, $spfp, $conn){
    $sqlRequest = "INSERT INTO tbl_social_friends(sID, rID, sname, spfp, status) VALUES ('$sid','$rid','$sname','$spfp','pending')";

    mysqli_query($conn, $sqlRequest);
    refreshPosts();
  }

  if(isset($_GET['mode']) == 'like'){
    like($_GET['id'], $connect);
  }

  if(isset($_GET['mode']) == 'delete'){
    deletePost($_GET['id1'], $connect);
  }

  if(isset($_GET['mode']) == 'request'){
    sendRequest($_SESSION['userNo'], $_GET['rid'], $_SESSION['userID'], $_SESSION['userPfp'], $connect);
  }

	if($connect){
		$sql = "SELECT * FROM tbl_posts ORDER BY id DESC";
		$sqlImg = "SELECT * FROM tbl_posts ORDER BY id DESC";
		$sqlUsr = "SELECT * FROM tbl_social_users";
    $sqlComm = "SELECT * FROM tbl_social_comments ORDER BY commentID DESC";

		$query = $connect->query($sql);
		$queryUsr = $connect->query($sqlUsr);
    $queryComm = $connect->query($sqlComm);
    $queryImg = $connect->query($sqlImg);

		if(isset($_POST['postsubmit'])){
			$currentUser = $_SESSION['userID'];
			$date = date('d-m-Y h:i:s');
			$content = $_POST['content'];
			$profilePic = $_SESSION['userPfp'];
      
      $date = date('d-m-Y h:i:s');

      $filename = $_FILES["uploadfile"]["name"];
      $tempname = $_FILES["uploadfile"]["tmp_name"];
      $folder = "./image/" . $filename;

			$sqlCont = "INSERT INTO tbl_posts(user,postTime,content,pfp,filename) VALUES ('$currentUser','$date','$content','$profilePic','$filename')";

		  mysqli_query($connect, $sqlCont);

      if (move_uploaded_file($tempname, $folder)) {
          $errImag .= "<h3>&nbsp; Item added to market successfully!</h3>";
      } else {
          $errImag .= "<h3>&nbsp; Failed to add Item!</h3>";
      }
  
      $query = $connect->query($sql);
    	$queryImg = $connect->query($sqlImg);
		}else{
			$errPost .= 'Could not post';
		}

    if(isset($_POST['postcomment'])){
      $currentUser = $_SESSION['userID'];
      $date = date('d-m-Y h:i:s');
      $comment = $_POST['comment'];
      $profilePic = $_SESSION['userPfp'];
      $commenterName = $_SESSION['userID'];
      $postID = $_POST['postID'];

      $sqlPostComm = "INSERT INTO tbl_social_comments(commentID,comment,byUser,postID,commPfp) VALUES ('$currentUser','$comment','$commenterName','$postID','$profilePic')";

      mysqli_query($connect, $sqlPostComm);

      $queryComm = $connect->query($sqlComm);
    }else{
      $errPost .= 'Could not post';
    }

	}else{
		$errConn .= 'Could not connect';
	}
  
?>

<?php include_once('bs-links.php'); ?>

<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <title>
      Quick Meet
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
                <div class="cover-body d-flex justify-content-between align-items-center" id="card-cover">
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
              <div class="header-links" id="card-links">
                <ul class="links d-flex align-items-center mt-3 mt-md-0">
                  <li class="header-link-item d-flex align-items-center active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-columns mr-1 icon-md">
                      <path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18">
                      </path>
                    </svg>
                    <a class="pt-1px d-none d-md-block" href="#">
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
                <!-- Bootstrap 5 switch -->
				<div class="form-check form-switch ml-5">
				    <input class="form-check-input" type="checkbox" id="darkModeSwitch">
				    <label class="form-check-label" for="darkModeSwitch">Dark Mode</label>
				</div>
              </div>
            </div>
          </div>
        </div>
        <div class="row profile-body">
          <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
            <div class="card rounded">
              <div class="card-body" id="card-about">
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
          <div class="col-md-8 col-xl-6 middle-wrapper">

            <div class="row">
              <div class="col-md-12 grid-margin">
          		 <div class="feed-post card rounded" id="card-post">
                  <div class="card-header">
                    <h5>Create a new post</h5>
                  </div>
                  <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" name="form-image">
                        <div class="mb-3">
                            <textarea class="form-control" rows="3" placeholder="What's on your mind?" name="content" required></textarea>
                            <!-- <span class="text-danger"><?php echo $errPost; ?></span> -->
                        </div>

                        <div class="mb-3">
                            <input class="form-control" type="file" name="uploadfile" value="" accept="image/*,video/*,audio/*">
                        </div>

                        <button type="submit" class="btn btn-danger" name="postsubmit">Post</button>
                    </form>
                  </div>
                </div>
              </div>
           </div>
            <div class="row" id="posts">
              <?php while($post = $query->fetch_assoc()){ ?>
              <div class="col-md-12 grid-margin">
                <div class="card rounded" id="card-comment">
                  <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="d-flex align-items-center">
                        <?php if(!empty($post['pfp'])) { ?>
                          <img class="img-xs rounded-circle" src="./pfp/<?php echo $post['pfp']; ?>"
                          alt="https://bootdey.com/img/Content/avatar/avatar6.png">
                        <?php }else{ ?>
                          <img class="img-xs rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar6.png" 
                          alt="https://bootdey.com/img/Content/avatar/avatar6.png">
                        <?php } ?>
                        
                        <div class="ml-2">
                          <p>
                            <?php echo $post['user']; ?>
                          </p>
                          <p class="tx-11 text-muted">
                     	 			<?php echo $post['postTime']; ?>
                          </p>
                        </div>
                      </div>
                      <div class="dropdown">
                        <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" class="feather feather-more-horizontal icon-lg pb-3px">
                            <circle cx="12" cy="12" r="1">
                            </circle>
                            <circle cx="19" cy="12" r="1">
                            </circle>
                            <circle cx="5" cy="12" r="1">
                            </circle>
                          </svg>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                          <?php if($post['user'] == $_SESSION['userID']){ ?>
                            <a class="dropdown-item d-flex align-items-center" href="home.php?mode='delete'&id1=<?= $post['id']; ?>">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" class="feather feather-meh icon-sm mr-2">
                                <circle cx="12" cy="12" r="10">
                                </circle>
                                <line x1="8" y1="15" x2="16" y2="15">
                                </line>
                                <line x1="9" y1="9" x2="9.01" y2="9">
                                </line>
                                <line x1="15" y1="9" x2="15.01" y2="9">
                                </line>
                              </svg>
                              <span class>
                                delete
                              </span>
                            </a>
                          <?php } ?>
                          <a class="dropdown-item d-flex align-items-center" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-corner-right-up icon-sm mr-2">
                              <polyline points="10 9 15 4 20 9">
                              </polyline>
                              <path d="M4 20h7a4 4 0 0 0 4-4V4">
                              </path>
                            </svg>
                            <span class>
                              Go to post
                            </span>
                          </a>
                          <a class="dropdown-item d-flex align-items-center" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-share-2 icon-sm mr-2">
                              <circle cx="18" cy="5" r="3">
                              </circle>
                              <circle cx="6" cy="12" r="3">
                              </circle>
                              <circle cx="18" cy="19" r="3">
                              </circle>
                              <line x1="8.59" y1="13.51" x2="15.42" y2="17.49">
                              </line>
                              <line x1="15.41" y1="6.51" x2="8.59" y2="10.49">
                              </line>
                            </svg>
                            <span class>
                              Share
                            </span>
                          </a>
                          <a class="dropdown-item d-flex align-items-center" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-copy icon-sm mr-2">
                              <rect x="9" y="9" width="13" height="13" rx="2" ry="2">
                              </rect>
                              <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1">
                              </path>
                            </svg>
                            <span class>
                              Copy link
                            </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <p class="mb-3 tx-14">
                      <?php echo $post['content']; ?>
                    </p>
                    <?php if(!empty($post['filename'])){ ?>
                    	
                          <?php
                            $file_parts = pathinfo($post['filename']);
                            $file_extension = strtolower($file_parts['extension']);
                            $file_url = "./image/" . htmlspecialchars($post['filename']);
                          ?>

                          <?php if (in_array($file_extension, ['jpeg', 'jpg', 'png'])): ?>
                              <a href="<?php echo $file_url; ?>">
                                  <img class="img-fluid" src="./image/<?php echo $post['filename']; ?>" alt>
                              </a>
                          <?php elseif (in_array($file_extension, ['mp3', 'ogg', 'wav'])): ?>
                              <a href="<?php echo $file_url; ?>">
                                  <audio controls>
                                      <source src="<?php echo $file_url; ?>" type="audio/<?php echo $file_extension; ?>">
                                  </audio>
                              </a>
                          <?php elseif (in_array($file_extension, ['mp4', 'ogg', 'webm'])): ?>
                              <a href="<?php echo $file_url; ?>">
                                  <video class="w-100" preload="metadata" controls>
                                      <source src="<?php echo $file_url; ?>" type="video/<?php echo $file_extension; ?>">
                                  </video>
                              </a>
                          <?php else: ?>
                              <a href="<?php echo $file_url; ?>"><?php echo htmlspecialchars($post['filename']); ?></a>
                        <?php endif; ?>
                    <?php } ?>
                  </div>
                  <div class="card-footer">
                    <div class="d-flex post-actions">
                      <a href="home.php?mode='like'&id=<?= $post['id']; ?>" class="d-flex align-items-center text-muted mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-heart icon-md">
                          <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                          </path>
                        </svg>
                        <p class="d-none d-md-block ml-2">
                          <span class="text-danger"><?php echo $post['likes'] ?></span> Likes
                        </p>
                      </a>
                      <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-message-square icon-md" 
                        data-bs-toggle="collapse" data-bs-target="#<?=$post['id'] ?>" aria-expanded="false" aria-controls="friendsList">
                          <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z">
                          </path>
                        </svg>
                        <p class="d-none d-md-block ml-2">
                        	<button class="list-group-item list-group-item-action" type="button" data-bs-toggle="collapse" data-bs-target="#<?=$post['id'] ?>" aria-expanded="false" aria-controls="friendsList">Comment</button>
                        </p>
                      </a>
                      <a href="javascript:;" class="d-flex align-items-center text-muted" data-bs-toggle="modal" data-bs-target="#preview">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-share icon-md">
                          <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8">
                          </path>
                          <polyline points="16 6 12 2 8 6">
                          </polyline>
                          <line x1="12" y1="2" x2="12" y2="15">
                          </line>
                        </svg>
                        <p class="d-none d-md-block ml-2">
                          Share
                        </p>
                      </a>
                  </div>
                  <div class="card-footer">
	                  <div class="collapse" id="<?=$post['id'] ?>">
                      <form method="POST" enctype="multipart/form-data" name="form-comment">
                        <div class="mb-3">
                            <textarea class="form-control" rows="3" placeholder="What's on your mind?" name="comment" required></textarea>
                            <input type="hidden" value="<?=$post['id'] ?>" name="postID">
                        </div>

                        <button type="submit" class="btn btn-danger" name="postcomment">Comment</button>
                      </form>
	                    <div class="list-group">
                        <?php 
                          $postID = $post['id'];
                          $queryComm = $connect->query("SELECT * FROM tbl_social_comments WHERE postID = '$postID' ORDER BY commentID DESC");
                        ?>
                        <?php while($comments = $queryComm->fetch_assoc()){?>
                          <?php if($comments['postID'] == $post['id']){ ?>
                            <a href="#" class="list-group-item list-group-item-action">
                              <div class="d-flex align-items-center">
                                <?php if(!empty($comments['commPfp'])){ ?>
                                  <img class="img-xs rounded-circle" src="./pfp/<?php echo $comments['commPfp']; ?>">
                                <?php }else{ ?>
                                  <img class="img-xs rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar6.png">
                                <?php } ?>
                                <p><?php echo $comments['byUser']; ?></p>
                              </div>
                              <?php echo $comments['comment']; ?>  
                            </a>
                          <?php } ?>
                        <?php } ?>
                      </div>
                    </div>
                  </div>

                  </div>
                </div>
              </div>
          	  <?php } ?>
            </div>
          </div>
          <div class="d-none d-xl-block col-xl-3 right-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="card rounded">
                  <div class="card-body" id="card-photos">
                    <h6 class="card-title">
                      latest photos
                    </h6>
                    <div class="latest-photos">
                      <div class="row">
                        <?php while($image = $queryImg->fetch_assoc()){ ?>
	                        	<?php if(!empty($image['filename'])){ ?>
	                        		<?php
		                            $file_parts = pathinfo($image['filename']);
		                            $file_extension = strtolower($file_parts['extension']);
		                            $file_url = "./image/" . htmlspecialchars($image['filename']);
			                        ?>
	                        		<?php if (in_array($file_extension, ['jpeg', 'jpg', 'png'])){ ?>
		                        		<div class="col-md-4">
				                          <figure>
				                          	<a href="./image/<?php echo $image['filename']; ?>">
				                            	<img class="img-fluid" src="./image/<?php echo $image['filename']; ?>"
				                            	alt="https://bootdey.com/img/Content/avatar/avatar1.png">
				                          	</a>
				                          </figure>
	                        			</div>
		                         	<?php } ?>
	                          <?php } ?>
	                      <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 grid-margin">
                <div class="card rounded">
                  <div class="card-body" id="card-suggestions">
                    <h6 class="card-title">
                      suggestions for you
                    </h6>
                    <?php while($users = $queryUsr->fetch_assoc()){ ?>
                    <?php if($users['id'] != $_SESSION['userNo']) { ?>
                    <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                      <div class="d-flex align-items-center hover-pointer">

                        <?php if(!empty($users['filename'])) { ?>
                          <img class="img-xs rounded-circle" src="./pfp/<?php echo $users['filename']; ?>"
                          alt="https://bootdey.com/img/Content/avatar/avatar6.png">
                        <?php }else{ ?>
                          <img class="img-xs rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar6.png" 
                          alt="https://bootdey.com/img/Content/avatar/avatar6.png">
                        <?php } ?>
                        
                        <div class="ml-2">
                          <a href="user.php?id=<?= $users['id']; ?>" class="text-dark">
                            <p>
                              <?php echo $users['username']; ?>
                            </p>
                          </a>
                          <p class="tx-11 text-muted">
                            12 Mutual Friends
                          </p>
                        </div>
                      </div>
                      <button class="btn btn-icon">
                        <a href="home.php?mode='request'&rid=<?= $users['id']; ?>" class="text-dark">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" class="feather feather-user-plus" data-toggle="tooltip"
                          title data-original-title="Connect">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2">
                            </path>
                            <circle cx="8.5" cy="7" r="4">
                            </circle>
                            <line x1="20" y1="8" x2="20" y2="14">
                            </line>
                            <line x1="23" y1="11" x2="17" y2="11">
                            </line>
                          </svg>
                        </a>
                      </button>
                    </div>
                  <?php } ?>
                	<?php } ?>
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
    	document.addEventListener('DOMContentLoaded', (event) => {
	    const htmlElement = document.getElementsByTagName('body')[0];
	    const switchElement = document.getElementById('darkModeSwitch');
	    const about = document.getElementById('card-about');
	    const post = document.getElementById('card-post');
	    const links = document.getElementById('card-links');
	    const photos = document.getElementById('card-photos');
	    const suggestions = document.getElementById('card-suggestions');
	    const comms = document.querySelectorAll("[id='card-comment']");

	    console.log(comms.length);

	    switchElement.addEventListener('change', function () {
	        if (this.checked) {
	            htmlElement.style.backgroundColor='#0f0f0f';
	            about.style.backgroundColor='#292928';
	            about.style.color='white';
	            post.style.backgroundColor='#292928';
	            post.style.color='white';
	            links.style.backgroundColor='#292928';
	            links.style.color='white';
	            photos.style.backgroundColor='#292928';
	            photos.style.color='white';
	            suggestions.style.backgroundColor='#292928';
	            suggestions.style.color='white';

	            for(var i = 0; i < comms.length; i++){
		            comms[i].style.backgroundColor='#292928';
		            comms[i].style.color='white';
		        }
	        } else {
	            htmlElement.style.backgroundColor='#f9fafb';
	            about.style.backgroundColor='#f9fafb';
	            about.style.color='black';
	            post.style.backgroundColor='#f9fafb';
	            post.style.color='black';
	            links.style.backgroundColor='#f9fafb';
	            links.style.color='black';
	            photos.style.backgroundColor='#f9fafb';
	            photos.style.color='black';
	            suggestions.style.backgroundColor='#f9fafb';
	            suggestions.style.color='black';

	            for(var i = 0; i < comms.length; i++){
		            comms[i].style.backgroundColor='#f9fafb';
		            comms[i].style.color='black';
	        	}
	        }
	    });
	});
    </script>
	  <script type="text/javascript">
    	/*function updateDiv(){ 
  			$('#posts').load(document.URL +  ' #posts');
  		}

		  setInterval(updateDiv, 10000);
      */
	  </script>


    <div class="modal fade" id="preview" tabindex="-1" aria-labelledby="previewLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Share This post</span></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>