<?php
/**
 * initialise and handle cart actions
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
<<<<<<< HEAD
 * @version $Id:
=======
 * @version GIT: $Id: Author: Ian Wilson  Sat Oct 6 15:06:42 2012 +0100 Modified in v1.5.2 $
>>>>>>> upstream/master
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
if (zcRequest::hasGet('action')) {
  /**
   * redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled
   */
  if ($session_started == false) {
    zen_redirect(zen_href_link(FILENAME_COOKIE_USAGE));
  }
  if (DISPLAY_CART == 'true') {
    $goto =  FILENAME_SHOPPING_CART;
    $parameters = array('action', 'cPath', 'products_id', 'pid', 'main_page');
  } else {
<<<<<<< HEAD
    $chk_handler = zen_get_info_page(zcRequest::readGet('products_id', 0));
    $goto = zcRequest::readGet('main_page');
    if (zcRequest::readGet('action') == 'buy_now') {
=======
    $chk_handler = zen_get_info_page(isset($_GET['products_id']) ? $_GET['products_id'] : 0);
    $goto = $_GET['main_page'];
    if ($_GET['action'] == 'buy_now') {
>>>>>>> upstream/master
      if (strpos($goto, 'reviews') > 5) {
        $parameters = array('action');
        $goto = FILENAME_PRODUCT_REVIEWS;
      } else {
        $parameters = array('action', 'products_id');
      }
<<<<<<< HEAD
    } elseif (zcRequest::readGet('main_page') == $chk_handler) {
=======
    } elseif ($_GET['main_page'] == $chk_handler) {
>>>>>>> upstream/master
      $parameters = array('action', 'pid', 'main_page');
    } else {
      $parameters = array('action', 'pid', 'main_page', 'products_id');
    }
  }
  /**
   * require file containing code to handle default cart actions
   */
  require(DIR_WS_INCLUDES . 'main_cart_actions.php');
}
