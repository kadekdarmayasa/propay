<?php
class Dashboard extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    $data['title'] = 'Propay - Dashboard';
    $data['breadcrumb'] = 'Dashboard';

    $this->view('templates/header', $data, 'dashboard');
    $this->view('templates/sidebar', $data, 'dashboard');
    $this->view('templates/top-bar', $data, 'dashboard');
    $this->view('dashboard/index', $data, 'dashboard');
    $this->view('templates/footer', $data, 'dashboard');
  }
}
