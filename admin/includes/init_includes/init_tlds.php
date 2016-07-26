<?php
/**
 * @package admin
<<<<<<< HEAD
 * @copyright Copyright 2003-2016 Zen Cart Development Team
=======
 * @copyright Copyright 2003-2013 Zen Cart Development Team
>>>>>>> upstream/master
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version GIT: $Id: Author: DrByte  Fri Oct 25 12:27:22 2013 -0400 Modified in v1.5.2 $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$http_domain = zen_get_top_level_domain(ADMIN_HTTP_SERVER);
$cookieDomain = $http_domain;
if (defined('HTTP_COOKIE_DOMAIN'))
{
  $cookieDomain = HTTP_COOKIE_DOMAIN;
}