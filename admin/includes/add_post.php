<?php 
  if(isset($_POST['create_post'])){
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

    //current date with formant 'd-m-y'
    $post_date= date('d-m-y');
    $post_comment_count = 0;

    //if you get permission deny, you need to go to the folder and give permission to everyone in the setting of the folder
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    $query = "INSERT INTO posts(category_id, title, author, date, image, content, tags, comment_count, status) ";
    $query .= "VALUES($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', $post_comment_count, '$post_status')";
    $create_post_query = mysqli_query($connection, $query);
    confirmQuery($create_post_query);
    header("Location: posts.php");
  }
?>
<!-- enctype is for sending image like different form data -->
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title">
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
    <input type="text" class="form-control" name="author">
  </div>
  <div class="form-group">
    <label for="status">Status</label><br>
    <select name="status" id="status">
        <option value='draft'>Draft</option>
        <option value='publish'>Publish</option>
    </select>
  </div>
  <div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image">
  </div>
  <div class="form-group">
    <label for="tags">Tags</label>
    <input type="text" class="form-control" name="tags">
  </div>
  <div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_post" value="Post">
  </div>
</form>