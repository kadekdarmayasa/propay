<?php

class EDC_Payment extends Controller
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

    $data['title'] = 'Propay - EDC Payment';
    $data['breadcrumb'] = 'EDC/Payment';
    $data['page'] = 1;
    $this->view('templates/header', $data, 'edc/payment');
    $this->view('templates/sidebar', $data, 'edc/payment');
    $this->view('templates/top-bar', $data, 'edc/payment');
    $this->view('edc/payment', $data, 'edc/payment');
    $this->view('templates/footer', $data, 'edc/payment');
  }
}
