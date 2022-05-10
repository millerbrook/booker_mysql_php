<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['ISBN'])) {
    redirect_to(url_for('/staff/authors/index.php'));
}
$ISBN = $_GET['ISBN'];

if(is_post_request()) {

  $result = delete_author_by_ISBN($ISBN);
  $_SESSION['message'] = 'The author entry was deleted successfully.';
  redirect_to(url_for('/staff/authors/index.php'));

} else {
  $author = find_author_by_ISBN($ISBN);
}

?>

<?php $page_title = 'Delete Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject delete">
    <h1>Delete Admin</h1>
    <p>Are you sure you want to delete this admin?</p>
    <p class="item"><?php echo h($admin['FirstName'] . " " . $admin['LastName']); ?></p>
    <p class="item"><?php echo h("Associated id: " . $admin['id']); ?></p>
    <form action="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Admin" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
