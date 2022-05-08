<?php
  //array of main menu items
  $main_nav_items = ['Sandboxes'=>array('Timelines', 'Locations', 'Animations', 'Variable Correlations'), 'Themes'=>array('War', 'Bildung', 'Race', 'Class', 'Gender', 'Empire', 'Post-coloniality') , 'Formal Features'=>array('Genre', 'Metafiction', 'Temporal Structure', 'Book Length'), 'Locations'=>array('London', 'England', 'Colonies', 'Ireland', 'Transnational'), 'Authors'=>array('Gender', 'Nation', 'Age', 'Debut', 'Subsequent Work'), 'Reception'=>array('Journalistic', 'Scholarly', 'Popularity', 'Adaptation', 'Booker Success', 'Other Awards'), 'Auditing & Feedback'=>array('Single Book', 'Single Author'), 'Sample Scholarship'=>array('Single Author', 'Thematic', 'Canonicity'), 'Resources'=>array('API', 'Prize Culture Bibliography', 'Booker Prize Bibliography', 'Scholarship with Digital Resources Bibliography')];
  // Default values to prevent errors
  $category_id = $category_id ?? '';
  $subject_id = $subject_id ?? '';
  if (isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];
  }
  if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
  }
  
  $selected = false; //set $selected to false. if $selected has been passed in $_GET as true, then sub menu is visible 
  if (isset($_GET['selected'])) {
    $selected = $_GET['selected'];
  }
?>

<navigation>
  
  <ul class="main_nav_items"> <!--note this class was 'subjects' -- change in css -->
      <li class="<?php if ($category_id == "Years") {echo 'selected'; } ?>">
        <a href="<?php echo url_for('years.php?subject_id=choose&category_id=Years&selected=' . (!$selected))?>">Years</a>
      </li>
    <?php foreach ($main_nav_items as $main_nav_item=> $sub_items) { ?>
      <li class="<?php if($main_nav_item == $category_id) { echo 'selected'; } ?>">
        <a href="<?php echo url_for('index.php?subject_id=' . h(u($main_nav_item)) . '&' . 'category_id=' . h(u($main_nav_item)) . '&selected=' . (!$selected))?>">
          <?php echo h($main_nav_item); ?>
        </a>

        <?php if(($main_nav_item == $category_id) && ($selected)) { ?>
          <ul class="sub_items">
            <?php foreach ($sub_items as $sub_item) {?>
              <li class="<?php if($sub_item == $subject_id) { echo 'selected'; } ?>">
                <a href="<?php echo url_for('index.php?subject_id=' . h(u($sub_item)) . '&' . 'category_id=' . h(u($main_nav_item))  . '&selected=' . $selected); ?>">
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
