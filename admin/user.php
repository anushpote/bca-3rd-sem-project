<?php
	session_start();
	
	if($_SESSION['loginUser']=='' && $_SESSION['loginUserId']==''){
	  header('Location: login.php');
	}
	
	include_once('header.php');
	include_once('sidebar.php');
	include_once('Database.php');

	$objDb = new Database();

	if(isset($_GET['mode'])=='Delete'){
	    $id = $_GET['id'];
	    $objDb->deleteUser($id);
	    echo 'Deleted. <br>';
	}

	$query = $objDb->listUser();
?>

    <a href="user-add.php" class="btn btn-primary">Add New</a>

    <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">List Users</p>
                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php 
                            $i = 1;
                            while($data = $query->fetch_assoc()){?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $data['username'];?></td>
                                <td><?= $data['email'];?></td>
                                <td>
                                    <a href="user-edit.php?id=<?=$data['id'];?>">Edit</a>
                                    <a href="user.php?mode=Delete&id=<?=$data['id'];?>"  onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php $i++;}?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>


<?php 
include_once('footer.php');
?>