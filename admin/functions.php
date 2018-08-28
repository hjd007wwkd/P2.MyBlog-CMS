<?php
  function confirmQuery($result){
    global $connection;
    if(!$result){
      die("QUERY FAILED" . mysqli_error($connection));
    }
  };

  function insert_categories() {
    global $connection;
    if(isset($_POST['Add'])){
      $cat_title = $_POST['title'];
      if($cat_title === "" || empty($cat_title)) {
        echo "This field should not be empty";
      } else {
        $query = "INSERT INTO categories(title)";
        $query .= "VALUE('$cat_title')";
        $create_category_query = mysqli_query($connection, $query);
        if(!$create_category_query){
          die('QUERY FAILED' . mysqli_error($connection));
        }
      }
    }
  }

  function findAllCategories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_categories)){
      $cat_id = $row['id'];
      $cat_title = $row['title'];
      //categories.php?delete=$cat_id
      //we are passign parameter to categories.php
      //delete is key, $cat_id is a value
      echo "<tr>
              <td>$cat_id</td>
              <td>$cat_title</td>
              <td><a href='categories.php?delete=$cat_id'>Delete</a></td>
              <td><a href='categories.php?edit=$cat_id'>Edit</a></td>
            </tr>";
    }
  }

  function deleteCategories() {
    global $connection;
    if(isset($_GET['delete'])) {
      $the_cat_id = $_GET['delete'];
      $query = "DELETE FROM categories WHERE id=$the_cat_id";
      $delete_query = mysqli_query($connection, $query);
      //send another request so it refresh the page
      header("Location: categories.php");
    }
  }
?>