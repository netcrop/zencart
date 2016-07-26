<?php
/**
 * product_listing_alpha_sorter module
 *
 * @package modules
<<<<<<< HEAD
 * @copyright Copyright 2003-2016 Zen Cart Development Team
=======
 * @copyright Copyright 2003-2016 Zen Cart Development Team
>>>>>>> upstream/master
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Author: DrByte  Mon Feb 15 13:59:01 2016 -0500 Modified in v1.5.5 $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

// build alpha sorter dropdown
  if (PRODUCT_LIST_ALPHA_SORTER == 'true') {
    if ((int)$_GET['alpha_filter_id'] == 0) {
      $prefix = TEXT_PRODUCTS_LISTING_ALPHA_SORTER_NAMES;
    } else {
      $prefix = TEXT_PRODUCTS_LISTING_ALPHA_SORTER_NAMES_RESET;
    }
    $prefix .= ':;';
    $alpha_sort_list = explode(';', $prefix . trim(PRODUCT_LIST_ALPHA_SORTER_LIST));
    for ($j=0, $n=sizeof($alpha_sort_list); $j<$n; $j++) {
      $letters_list[] = array('id' => $j, 'text' => substr($alpha_sort_list[$j], 0, strpos($alpha_sort_list[$j], ':')));
    }

    $zco_notifier->notify('NOTIFY_PRODUCT_LISTING_ALPHA_SORTER_SELECTLIST', $prefix, $letters_list);

    if (TEXT_PRODUCTS_LISTING_ALPHA_SORTER != '') {
      echo '<label class="inputLabel">' . TEXT_PRODUCTS_LISTING_ALPHA_SORTER . '</label>';
    }
    echo zen_draw_pull_down_menu('alpha_filter_id', $letters_list, (isset($_GET['alpha_filter_id']) ? (int)$_GET['alpha_filter_id'] : 0), 'onchange="this.form.submit()"');
  }
<<<<<<< HEAD

=======
>>>>>>> upstream/master
