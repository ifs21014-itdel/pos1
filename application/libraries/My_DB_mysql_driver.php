<?php
class MY_DB_mysql_driver extends CI_DB_mysql_driver {

  function __construct($params){
    parent::__construct($params);
    log_message('debug', 'Extended DB driver class instantiated!');
  }

  function get_first($table){
     return $this->limit(1)->get($table);
  }

}
?>