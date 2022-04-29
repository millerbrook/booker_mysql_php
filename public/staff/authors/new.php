<?php
//PROBLEM LIST: 1. dates not working; 
require_once('../../../private/initialize.php');

if(is_post_request()) {

    // Handle form values sent by new.php
    $author = [];
    $author['ISBN'] = $_POST['ISBN'] ?? '';
    $author['FirstName'] = $_POST['FirstName'] ?? '';
    $author['LastName'] = $_POST['LastName'] ?? '';
    $author['Gender'] = $_POST['Gender'] ?? '';
    $author['Nation'] = $_POST['Nation'] ?? '';
    //$Birthdate = $_POST['Birthdate'] ?? '';
    //$visible = $_POST['visible'] ?? '';
    $result_author = insert_author($author);
    if($result_author === true) {
        redirect_to(url_for('/staff/authors/show.php?ISBN=' . $author['ISBN']));
    } else {
        $errors = $result_author;
      }
    } else {
        $author = [];
        $author['ISBN'] = '';
        $author['FirstName'] = '';
        $author['LastName'] = '';
        $author['Gender'] = '';
        $author['Nation'] = '';
    }
   
?>

<?php $page_title = 'Create Author Entry'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/authors/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create NEW Author Entry</h1>

        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/staff/authors/new.php'); ?>" method="post">
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
            <!-- <dl>
                <dt>Birthdate</dt>
                <dd>
                    <input type="date" name="BirthDate" value="" />
                </dd>
            </dl> -->
            <!-- <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1"<?php // if($visible=="1") { echo " checked";} ?> />
                </dd>
            </dl> -->
            <div id="operations">
                <input type="submit" value="Create Author Entry" />
            </div>
        </form>

    </div>

</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>
<?php //Deleted { to Close else clause from above (all form stuff is in 'else' clause) ?> 
