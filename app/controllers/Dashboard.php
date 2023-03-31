<?php
class Dashboard extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_edc_keyword']);
    unset($_SESSION['search_staff_keyword']);
    unset($_SESSION['search_student_keyword']);
    unset($_SESSION['last_search']);
    unset($_SESSION['row_per_page']);

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $staff_name = $_SESSION['user']['staff_name'];
      $secondAndThirdOfStaffName = explode(' ', $staff_name)[0] . ' ' . explode(' ', $staff_name)[1];
      $data['greeting_name'] = $secondAndThirdOfStaffName;
      $data['name'] = $staff_name;
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    $data['title'] = 'Propay - Dashboard';
    $data['breadcrumb'] = 'Dashboard';
    $data['total_student'] = count($this->model('Student_model')->getAllStudents());
    $data['total_class'] = count($this->model('Class_model')->getAllClasses());
    $data['total_staff'] = count($this->model('Staff_Model')->getAllStaff());
    $this->view('templates/header', $data, 'dashboard');
    $this->view('templates/sidebar', $data, 'dashboard');
    $this->view('templates/top-bar', $data, 'dashboard');
    $this->view('dashboard/index', $data, 'dashboard');
    $this->view('templates/footer', $data, 'dashboard');
  }
}
