<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['ISBN'])) {
  redirect_to(url_for('/staff/authors/index.php'));
}
$ISBN = $_GET['ISBN'];

if(is_post_request()) {

  $result = delete_author_by_ISBN($ISBN);
  redirect_to(url_for('/staff/authors/index.php'));

} else {
  $author = find_author_by_ISBN($ISBN);
}

?>

<?php $page_title = 'Delete Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/authors/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject delete">
    <h1>Delete Author</h1>
    <p>Are you sure you want to delete this author?</p>
    <p class="item"><?php echo h($author['FirstName'] . " " . $author['LastName']); ?></p>
    <p class="item"><?php echo h("Associated ISBN: " . $author['ISBN']); ?></p>
    <form action="<?php echo url_for('/staff/authors/delete.php?id=' . h(u($author['ISBN']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Subject" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
