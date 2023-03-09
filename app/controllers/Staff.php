<?php
class Staff extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    $data['title'] = 'Propay - Staff';
    $data['breadcrumb'] = 'Staff';
    $data['staff'] = $this->model('Staff_Model')->getAllStaff();
    $this->view('templates/header', $data, 'staff');
    $this->view('templates/sidebar', $data, 'staff');
    $this->view('templates/top-bar', $data, 'staff');
    $this->view('staff/index', $data, 'staff');
    $this->view('templates/footer', $data, 'staff');
  }
}
