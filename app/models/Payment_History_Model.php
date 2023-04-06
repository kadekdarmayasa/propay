<?php
class Payment_History_Model
{
  private $table = "payment_history";
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function addPaymentHistory($payment_id, $staff_id, $payment_amount, $date_of_payment, $refund, $sin)
  {
    $query = "INSERT INTO " . $this->table . " (payment_id, staff_id, payment_amount, date_of_payment, refund_total, sin) VALUES (:payment_id, :staff_id, :payment_amount, :date_of_payment, :refund, :sin)";

    $this->db->query($query);
    $this->db->bind(':payment_id', $payment_id, PDO::PARAM_INT);
    $this->db->bind(':staff_id', $staff_id, PDO::PARAM_INT);
    $this->db->bind(':payment_amount', $payment_amount, PDO::PARAM_INT);
    $this->db->bind(':date_of_payment', $date_of_payment, PDO::PARAM_STR);
    $this->db->bind(':refund', $refund, PDO::PARAM_INT);
    $this->db->bind(':sin', $sin, PDO::PARAM_INT);
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

  public function getPaymentHistoryWithLimit($start_data, $total_data_per_page, $keyword = null, $staff_id = null)
  {
    if ($keyword != null) {
      $query = "SELECT * FROM " . $this->table . " WHERE sin = :keyword OR payment_id LIKE :keyword OR payment_amount LIKE :keyword OR date_of_payment LIKE :keyword OR refund_total LIKE :keyword ORDER BY date_of_payment DESC LIMIT :start_data, :total_data_per_page";

      $this->db->query($query);
      $this->db->bind(':keyword', "%$keyword%");
    } else {
      if ($staff_id !== null) {
        $query = "SELECT * FROM " . $this->table . " WHERE staff_id = :staff_id ORDER BY date_of_payment DESC LIMIT :start_data, :total_data_per_page";

        $this->db->query($query);
        $this->db->bind(":staff_id", $staff_id);
      } else {
        $query = "SELECT * FROM " . $this->table . " ORDER BY date_of_payment DESC LIMIT :start_data, :total_data_per_page";

        $this->db->query($query);
      }
    }

    $this->db->bind(':start_data', $start_data, PDO::PARAM_INT);
    $this->db->bind(':total_data_per_page', $total_data_per_page, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->resultSet();
  }

  function getPaymentHistoryByAny($keyword)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE sin LIKE :keyword OR payment_amount LIKE :keyword OR date_of_payment LIKE :keyword OR refund_total LIKE :keyword";

    $this->db->query($query);
    $this->db->bind(':keyword', "%$keyword%");
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

  public function getPaymentHistoryBySIN($sin)
  {
    $query = "SELECT * FROM " .  $this->table . " WHERE sin = :sin ORDER BY date_of_payment DESC LIMIT 0, 4";

    $this->db->query($query);
    $this->db->bind(':sin', $sin, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->resultSet();
  }
}
