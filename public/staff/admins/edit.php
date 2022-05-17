<?php

require_once('../../../private/initialize.php');

// If no $_GET value passed, send to index
// NOTE: does this work? If $_POST are passed below, is no $_GET passed?
if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/admins/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {
    $admin = [];
    // Handle form values sent by edit.php below
    $admin['id'] = $_POST['id'] ?? '';
    $admin['first_name'] = $_POST['first_name'] ?? '';
    $admin['last_name'] = $_POST['last_name'] ?? '';
    $admin['email'] = $_POST['email'] ?? '';
    $admin['username'] = $_POST['username'] ?? '';
    $admin['password'] = $_POST['password'] ?? '';
    $admin['confirm_password'] = $_POST['confirm_password'] ?? '';
   
    // Update the DB record, add a session message, and redirect to the single admin page to display result
    $result = update_admin($admin);
    $_SESSION['message'] = 'The admin entry was updated successfully.';
    redirect_to((url_for('/staff/admins/show.php?id=' . $admin['id'])));

} else {
    // Locate current details about admin
    $admin = find_admin_by_id($id);
}
?>

<?php $page_title = 'Edit Admin Entry'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Edit Admin Entry</h1>

        <?php echo display_errors($errors); ?>
        
        <form action="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($id))); ?>" method="post">
            <dl>
                <dt>Associated ID</dt>
                <dd><input type="text" name="id" value="<?php echo $admin['id'];?>" readonly="readonly"/></dd>
            </dl>
            <dl> 
                <dt>First Name</dt>
                <dd>
                    <input type="text" name="first_name" value="<?php echo $admin['first_name'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Last Name</dt>
                <dd>
                    <input type="text" name="last_name" value="<?php echo $admin['last_name'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Email</dt>
                <dd>
                    <input type="text" name="email" value="<?php echo $admin['email']; ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Username</dt>
                <dd>
                    <input type="text" name="username" value="<?php echo $admin['username']; ?>" />
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Admin Entry" />
            </div>
            <dl>
                <dt>Password</dt>
                <dd>
                    <input type="password" name="password" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Confirm Password</dt>
                <dd>
                    <input type="password" name="confirm_password" value="" />
                </dd>
            </dl>
            <p>Password should be at least 12 characters long and include at least 1 uppercase letter, 1 lowercase letter, and 1 symbol</p>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>