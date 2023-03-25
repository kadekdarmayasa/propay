<?php
class EDC_Model
{
  private $table = "edc";
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllEDC()
  {
    $query = "SELECT * FROM " . $this->table;

    $this->db->query($query);
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getEDCByTerm($term)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE term = :term";

    $this->db->query($query);
    $this->db->bind(":term", $term);
    $this->db->execute();

    return $this->db->single();
  }
}
