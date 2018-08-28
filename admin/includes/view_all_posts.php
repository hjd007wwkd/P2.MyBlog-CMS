<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Author</th>
      <th>Title</th>
      <th>Category</th>
      <th>Status</th>
      <th>Image</th>
      <th>Tags</th>
      <th>Comments</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $query = "SELECT * FROM posts";
      $select_posts = mysqli_query($connection, $query);

      while($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['id'];
        $post_author = $row['author'];
        $post_title = $row['title'];
        $post_category_id = $row['category_id'];
        $post_status = $row['status'];
        $post_image = $row['image'];
        $post_tags = $row['tags'];
        $post_comment_count = $row['comment_count'];
        $post_date = $row['date'];

        $query = "SELECT * FROM categories WHERE id=$post_category_id";
        $select_categories_id = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_categories_id)){
          $cat_id = $row['id'];
          $cat_title = $row['title'];
        };
        
        echo "<tr>
                <td>$post_id</td>
                <td>$post_author</td>
                <td>$post_title</td>
                <td>$cat_title</td>
                <td>$post_status</td>
                <td><img width='100' src='../images/$post_image' alt='image'></td>
                <td>$post_tags</td>
                <td>$post_comment_count</td>
                <td>$post_date</td>
                <td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>
                <td><a href='posts.php?delete=$post_id'>Delete</a></td>
              </tr>";
      }
    ?>
  </tbody>
</table>

<?php 
  if(isset($_GET['delete'])){
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE id=$the_post_id";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
  }
?>