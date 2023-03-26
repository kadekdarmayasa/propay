<?php

class EDC_Report extends Controller
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
    $data['breadcrumb'] = 'EDC/Report';
    $data['page'] = 1;
    $this->view('templates/header', $data, 'edc/report');
    $this->view('templates/sidebar', $data, 'edc/report');
    $this->view('templates/top-bar', $data, 'edc/report');
    $this->view('edc/report', $data, 'edc/report');
    $this->view('templates/footer', $data, 'edc/report');
  }
}
