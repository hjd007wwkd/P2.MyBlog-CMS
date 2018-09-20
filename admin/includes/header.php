<!-- when you redirect, you need ob_start() -->
<!-- header() 라는 펑션을 쓸때 이게 없으면 
header()가 한번 보내진상태에서 또 보내면 에러가뜬다
근데 이거는 header 빼고는 나머지는 buffer에 저장을 해놓고
나중에 보내기때문에 괜찮다 -->
<?php ob_start(); ?>
<?php session_start(); ?>

<?php 
  if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'subscriber'){
      header("Location: ../index.php");
    }
  } else {
    header("Location: ../index.php");
  }
?>

<?php include "../includes/db.php";?>
<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>My Blog</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/sb-admin.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>
  <div id="wrapper">

    <!-- Navigation -->
    <?php include 'navigation.php'; ?>

    <div id="page-wrapper">

      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-lg-12">
            
            <h1 class="page-header">
              Welcome to admin
              <small><?php echo $_SESSION['username'] ?></small>
            </h1>