<?php
class Dashboard extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    $data['title'] = 'dashboard';
    $this->view('templates/header', $data);
    $this->view('dashboard/index', $data);
    $this->view('templates/footer', $data);
  }
}
