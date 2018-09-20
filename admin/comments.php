<?php include 'includes/header.php'; ?>

            <?php 
              if(isset($_GET['source'])){
                $source = $_GET['source'];
              } else {
                $source = '';
              }
              switch($source) {
                case 'add_comment':
                  break;
                default:
                  include "includes/view_all_comments.php";
              }
            ?>
            
<?php include 'includes/footer.php'; ?>