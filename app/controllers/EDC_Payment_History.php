<?php

class EDC_Payment_History extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $data['name'] = $_SESSION['user']['staff_name'];
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    $data['title'] = 'Propay - EDC Payment History';
    $data['breadcrumb'] = 'EDC/Payment History';
    $data['page'] = 1;
    $this->view('templates/header', $data, 'edc/payment_history');
    $this->view('templates/sidebar', $data, 'edc/payment_history');
    $this->view('templates/top-bar', $data, 'edc/payment_history');
    $this->view('edc/payment_history', $data, 'edc/payment_history');
    $this->view('templates/footer', $data, 'edc/payment_history');
  }
}
