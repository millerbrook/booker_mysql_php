<?php require_once('../private/initialize.php'); ?>
<?php 
    $con_year = $_POST['ConYear'] ?? 1981;
?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">
  <?php include(SHARED_PATH . '/public_navigation.php'); ?>
  <div id="page">
    <form action="<?php echo url_for('years.php?$category_id='.h(u($category_id)).'&subject_id='.h(u($subject_id)).'&selected='.h(u($selected))); ?>" method="post">
        <dl>
            <dt>Prize Consideration Year</dt>
            <dd>
                <input type="number" name="ConYear" min="1969" max="<?php echo date('Y'); ?>" step="1" />
            </dd>
        </dl>
        <div id="operations">
            <input type="submit" value="Choose Prize Year" />
        </div>
    </form>
    <?php 
        include(SHARED_PATH . '/dynamic_homepage.php');
    ?>
  </div>
</div>
<?php include(SHARED_PATH . '/public_footer.php'); ?>
