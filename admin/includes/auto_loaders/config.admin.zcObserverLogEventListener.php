<?php
/**
 * @package plugins
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
<<<<<<< HEAD
 * @version GIT: $Id: Author: DrByte  Jun 30 2014 Modified in v1.5.4 $
=======
 * @version GIT: $Id: Author: DrByte  Jun 30 2014 New in v1.5.4 $
>>>>>>> upstream/master
 *
 * Designed for v1.5.4+
 * Loadpoint 1 is to simply load this file
 * Loadpoint 40 is for instantiating the observer class after dependencies are loaded
 *
 */
  $autoLoadConfig[1][] = array('autoType'=>'class',
                               'loadFile'=>'class.admin.zcObserverLogEventListener.php',
                               'classPath'=>DIR_WS_CLASSES);
<<<<<<< HEAD
  $autoLoadConfig[40][] = array('autoType'=>'classInstantiate',
=======
  $autoLoadConfig[65][] = array('autoType'=>'classInstantiate',
>>>>>>> upstream/master
                               'className'=>'zcObserverLogEventListener',
                               'objectName'=>'zcObserverLogEventListener');
