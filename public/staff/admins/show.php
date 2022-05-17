<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = "Single Admin Page"; ?>
<?php include(SHARED_PATH . "/staff_header.php"); ?>

<?php
$username = $_GET['username'] ?? 'No Username Provided'; // PHP > 7.0
$admin = find_admin_by_username($username); // Find the admin record
?>

<div id='content'>
    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>
    <div class="attributes">
        <table>
            <dl>
                <dt>ID: </dt>
                <dd><?php echo h($admin['id']); ?></dd>
            </dl>
            <dl>
                <dt>Admin Name: </dt>
                <dd>
                    <?php echo (h($admin['first_name']) . " " . h($admin['last_name'])); ?>
                </dd>
            </dl>
            <dl>
                <dt>Email</dt>
                <dd>
                    <?php echo h($admin['email']); ?>
                </dd>
            </dl>
            <dl>
                <dt>Username</dt>
                <dd>
                    <?php echo h($admin['username']); ?>
                </dd>
            </dl>
        </table>
    </div>
</div>

<?php include(SHARED_PATH . "staff_footer.php"); ?>