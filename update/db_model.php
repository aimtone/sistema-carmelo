<?php 
  include 'constants.php';
  class db_model {
    public $conn;
    function __construct() {
      $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }
    function get($sql) {
      $result = $this->conn->query($sql);
      while ($rows[] = $result->fetch_assoc());
      $result->close();
      array_pop($rows);
      return $rows;
    }
    function set($sql) {
      $result = $this->conn->query($sql);
      return $result;
    }
    function __destruct() {
      //$this->conn->close();
    }
  }
?>