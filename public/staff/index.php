<?php require_once('../../private/initialize.php'); ?>

<?php $page_title = 'Admin Area'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div id="main-menu">
    <h2>Main Menu</h2>
    <ul>
      <li><a href="<?php echo url_for('/staff/books/index.php'); ?>">Books</a></li>
      <li><a href="<?php echo url_for('/staff/authors/index.php'); ?>">Authors</a></li>
      <li><a href="<?php echo url_for('/staff/admins/index.php'); ?>">Admins</a></li>
    </ul>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>