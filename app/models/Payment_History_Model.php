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
}
