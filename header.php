<?php
// print_r($_ SESSION);
if(isset($_SESSION['admin'])){
  $email =$_SESSION['admin'];
  $query = mysqli_query($cnn,"SELECT * FROM `login` WHERE status='Active'");
  $row = mysqli_fetch_array($query);
  $email = $row['email'];
  $name = $row['name']; 


}
?>
<div class="k-header">
        <div>
          <button
            class="k-toggle-sidebar"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasExample"
          >
            <i class="fas fa-bars"></i>
          </button>
        </div>
        <div class="k-user-info">
          <img src="images/profile-img.png" alt="User Avatar" />
          <div>
          <div class="fw-bold"><?php echo ucfirst($name); ?></div>
           
            <button class="small text-muted dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
                Admin
              </button>
            <div class="dropdown">
              
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>