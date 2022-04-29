<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['ISBN'])) {
    redirect_to(url_for('/staff/books/index.php'));
}
$ISBN = $_GET['ISBN'];

if(is_post_request()) { //this is key -- different between going to the page the first time and second time (after form submit)

  $result = delete_book_by_ISBN($ISBN);
  redirect_to(url_for('/staff/books/index.php'));

} else {
  $book = find_book_by_ISBN($ISBN);
}

?>

<?php $page_title = 'Delete Book'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/books/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject delete">
    <h1>Delete Book</h1>
    <p>Are you sure you want to delete this book?</p>
    <p class="item"><?php echo h($book['Title']); ?></p>
    <p class="item"><?php echo h("Associated ISBN: " . $book['ISBN']); ?></p>
    <form action="<?php echo url_for('/staff/books/delete.php?ISBN=' . h(u($book['ISBN']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Book" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
