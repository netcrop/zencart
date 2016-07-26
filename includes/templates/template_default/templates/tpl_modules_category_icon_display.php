<?php
/**
 * Module Template
 *
 * @package templateSystem
<<<<<<< HEAD
 * @copyright Copyright 2003-2013 Zen Cart Development Team
=======
 * @copyright Copyright 2003-2016 Zen Cart Development Team
>>>>>>> upstream/master
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Author: DrByte  Fri Jan 8 00:33:36 2016 -0500 Modified in v1.5.5 $
 */
  require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_CATEGORY_ICON_DISPLAY));

?>
<<<<<<< HEAD
<div align="<?php echo $align; ?>" id="categoryIcon" class="categoryIcon">
  <a href="<?php echo zen_href_link(FILENAME_DEFAULT, 'cPath=' . $_GET['cPath'], 'NONSSL'); ?>">
    <?php echo $category_icon_display_image; ?>
    <span itemprop="category" content="<?php echo $category_icon_display_name; ?>"><?php echo $category_icon_display_name; ?></span>
  </a>
</div>
=======

<div id="categoryIcon" class="categoryIcon <?php echo 'align' . base::camelize($align, true); ?>"><?php echo '<a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath=' . $_GET['cPath'], 'NONSSL') . '">' . $category_icon_display_image . $category_icon_display_name .  '</a>'; ?></div>
>>>>>>> upstream/master
