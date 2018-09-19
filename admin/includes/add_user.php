<?php 
  if(isset($_POST['create_user'])){
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
    
    $query = "INSERT INTO users(firstname, lastname, role, username, email, password) ";
    $query .= "VALUES('$user_firstname', '$user_lastname', '$user_role', '$user_username', '$user_email', '$user_password')";
    $create_user_query = mysqli_query($connection, $query);
    confirmQuery($create_user_query);
    header("Location: users.php");
  }
?>
<!-- enctype is for sending image like different form data -->
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="firstname">Firstname</label>
    <input type="text" class="form-control" name="firstname">
  </div>
  <div class="form-group">
    <label for="lastname">Lastname</label>
    <input type="text" class="form-control" name="lastname">
  </div>
  <div class="form-group">
    <label for="role">Role</label><br>
    <select name="role" id="role">
      <option value='admin'>Admin</option>
      <option value='subscriber'>Subscriber</option>
    </select>
  </div>
  <!-- <div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image">
  </div> -->
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
  </div>
</form>