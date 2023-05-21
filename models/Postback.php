<?php
  class Postback {
    // DB Stuff
    private $conn;
    private $table = 'postback';

    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get values
    public function read() {
      // Create query
      $query = 'SELECT
        id,
        postback_params,
        created_at
      FROM
        ' . $this->table . '
      ORDER BY
        id DESC;';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

  // Create A RECORD
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      postback_params = :postback_params;
                    
    UPDATE ' . $this->table .' 
      SET postback_params = 
      REPLACE(postback_params, "&amp;", "&") 
      ORDER BY 
        id DESC LIMIT 1;';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->postback_params = htmlspecialchars(strip_tags($this->postback_params));

  // Bind data
  $stmt-> bindParam(':postback_params', $this->postback_params);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error:  ", $stmt->error);

  return false;
  }
  }
