<?php
/**
 * customer authorisation based on DOWN_FOR_MAINTENANCE and CUSTOMERS_APPROVAL_AUTHORIZATION settings
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
<<<<<<< HEAD
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version GIT: $Id: Modified in v1.6.0 $
=======
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Author: DrByte  Sun Oct 18 23:45:35 2015 -0400 Modified in v1.5.5 $
>>>>>>> upstream/master
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * Check if customer's session contains a valid customer_id. If not, then it could be that the administrator has deleted the customer (managing spam etc) so we'll log them out.
 */
if (isset($_SESSION['customer_id'])) {
  $sql = "select customers_id from " . TABLE_CUSTOMERS . " where customers_id = " . (int)$_SESSION['customer_id'];
  $result = $db->Execute($sql);
  if ($result->RecordCount() == 0) {
    $_SESSION['cart']->reset(true);
    zen_session_destroy();
    zen_redirect(zen_href_link(FILENAME_TIME_OUT));
  }
}

$down_for_maint_flag = false;
/**
 * do not let people get to down for maintenance page if not turned on unless is admin in IP list
 */
if (DOWN_FOR_MAINTENANCE=='false' and zcRequest::readGet('main_page') == DOWN_FOR_MAINTENANCE_FILENAME && !strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])){
  zen_redirect(zen_href_link(FILENAME_DEFAULT));
}
/**
 * see if DFM mode type is defined (strict means all pages blocked, relaxed means logoff/privacy/etc pages are usable)
 */
if (!defined('DOWN_FOR_MAINTENANCE_TYPE')) define('DOWN_FOR_MAINTENANCE_TYPE', 'relaxed');
/**
 * check to see if site is DFM, and set a flag for use later
 */
if (DOWN_FOR_MAINTENANCE == 'true') {
  if (!strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])){
    if (zcRequest::readGet('main_page') != DOWN_FOR_MAINTENANCE_FILENAME) $down_for_maint_flag = true;
  }
}
/**
 * recheck customer status for authorization
 */
if ((int)$_SESSION['customer_id'] > 0) {
  $check_customer_query = "select customers_id, customers_authorization
                             from " . TABLE_CUSTOMERS . "
                             where customers_id = " . (int)$_SESSION['customer_id'];
  $check_customer = $db->Execute($check_customer_query);
  $_SESSION['customers_authorization'] = $check_customer->fields['customers_authorization'];

  if ($_SESSION['customers_authorization'] == '4') {
    // this account is banned
    $zco_notifier->notify('NOTIFY_LOGIN_BANNED');
    zen_session_destroy();
    zen_redirect(zen_href_link(FILENAME_LOGIN));
  }
<<<<<<< HEAD
  if ($_SESSION['customers_authorization'] != 0 && in_array(zcRequest::readGet('main_page'), array(FILENAME_CHECKOUT_FLOW))) {
=======
  if ($_SESSION['customers_authorization'] != 0 && in_array($_GET['main_page'], array(FILENAME_CHECKOUT_SHIPPING, FILENAME_CHECKOUT_PAYMENT, FILENAME_CHECKOUT_CONFIRMATION))) {
>>>>>>> upstream/master
    // this account is not valid for checkout
    global $messageStack;
    $messageStack->add_session('header', TEXT_AUTHORIZATION_PENDING_CHECKOUT, 'caution');
    zen_redirect(zen_href_link(FILENAME_DEFAULT));
  }
}
/**
 * customer login status
 * 0 = normal shopping
 * 1 = Login to shop
 * 2 = Can browse but no prices
 *
 * customer authorization status
 * 0 = normal shopping
 * 1 = customer authorization to shop
 * 2 = customer authorization pending can browse but no prices
 */
switch (true) {
  /**
   * bypass redirects for these scripts, to processing regardless of store mode or cust auth mode
   */
  case (preg_match('|_handler\.php$|', $_SERVER['SCRIPT_NAME'])):
  case (preg_match('|ajax\.php$|', $_SERVER['SCRIPT_NAME'])):
  break;

<<<<<<< HEAD
  // if DFM is in strict mode, then block access to all pages:
=======
>>>>>>> upstream/master
  case ($down_for_maint_flag && DOWN_FOR_MAINTENANCE_TYPE == 'strict'):
    zen_redirect(zen_href_link(DOWN_FOR_MAINTENANCE_FILENAME));
  break;

  // on special pages, if DFM mode is "relaxed", allow access to these pages
  case ((DOWN_FOR_MAINTENANCE == 'true') && !in_array(zcRequest::readGet('main_page'), array(FILENAME_LOGOFF, FILENAME_PRIVACY, FILENAME_CONTACT_US, FILENAME_CONDITIONS, FILENAME_SHIPPING))):
    if ($down_for_maint_flag && DOWN_FOR_MAINTENANCE_TYPE == 'relaxed') {
      zen_redirect(zen_href_link(DOWN_FOR_MAINTENANCE_FILENAME));
    }
  break;

  // on special pages, allow customers to access regardless of store mode or cust auth mode
  case (in_array(zcRequest::readGet('main_page'), array(FILENAME_ORDER_STATUS, FILENAME_LOGOFF, FILENAME_PRIVACY, FILENAME_PASSWORD_FORGOTTEN, FILENAME_CONTACT_US, FILENAME_CONDITIONS, FILENAME_SHIPPING, FILENAME_UNSUBSCRIBE))):
  break;

/**
 * check store status before authorizations
 */
  case (STORE_STATUS != 0):
  break;
/**
 * if not down for maintenance check login status
 */
  case (CUSTOMERS_APPROVAL == '1' and (int)$_SESSION['customer_id'] == 0):
  /**
   * customer must be logged in to browse
   */
  if (!in_array(zcRequest::readGet('main_page'), array(FILENAME_LOGIN, FILENAME_CREATE_ACCOUNT))) {
    if (!isset($_GET['set_session_login'])) {
      $_GET['set_session_login'] = 'true';
      $_SESSION['navigation']->set_snapshot();
    }
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  break;
  case (CUSTOMERS_APPROVAL == '2' and (int)$_SESSION['customer_id'] == 0):
  /**
   * customer may browse but no prices
   */
  break;
  default:
  /**
   * proceed normally
   */
  break;
}

switch (true) {
  /**
   * bypass redirects for these scripts, to processing regardless of store mode or cust auth mode
   */
  case (preg_match('|_handler\.php$|', $_SERVER['SCRIPT_NAME'])):
  case (preg_match('|ajax\.php$|', $_SERVER['SCRIPT_NAME'])):
  break;

/**
 * check store status before authorizations
 */
  case (STORE_STATUS != 0):
<<<<<<< HEAD
  break;
=======
    break;
>>>>>>> upstream/master

  case (CUSTOMERS_APPROVAL_AUTHORIZATION == '1' and (int)$_SESSION['customer_id'] == 0):
  /**
   * customer must be logged in to browse
   */
<<<<<<< HEAD
  if (!in_array(zcRequest::readGet('main_page'), array(FILENAME_ORDER_STATUS, FILENAME_LOGIN, FILENAME_LOGOFF, FILENAME_CREATE_ACCOUNT, FILENAME_PASSWORD_FORGOTTEN, FILENAME_CONTACT_US, FILENAME_PRIVACY, DOWN_FOR_MAINTENANCE_FILENAME))) {
=======
  if (!in_array($_GET['main_page'], array(FILENAME_LOGIN, FILENAME_LOGOFF, FILENAME_CREATE_ACCOUNT, FILENAME_PASSWORD_FORGOTTEN, FILENAME_CONTACT_US, FILENAME_PRIVACY, DOWN_FOR_MAINTENANCE_FILENAME))) {
>>>>>>> upstream/master
    if (!isset($_GET['set_session_login'])) {
      $_GET['set_session_login'] = 'true';
      $_SESSION['navigation']->set_snapshot();
    }
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  break;
  case (CUSTOMERS_APPROVAL_AUTHORIZATION == '2' and (int)$_SESSION['customer_id'] == 0):
  /**
   * customer may browse but no prices unless Authorized
   */
  /*
  if (!in_array(zcRequest::readGet('main_page'), array(FILENAME_LOGIN, FILENAME_CREATE_ACCOUNT))) {
   if (!isset($_GET['set_session_login'])) {
    $_GET['set_session_login'] = 'true';
    $_SESSION['navigation']->set_snapshot();
   }
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  */
  break;
  case ((CUSTOMERS_APPROVAL_AUTHORIZATION == '1' and $_SESSION['customers_authorization'] != '0') || (int)$_SESSION['customers_authorization'] == 1):
  /**
   * customer is pending approval
   * customer must be logged in to browse
   * customer is logged in and changed to must be authorized to browse
   */
<<<<<<< HEAD
  if (!in_array(zcRequest::readGet('main_page'), array(FILENAME_ORDER_STATUS, FILENAME_LOGIN, FILENAME_LOGOFF, FILENAME_CONTACT_US, FILENAME_PRIVACY))) {
    if (zcRequest::readGet('main_page') != CUSTOMERS_AUTHORIZATION_FILENAME) {
=======
  if (!in_array($_GET['main_page'], array(FILENAME_LOGIN, FILENAME_LOGOFF, FILENAME_CONTACT_US, FILENAME_PRIVACY))) {
    if ($_GET['main_page'] != CUSTOMERS_AUTHORIZATION_FILENAME) {
>>>>>>> upstream/master
      zen_redirect(zen_href_link(preg_replace('/[^a-z_]/', '', CUSTOMERS_AUTHORIZATION_FILENAME)));
    }
  }
  break;
  case (CUSTOMERS_APPROVAL_AUTHORIZATION == '2' and $_SESSION['customers_authorization'] != '0'):
  /**
   * customer may browse but no prices
   */
  break;
  default:
  /**
   * proceed normally
   */
  break;
}
