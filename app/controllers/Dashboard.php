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
    unset($_SESSION['search_sin_keyword']);
    unset($_SESSION['search_payment_keyword']);
    unset($_SESSION['search_history_keyword']);
    unset($_SESSION['payment_data_per_student']);
    unset($_SESSION['payment_data_per_class']);

    if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'staff') {
      if (isset($_SESSION['profile_change'])) {
        $staff = $this->model('Staff_Model')->getStaffById($_SESSION['user']['staff_id']);

        $full_name = $staff['staff_name'];
      } else {
        $full_name = $_SESSION['user']['staff_name'];
      }

      $first_name = explode(' ', $full_name)[0];
      $second_name = explode(' ', $full_name)[1];
      $staff_name = "$first_name $second_name";

      $data['greeting_name'] = $staff_name;
      $data['name'] = $full_name;
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    if ($_SESSION['user']['role'] == 'student') {
      if (isset($_SESSION['profile_change'])) {
        $student = $this->model('Student_Model')->getStudentBySIN($_SESSION['user']['sin']);

        $full_name = $student['student_name'];
      } else {
        $full_name = $_SESSION['user']['student_name'];
      }

      $first_name = explode(' ', $full_name)[0];
      $second_name = explode(' ', $full_name)[1];
      $student_name = "$first_name $second_name";

      $data['greeting_name'] = $student_name;
      $data['name'] = $full_name;
      $data['role'] = 'student';
    }


    if ($_SESSION['user']['role'] == 'student') {
      $payment_histories = $this->model('Payment_History_Model')->getPaymentHistoryBySIN($_SESSION['user']['sin']);
    } else {
      $payment_histories = $this->model('Payment_History_Model')->getPaymentHistoryWithLimit(0, 4,  null, true);
    }

    for ($i = 0; $i < count($payment_histories); $i++) {
      $payment_histories[$i]['staff'] = $this->model('Staff_Model')->getStaffById($payment_histories[$i]['staff_id']);
    }

    $data['title'] = 'Propay - Dashboard';
    $data['breadcrumb'] = 'Dashboard';
    $data['payment_histories'] = $payment_histories;
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
