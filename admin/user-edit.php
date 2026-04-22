<?php
	session_start();

	if($_SESSION['loginUser']=='' && $_SESSION['loginUserId']==''){
	  header('Location: login.php');
	}

	include_once('header.php');
	include_once('sidebar.php');
	include_once('Database.php');

	$objDb = new Database();
	$id = $_GET['id']; 

	$data = $objDb->getUserById($id);

	if($_POST){
	        // set data in variable
	    $username = $_POST['username'];
	    $email = $_POST['email'];
	    $query = $objDb->editUser($id,$username,$email);
	    
	    if($query==true){
	    	echo 'Successfully Edited.';
	    }
	}
?>
<a href="user.php">User List</a><br>
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Add user</h4>
            <form class="forms-sample" method="POST">
                <label>Username</label>
                <input type = "text" name = "username" class = "form-control" placeholder="Your Username" value="<?php echo $data['username']; ?>" required><br><br>
                <label>Address</label>
                <input type = "text" name = "address" class = "form-control" placeholder="Your Address" value="<?php echo $data['address']; ?>" required><br><br>
                <label>Email</label>
                <input type = "email" name = "email" class = "form-control" placeholder="Your Email" value="<?php echo $data['email']; ?>" required><br><br>
                <input type="submit" value="Submit" class="btn btn-primary"/>
            </form>
    </div>
    </div>
</div>
<?php 
include_once('footer.php');
?>