<?php
/**
 * @package admin
<<<<<<< HEAD
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: alert_page.php drbyte  Modified in v1.6.0 $
=======
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Author: DrByte  Mon Oct 19 16:41:08 2015 -0400 Modified in v1.5.5 $
>>>>>>> upstream/master
 */
require ('includes/application_top.php');
$adminDirectoryExists = $installDirectoryExists = FALSE;
if (substr(DIR_WS_ADMIN, -7) == '/admin/' || substr(DIR_WS_HTTPS_ADMIN, -7) == '/admin/')
{
   $adminDirectoryExists = TRUE;
}
$check_path = dirname($_SERVER['SCRIPT_FILENAME']) . '/../zc_install';
if (is_dir($check_path))
{
  $installDirectoryExists = TRUE;
}
if (!$adminDirectoryExists && !$installDirectoryExists)
{
  zen_redirect(zen_admin_href_link(FILENAME_DEFAULT));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>Zen Cart!</title>
<<<<<<< HEAD
<meta name="robots" content="noindex, nofollow">
=======
<meta name="robots" content="noindex, nofollow" />
>>>>>>> upstream/master
</head>
<body>
  <div style="width:400px;margin:auto;margin-top:10%;border:5px red solid;padding:20px 50px 50px 50px;background-color:#FFAFAF;">
  <h1 style="text-align: center;font-size:40px;color:red;margin:0;"><?php echo HEADING_TITLE; ?></h1>
  <p style=""><?php echo ALERT_PART1; ?></p>
  <ul style="">
  <?php if ($installDirectoryExists) { ?>
<<<<<<< HEAD
  <li><?php echo ALERT_REMOVE_ZCINSTALL; ?><br><br></li>
  <?php  } ?>
  <?php if ($adminDirectoryExists) { ?>
  <li><?php echo ALERT_RENAME_ADMIN; ?><br><a href="http://www.zen-cart.com/content.php?75-admin-rename-instructions" target="_blank"><?php echo ADMIN_RENAME_FAQ_NOTE; ?></a></li>
=======
  <li><?php echo ALERT_REMOVE_ZCINSTALL; ?><br /><br /></li>
  <?php  } ?>
  <?php if ($adminDirectoryExists) { ?>
  <li><?php echo ALERT_RENAME_ADMIN; ?><br /><a href="http://tutorials.zen-cart.com/index.php?article=33" target="_blank"><?php echo ADMIN_RENAME_FAQ_NOTE; ?></a></li>
>>>>>>> upstream/master
  <?php  } ?>
  </ul>
  <?php if ($adminDirectoryExists) { ?>
  <br />
  <p class=""><?php echo ALERT_PART2; ?></p>
<<<<<<< HEAD
  <?php } else { ?>
  <button class="button"><a href="<?php echo str_replace('?cmd=alert_page', '', $_SERVER['REQUEST_URI']);?>"><?php echo ALERT_CLICK_HERE; ?></a></button>
=======
>>>>>>> upstream/master
  <?php } ?>
  </div>
</body>
</html>
