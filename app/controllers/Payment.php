<?php

class Payment extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    } else {
      if ($_SESSION['user']['role'] == 'student') {
        header('Location: ' . BASEURL);
        exit;
      }
    }

    unset($_SESSION['search_student_keyword']);
    unset($_SESSION['search_staff_keyword']);
    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_edc_keyword']);
    unset($_SESSION['search_sin_keyword']);
    unset($_SESSION['search_payment_keyword']);
    unset($_SESSION['search_history_keyword']);
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

    if (isset($_POST['search']) || isset($_SESSION['search_sin_keyword'])) {
      $last_search_sin =  $_POST['sin'] ?? $_SESSION['search_sin_keyword'];
      $data['keyword'] = $last_search_sin;

      if ($last_search_sin == '') {
        unset($data['isStudentFound']);
      } else {
        if ($student = $this->model('Student_Model')->getStudentBySIN($last_search_sin)) {
          unset($_SESSION['search_sin_keyword']);
          $_SESSION['search_sin_keyword'] = trim($last_search_sin);

          header('Location: ' . BASEURL . 'payment/page/' . 1 . '/' . $student['sin']);
          exit;
        } else {
          $data['isStudentFound'] = false;
        }
      }
    }

    $data['title'] = 'Propay - Payment';
    $data['breadcrumb'] = 'Payment';
    $data['page'] = 1;

    $this->view('templates/header', $data, 'edc/payment/index');
    $this->view('templates/sidebar', $data, 'edc/payment/index');
    $this->view('templates/top-bar', $data, 'edc/payment/index');
    $this->view('edc/payment/index', $data, 'edc/payment/index');
    $this->view('templates/footer', $data, 'edc/payment/index');
  }

  public function page($page = 0, $sin = 0)
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    } else {
      if ($_SESSION['user']['role'] == 'student') {
        header('Location: ' . BASEURL);
        exit;
      }
    }

    unset($_SESSION['search_student_keyword']);
    unset($_SESSION['search_staff_keyword']);
    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_edc_keyword']);
    unset($_SESSION['search_history_keyword']);
    unset($_SESSION['payment_data_per_student']);
    unset($_SESSION['payment_data_per_class']);

    $data['isStudentFound'] = true;

    if (isset($_POST['search']) || isset($_SESSION['search_sin_keyword'])) {
      $last_search_sin = $_POST['sin'] ?? $_SESSION['search_sin_keyword'];
      $data['keyword'] = $last_search_sin;

      if ($last_search_sin == '') {
        unset($_SESSION['search_sin_keyword']);
        $_SESSION['search_sin_keyword'] = trim($last_search_sin);

        header('Location: ' . BASEURL . 'payment');
        exit;
      } else {
        if ($last_search_sin != $sin) {
          unset($_SESSION['search_sin_keyword']);
          $_SESSION['search_sin_keyword'] = trim($last_search_sin);

          header('Location: ' . BASEURL . 'payment');
          exit;
        }
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

    if (isset($_SESSION['search-payment-keyword']) && $_SESSION['search-payment-keyword'] != '') {
      $payment = $this->model('Payment_Model')->getPaymentByAny($sin, $_SESSION['search-payment-keyword']);
      $total_data = count($payment);

      $data['payment_count'] = $total_data;
    } else {
      $payment = $this->model('Payment_Model')->getPaymentsBySIN($sin);
      $total_data = count($payment);

      $data['payment_count'] = $total_data;
    }

    if (isset($_POST['search-payment'])) {
      $payment = $this->model('Payment_Model')->getPaymentByAny($sin, $_POST['payment-field']);
      $total_data = count($payment);

      $data['payment_count'] = $total_data;
      $_SESSION['search-payment-keyword'] = $_POST['payment-field'];

      if ($total_data < 6) {
        header('Location: ' . BASEURL . 'payment/page/1/' .  $sin);
        exit;
      }
    }

    // Pagination
    if (isset($_POST['row_per_page'])) {
      $total_data_per_page = $_POST['row_per_page'];

      $_SESSION['row_per_page'] = $_POST['row_per_page'];
    } else {
      if (isset($_SESSION['row_per_page']) && $_SESSION['row_per_page'] == 10) {
        $total_data_per_page = 12;
      } else {
        $total_data_per_page = 6;
      }
    }

    $total_page = ceil($total_data / $total_data_per_page);

    if ($total_page <= 1 && $page != 1) {
      header('Location: ' . BASEURL . 'payment/page/1/' . $sin);
      exit;
    }

    if ($page > $total_page && $page > 1) {
      header('Location: ' . BASEURL . 'payment/page/' . $total_page . '/' . $sin);
      exit;
    }

    if ($page < 1) {
      header('Location: ' . BASEURL . 'payment/page/1/' .  $sin);
      exit;
    }

    $current_page = $page;
    $start_data = ($total_data_per_page * $current_page) - $total_data_per_page;
    $end_data = $start_data + $total_data_per_page;
    $total_link = 2;

    if ($current_page > $total_link) {
      $start_number = $current_page - $total_link;
    } else {
      $start_number = 1;
    }

    if ($current_page < ($total_page - $total_link)) {
      $end_number = $current_page + $total_link;
    } else {
      $end_number = $total_page;
    }

    if ($end_number != $total_page) {
      $start_number = $current_page - $total_link + 1;
      if ($start_number < 1) {
        $start_number = 1;
      }
    }

    if (isset($_SESSION['search-payment-keyword'])) {
      $data['payment'] = $this->model('Payment_Model')->getPaymentWithLimit($start_data, $total_data_per_page, $sin, $_SESSION['search-payment-keyword']);
    } else {
      $data['payment'] = $this->model('Payment_Model')->getPaymentWithLimit($start_data, $total_data_per_page, $sin, null);
    }

    $student = $this->model('Student_Model')->getStudentBySIN($sin);
    $edc = $this->model("EDC_Model")->getEDCByTerm($student['term']);

    $data['student'] = $student;
    $data['student']['class'] = $this->model("Class_Model")->getClassById($student['class_id']);
    $data['student']['edc'] = $edc;

    for ($i = 0; $i < count($data['payment']); $i++) {
      $data['payment'][$i]['due_date'] = $this->util('Date_Util')->format_date($data['payment'][$i]['due_date']);
    }

    $data['pagination'] = [
      'total_page' => $total_page,
      'current_page' => $current_page,
      'start_number' => $start_number,
      'end_number' => $end_number,
      'total_link' => $total_link,
      'start_data' => $start_data,
      'end_data' => $end_data,
    ];

    $data['title'] = 'Propay - EDC Payment';
    $data['breadcrumb'] = 'EDC Payment';
    $data['page'] = $page;

    $this->view('templates/header', $data, 'edc/payment/index');
    $this->view('templates/sidebar', $data, 'edc/payment/index');
    $this->view('templates/top-bar', $data, 'edc/payment/index');
    $this->view('edc/payment/index', $data, 'edc/payment/index');
    $this->view('templates/footer', $data, 'edc/payment/index');
  }

  public function payment_action()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $payment_amount = $data['payment_amount'];
    $payment_id = $data['payment_id'];
    $staff_id = $data['staff_id'];
    $sin = $data['sin'];
    $date_of_payment = $data['date_of_payment'];

    $refund = 0;
    $row_count_payment = 0;

    $payment = $this->model('Payment_Model')->getPaymentById($data['payment_id']);
    $edc = $this->model('EDC_Model')->getEDCById($payment['edc_id']);

    $payment_amount_db = $payment['payment_amount'];
    $nominal = $edc['nominal'];

    if ($payment_amount_db == null) {
      if ($payment_amount >  $nominal) {
        $row_count_payment = $this->model('Payment_Model')->updatePayment($payment_id, $nominal, 'Paid');

        $refund = $payment_amount - $nominal;
      }

      if ($payment_amount == $nominal) {
        $row_count_payment = $this->model('Payment_Model')->updatePayment($payment_id, $payment_amount, 'Paid');
      }

      if ($payment_amount < $nominal) {
        $row_count_payment = $this->model('Payment_Model')->updatePayment($payment_id, $payment_amount, 'Paid Half');
      }
    } else {
      $total_payment = $payment_amount_db + $payment_amount;

      if ($total_payment > $nominal) {
        $row_count_payment = $this->model('Payment_Model')->updatePayment($payment_id, $nominal, 'Paid');

        $refund = $total_payment - $nominal;
      }

      if ($total_payment == $nominal) {
        $row_count_payment = $this->model('Payment_Model')->updatePayment($payment_id, $nominal, 'Paid');
      }

      if ($total_payment < $nominal) {
        $row_count_payment = $this->model('Payment_Model')->updatePayment($payment_id, $payment_amount + $payment_amount_db, 'Paid Half');
      }
    }

    if ($row_count_payment) {
      $row_count_payment_history = $this->model('Payment_History_Model')->addPaymentHistory($payment_id, $staff_id, $payment_amount, $date_of_payment, $refund, $sin);

      $refund = 'Rp. ' . number_format($refund, 0, ',', '.');

      if ($row_count_payment_history) {
        $response = [
          'status' => 'success',
          'message' => 'Payment success',
          'refund' => $refund,
          'description' => 'Your payment has been successfully processed'
        ];
      } else {
        $response = [
          'status' => 'error',
        ];
      }

      file_put_contents('php://output', json_encode($response));
    }
  }

  public function check_years()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $payment_years = $this->model('Payment_Model')->getYears($data);

    if ($payment_years) {
      $response = [
        'status' => 'success',
        'years' => $payment_years
      ];
    } else {
      $response = [
        'status' => 'error',
      ];
    }

    file_put_contents('php://output', json_encode($response));
  }
}
