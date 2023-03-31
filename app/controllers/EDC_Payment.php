<?php

class EDC_Payment extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $data['name'] = $_SESSION['user']['staff_name'];
      $data['role'] = $_SESSION['user']['staff_level'];
    }


    if (isset($_POST['search']) || isset($_SESSION['last_search'])) {
      $last_search_sin =  $_POST['sin'] ?? $_SESSION['last_search'];
      $data['keyword'] = $last_search_sin;

      if ($last_search_sin == '') {
        unset($data['isStudentFound']);
      } else {
        if ($student = $this->model('Student_Model')->getStudentBySIN($last_search_sin)) {
          unset($_SESSION['last_search']);
          $_SESSION['last_search'] = trim($last_search_sin);
          header('Location: ' . BASEURL . 'edc_payment/page/' . 1 . '/' . $student['sin']);
          exit;
        } else {
          $data['isStudentFound'] = false;
        }
      }
    }

    $data['title'] = 'Propay - EDC Payment';
    $data['breadcrumb'] = 'EDC Payment';
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
    }


    $data['isStudentFound'] = true;

    if (isset($_POST['search']) || isset($_SESSION['last_search'])) {
      $last_search_sin = $_POST['sin'] ?? $_SESSION['last_search'];
      $data['keyword'] = $last_search_sin;

      if ($last_search_sin == '') {
        unset($_SESSION['last_search']);
        $_SESSION['last_search'] = trim($last_search_sin);
        header('Location: ' . BASEURL . 'edc_payment');
        exit;
      } else {
        if ($last_search_sin != $sin) {
          unset($_SESSION['last_search']);
          $_SESSION['last_search'] = trim($last_search_sin);
          header('Location: ' . BASEURL . 'edc_payment');
          exit;
        }
      }
    }

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $data['name'] = $_SESSION['user']['staff_name'];
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    if (isset($_SESSION['search-payment-keyword']) && $_SESSION['search-payment-keyword'] != '') {
      $total_data = count($this->model('Payment_Model')->getPaymentByAny($sin, $_SESSION['search-payment-keyword']));
      $data['payment_count'] = $total_data;
    } else {
      $total_data = count($this->model('Payment_Model')->getPaymentsBySIN($sin));
      $data['payment_count'] = $total_data;
    }

    if (isset($_POST['search-payment'])) {
      $payment = $this->model('Payment_Model')->getPaymentByAny($sin, $_POST['payment-field']);
      $total_data = count($payment);
      $data['payment_count'] = $total_data;
      $_SESSION['search-payment-keyword'] = $_POST['payment-field'];

      if ($total_data < 6) {
        header('Location: ' . BASEURL . 'edc_payment/page/1/' .  $sin);
        exit;
      }
    }

    // Pagination
    if (isset($_POST['row_per_page'])) {
      $total_data_per_page = $_POST['row_per_page'];
      $_SESSION['row_per_page'] = $_POST['row_per_page'];
    } else {
      $total_data_per_page = isset($_SESSION['row_per_page']) ? $_SESSION['row_per_page'] : 6;
    }


    $total_page = ceil($total_data / $total_data_per_page);

    if ($total_page <= 1 && $page != 1) {
      header('Location: ' . BASEURL . 'edc_payment/page/1/' . $sin);
    }

    if ($page > $total_page && $total_page > 1) {
      header('Location: ' . BASEURL . 'edc_payment/page/' . $total_page . '/' . $sin);
      exit;
    }

    if ($page < 1) {
      header('Location: ' . BASEURL . 'edc_payment/page/1/' .  $sin);
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
    $start_date_time = strtotime($edc['start_date']);
    $enrollment_date_time = strtotime($student['enrollment_date']);

    $data['student'] = $student;
    $data['student']['class'] = $this->model("Class_Model")->getClassById($student['class_id']);
    $data['student']['edc'] = $edc;

    for ($i = 0; $i < count($data['payment']); $i++) {
      $data['payment'][$i]['due_date'] = format_date($data['payment'][$i]['due_date']);
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
    file_get_contents('php://input');
    $data = json_decode(file_get_contents('php://input'), true);
    $payment_amount = $data['payment_amount'];
    $payment_id = $data['payment_id'];
    $staff_id = $data['staff_id'];
    $date_of_payment = $data['date_of_payment'];

    $refund = 0;
    $row_count_payment = 0;
    $payment = $this->model('Payment_Model')->getPaymentById($data['payment_id']);
    $payment_amount_db = $payment['payment_amount'];
    $edc = $this->model('EDC_Model')->getEDCById($payment['edc_id']);
    $nominal = $edc['nominal'];

    if ($payment_amount_db == null) {
      if ($payment_amount >  $nominal) {
        $refund = $payment_amount - $nominal;
        $row_count_payment = $this->model('Payment_Model')->updatePayment($payment_id, $nominal, 'Paid');
      } else {
        if ($payment_amount == $nominal) {
          $row_count_payment = $this->model('Payment_Model')->updatePayment($payment_id, $payment_amount, 'Paid');
        } else {
          $row_count_payment = $this->model('Payment_Model')->updatePayment($payment_id, $payment_amount, 'Paid Half');
        }
      }
    } else {
      if (($payment_amount_db + $payment_amount) > $nominal) {
        $refund = ($payment_amount_db + $payment_amount) - $nominal;
        $row_count_payment = $this->model('Payment_Model')->updatePayment($payment_id, $nominal, 'Paid');
      } else {
        if (($payment_amount_db + $payment_amount) == $nominal) {
          $row_count_payment = $this->model('Payment_Model')->updatePayment($payment_id, $nominal, 'Paid');
        } else {
          $row_count_payment = $this->model('Payment_Model')->updatePayment($payment_id, $payment_amount + $payment_amount_db, 'Paid Half');
        }
      }
    }

    if ($row_count_payment) {
      $row_count_payment_history = $this->model('Payment_History_Model')->addPaymentHistory($payment_id, $staff_id, $payment_amount, $date_of_payment, $refund);

      $refund = 'Rp. ' . number_format($refund, 0, ',', '.');

      if ($row_count_payment_history) {
        $response = [
          'status' => 'success',
          'message' => 'Payment success',
          'refund' => $refund,
          'description' => 'Your payment has been successfully processed'
        ];

        file_put_contents('php://output', json_encode($response));
      }
    }
  }
}

function format_date($date)
{
  $date = date('d F Y', strtotime($date));
  $date = explode(' ', $date);
  $month = substr($date[1], 0, 3);
  $year = $date[2];
  $day = $date[0];

  return $day . ' ' . $month . ' ' . $year;
}
