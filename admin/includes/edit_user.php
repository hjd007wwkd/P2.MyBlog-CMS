<?php 
  if(isset($_GET['u_id'])){
    $the_user_id = $_GET['u_id'];
    $query = "SELECT * FROM users WHERE id=$the_user_id";
    $select_users_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_users_by_id)) {
      $user_id = $row['id'];
      $user_firstname = $row['firstname'];
      $user_lastname = $row['lastname'];
      $user_role = $row['role'];
      $user_username = $row['username'];
      $user_email = $row['email'];
      $user_password = $row['password'];
    }
  }
  if(isset($_POST['edit_user'])){
    $user_firstname = $_POST['firstname'];
    $user_lastname = $_POST['lastname'];
    $user_role = $_POST['role'];
    $user_username = $_POST['username'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];

    //$_FILES has
    /* Array (
      [fileUP] => Array (
        [name] => actual file name like '11.jpg'
        [type] => type of file like 'image/jpeg'
        [tmp_name] => 파일이 전송되면 서버에 임시로 저장하게 되는데.. 임시로 저장된 디렉터리와 임시파일명입니다. like /tmp/phprDT4md
        [error] => 0 이면 정상이고  파일이 없던가 업로드가 안되면 4 번이 출력됩니다. like 0
        [size] => actual size of file in bit like 106206
      )
    )*/
    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    //if you get permission deny, you need to go to the folder and give permission to everyone in the setting of the folder
    // move_uploaded_file($post_image_temp, "../images/$post_image");
    
    $query = "UPDATE users SET ";
    $query .= "firstname='$user_firstname', ";
    $query .= "lastname='$user_lastname', ";
    $query .= "role='$user_role', ";
    $query .= "username='$user_username', ";
    $query .= "email='$user_email', ";
    $query .= "password='$user_password' ";
    $query .= "WHERE id=$the_user_id";
    $update_user = mysqli_query($connection, $query);

    confirmQuery($update_user);
    header("Location: users.php");
  }
?>
<!-- enctype is for sending image like different form data -->
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="firstname">Firstname</label>
    <input type="text" class="form-control" name="firstname" value="<?php echo $user_firstname?>">
  </div>
  <div class="form-group">
    <label for="lastname">Lastname</label>
    <input type="text" class="form-control" name="lastname" value="<?php echo $user_lastname?>">
  </div>
  <div class="form-group">
    <label for="role">Role</label><br>
    <select name="role" id="role">
      <option value="<?php echo $user_role?>"><?php echo $user_role?></option>
      <?php 
        if($user_role == 'admin'){
          echo "<option value='subscriber'>subscriber</option>";
        } else {
          echo "<option value='admin'>admin</option>";
        }
      ?>
    </select>
  </div>
  <!-- <div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image">
  </div> -->
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $user_username?>">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email" value="<?php echo $user_email?>">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" value="<?php echo $user_password?>">
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
  </div>
</form>