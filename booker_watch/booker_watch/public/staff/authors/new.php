<?php
//PROBLEM LIST: 1. dates not working; 
require_once('../../../private/initialize.php');

// if(is_post_request()) {

//     // Handle form values sent by new.php
//     $formattedBirthdate = strtotime($_POST['Birthdate']);
//     $ISBN = $_POST['ISBN'] ?? '';
//     $FirstName = $_POST['FirstName'] ?? '';
//     $LastName = $_POST['LastName'] ?? '';
//     $Gender = $_POST['Gender'] ?? '';
//     $Nation = $_POST['Nation'] ?? '';
//     $Birthdate = date('d-m-Y', $formattedBirthdate) ?? ''; //doesn't work
//     $visible = $_POST['visible'] ?? '';

//     echo "Form parameters<br />";
//     echo "ISBN: " . $ISBN . "<br />";
//     echo "Name: " . $FirstName . " " . $LastName . "<br />";
//     echo "Gender: " . $Gender . "<br />";
//     echo "Nation: " . $Nation . "<br />";
//     echo "Birth Date: " . $Birthdate . "<br />"; //Problem here -- doesn't print date
//     echo "Visible: " . $visible . "<br />";

// } else {
?>

<?php $page_title = 'Create Author Entry'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/authors/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create New Author Entry</h1>

        <form action="<?php echo url_for('/staff/authors/create.php'); ?>" method="post"><!--sends back to same page-->
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
            <dl>
                <dt>Birthdate</dt>
                <dd>
                    <input type="date" name="BirthDate" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1"<?php if($visible=="1") { echo " checked";} ?> />
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Author Entry" />
            </div>
        </form>

    </div>

</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>
<?php //Deleted { to Close else clause from above (all form stuff is in 'else' clause) ?> 
