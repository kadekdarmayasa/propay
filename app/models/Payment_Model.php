<?php
class Payment_Model
{
  private $table = "payment";
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function addPayment($edc_id, $sin, $year, $month, $due_date, $payment_id)
  {
    $query = "INSERT INTO " . $this->table . " (payment_id, month, year, due_date, payment_status, sin, edc_id) VALUES (:payment_id, :month, :year, :due_date, 'Unpaid', :sin, :edc_id)";

    $this->db->query($query);
    $this->db->bind(':payment_id', $payment_id, PDO::PARAM_INT);
    $this->db->bind(':month', $month, PDO::PARAM_STR);
    $this->db->bind(':year', $year, PDO::PARAM_INT);
    $this->db->bind(':due_date', $due_date, PDO::PARAM_STR);
    $this->db->bind(':sin', $sin, PDO::PARAM_INT);
    $this->db->bind(':edc_id', $edc_id, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getPaymentWithLimit($start_data, $total_data_per_page, $sin, $keyword = null)
  {
    if ($keyword != null) {
      $query = "SELECT * FROM " . $this->table . " WHERE sin = :sin AND (year LIKE :keyword OR month LIKE :keyword OR payment_status LIKE :keyword) LIMIT :start_data, :total_data_per_page";

      $this->db->query($query);
      $this->db->bind(':keyword', $keyword . '%');
      $this->db->bind(':sin', $sin, PDO::PARAM_INT);
      $this->db->bind(':start_data', $start_data, PDO::PARAM_INT);
      $this->db->bind(':total_data_per_page', $total_data_per_page, PDO::PARAM_INT);
    } else {
      $query = "SELECT * FROM " . $this->table . " WHERE sin = :sin LIMIT :start_data, :total_data_per_page";

      $this->db->query($query);
      $this->db->bind(':sin', $sin, PDO::PARAM_INT);
      $this->db->bind(':start_data', $start_data, PDO::PARAM_INT);
      $this->db->bind(':total_data_per_page', $total_data_per_page, PDO::PARAM_INT);
    }

    $this->db->execute();
    return $this->db->resultSet();
  }

  public function deletePayment($sin)
  {
    $query = "DELETE FROM " . $this->table . " WHERE sin = :sin";

    $this->db->query($query);
    $this->db->bind(':sin', $sin, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getPaymentsBySIN($sin)
  {
    $query = "SELECT * FROM " . $this->table  .  " WHERE sin = :sin";

    $this->db->query($query);
    $this->db->bind(':sin', $sin, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getPaymentByMonth($month, $year, $sin)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE month = :month AND year = :year AND sin = :sin";

    $this->db->query($query);
    $this->db->bind(':month', $month, PDO::PARAM_STR);
    $this->db->bind(':year', $year, PDO::PARAM_STR);
    $this->db->bind(':sin', $sin, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->single();
  }

  public function getAllPayments()
  {
    $query = "SELECT * FROM " . $this->table;

    $this->db->query($query);
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getPaymentByAny($sin, $keyword = null)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE sin = :sin AND (month LIKE :keyword OR year LIKE :keyword OR payment_status LIKE :keyword)";

    $this->db->query($query);
    $this->db->bind(':keyword', $keyword . '%');
    $this->db->bind(':sin', $sin, PDO::PARAM_INT);

    $this->db->execute();
    return $this->db->resultSet();
  }

  public function getPaymentById($payment_id)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE payment_id = :payment_id";

    $this->db->query($query);
    $this->db->bind(':payment_id', $payment_id, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->single();
  }

  public function updatePayment($payment_id, $payment_amount, $payment_status)
  {
    $query = "UPDATE " . $this->table . " SET payment_amount = :payment_amount, payment_status = :payment_status WHERE payment_id = :payment_id";

    $this->db->query($query);
    $this->db->bind(':payment_id', $payment_id, PDO::PARAM_INT);
    $this->db->bind(':payment_amount', $payment_amount, PDO::PARAM_INT);
    $this->db->bind(':payment_status', $payment_status, PDO::PARAM_STR);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function getPaymentByDate($sin, $start_date, $end_date)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE sin = :sin AND due_date BETWEEN :start_date AND :end_date";

    $this->db->query($query);
    $this->db->bind(':sin', $sin, PDO::PARAM_INT);
    $this->db->bind(':start_date', $start_date, PDO::PARAM_STR);
    $this->db->bind(':end_date', $end_date, PDO::PARAM_STR);
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getYears($data)
  {
    $month = htmlspecialchars($data['month']);
    $sin = htmlspecialchars($data['sin']);

    $query = "SELECT year FROM " . $this->table . " WHERE sin = :sin AND month = :month";

    $this->db->query($query);
    $this->db->bind(':sin', $sin, PDO::PARAM_INT);
    $this->db->bind(':month', $month, PDO::PARAM_STR);
    $this->db->execute();

    return $this->db->resultSet();
  }
}
