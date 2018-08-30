<?php include "includes/header.php";?>
  <!-- Navigation -->
  <?php include 'includes/navigation.php';?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <h1 class="page-header">
          My Blog
          <small>Jin</small>
        </h1>

        <?php
          if(isset($_GET['p_id'])){
            $post_id = $_GET['p_id'];
            $query = "SELECT * FROM posts WHERE id=$post_id";
          }
          $select_query = mysqli_query($connection, $query);
          $count = mysqli_num_rows($select_query);
          if($count == 0) {
            echo "<h1>Sorry There is no such page</h1>";
          } else {
            while($row = mysqli_fetch_assoc($select_query)){
              $post_title = $row['title'];
              $post_author = $row['author'];
              $post_date = $row['date'];
              $post_image = $row['image'];
              $post_content = $row['content'];
              ?>
              
              <!-- Blog Post -->
              <h2>
                <a href="#"><?php echo $post_title;?></a>
              </h2>
              <p class="lead">
                by <a href="index.php"><?php echo $post_author;?></a>
              </p>
              <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;?></p>
              <hr>
              <img class="img-responsive" src="<?php echo ($post_image) ? 'images/'.$post_image : 'http://placehold.it/900x300';?>" alt="">
              <hr>
              <p><?php echo $post_content;?></p>
              <hr>
              <?php
            }
          }
        ?>

        <!-- Blog Comments -->

        <?php 
          if(isset($_POST['create_comment'])){
            $comment_post_id = $_GET['p_id'];
            $comment_author = $_POST['author'];
            $comment_email = $_POST['email'];
            $comment_content = $_POST['content'];
            $comment_status = 'unapproved';
            $comment_date = 'now()';

            $query = "INSERT INTO comments (post_id, author, email, content, status, date) ";
            $query .= "VALUES ($comment_post_id, '$comment_author', '$comment_email', '$comment_content', '$comment_status', $comment_date)";

            $create_comment_query = mysqli_query($connection, $query);
            confirmQuery($create_comment_query);

            $query = "UPDATE posts SET comment_count = comment_count + 1 WHERE id=$comment_post_id";
            $update_comment_count = mysqli_query($connection, $query);
            confirmQuery($update_comment_count);
          }
        ?>

        <!-- Comments Form -->
        <div class="well">
          <h4>Leave a Comment:</h4>
          <form action="" method="post" role="form">
            <div class="form-group">
              <input type="text" class="form-control" name="author" placeholder="Author">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
              <textarea class="form-control" rows="3" name="content" placeholder="Your Comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
          </form>
        </div>

        <hr>

        <!-- Posted Comments -->
        <?php
          $the_post_id = $_GET['p_id'];
          $query = "SELECT * FROM comments WHERE post_id=$the_post_id ";
          $query .= "AND status='approved' ";
          $query .= "ORDER BY id DESC";
          $select_comment_query = mysqli_query($connection, $query);
          confirmQuery($select_comment_query);
          while ($row = mysqli_fetch_array($select_comment_query)){
            $comment_date = $row['date'];
            $comment_content = $row['content'];
            $comment_author = $row['author'];
            ?>

            <!-- Comment -->
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
              </a>
              <div class="media-body">
                <h4 class="media-heading"><?php echo $comment_author; ?>
                  <small><?php echo $comment_date; ?></small>
                </h4>
                <?php echo $comment_content;?>
              </div>
            </div>

            <?php
          }
        ?>
      </div>

      <!-- Blog Sidebar Widgets Column -->
      <?php include "includes/sidebar.php";?>
    </div>
    <!-- /.row -->

    <hr>
<?php include "includes/footer.php";?>