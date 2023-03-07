<?php

class EDC extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    $data['title'] = 'Propay - EDC';
    $this->view('templates/header', $data, 'edc');
    $this->view('templates/sidebar', $data, 'edc/list');
    $this->view('templates/top-bar', $data, 'edc');
    $this->view('edc/index', $data, 'edc');
    $this->view('templates/footer', $data, 'edc');
  }

  public function payment()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    $data['title'] = 'Propay - EDC Payment';
    $this->view('templates/header', $data, 'edc');
    $this->view('templates/sidebar', $data, 'edc/payment');
    $this->view('templates/top-bar', $data, 'edc');
    $this->view('edc/index', $data, 'edc');
    $this->view('templates/footer', $data, 'edc');
  }

  public function payment_history()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    $data['title'] = 'Propay - EDC Payment History';
    $this->view('templates/header', $data, 'edc');
    $this->view('templates/sidebar', $data, 'edc/payment_history');
    $this->view('templates/top-bar', $data, 'edc');
    $this->view('edc/index', $data, 'edc');
    $this->view('templates/footer', $data, 'edc');
  }
}
