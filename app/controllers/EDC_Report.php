<?php

class EDC_Report extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    } else {
      if ($_SESSION['user']['role'] == 'student' || $_SESSION['user']['role'] == 'staff') {
        header('Location: ' . BASEURL);
        exit;
      }
    }

    if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'staff') {
      if (isset($_SESSION['profile_change'])) {
        $staff = $this->model('Staff_Model')->getStaffById($_SESSION['user']['staff_id']);
        $staff_name = $staff['staff_name'];
      } else {
        $staff_name = $_SESSION['user']['staff_name'];
      }

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

      $data['name'] = $student_name;
      $data['role'] = 'student';
    }

    $data['title'] = 'Propay - EDC Payment Report';
    $data['breadcrumb'] = 'Payment Report';
    $data['page'] = 1;
    $this->view('templates/header', $data, 'edc/report/index');
    $this->view('templates/sidebar', $data, 'edc/report/index');
    $this->view('templates/top-bar', $data, 'edc/report/index');
    $this->view('edc/report/index', $data, 'edc/report/index');
    $this->view('templates/footer', $data, 'edc/report/index');
  }



  public function student()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    } else {
      if ($_SESSION['user']['role'] == 'student' || $_SESSION['user']['role'] == 'staff') {
        header('Location: ' . BASEURL);
        exit;
      }
    }

    if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'staff') {
      if (isset($_SESSION['profile_change'])) {
        $staff = $this->model('Staff_Model')->getStaffById($_SESSION['user']['staff_id']);
        $staff_name = $staff['staff_name'];
      } else {
        $staff_name = $_SESSION['user']['staff_name'];
      }

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

      $data['name'] = $student_name;
      $data['role'] = 'student';
    }

    if (isset($_POST['generate'])) {
      $sin = $_POST['sin'];
      $start_date = $_POST['start-date'];
      $end_date = $_POST['end-date'];
      $student = $this->model('Student_Model')->getStudentBySIN($sin);

      $payment = $this->model('Payment_Model')->getPaymentByDate($sin, $start_date, $end_date);
      $edc = $this->model('EDC_Model')->getEDCById($payment[0]['edc_id']);

      for ($j = 0; $j < count($payment); $j++) {
        if ($payment[$j]['payment_amount'] == $edc['nominal']) {
          $payment[$j]['payment_amount'] = 0;
        } else if ($payment[$j]['payment_amount'] == NULL) {
          $payment[$j]['payment_amount'] = $edc['nominal'];
        } else if ($payment[$j]['payment_amount'] < $edc['nominal'] && $payment[$j]['payment_amount'] != NULL) {
          $payment[$j]['payment_amount'] = $edc['nominal'] - $payment[$j]['payment_amount'];
        }
      }
      $_SESSION['payment_data_per_student'] = $payment;
      $_SESSION['payment_data']['student'] = $student;
      header('Location: ' . BASEURL . 'edc_report/generate');
    }

    $data['title'] = 'Propay - Payment Report';
    $data['breadcrumb'] = 'Payment Report';
    $data['page'] = 1;
    $this->view('templates/header', $data, 'edc/report/student');
    $this->view('templates/sidebar', $data, 'edc/report/student');
    $this->view('templates/top-bar', $data, 'edc/report/student');
    $this->view('edc/report/student', $data, 'edc/report/student');
    $this->view('templates/footer', $data, 'edc/report/student');
  }

  public function generate()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    } else {
      if ($_SESSION['user']['role'] == 'student' || $_SESSION['user']['role'] == 'staff') {
        header('Location: ' . BASEURL);
        exit;
      }
    }

    $data['payment'] = $_SESSION['payment_data_per_class'] ?? $_SESSION['payment_data_per_student'];
    $data['title'] = 'Propay - Payment Report';
    $data['breadcrumb'] = 'Payment Report';
    $data['page'] = 1;
    $this->view('templates/header', $data, 'edc/report/generate');
    $this->view('edc/report/generate', $data, 'edc/report/generate');
    $this->view('templates/footer', $data, 'edc/report/student');
  }
}
