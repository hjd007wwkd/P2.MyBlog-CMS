<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Email</th>
      <th>Role</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $query = "SELECT * FROM users";
      $select_users = mysqli_query($connection, $query);

      while($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['id'];
        $user_username = $row['username'];
        $user_password = $row['password'];
        $user_firstname = $row['firstname'];
        $user_lastname = $row['lastname'];
        $user_email = $row['email'];
        $user_image = $row['image'];
        $user_role = $row['role'];
        
        echo "<tr>
                <td>$user_id</td>
                <td>$user_username</td>
                <td>$user_firstname</td>
                <td>$user_lastname</td>
                <td>$user_email</td>
                <td>$user_role</td>
                <td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>
                <td><a href='users.php?change_to_subscriber=$user_id'>Subscriber</a></td>
                <td><a href='users.php?source=edit_user&u_id=$user_id'>Edit</a></td>
                <td><a href='users.php?delete=$user_id'>Delete</a></td>
              </tr>";
      }
    ?>
  </tbody>
</table>

<?php
  if(isset($_GET['change_to_admin'])){
    $the_user_id = $_GET['change_to_admin'];
    $query = "UPDATE users SET role='admin' WHERE id=$the_user_id";
    $change_to_admin_query = mysqli_query($connection, $query);
    header("Location: users.php");
  }

  if(isset($_GET['change_to_subscriber'])){
    $the_user_id = $_GET['change_to_subscriber'];
    $query = "UPDATE users SET role='subscriber' WHERE id=$the_user_id";
    $change_to_subscriber_query = mysqli_query($connection, $query);
    header("Location: users.php");
  }

  if(isset($_GET['delete'])){
    $the_user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE id=$the_user_id";
    $delete_query = mysqli_query($connection, $query);

    confirmQuery($delete_query);
    header("Location: users.php");
  }
?>