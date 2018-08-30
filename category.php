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
          if(isset($_GET['category'])) {
            $post_category_id = $_GET['category'];
            $query = "SELECT * FROM posts WHERE category_id=$post_category_id AND status='publish'";
          }
          
          $select_query = mysqli_query($connection, $query);
          $count = mysqli_num_rows($select_query);
          if($count == 0) {
            echo "<h1>NO RESULT</h1>";
          } else {
            while($row = mysqli_fetch_assoc($select_query)){
              $post_id = $row['id'];
              $post_title = $row['title'];
              $post_author = $row['author'];
              $post_date = $row['date'];
              $post_image = $row['image'];
              $post_content = substr($row['content'], 0, 100);
              ?>
              
              <!-- Blog Post -->
              <h2>
                <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title;?></a>
              </h2>
              <p class="lead">
                by <a href="index.php"><?php echo $post_author;?></a>
              </p>
              <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;?></p>
              <hr>
              <img class="img-responsive" src="<?php echo ($post_image) ? 'images/'.$post_image : 'http://placehold.it/900x300';?>" alt="">
              <hr>
              <p><?php echo $post_content;?></p>
              <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
  
              <hr>
              <?php
            }
          }
        ?>

        <!-- Pager -->
        <ul class="pager">
          <li class="previous">
            <a href="#">&larr; Older</a>
          </li>
          <li class="next">
            <a href="#">Newer &rarr;</a>
          </li>
        </ul>

      </div>

      <!-- Blog Sidebar Widgets Column -->
      <?php include "includes/sidebar.php";?>
    </div>
    <!-- /.row -->

    <hr>
<?php include "includes/footer.php";?>