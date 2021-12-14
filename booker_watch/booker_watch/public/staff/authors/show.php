<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = "Single Author Page";?>
<?php include(SHARED_PATH . "staff_header.php");?>
<div id='content'>
    <a class="back-link" href="<?php echo url_for('/staff/authors/index.php');?>">&laquo; Back to List</a>
</div>
<?php
    $isbn = $_GET['ISBN'] ?? 'No ISBN Provided'; // PHP > 7.0
    echo "Author ISBN: " . h($isbn);
?>

<?php include(SHARED_PATH . "staff_footer.php");?>