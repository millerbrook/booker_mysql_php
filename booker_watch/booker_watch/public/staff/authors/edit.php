<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['ISBN'])) {
    redirect_to(url_for('/staff/authors/index.php'));
}


$ISBN = $_GET['ISBN'];

if(is_post_request()) {
    $author = [];
    // Handle form values sent by edit.php below
    $author['ISBN'] = $_POST['ISBN'] ?? '';
    $author['FirstName'] = $_POST['FirstName'] ?? '';
    $author['LastName'] = $_POST['LastName'] ?? '';
    $author['Gender'] = $_POST['Gender'] ?? '';
    $author['Nation'] = $_POST['Nation'] ?? '';
    //$author['Birthdate'] = $_POST['Birthdate'] ?? '';
    //$visible = $_POST['visible'] ?? '';
   
    $result = update_author($author);
    redirect_to((url_for('/staff/authors/show.php?ISBN=' . $author['ISBN'])));

} else {
    $author = find_author_by_ISBN($ISBN);
}
?>

<?php $page_title = 'Edit Author Entry'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/authors/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Edit Author Entry</h1>

        <form action="<?php echo url_for('/staff/authors/edit.php?ISBN=' . h(u($ISBN))); ?>" method="post">
            <!-- DECIDE: MAKE ISBN EDITABLE? IT IS THE PRIMARY KEY -->
            <dl>
                <dt>Associated ISBN</dt>
                <dd><input type="text" name="ISBN" value="<?php echo $author['ISBN'];?>" readonly="readonly"/></dd>
            </dl>
            <dl> 
                <dt>First Name</dt>
                <dd>
                    <input type="text" name="FirstName" value="<?php echo $author['FirstName'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Last Name</dt>
                <dd>
                    <input type="text" name="LastName" value="<?php echo $author['LastName'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Gender</dt>
                <dd>
                    <input type="text" name="Gender" value="<?php echo $author['Gender']; ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Nation</dt>
                <dd>
                    <input type="text" name="Nation" value="<?php echo $author['Nation']; ?>" />
                </dd>
            </dl>
            <!-- <dl>
                <dt>Birthdate</dt>
                <dd>
                    <input type="date" name="BirthDate" value="<?php //echo $author['Birthdate'];?>" />
                </dd>
            </dl> -->
            <!-- <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1"<?php //if($visible=="1") { echo " checked";} ?> />
                </dd>
            </dl> -->
            <div id="operations">
                <input type="submit" value="Edit Author Entry" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>