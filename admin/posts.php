<?php
	session_start();
	
	
	include_once('header.php');
	include_once('sidebar.php');
	include_once('Database.php');

	$objDb = new Database();
  	$allPosts = $objDb->getPosts('likes');
?>

    <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Most Liked posts</p>
                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                            <th>User</th>
                            <th>Content</th>
                            <th>Likes</th>
                            <th>Date</th>
                            <th>Profile</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while($data=$allPosts->fetch_assoc()){ ?>
                          <tr>
                              <td><?php echo $data['user'] ?></td>
                              <td><?php echo $data['content'] ?></td>
                              <td><?php echo $data['likes'] ?></td>
                              <td><?php echo $data['postTime'] ?></td>
                              <td><img src="../pfp/<?php echo $data['pfp']; ?>" alt="profile"/></td>
                          </tr>
                        <?php } ?>
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