<?php
class Staff extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $staff_name = $_SESSION['user']['staff_name'];
      $secondAndThirdOfStaffName = explode(' ', $staff_name)[0] . ' ' . explode(' ', $staff_name)[1];
      $data['greeting_name'] = $secondAndThirdOfStaffName;
      $data['name'] = $staff_name;
      $data['role'] = $_SESSION['user']['staff_level'];
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
