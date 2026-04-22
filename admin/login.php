<?php
	session_start();

	include_once('Database.php');
	$objDb = new Database();

	$usernamemsg = '';
	$passwordmsg = '';
	$msg = '';

	if($_POST){
	    // set data in variable
	    $username = $_POST['username'];
	    $password = md5($_POST['password']);
	    
	    //validation
	    if($username==''){
	        $usernamemsg = "Username can't be blank.<br>";
	    }
	    if($_POST['password']==''){
	        $passwordmsg = "Password can't be blank.<br>";
	    }
	    if($username && $_POST['password']){
	        $query = $objDb->login($username,$password);
	        $data = $query->fetch_assoc();
	       
	        if($query->num_rows==1){
		        $_SESSION['loginUser'] = $data['username'];
		        $_SESSION['loginUserId'] = $data['id'];
		        $_SESSION['loginUserName'] = $data['name'];
		        
		        echo 'Successfully Login.';
		        header('Location: index.php');
	        }else{
	            $msg = "Username and Password does't matched.";
	        }
	    }
	}
?>
<!-- plugins:css -->
<link rel="stylesheet" href="css/materialdesignicons.min.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 grid-margin stretch-card mt-5">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Login</h4>
                <span class="error_msg"><?= $msg;?></span>
                    <form class="forms-sample" method="POST">
                        <div class="form-group row">
                            <label>Username</label>
                            <input type="text" name="username"  class="form-control"/>
                            <span class="error_msg"><?php  echo $usernamemsg;?></span>
                        </div>
                        <div class="form-group row">
                            <label>Password</label>
                            <input type="password" name="password"  class="form-control"/>
                            <span class="error_msg"><?php echo $passwordmsg;?></span>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Login</button>
                    </form>
            </div>
            </div>
        </div>
    </div>
