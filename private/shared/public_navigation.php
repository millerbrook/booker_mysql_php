<?php
  //array of main menu items
  $main_nav_items = ['Sandboxes'=>array('Timelines', 'Locations', 'Animations', 'Variable Correlations'), 'Themes'=>array('War', 'Bildung', 'Race', 'Class', 'Gender', 'Empire', 'Post-coloniality') , 'Formal Features'=>array('Genre', 'Metafiction', 'Temporal Structure', 'Book Length'), 'Location'=>array('London', 'England', 'Colonies', 'Ireland', 'Transnational'), 'Authors'=>array('Gender', 'Nation', 'Age', 'Debut', 'Subsequent Work'), 'Reception'=>array('Journalistic', 'Scholarly', 'Popularity', 'Adaptation', 'Booker Success', 'Other Awards'), 'Years'=>array('Individual', 'By Range'), 'Auditing & Feedback'=>array('Single Book', 'Single Author'), 'Sample Scholarship'=>array('Single Author', 'Thematic', 'Canonicity'), 'Resources'=>array('Prize Culture Bibliography', 'Booker Prize Bibliography', 'Scholarship with Digital Resources Bibliography')];
  // Default values to prevent errors
  $page_id = $page_id ?? '';
  $subject_id = $subject_id ?? '';
  if (isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];
  }
?>

<navigation>
  
  <ul class="main_nav_items"> <!--note this class was 'subjects' -- change in css -->
    <?php foreach ($main_nav_items as $main_nav_item=> $sub_items) { ?>
      <li class="<?php if($main_nav_item == $subject_id) { echo 'selected'; } ?>">
        <a href="<?php echo url_for('index.php?subject_id=' . h(u($main_nav_item)) . '&' . 'category_id=' . h(u($main_nav_item))); ?>">
          <?php echo h($main_nav_item); ?>
        </a>

        <?php if($main_nav_item == $subject_id) { ?>
          <ul class="sub_items">
            <?php foreach ($sub_items as $sub_item) {?>
              <li class="<?php if($sub_item == $subject_id) { echo 'selected'; } ?>">
                <a href="<?php echo url_for('index.php?subject_id=' . h(u($sub_item)) . '&' . 'category_id=' . h(u($main_nav_item))); ?>">
                    <?php echo h($sub_item); ?>
                </a>
              </li>
              <?php } // while $sub_items ?>
          </ul>
          <?php } // end if clause to trigger $sub_item menu ?>
      </li>
    <?php } // foreach main_nav_items  ?>
  </ul>
</navigation>
