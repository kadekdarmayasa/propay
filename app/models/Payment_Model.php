<?php
class Payment_Model
{
  private $table = "payment";
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function addPayment($edc_id, $sin, $year, $month, $due_date)
  {
    $query = "INSERT INTO " . $this->table . " (month, year, due_date, sin, edc_id) VALUES (:month, :year, :due_date, :sin, :edc_id)";

    $this->db->query($query);
    $this->db->bind(':month', $month);
    $this->db->bind(':year', $year);
    $this->db->bind(':due_date', $due_date);
    $this->db->bind(':sin', $sin);
    $this->db->bind(':edc_id', $edc_id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deletePayment($sin)
  {
    $query = "DELETE FROM " . $this->table . " WHERE sin = :sin";

    $this->db->query($query);
    $this->db->bind(':sin', $sin);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getPaymentsBySIN($sin)
  {
    $query = "SELECT * FROM " . $this->table  .  " WHERE sin = :sin";

    $this->db->query($query);
    $this->db->bind(':sin', $sin);
    $this->db->execute();

    return $this->db->resultSet();
  }
}
