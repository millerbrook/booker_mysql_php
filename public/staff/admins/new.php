<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {

    // Handle form values sent by new.php
    $admin = [];
    $admin['id'] = $_POST['id'] ?? '';
    $admin['first_name'] = $_POST['first_name'] ?? '';
    $admin['last_name'] = $_POST['last_name'] ?? '';
    $admin['username'] = $_POST['username'] ?? '';
    $admin['email'] = $_POST['email'] ?? '';
    $admin['password'] = $_POST['password'] ?? '';
    $admin['confirm_password'] = $_POST['confirm_password'] ?? '';
    $result_admin = insert_admin($admin);
    if($result_admin === true) {
        $_SESSION['message'] = 'The admin entry was added successfully.';
        redirect_to(url_for('/staff/admins/show.php?username=' . $admin['username']));
    } else {
        $errors = $result_admin;
      }
    } else {
        $admin = [];
        $admin['id'] = '';
        $admin['first_name'] = '';
        $admin['last_name'] = '';
        $admin['email'] = '';
        $admin['username'] = '';
        $admin['password'] = '';
        $admin['confirm_password'] = '';
    }
   
?>

<?php $page_title = 'Create Admin Entry'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create New Admin Entry</h1>

        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/staff/admins/new.php'); ?>" method="post">
            <dl>
                <dt>First Name</dt>
                <dd>
                    <input type="text" name="first_name" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Last Name</dt>
                <dd>
                    <input type="text" name="last_name" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Email</dt>
                <dd>
                    <input type="text" name="email" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Username</dt>
                <dd>
                    <input type="text" name="username" value="" />
                </dd>
            </dl>
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
            <div id="operations">
                <input type="submit" value="Create Admin Entry" />
            </div>
        </form>

    </div>

</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>