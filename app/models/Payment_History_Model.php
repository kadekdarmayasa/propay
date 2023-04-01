<?php
class Payment_History_Model
{
  private $table = "payment_history";
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function addPaymentHistory($payment_id, $staff_id, $payment_amount, $date_of_payment, $refund)
  {
    $query = "INSERT INTO " . $this->table . " (payment_id, staff_id, payment_amount, date_of_payment, refund_total) VALUES (:payment_id, :staff_id, :payment_amount, :date_of_payment, :refund)";

    $this->db->query($query);
    $this->db->bind(':payment_id', $payment_id, PDO::PARAM_INT);
    $this->db->bind(':staff_id', $staff_id, PDO::PARAM_INT);
    $this->db->bind(':payment_amount', $payment_amount, PDO::PARAM_INT);
    $this->db->bind(':date_of_payment', $date_of_payment, PDO::PARAM_STR);
    $this->db->bind(':refund', $refund, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getPaymentHistoryByPaymentID($payment_id)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE payment_id = :payment_id";

    $this->db->query($query);
    $this->db->bind(':payment_id', $payment_id, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->single();
  }

  function deletePaymentHistory($payment_id)
  {
    $query = "DELETE FROM " . $this->table . " WHERE payment_id = :payment_id";

    $this->db->query($query);
    $this->db->bind(':payment_id', $payment_id, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getPaymentHistoryWithLimit($start_data, $total_data_per_page,  $payment_id, $keyword)
  {
    if ($payment_id != null) {
      $query = "SELECT * FROM " . $this->table . " WHERE payment_id LIKE :payment_id";
      $this->db->query($query);
      $this->db->bind(':payment_id', $payment_id, PDO::PARAM_INT);
    } elseif ($keyword != null) {
      $query = "SELECT * FROM " . $this->table . " WHERE payment_id LIKE :keyword OR staff_id LIKE :keyword OR payment_amount LIKE :keyword OR date_of_payment LIKE :keyword OR refund_total LIKE :keyword";

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

  function getPaymentHistoryByAny($keyword)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE staff_id LIKE :keyword OR payment_amount LIKE :keyword OR date_of_payment LIKE :keyword OR refund_total LIKE :keyword";

    $this->db->query($query);
    $this->db->bind(':keyword', "%$keyword%", PDO::PARAM_STR);
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getAllPaymentHistories($isOrdered = false)
  {
    if ($isOrdered == false) {
      $query  = "SELECT * FROM " . $this->table;
    } else {
      $query =  "SELECT * FROM " . $this->table . " ORDER BY date_of_payment DESC";
    }

    $this->db->query($query);
    $this->db->execute();

    return $this->db->resultSet();
  }
}
