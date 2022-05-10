<?php
    if(!isset($page_title)) {
        $page_title = 'Admin Area';
    }
    ?>
<!doctype html>
    <html lang="en">
    <head>
        <title>Booker Watch - <?php echo h($page_title); ?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />
    </head>

    <body>
        <header>
        <h1>Booker Watch -- <?php echo $page_title; ?></h1>
        </header>

        <navigation>
        <ul>
            <li>User: <?php echo $_SESSION['username'] ?? ''; ?></li>
            <li><a href="<?php echo url_for('/index.php'); ?>">Public Home Page</a></li>    
            <li><a href="<?php echo url_for('/staff/index.php')?>">Admin Menu</a></li>
        </ul>
        </navigation>

        <?php echo display_session_message(); ?>
