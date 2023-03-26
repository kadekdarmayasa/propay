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

  public function getEDCByAny($keyword)
  {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE term LIKE :keyword OR nominal LIKE :keyword';

    $this->db->query($query);
    $this->db->bind(':keyword', "%$keyword%");
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getEDCWithLimit($start_data, $total_data_per_page, $keyword = null)
  {
    if ($keyword != null) {
      $query = "SELECT * FROM " . $this->table . " WHERE term LIKE :keyword OR nominal LIKE :keyword LIMIT :start_data, :total_data_per_page";

      $this->db->query($query);
      $this->db->bind(':keyword', "%$keyword%", PDO::PARAM_STR);
      $this->db->bind(':start_data', $start_data, PDO::PARAM_INT);
      $this->db->bind(':total_data_per_page', $total_data_per_page, PDO::PARAM_INT);
    } else {
      $query = "SELECT * FROM " . $this->table . " LIMIT :start_data, :total_data_per_page";

      $this->db->query($query);
      $this->db->bind(':start_data', $start_data, PDO::PARAM_INT);
      $this->db->bind(':total_data_per_page', $total_data_per_page, PDO::PARAM_INT);
    }

    $this->db->execute();
    return $this->db->resultSet();
  }

  public function deleteEDC($edc_id)
  {
    $query = "DELETE FROM " . $this->table . " WHERE edc_id = :edc_id";

    $this->db->query($query);
    $this->db->bind(":edc_id", $edc_id);
    $this->db->execute();

    return [
      'row_count' => $this->db->rowCount(),
      'edc_id' => $edc_id
    ];
  }

  public function addEDC($data, $start_date)
  {
    $term = htmlspecialchars($data['term']);
    $nominal =  htmlspecialchars($data['nominal']);

    $query = "INSERT INTO " . $this->table . " VALUES (null, :term, :nominal, :start_date)";

    $this->db->query($query);
    $this->db->bind(':term', $term);
    $this->db->bind(':nominal', $nominal);
    $this->db->bind(':start_date', $start_date);
    $this->db->execute();

    return $this->db->rowCount();
  }
}
