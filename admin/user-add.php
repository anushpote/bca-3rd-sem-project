<?php
	session_start();

	if($_SESSION['loginUser']=='' && $_SESSION['loginUserId']==''){
	  header('Location: login.php');
	}

	include_once('header.php');
	include_once('sidebar.php');
	include_once('Database.php');

	$objDb = new Database();

	if($_POST){
	    // set data in variable
	    $username = $_POST['username'];
	    $email = $_POST['email'];
	    $address = $_POST['address'];
	    $password = md5($_POST['password']);
      	$date = date('d-m-Y');

	    //validation
	    $msg = '';
	    
	    if($username==''){
	        $msg.= "Full Name can't be blank.<br>";
	    }
	    if($email==''){
	        $msg.= "Email can't be blank.<br>";
	    }

	    if($username && $email){
	        $query = $objDb->addUser($username,$email,$password,$address,$date);
	        if($query==true){
	         echo 'Successfully Saved.';
	        }
	    }

	    echo $msg;
	}
?>
<a href="user.php">User List</a><br>

<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Add user</h4>
            <form class="forms-sample" method="POST">

                <div class="form-group row">
                    <label>Username</label>
                    <input type = "text" name = "username" class = "form-control" placeholder="Username" required>
                </div>
                <div class="form-group row">
                    <label>Email</label>
                    <input type = "email" name = "email" class = "form-control" placeholder="Email Address" required>
                </div>
                <div class="form-group row">
                    <label>Address</label>
                    <input type = "text" name = "address" class = "form-control" placeholder="Your Address" required>
                </div>
                <div class="form-group row">
                    <label>Password</label>
                    <input type = "password" name = "password" class = "form-control" placeholder="password" required>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
            </form>
    </div>
    </div>
</div>

<?php 
include_once('footer.php');
?>