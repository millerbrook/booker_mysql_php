<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {

    // Handle form values sent by new.php
    $admin = [];
    $admin['ISBN'] = $_POST['ISBN'] ?? '';
    $admin['FirstName'] = $_POST['FirstName'] ?? '';
    $admin['LastName'] = $_POST['LastName'] ?? '';
    $admin['Gender'] = $_POST['Gender'] ?? '';
    $admin['Nation'] = $_POST['Nation'] ?? '';
    //$Birthdate = $_POST['Birthdate'] ?? '';
    //$visible = $_POST['visible'] ?? '';
    $result_admin = insert_admin($admin);
    if($result_admin === true) {
        $_SESSION['message'] = 'The admin entry was added successfully.';
        redirect_to(url_for('/staff/admins/show.php?ISBN=' . $admin['ISBN']));
    } else {
        $errors = $result_admin;
      }
    } else {
        $admin = [];
        $admin['ISBN'] = '';
        $admin['FirstName'] = '';
        $admin['LastName'] = '';
        $admin['Gender'] = '';
        $admin['Nation'] = '';
    }
   
?>

<?php $page_title = 'Create admin Entry'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create NEW admin Entry</h1>

        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/staff/admins/new.php'); ?>" method="post">
            <dl>
                <dt>Associated ISBN</dt>
                <dd><input type="text" name="ISBN" value="" /></dd>
            </dl>
            <dl>
                <dt>First Name</dt>
                <dd>
                    <input type="text" name="FirstName" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Last Name</dt>
                <dd>
                    <input type="text" name="LastName" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Gender</dt>
                <dd>
                    <input type="text" name="Gender" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Nation</dt>
                <dd>
                    <input type="text" name="Nation" value="" />
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create admin Entry" />
            </div>
        </form>

    </div>

</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>
<?php //Deleted { to Close else clause from above (all form stuff is in 'else' clause) ?> 
