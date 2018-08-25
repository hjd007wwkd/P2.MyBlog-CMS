<?php include 'includes/header.php'; ?>
  <div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <div id="page-wrapper">

      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">
              Welcome to admin
              <small>Jin</small>
            </h1>
            <div class="col-xs-6">
              <?php 
                insert_categories();
                deleteCategories();

                if(isset($_POST['Edit'])){
                  $the_cat_title = $_POST['title'];
                  $cat_id = $_GET['edit'];
                  if($the_cat_title === "" || empty($the_cat_title)) {
                    echo "This field should not be empty";
                  } else {
                    $query = "UPDATE categories SET title='$the_cat_title' ";
                    $query .= "WHERE id=$cat_id";
                    $edit_category_query = mysqli_query($connection, $query);
                    if(!$edit_category_query){
                      die('QUERY FAILED' . mysqli_error($connection));
                    }
                    //send another request so it refresh the page
                    header("Location: categories.php");
                  }
                }

                if(isset($_GET['edit'])){
                  $cat_id = $_GET['edit'];
                  $query = "SELECT * FROM categories WHERE id=$cat_id";
                  $select_categories_id = mysqli_query($connection, $query);
                  $row = mysqli_fetch_assoc($select_categories_id);
                  $cat_title = $row['title'];
                }
              ?>

              <?php
                $form_name = 'Add';
                $form_value = '';
                $form_id = '';
                if(isset($_GET['edit'])) {
                  $form_name = 'Edit';
                  $form_value = $cat_title;
                  $form_id = $cat_id;
                }
              ?>
              <form action="categories.php<?php echo "?edit=$form_id"?>" method="post">
                <div class='form-group'>
                  <label for="title"><?php echo $form_name;?> Category</label>
                  <input value="<?php echo $form_value;?>" type="text" class="form-control" name="title">
                </div>
                <div class='form-group'>
                  <input class="btn btn-primary" type="submit" name="<?php echo $form_name; ?>" value="<?php echo $form_name; ?> Category">
                </div>
              </form>
            </div>

            <div class="col-xs-6">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Category Title</th>
                  </tr>
                </thead>
                <tbody>
                  <?php //Find all categoies query
                    findAllCategories()
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

  </div>
  <!-- /#wrapper -->

<?php include 'includes/footer.php'; ?>