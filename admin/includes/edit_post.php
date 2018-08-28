<?php 
  if(isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE id=$the_post_id";
    $select_posts_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_by_id)) {
      $post_id = $row['id'];
      $post_author = $row['author'];
      $post_title = $row['title'];
      $post_category_id = $row['category_id'];
      $post_status = $row['status'];
      $post_image = $row['image'];
      $post_tags = $row['tags'];
      $post_content = $row['content'];
      $post_comment_count = $row['comment_count'];
      $post_date = $row['date'];
    }
  }

  if(isset($_POST['edit_post'])){
    $the_post_id = $_GET['p_id'];
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['category_id'];
    $post_status = $_POST['status'];

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
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['tags'];
    $post_content = $_POST['content'];

    //if you get permission deny, you need to go to the folder and give permission to everyone in the setting of the folder
    move_uploaded_file($post_image_temp, "../images/$post_image");
    if(empty($post_image)){
      $query = "SELECT * FROM posts WHERE id=$the_post_id";
      $select_image = mysqli_query($connection, $query);
      while($row = mysqli_fetch_array($select_image)){
        $post_image = $row['image'];
      }
    }
    
    $query = "UPDATE posts SET ";
    $query .= "title='$post_title', ";
    $query .= "category_id='$post_category_id', ";
    $query .= "date=now(), ";
    $query .= "author='$post_author', ";
    $query .= "status='$post_status', ";
    $query .= "tags='$post_tags', ";
    $query .= "content='$post_content', ";
    $query .= "image='$post_image' ";
    $query .= "WHERE id=$the_post_id";
    $update_post = mysqli_query($connection, $query);
    confirmQuery($update_post);
    header("Location: posts.php");
  }
  
?>

<!-- enctype is for sending image like different form data -->
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title</label>
    <input value="<?php echo $post_title;?>" type="text" class="form-control" name="title">
  </div>
  <div class="form-group">
    <label for="category_id">Category</label><br>
    <select name="category_id" id="category_id">
      <?php
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);
        confirmQuery($select_categories);

        while($row = mysqli_fetch_assoc($select_categories)){
          $cat_id = $row['id']; 
          $cat_title = $row['title'];
          echo "<option value='$cat_id'>$cat_title</option>";
        }
      ?>

    </select>
  </div>
  <div class="form-group">
    <label for="author">Author</label>
    <input value="<?php echo $post_author;?>" type="text" class="form-control" name="author">
  </div>
  <div class="form-group">
    <label for="status">Status</label><br>
    <select name="status" id="status">
        <option value='draft'>Draft</option>
        <option value='publish'>Publish</option>
    </select>
  </div>
  <div class="form-group">
    <label for="image">Image</label><br>
    <img width="100" src="../images/<?php echo $post_image; ?>" alt="image">
    <input type="file" name="image">
  </div>
  <div class="form-group">
    <label for="tags">Tags</label>
    <input value="<?php echo $post_tags;?>" type="text" class="form-control" name="tags">
  </div>
  <div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" name="content" id="" cols="30" rows="10"><?php echo $post_content;?></textarea>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="edit_post" value="Edit">
  </div>
</form>