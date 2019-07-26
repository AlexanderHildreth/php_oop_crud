<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title><?php echo $page_title; ?></title>
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="dist/css/custom.css" />

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>  
</head>
<body>
    <?php 
    // session_start(); 
   /*if( $_SESSION['last_activity'] < time() - $_SESSION['expire_time'] ) { 
      $_SESSION['logged'] = false;
      $_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><i class='fa fa-exclamation-circle'></i> You're not logged in!<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
      // header('Location:index.php');
    } else{
        $_SESSION['last_activity'] = time();
    }*/
    ?> 
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">
           <i class="fa fa-terminal" aria-hidden="true"></i> Decoded
          </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Posts</a></li>
            <?php if($_SESSION['logged']) { ?>
              <li><a href="create_blog.php">Create Post</a></li>
            <?php } ?>
          </ul>
          <form role='search' class="navbar-form navbar-right" action='search.php'>
            <div class='input-group margin-right-1em'>
                <?php $search_value = isset($search_term) ? "value='{$search_term}'" : "" ?>
                <input type='text' class='form-control' placeholder='Type post title name or post...' name='search' id='search-term' required <?php echo $search_value ?> />
                <div class='input-group-btn'>
                    <button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>
                </div>
            </div>
        </form>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <?php if (!$_SESSION['logged']) { ?>
                  <li><a href="login.php">Login</a></li>
                  <li><a href="register.php">Register</a></li>
                <?php } else { ?>
                  <li><a href="logout.php">Logout</a></li>
                <?php } ?>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class="container">
        <?php
        echo "<div class='page-header'>
                <h1>{$page_title}</h1>
            </div>";
        ?>