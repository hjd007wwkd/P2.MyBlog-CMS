<?php include 'includes/header.php'; ?>
<div class="row">
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
              <i class="fa fa-file-text fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <?php 
              $query = "SELECT * from posts";
              $select_all_post = mysqli_query($connection, $query);
              $post_count = mysqli_num_rows($select_all_post);
              echo "<div class='huge'>{$post_count}</div>"
            ?>
            <div>Posts</div>
          </div>
        </div>
      </div>
      <a href="posts.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-green">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-comments fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <?php 
              $query = "SELECT * from comments";
              $select_all_comment = mysqli_query($connection, $query);
              $comment_count = mysqli_num_rows($select_all_comment);
              echo "<div class='huge'>{$comment_count}</div>"
            ?>
            <div>Comments</div>
          </div>
        </div>
      </div>
      <a href="comments.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-yellow">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-user fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <?php 
              $query = "SELECT * from users";
              $select_all_user = mysqli_query($connection, $query);
              $user_count = mysqli_num_rows($select_all_user);
              echo "<div class='huge'>{$user_count}</div>"
            ?>
            <div> Users</div>
          </div>
        </div>
      </div>
      <a href="users.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-red">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-list fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <?php 
              $query = "SELECT * from categories";
              $select_all_category = mysqli_query($connection, $query);
              $category_count = mysqli_num_rows($select_all_category);
              echo "<div class='huge'>{$category_count}</div>"
            ?>
            <div>Categories</div>
          </div>
        </div>
      </div>
      <a href="categories.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
</div>

<!-- google chart -->
<?php
  $query = "SELECT * from posts WHERE status='publish'";
  $select_all_active_post = mysqli_query($connection, $query);
  $post_active_count = mysqli_num_rows($select_all_active_post);

  $query = "SELECT * from posts WHERE status='draft'";
  $select_all_draft_post = mysqli_query($connection, $query);
  $post_draft_count = mysqli_num_rows($select_all_draft_post);

  $query = "SELECT * from comments WHERE status='approved'";
  $select_all_approved_comment = mysqli_query($connection, $query);
  $approved_comment_count = mysqli_num_rows($select_all_approved_comment);

  $query = "SELECT * from comments WHERE status='unapproved'";
  $select_all_unapproved_comment = mysqli_query($connection, $query);
  $unapproved_comment_count = mysqli_num_rows($select_all_unapproved_comment);

  $query = "SELECT * from users WHERE role='admin'";
  $select_all_admin = mysqli_query($connection, $query);
  $admin_count = mysqli_num_rows($select_all_admin);

  $query = "SELECT * from users WHERE role='subscriber'";
  $select_all_subscriber = mysqli_query($connection, $query);
  $subscriber_count = mysqli_num_rows($select_all_subscriber);
?>
<div class="row">
  <script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Date', 'Count'],
        <?php 
          $element_text = ['Active Posts', 'Draft Posts', 'Approved Comments', 'Unapproved Comments', 'Admin Users', 'Subscriber Users', 'Categories'];
          $element_count = [$post_active_count, $post_draft_count, $approved_comment_count, $unapproved_comment_count, $admin_count, $subscriber_count, $category_count];
          for($i = 0; $i < 7; $i++){
            echo "['{$element_text[$i]}'" . ", " . "{$element_count[$i]}],";
          }
        ?>
      ]);

      var options = {
        chart: {
          title: '',
          subtitle: '',
        }
      };

      var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>
  <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
</div>
<?php include 'includes/footer.php'; ?>