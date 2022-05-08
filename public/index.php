<?php require_once('../private/initialize.php'); ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">
  <?php include(SHARED_PATH . '/public_navigation.php'); ?>
  <div id="page">
    <?php 
      if((null != $category_id) && ($subject_id != $category_id)) {
        // show the page from the database
        // TODO add html escaping back in
        //include(SHARED_PATH . '/dynamic_homepage.php');
        include(SHARED_PATH . '/dynamic_homepage.php');
      } else {
        // Show the homepage
        // The homepage content could:
        // * be static content (here or in a shared file)
        // * show the first page from the nav
        // * be in the database but add code to hide in the nav
        include(SHARED_PATH . '/static_homepage.php');
      }
    ?>
  </div>
</div>
<?php include(SHARED_PATH . '/public_footer.php'); ?>
