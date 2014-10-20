<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="css/vendor/bootstrap.min.css">
    <!--<link rel="stylesheet" href="css/vendor/bootstrap-theme.min.css">-->
    <link rel="stylesheet" href="css/main.css">
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>

<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">IIM Blog</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="/" <?php  if(isset($homeActive)) { echo 'class="active"'; } ?>>Home</a></li>
                <li><a href="/categories.php">Categories</a></li>
                <li><a href="/tags.php">Tags</a></li>
                <li><a href="/contact.php">Contact</a></li>
                <?php if (true === isConnected()) { ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administration <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">Articles</li>
                        <li><a href="/admin-article-list.php"><span class="glyphicon glyphicon-list-alt"></span> List Articles</a></li>
                        <li><a href="/admin-article-add.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Article</a></li>
                        <li class="divider"></li>
                        <?php if (true === isAdmin()) { ?>
                        <li class="dropdown-header">Categories</li>
                        <li><a href="/admin-category-list.php"><span class="glyphicon glyphicon-list-alt"></span> List Categories</a></li>
                        <li><a href="/admin-category-add.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Category</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Tags</li>
                        <li><a href="/admin-tag-list.php"><span class="glyphicon glyphicon-list-alt"></span> List Tags</a></li>
                        <li><a href="/admin-tag-add.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Tag</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Users</li>
                        <li><a href="/admin-user-list.php"><span class="glyphicon glyphicon-list-alt"></span> List Users</a></li>
                        <li><a href="/admin-user-add.php"><span class="glyphicon glyphicon-plus-sign"></span> Add User</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (true === isConnected()) { ?>
                <li><a href="#">Welcome <?php echo getSession()['username']; ?>!</a></li>
                <li><a href="/logout.php">Logout</a></li>
                <?php } else { ?>
                <li><a href="/login.php">Login</a></li>
                <?php } ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">