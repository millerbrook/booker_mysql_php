<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/admins/index.php'));
}

$ISBN = $_GET['id'];

if(is_post_request()) {
    $admin = [];
    // Handle form values sent by edit.php below
    $admin['id'] = $_POST['id'] ?? '';
    $admin['first_name'] = $_POST['first_name'] ?? '';
    $admin['last_name'] = $_POST['last_name'] ?? '';
    $admin['email'] = $_POST['email'] ?? '';
    $admin['username'] = $_POST['username'] ?? '';
    //$author['Birthdate'] = $_POST['Birthdate'] ?? '';
    //$visible = $_POST['visible'] ?? '';
   
    $result = update_admin($admin);
    $_SESSION['message'] = 'The admin entry was updated successfully.';
    redirect_to((url_for('/staff/admins/show.php?id=' . $admin['id'])));

} else {
    $admin = find_admin_by_id($id);
}
?>

<?php $page_title = 'Edit admin Entry'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Edit admin Entry</h1>

        <?php echo display_errors($errors); ?>
        
        <form action="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($id))); ?>" method="post">
            <!-- DECIDE: MAKE ISBN EDITABLE? IT IS THE PRIMARY KEY -->
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
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>