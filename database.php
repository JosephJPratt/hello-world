<?php
  require_once("config.php");

class MySQLDatabase {
  // Connection attribute will be available to use in fucntions inside the class.
  private $connection;

  // Performs setup tasks.
  function __construct() {
    // Opens DB connection.
    $this->open_connection();
  }

  // Opens the connection with the database.
  public function open_connection() {
    $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if(mysqli_connect_errno()) {
      die("Database connection failed: " .
           mysqli_connect_error() .
           " (" . mysqli_connect_errno() . ")"
      );
    } // END if mysqli_connect_errno()
  } // end function open_connection

  // Closes the connection.
  # Checks if theres a connection.
  # If true closes the connection.
  # Unsets database values.
  public function close_connection() {
    if(isset($this->connection)) {
      mysqli_close($this->connection);
      unset($this->connection);
    } // end if(isset($this->connection))
  } // end function close_connection

  // Queries the database.
  # Checks for a result using the connection and a query.
  # If there's no result it fails.
  # If there's a result, returns it.
  public function query($sql) {
    $result = mysqli_query($this->connection, $sql);
    $this->confirm_query($result);
    return $result;
  } // end function query

  // Checks if query is working as expected.
  # Checks for a result.
  # It only runs inside the class.
  private function confirm_query($result) {
    if (!$result) {
      die("Database query failed.");
    }
  } // end function confirm_query

  // Escapes mysql string to avoid injections.
  public function escape_value($string) {
    $escaped_string = mysqli_real_escape_string($this->connection, $string);
    return $escaped_string;
  } // end function mysql_prep

  // Fetches results array.
  # Runs mysqli_fetch_array behind the scenes.
  # Returns array.
  # Keeps script database agnostic.
  public function fetch_array($result_set) {
    return mysqli_fetch_array($result_set, MYSQL_NUM);
  }

  public function num_rows($result_set) {
    return mysqli_num_rows($result_set);
  }

  public function insert_id() {
    return mysqli_insert_id($this->connection);
  }

  public function affected_rows() {
    return mysqli_affected_rows($this->connection);
  }

  public function fetch_assoc($result_set) {
    return mysqli_fetch_assoc($result_set);
  }

} // end class MySQLDatabase


//Instantiates a MySQLDatabase class.
$database = new MySQLDatabase();
?>
