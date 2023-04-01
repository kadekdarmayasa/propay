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


    if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'staff') {
      if (isset($_SESSION['profile_change'])) {
        $staff = $this->model('Staff_Model')->getStaffById($_SESSION['user']['staff_id']);
        $staff_name = $staff['staff_name'];
      } else {
        $staff_name = $_SESSION['user']['staff_name'];
      }

      $secondAndThirdOfStaffName = explode(' ', $staff_name)[0] . ' ' . explode(' ', $staff_name)[1];
      $data['greeting_name'] = $secondAndThirdOfStaffName;
      $data['name'] = $staff_name;
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    if ($_SESSION['user']['role'] == 'student') {
      if (isset($_SESSION['profile_change'])) {
        $student = $this->model('Student_Model')->getStudentBySIN($_SESSION['user']['sin']);
        $student_name = $student['student_name'];
      } else {
        $student_name = $_SESSION['user']['student_name'];
      }

      $secondAndThirdOfStaffName = explode(' ', $student_name)[0] . ' ' . explode(' ', $student_name)[1];
      $data['greeting_name'] = $secondAndThirdOfStaffName;
      $data['name'] = $student_name;
      $data['role'] = 'student';
    }


    $payment_history = $this->model('Payment_History_Model')->getAllPaymentHistories(true);

    for ($i = 0; $i < count($payment_history); $i++) {
      $payment_history[$i]['payment'] = $this->model('Payment_Model')->getPaymentById($payment_history[$i]['payment_id']);
      $payment_history[$i]['staff'] = $this->model('Staff_Model')->getStaffById($payment_history[$i]['staff_id']);
    }

    for ($i = 0; $i < count($payment_history); $i++) {
      $payment_history[$i]['student'] = $this->model('Student_Model')->getStudentBySIN($payment_history[$i]['payment']['sin']);
    }

    $student_payment_history = [];

    if ($_SESSION['user']['role'] == 'student') {
      for ($i = 0; $i < count($payment_history); $i++) {
        if ($payment_history[$i]['payment']['sin'] == $_SESSION['user']['sin']) {
          array_push($student_payment_history, $payment_history[$i]);
        }
      }
    }

    if (count($student_payment_history) > 0) {
      $data['payment_history'] = $student_payment_history;
    } elseif ($_SESSION['user']['role'] != 'student') {
      $data['payment_history'] = $payment_history;
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
