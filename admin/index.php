<?php
use ZenCart\AdminUser\AdminUser;
/**
 * @package admin
<<<<<<< HEAD
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version GIT: $Id: $
=======
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Author: DrByte  Fri Feb 19 22:01:13 2016 -0500 Modified in v1.5.5 $
>>>>>>> upstream/master
 */
require('includes/application_bootstrap.php');

if (!isset($_GET['cmd']))
{
    $cmd = str_replace('.php', '', basename($_SERVER['SCRIPT_FILENAME']));
    $_GET['cmd'] = $cmd;

    // Only redirect if not a request for "index.php"
    if($cmd != 'index') {
        require('includes/application_top.php');
        zen_redirect(zen_admin_href_link(str_replace('.php', '', basename($_SERVER ['SCRIPT_FILENAME'])), zen_get_all_get_params()));
    }
<<<<<<< HEAD

    // Populate the command and continue
    unset($cmd);
}
$controllerCommand = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET ['cmd']);
$foundAction = FALSE;
if ($controllerCommand != $_GET['cmd'])
{
    $controllerCommand = 'index';
}
$controllerName = 'ZenCart\\Controllers\\'. ucfirst(zcCamelize($controllerCommand, true));
$controllerFile =  DIR_CATALOG_LIBRARY . URL_CONTROLLERS . '/admin/' . ucfirst(zcCamelize($controllerCommand, true)) . '.php';
if (file_exists($controllerFile))
{
    require('includes/application_top.php');
    require_once ($controllerFile);
    if (class_exists($controllerName))
    {
        $foundAction = TRUE;
        $actionClass = $di->newInstance($controllerName);
//        $actionClass = new $controllerName($zcRequest, $db, new AdminUser($_SESSION['admin_id']));
        $actionClass->invoke();
    }
}
if ($foundAction)
{
    die(0);
} else
{
    require(preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET ['cmd']) . '.php');
}
function zcCamelize($rawName, $camelFirst = FALSE)
{
    if ($rawName == "")
        return $rawName;
    if ($camelFirst)
    {
        $rawName[0] = strtoupper($rawName[0]);
    }
    return preg_replace_callback('/[_-]([0-9,a-z])/', create_function('$matches', 'return strtoupper($matches[1]);'), $rawName);
}
=======
  }

  if (STORE_NAME == '' || STORE_OWNER =='' || STORE_OWNER_EMAIL_ADDRESS =='' || STORE_NAME_ADDRESS =='') {
    require('index_setup_wizard.php');
  } else {
    require('index_dashboard.php');
  }
?>
<footer class="homeFooter">
<!-- The following copyright announcement is in compliance
to section 2c of the GNU General Public License, and
thus can not be removed, or can only be modified
appropriately.

Please leave this comment intact together with the
following copyright announcement. //-->

<div class="copyrightrow"><a href="http://www.zen-cart.com" target="_blank"><img src="images/small_zen_logo.gif" alt="Zen Cart:: the art of e-commerce" border="0" /></a><br /><br />E-Commerce Engine Copyright &copy; 2003-<?php echo date('Y'); ?> <a href="http://www.zen-cart.com" target="_blank">Zen Cart&reg;</a></div><div class="warrantyrow"><br /><br />Zen Cart is derived from: Copyright &copy; 2003 osCommerce<br />This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;<br />without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE<br />and is redistributable under the <a href="http://www.zen-cart.com/license/2_0.txt" target="_blank">GNU General Public License</a><br />
</div>
</footer>
</body>
</html>
<?php require('includes/application_bottom.php');
>>>>>>> upstream/master
