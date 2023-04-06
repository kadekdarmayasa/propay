<?php

class Payment_Report extends Controller
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

    unset($_SESSION['search_student_keyword']);
    unset($_SESSION['search_staff_keyword']);
    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_edc_keyword']);
    unset($_SESSION['search_history_keyword']);
    unset($_SESSION['search_sin_keyword']);
    unset($_SESSION['search_payment_keyword']);
    unset($_SESSION['payment_data_per_student']);
    unset($_SESSION['payment_data_per_class']);

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

    $data['title'] = 'Propay - Payment Report';
    $data['breadcrumb'] = 'Payment Report';
    $data['page'] = 1;

    $this->view('templates/header', $data, 'edc/report/index');
    $this->view('templates/sidebar', $data, 'edc/report/index');
    $this->view('templates/top-bar', $data, 'edc/report/index');
    $this->view('edc/report/index', $data, 'edc/report/index');
    $this->view('templates/footer', $data, 'edc/report/index');
  }

  public function class()
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

    unset($_SESSION['search_student_keyword']);
    unset($_SESSION['search_staff_keyword']);
    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_edc_keyword']);
    unset($_SESSION['search_history_keyword']);
    unset($_SESSION['search_sin_keyword']);
    unset($_SESSION['search_payment_keyword']);

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

    if (isset($_POST['generate'])) {
      $month = $_POST['month'];
      $year = $_POST['year'];
      $class_id = $_POST['class_id'];

      $students = $this->model('Student_Model')->getStudentsByClassId($class_id);
      $edc = $this->model('EDC_Model')->getEDCByTerm($students[0]['term']);

      for ($i = 0; $i < count($students); $i++) {
        $students[$i]['payment'] = $this->model('Payment_Model')->getPaymentByMonth($month, $year, $students[$i]['sin']);

        if ($students[$i]['payment']['payment_amount'] == $edc['nominal']) {
          $students[$i]['payment']['payment_amount'] = 0;
        } else if ($students[$i]['payment']['payment_amount'] == NULL) {
          $students[$i]['payment']['payment_amount'] = $edc['nominal'];
        } else if ($students[$i]['payment']['payment_amount'] < $edc['nominal'] && $students[$i]['payment']['payment_amount'] != NULL) {
          $students[$i]['payment']['payment_amount'] = $edc['nominal'] - $students[$i]['payment']['payment_amount'];
        }
      }

      $_SESSION['payment_data_per_class'] = $students;
      $_SESSION['payment_date'] = $month . ' ' . $year;
      $_SESSION['class'] = $this->model('Class_Model')->getClassById($class_id);

      unset($_SESSION['payment_data_per_student']);
      header('Location: ' . BASEURL . 'payment_report/generate');
      exit;
    }

    $data['title'] = 'Propay - Payment Report';
    $data['breadcrumb'] = 'Payment Report/Class';
    $data['page'] = 1;
    $data['months'] = [
      'January', 'February', 'March', 'April', 'May',
      'June', 'July', 'August', 'September', 'October',
      'November', 'December',
    ];

    $this->view('templates/header', $data, 'edc/report/class');
    $this->view('templates/sidebar', $data, 'edc/report/class');
    $this->view('templates/top-bar', $data, 'edc/report/class');
    $this->view('edc/report/class', $data, 'edc/report/class');
    $this->view('templates/footer', $data, 'edc/report/class');
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

    unset($_SESSION['search_student_keyword']);
    unset($_SESSION['search_staff_keyword']);
    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_edc_keyword']);
    unset($_SESSION['search_history_keyword']);
    unset($_SESSION['search_sin_keyword']);
    unset($_SESSION['search_payment_keyword']);

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

    if (isset($_POST['generate'])) {
      $sin = $_POST['sin'];
      $start_date = $_POST['start-date'];
      $end_date = $_POST['end-date'];

      $student = $this->model('Student_Model')->getStudentBySIN($sin);
      $payments = $this->model('Payment_Model')->getPaymentByDate($sin, $start_date, $end_date);
      $edc = $this->model('EDC_Model')->getEDCById($payments[0]['edc_id']);

      for ($i = 0; $i < count($payments); $i++) {
        if ($payments[$i]['payment_amount'] == $edc['nominal']) {
          $payments[$i]['payment_amount'] = 0;
        } else if ($payments[$i]['payment_amount'] == NULL) {
          $payments[$i]['payment_amount'] = $edc['nominal'];
        } else if ($payments[$i]['payment_amount'] < $edc['nominal'] && $payments[$i]['payment_amount'] != NULL) {
          $payments[$i]['payment_amount'] = $edc['nominal'] - $payments[$i]['payment_amount'];
        }
      }

      $_SESSION['payment_data_per_student'] = $payments;
      $_SESSION['student'] = $student;
      $_SESSION['class'] = $this->model('Class_Model')->getClassById($student['class_id']);

      unset($_SESSION['payment_data_per_class']);
      header('Location: ' . BASEURL . 'payment_report/generate');
      exit;
    }

    $data['title'] = 'Propay - Payment Report';
    $data['breadcrumb'] = 'Payment Report/Student';
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

    if (isset($_SESSION['payment_data_per_class']) || isset($_SESSION['payment_data_per_student'])) {
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

      $data['title'] = 'Propay - Payment Report';
      $data['breadcrumb'] = 'Payment Report/Generate';
      $data['page'] = 1;
      $this->view('templates/header', $data, 'edc/report/generate');
      $this->view('edc/report/generate', $data, 'edc/report/generate');
      $this->view('templates/footer', $data, 'edc/report/student');
    } else {
      header('Location: ' . BASEURL . 'payment_report/index');
      exit;
    }
  }
}
