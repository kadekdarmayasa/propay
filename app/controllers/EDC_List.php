<?php

class EDC_List extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $data['name'] = $_SESSION['user']['staff_name'];
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    $data['title'] = 'Propay - EDC';
    $data['breadcrumb'] = 'EDC/List';
    $data['page'] = 1;
    $this->view('templates/header', $data, 'edc/list');
    $this->view('templates/sidebar', $data, 'edc/list');
    $this->view('templates/top-bar', $data, 'edc/list');
    $this->view('edc/list', $data, 'edc/list');
    $this->view('templates/footer', $data, 'edc/list');
  }
}
