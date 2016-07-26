<?php
/**
 * @package plugins
<<<<<<< HEAD
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version GIT: $Id: Author: DrByte  Jun 30 2014 Modified in v1.6.0 $
 *
 * Designed for ZC >= v1.6.0
=======
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Author: DrByte  Mon Jan 5 17:23:41 2015 -0500 Modified in v1.5.5 $
 *
 * Designed for ZC >= v1.5.4
>>>>>>> upstream/master
 *
 */

class zcObserverLogWriterDatabase extends base {

<<<<<<< HEAD
  public function __construct() {
    $this->attach($this, array('NOTIFY_ADMIN_FIRE_LOG_WRITERS', 'NOTIFY_ADMIN_FIRE_LOG_WRITER_RESET'));
=======
  public function __construct(notifier $zco_notifier = null) {
    if (!$zco_notifier) $zco_notifier = new notifier;
    $this->notifier = $zco_notifier;
    $this->notifier->attach($this, array('NOTIFY_ADMIN_FIRE_LOG_WRITERS', 'NOTIFY_ADMIN_FIRE_LOG_WRITER_RESET'));
    $this->checkLogSchema();
>>>>>>> upstream/master
  }

  public function updateNotifyAdminFireLogWriters(&$class, $eventID, $log_data)
  {
    global $db;
    $this->initLogsTable();
<<<<<<< HEAD
    $db->perform(TABLE_ADMIN_ACTIVITY_LOG, $this->dbPrepareLogData($log_data));
  }

  /**
   * this method is public for the sake of unit tests; doesn't need to be private anyway
   */
  public function dbPrepareLogData($log_data)
  {
=======

>>>>>>> upstream/master
    /**
     * gzip the passed postdata so that it takes less storage space in the database
     */
    $gzpostdata = gzdeflate($log_data['postdata'], 7);

    /**
     * map incoming log data to db schema
     */
<<<<<<< HEAD
    $sql_data_array= array(
            array('fieldName'=>'access_date',     'value'=>'now()',                   'type'=>'passthru'),
            array('fieldName'=>'admin_id',        'value'=> $log_data['admin_id'],    'type'=>'integer'),
            array('fieldName'=>'page_accessed',   'value'=> $log_data['page_accessed'], 'type'=>'string'),
            array('fieldName'=>'page_parameters', 'value'=> $log_data['page_parameters'], 'type'=>'string'),
            array('fieldName'=>'ip_address',      'value'=> $log_data['ip_address'],  'type'=>'string'),
            array('fieldName'=>'gzpost',          'value'=> $gzpostdata,              'type'=>'string'),
            array('fieldName'=>'flagged',         'value'=> $log_data['flagged'],     'type'=>'integer'),
            array('fieldName'=>'attention',       'value'=> $log_data['attention'],   'type'=>'string'),
            array('fieldName'=>'severity',        'value'=> $log_data['severity'],    'type'=>'string'),
            array('fieldName'=>'logmessage',      'value'=> $this->preserveSpecialCharacters($log_data['specific_message']), 'type'=>'string'),
    );

    return $sql_data_array;
=======
    $sql_data_array = array( 'access_date' => 'now()',
            'admin_id' => (int)$log_data['admin_id'],
            'page_accessed' => $db->prepare_input($log_data['page_accessed']),
            'page_parameters' => $db->prepare_input($log_data['page_parameters']),
            'ip_address' => $db->prepare_input($log_data['ip_address']),
            'gzpost' => $gzpostdata,
            'flagged' => (int)$log_data['flagged'],
            'attention' => $db->prepare_input($log_data['attention']),
            'severity' => $db->prepare_input($log_data['severity']),
            'logmessage' => $this->preserveSpecialCharacters($db->prepare_input($log_data['specific_message'])),
    );
    zen_db_perform(TABLE_ADMIN_ACTIVITY_LOG, $sql_data_array);
>>>>>>> upstream/master
  }

  /**
   * PCI requires that if the log table is blank, that the logs be initialized
   * So this simply tests whether the table has any records, and if not, adds an initialization entry
   */
<<<<<<< HEAD
  private function initLogsTable()
  {
    $this->checkLogSchema();

    global $db;
    $sql = "SELECT * from " . TABLE_ADMIN_ACTIVITY_LOG . " LIMIT 1";
    $result = $db->Execute($sql);

    if (count($result) == 0) {
      $log_data = array(
        'event_epoch_time'=> time(),
        'admin_id'        => (isset($_SESSION['admin_id'])) ? (int)$_SESSION['admin_id'] : 0,
        'page_accessed'   => 'Log found to be empty. Logging started.',
        'page_parameters' => '',
        'specific_message'=> 'Log found to be empty. Logging started.',
        'ip_address'      => substr($_SERVER['REMOTE_ADDR'],0,45),
        'postdata'        => '',
        'flagged'         => 0,
        'attention'       => '',
        'severity'        => 'notice',
      );
      $db->perform(TABLE_ADMIN_ACTIVITY_LOG, $this->dbPrepareLogData($log_data));
    }
  }

  private function checkLogSchema()
=======
  public function initLogsTable()
  {
    global $db;
    $sql = "SELECT ip_address from " . TABLE_ADMIN_ACTIVITY_LOG . " LIMIT 1";
    $result = $db->Execute($sql);
    if ($result->RecordCount() < 1) {
      $admin_id = (isset($_SESSION['admin_id'])) ? $_SESSION['admin_id'] : 0;
      $sql_data_array = array( 'access_date' => 'now()',
              'admin_id' => (int)$admin_id,
              'page_accessed' =>  'Log found to be empty. Logging started.',
              'page_parameters' => '',
              'ip_address' => $db->prepare_input(substr($_SERVER['REMOTE_ADDR'],0,45)),
              'gzpost' => '',
              'flagged' => 0,
              'attention' => '',
              'severity' => 'notice',
              'logmessage' =>  'Log found to be empty. Logging started.',
      );
      zen_db_perform(TABLE_ADMIN_ACTIVITY_LOG, $sql_data_array);
    }
  }

  public function checkLogSchema()
>>>>>>> upstream/master
  {
    // adds 'logmessage' field of type mediumtext
    global $db;
    $sql = "show fields from " . TABLE_ADMIN_ACTIVITY_LOG;
    $result = $db->Execute($sql);
<<<<<<< HEAD

    $found_logmessage = false;
    foreach ($result as $row => $val) {
      if ($val['Field'] == 'logmessage') {
        $found_logmessage = true;
      }
=======
    $found_logmessage = false;
    while (!$result->EOF) {
      if  ($result->fields['Field'] == 'logmessage') {
        $found_logmessage = true;
      }
      $result->MoveNext();
>>>>>>> upstream/master
    }
    if (!$found_logmessage)
    {
      $sql = "ALTER TABLE " . TABLE_ADMIN_ACTIVITY_LOG . " ADD COLUMN logmessage mediumtext NOT NULL";
      $db->Execute($sql);
    }
    // add 'severity' field of type varchar(9)
    $sql = "show fields from " . TABLE_ADMIN_ACTIVITY_LOG;
    $result = $db->Execute($sql);
<<<<<<< HEAD
    foreach ($result as $row => $val) {
      if ($val['Field'] == 'severity') {
        return true; // exists, so return with no error
      }
=======
    while (!$result->EOF) {
      if  ($result->fields['Field'] == 'severity') {
        return true; // exists, so return with no error
      }
      $result->MoveNext();
>>>>>>> upstream/master
    }
    $sql = "ALTER TABLE " . TABLE_ADMIN_ACTIVITY_LOG . " ADD COLUMN severity varchar(9) NOT NULL default 'info', ADD INDEX idx_severity_zen (severity)";
    $db->Execute($sql);
    $sql = "UPDATE " . TABLE_ADMIN_ACTIVITY_LOG . " SET severity='notice' where flagged=1";
    $db->Execute($sql);
<<<<<<< HEAD
  }

  private function preserveSpecialCharacters($string)
=======

    // Init the logs if necessary
    $this->initLogsTable();

    // Log the schema change
    $admin_id = (isset($_SESSION['admin_id'])) ? $_SESSION['admin_id'] : 0;
    $sql_data_array = array( 'access_date' => 'now()',
            'admin_id' => (int)$admin_id,
            'ip_address' => $db->prepare_input(substr($_SERVER['REMOTE_ADDR'],0,45)),
            'gzpost' => '',
            'flagged' => 1,
            'attention' => '',
            'severity' => 'notice',
            'logmessage' => 'Updated database schema to allow for tracking [severity] in logs. NOTE: Severity levels before this date did not draw extra attention to add/remove of admin users or payment modules (CRUD operations), so old occurrences will have severity of INFO; new occurrences will have the severity of WARNING.',
    );
    zen_db_perform(TABLE_ADMIN_ACTIVITY_LOG, $sql_data_array);
    return false;
  }

  public function preserveSpecialCharacters($string)
>>>>>>> upstream/master
  {
    $find_chars = array('\n');
    $replace_chars = array("\n");
    $translated = str_replace($find_chars, $replace_chars, $string);
    return $translated;
  }

<<<<<<< HEAD
  /**
   * PCI requires that if the log table is reset, that the reset be logged
   * This does both.
   */
  public function updateNotifyAdminFireLogWriterReset()
  {
    $this->checkLogSchema();

    global $db;
    $db->Execute("truncate table " . TABLE_ADMIN_ACTIVITY_LOG);
    $admname = '{' . preg_replace('/[^\w]/', '*', zen_get_admin_name()) . '[' . (int)$_SESSION['admin_id'] . ']}';
    $log_data = array(
            'event_epoch_time'=> time(),
            'admin_id'        => (isset($_SESSION['admin_id'])) ? (int)$_SESSION['admin_id'] : 0,
            'page_accessed'   => 'Log reset by ' . $admname . '.',
            'page_parameters' => '',
            'specific_message'=> 'Log reset by ' . $admname . '.',
            'ip_address'      => substr($_SERVER['REMOTE_ADDR'],0,45),
            'postdata'        => '',
            'flagged'         => 0,
            'attention'       => '',
            'severity'        => 'warning',
    );
    $db->perform(TABLE_ADMIN_ACTIVITY_LOG, $this->dbPrepareLogData($log_data));
=======
  public function updateNotifyAdminFireLogWriterReset()
  {
    global $db;
    $db->Execute("truncate table " . TABLE_ADMIN_ACTIVITY_LOG);
    $admname = '{' . preg_replace('/[^\w]/', '*', zen_get_admin_name()) . '[' . (int)$_SESSION['admin_id'] . ']}';
    $admin_id = (isset($_SESSION['admin_id'])) ? $_SESSION['admin_id'] : 0;
    $sql_data_array = array( 'access_date' => 'now()',
            'admin_id' => (int)$admin_id,
            'page_accessed' =>  'Log reset by ' . $admname . '.',
            'page_parameters' => '',
            'ip_address' => $db->prepare_input(substr($_SERVER['REMOTE_ADDR'],0,45)),
            'gzpost' => '',
            'flagged' => 0,
            'attention' => '',
            'severity' => 'warning',
            'logmessage' =>  'Log reset by ' . $admname . '.',
    );
    zen_db_perform(TABLE_ADMIN_ACTIVITY_LOG, $sql_data_array);
>>>>>>> upstream/master
  }

}
