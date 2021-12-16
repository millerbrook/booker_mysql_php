<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['ISBN'])) {
    redirect_to(url_for('/staff/authors/index.php'));
}

$ISBN = $_GET['ISBN'];
$FirstName = '';
$LastName = '';
$Gender = '';
$Nation = '';
$Birthdate = '';
$visible = '';

if(is_post_request()) {

    // Handle form values sent by edit.php below
    $FirstName = $_POST['FirstName'] ?? '';
    $LastName = $_POST['LastName'] ?? '';
    $Gender = $_POST['Gender'] ?? '';
    $Nation = $_POST['Nation'] ?? '';
    $Birthdate = $_POST['Birthdate'] ?? '';
    $visible = $_POST['visible'] ?? '';

    echo "Form parameters<br />";
    echo "ISBN: " . $ISBN . "<br />";
    echo "Name: " . $FirstName . " " . $LastName . "<br />";
    echo "Gender: " . $Gender . "<br />";
    echo "Nation: " . $Nation . "<br />";
    echo "Birth Date: " . $Birthdate . "<br />";
    echo "Visible: " . $visible . "<br />";

} else {
   // 
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
                <dd><input type="text" name="ISBN" value="<?php echo $ISBN;?>" /></dd>
            </dl>
            <dl> 
                <dt>First Name</dt>
                <dd>
                    <input type="text" name="FirstName" value="<?php echo $FirstName;?>" />
                </dd>
            </dl>
            <dl>
                <dt>Last Name</dt>
                <dd>
                    <input type="text" name="LastName" value="<?php echo $LastName;?>" />
                </dd>
            </dl>
            <dl>
                <dt>Gender</dt>
                <dd>
                    <input type="text" name="Gender" value="<?php echo $Gender; ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Nation</dt>
                <dd>
                    <input type="text" name="Nation" value="<?php echo $Nation; ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Birthdate</dt>
                <dd>
                    <input type="date" name="BirthDate" value="<?php echo $Birthdate;?>" />
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" />
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Author Entry" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>