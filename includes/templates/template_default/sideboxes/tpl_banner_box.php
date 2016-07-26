<?php
/**
 * Sidebox Template
 *
 * @package templateSystem
<<<<<<< HEAD
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_banner_box.php drbyte  Modified in v1.6.0 $
=======
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Author: DrByte  Mon Dec 28 11:41:25 2015 -0500 Modified in v1.5.5 $
>>>>>>> upstream/master
 */
 $content = '';
// if no active banner in the specified banner group then the box will not show
<<<<<<< HEAD
if ($banner !== false) {
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent centeredContent">';
  $content .= '<section class="info-promowrapper b-1">';
  $content .= zen_display_banner('static', $banner);
  $content .= '</section>';
  $content .= '</div>';
}
=======
  if ($banner = zen_banner_exists('dynamic', $banner_box_group)) {
    $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent centeredContent">';
    $content .= zen_display_banner('static', $banner);
    $content .= '</div>';
  }
>>>>>>> upstream/master
