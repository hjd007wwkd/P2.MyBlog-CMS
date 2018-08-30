<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Author</th>
      <th>Comment</th>
      <th>Email</th>
      <th>Status</th>
      <th>In Response to</th>
      <th>Date</th>
      <th>Approve</th>
      <th>Unapprove</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $query = "SELECT * FROM comments";
      $select_posts = mysqli_query($connection, $query);

      while($row = mysqli_fetch_assoc($select_posts)) {
        $comment_id = $row['id'];
        $comment_post_id = $row['post_id'];
        $comment_author = $row['author'];
        $comment_content = $row['content'];
        $comment_email = $row['email'];
        $comment_status = $row['status'];
        $comment_date = $row['date'];

        $query = "SELECT * FROM posts WHERE id=$comment_post_id";
        $select_posts_id_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_posts_id_query)){
          $pos_id = $row['id'];
          $pos_title = $row['title'];
        };
        
        echo "<tr>
                <td>$comment_id</td>
                <td>$comment_author</td>
                <td>$comment_content</td>
                <td>$comment_email</td>
                <td>$comment_status</td>
                <td><a href='../post.php?p_id=$pos_id'>$pos_title</a></td>
                <td>$comment_date</td>
                <td><a href='comments.php?approved=$comment_id'>Approve</a></td>
                <td><a href='comments.php?unapproved=$comment_id'>Unapprove</a></td>
                <td><a href='comments.php?delete=$comment_id'>Delete</a></td>
              </tr>";
      }
    ?>
  </tbody>
</table>

<?php
  if(isset($_GET['unapproved'])){
    $the_comment_id = $_GET['unapproved'];
    $query = "UPDATE comments SET status='unapproved' WHERE id=$the_comment_id";
    $unapprove_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
  }

  if(isset($_GET['approved'])){
    $the_comment_id = $_GET['approved'];
    $query = "UPDATE comments SET status='approved' WHERE id=$the_comment_id";
    $approve_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
  }

  if(isset($_GET['delete'])){
    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE id=$the_comment_id";
    $delete_query = mysqli_query($connection, $query);

    $query = "UPDATE posts SET comment_count = comment_count - 1 WHERE id=$comment_post_id";
    $update_comment_count = mysqli_query($connection, $query);
    confirmQuery($update_comment_count);
    header("Location: comments.php");
  }
?>