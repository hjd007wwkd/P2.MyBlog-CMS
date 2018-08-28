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

        <!-- Comments Form -->
        <div class="well">
          <h4>Leave a Comment:</h4>
          <form role="form">
            <div class="form-group">
              <textarea class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>

        <hr>

        <!-- Posted Comments -->

        <!-- Comment -->
        <div class="media">
          <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
          </a>
          <div class="media-body">
            <h4 class="media-heading">Start Bootstrap
              <small>August 25, 2014 at 9:30 PM</small>
            </h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
          </div>
        </div>

        <!-- Comment -->
        <div class="media">
          <a class="pull-left" href="#">
              <img class="media-object" src="http://placehold.it/64x64" alt="">
          </a>
          <div class="media-body">
            <h4 class="media-heading">Start Bootstrap
              <small>August 25, 2014 at 9:30 PM</small>
            </h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            <!-- Nested Comment -->
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
              </a>
              <div class="media-body">
                <h4 class="media-heading">Nested Start Bootstrap
                  <small>August 25, 2014 at 9:30 PM</small>
                </h4>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>
            <!-- End Nested Comment -->
          </div>
        </div>

      </div>

      <!-- Blog Sidebar Widgets Column -->
      <?php include "includes/sidebar.php";?>
    </div>
    <!-- /.row -->

    <hr>
<?php include "includes/footer.php";?>