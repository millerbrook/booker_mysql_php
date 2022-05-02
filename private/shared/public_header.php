<!doctype html>

<html lang="en">
  <head>
    <title>Booker Prize Watch <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>" />
  </head>

  <body>

    <header>
      <h1>
        <a href="<?php echo url_for('/index.php'); ?>">
          <img src="<?php echo url_for('/images/booksonshelfstock.png'); ?>" height="71" alt="" />
        </a>
        <p>Booker Prize Watch</p>
      </h1>
      <a href="<?php echo url_for('/staff/index.php'); ?>">Admin Area</a>
    </header>
