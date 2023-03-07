<?php

class Classes extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    $data['title'] = 'Propay - Class';
    $this->view('templates/header', $data, 'class');
    $this->view('templates/sidebar', $data, 'class');
    $this->view('templates/top-bar', $data, 'class');
    $this->view('class/index', $data, 'class');
    $this->view('templates/footer', $data, 'class');
  }
}
