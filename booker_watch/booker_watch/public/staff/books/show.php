<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = "Single Book Page";?>
<?php include(SHARED_PATH . "staff_header.php");?>
<div id='content'>
    <a class="back-link" href="<?php echo url_for('/staff/books/index.php');?>">&laquo; Back to List</a>
</div>

<?php
    $isbn = $_GET['ISBN'] ?? 'No ISBN Provided'; // PHP > 7.0
    echo "Book ISBN: " . h($isbn);
?>
<?php include(SHARED_PATH . "staff_footer.php");?>