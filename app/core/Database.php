<?php

class Database
{

  private $host = DB_HOST;
  private $username = DB_USERNAME;
  private $password = DB_PASSWORD;
  private $db_name = DB_NAME;
  private $dbh;
  private $stmt;

  public function __construct()
  {
    $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;

    $options = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    try {
      $this->dbh = new PDO($dsn, $this->username, $this->password, $options);
    } catch (PDOException $e) {
      $e->getMessage();
      die;
    }
  }

  public function query($query)
  {
    $this->stmt = $this->dbh->prepare($query);
  }

  public function lastInsertedId()
  {
    return $this->dbh->lastInsertId();
  }

  public function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
          break;
      }
    }

    $this->stmt->bindValue($param, $value, $type);
  }

  public function execute()
  {
    return $this->stmt->execute();
  }

  public function resultSet()
  {
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function single()
  {
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function rowCount()
  {
    return $this->stmt->rowCount();
  }
}
