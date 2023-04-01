<?php

class EDC_Payment_History extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
    } else {
      unset($_SESSION['search_class_keyword']);
      unset($_SESSION['search_edc_keyword']);
      unset($_SESSION['search_staff_keyword']);
      unset($_SESSION['search_student_keyword']);
      unset($_SESSION['last_search']);
      unset($_SESSION['row_per_page']);
      header('Location: ' . BASEURL . 'edc_payment_history/page/1');
    }

    exit;
  }

  public function page($page)
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if ($page < 1) {
      header('Location: ' . BASEURL . 'edc_payment_history_index');
      exit;
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

    // Pagination
    if (isset($_SESSION['search_history_keyword']) && $_SESSION['search_history_keyword'] != '') {
      $staff = $this->model('Staff_Model')->getStaffByAny($_SESSION['search_history_keyword']);
      $student = $this->model('Student_Model')->getStudentByAny($_SESSION['search_history_keyword']);

      if ($staff) {
        $total_data = [];
        for ($i = 0; $i < count($staff); $i++) {
          $total_data[] = $this->model('Payment_History_Model')->getPaymentHistoryByAny($staff[$i]['staff_id']);
        }
        $total_data = count($total_data);
      } else if ($student) {
        $payment = [];

        for ($i = 0; $i < count($student); $i++) {
          $total_payment = $this->model('Payment_Model')->getPaymentsBySIN($student[$i]['sin']);
          for ($j = 0; $j < count($total_payment); $j++) {
            $payment[] = $total_payment[$j];
          }
        }

        $total_data = [];
        for ($i = 0; $i < count($payment); $i++) {
          if ($payment[$i]['payment_status'] == 'Paid Half' || $payment[$i]['payment_status'] == 'Paid') {
            $total_data[] = $this->model('Payment_History_Model')->getPaymentHistoryByPaymentID($payment[$i]['payment_id']);
          }
        }
        $total_data = count($total_data);
      } else {
        $total_data = count($this->model('Payment_History_Model')->getPaymentHistoryByAny($_SESSION['search_history_keyword']));
      }
      $data['history_amount'] = $total_data;
    } else {
      $total_data = count($this->model('Payment_History_Model')->getAllPaymentHistories());
      $data['history_amount'] = $total_data;
    }


    if (isset($_POST['search-payment-history'])) {
      $staff = $this->model('Staff_Model')->getStaffByAny($_SESSION['search_history_keyword']);
      $student = $this->model('Student_Model')->getStudentByAny($_SESSION['search_history_keyword']);

      if ($staff) {
        $total_data = [];
        for ($i = 0; $i < count($staff); $i++) {
          $total_data[] = $this->model('Payment_History_Model')->getPaymentHistoryByAny($staff[$i]['staff_id']);
        }
        $total_data = count($total_data);
      } else if ($student) {
        $payment = [];

        for ($i = 0; $i < count($student); $i++) {
          $total_payment = $this->model('Payment_Model')->getPaymentsBySIN($student[$i]['sin']);
          for ($j = 0; $j < count($total_payment); $j++) {
            $payment[] = $total_payment[$j];
          }
        }

        $total_data = [];
        for ($i = 0; $i < count($payment); $i++) {
          if ($payment[$i]['payment_status'] == 'Paid Half' || $payment[$i]['payment_status'] == 'Paid') {
            $total_data[] = $this->model('Payment_History_Model')->getPaymentHistoryByPaymentID($payment[$i]['payment_id']);
          }
        }
        $total_data = count($total_data);
      } else {
        $total_data = count($this->model('Payment_History_Model')->getPaymentHistoryByAny($_SESSION['search_history_keyword']));
      }

      $data['history_amount'] = $total_data;
      $_SESSION['search_history_keyword'] = $_POST['payment_history_keyword'];

      if ($total_data < 6) {
        header('location: ' . BASEURL . 'edc_payment_history');
        exit;
      }
    }

    if (isset($_POST['row_per_page'])) {
      $total_data_per_page = $_POST['row_per_page'];
      $_SESSION['row_per_page'] = $_POST['row_per_page'];
    } else {
      $total_data_per_page = isset($_SESSION['row_per_page']) ? $_SESSION['row_per_page'] : 5;
    }

    $total_page = ceil($total_data / $total_data_per_page);

    if ($total_page <= 1 && $page != 1) {
      header('Location: ' . BASEURL . 'edc_payment_history');
    }

    if ($page > $total_page && $total_page > 1) {
      header('Location: ' .  BASEURL . 'edc_payment_history/page/' . $total_page);
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

    // How Many Data Will Display on Each Page
    if (isset($_SESSION['search_history_keyword']) && $_SESSION['search_history_keyword'] != '') {
      $staff = $this->model('Staff_Model')->getStaffByAny($_SESSION['search_history_keyword']);
      $student = $this->model('Student_Model')->getStudentByAny($_SESSION['search_history_keyword']);

      if ($staff) {
        $data['payment_history'] = [];
        for ($i = 0; $i < count($staff); $i++) {
          $payment_histories = $this->model('Payment_History_Model')->getPaymentHistoryWithLimit($start_data, $total_data_per_page, $staff[$i]['staff_id']);

          for ($j = 0; $j < count($payment_histories); $j++) {
            $data['payment_history'][] = $payment_histories[$j];
          }
        }
      } elseif ($student) {
        $payment = [];
        $data['payment_history'] = [];

        for ($i = 0; $i < count($student); $i++) {
          $total_payment = $this->model('Payment_Model')->getPaymentsBySIN($student[$i]['sin']);
          for ($j = 0; $j < count($total_payment); $j++) {
            $payment[] = $total_payment[$j];
          }
        }

        for ($i = 0; $i < count($payment); $i++) {
          if ($payment[$i]['payment_status'] == 'Paid Half' || $payment[$i]['payment_status'] == 'Paid') {
            $payment_histories = $this->model('Payment_History_Model')->getPaymentHistoryWithLimit($start_data, $total_data_per_page, $payment[$i]['payment_id'], null);

            for ($j = 0; $j < count($payment_histories); $j++) {
              $data['payment_history'][] = $payment_histories[$j];
            }
          }
        }
      } else {
        $data['payment_history'] = $this->model('Payment_History_Model')->getPaymentHistoryWithLimit($start_data, $total_data_per_page, null, $_SESSION['search_history_keyword']);
      }
    } else {
      $data['payment_history'] = $this->model('Payment_History_Model')->getPaymentHistoryWithLimit($start_data, $total_data_per_page, null, null);
    }


    for ($i = 0; $i < count($data['payment_history']); $i++) {
      /* Getting the payment and staff data from the database. */
      $data['payment_history'][$i]['payment'] = $this->model('Payment_Model')->getPaymentById($data['payment_history'][$i]['payment_id']);
      $data['payment_history'][$i]['staff'] = $this->model('Staff_Model')->getStaffById($data['payment_history'][$i]['staff_id']);
    }

    for ($i = 0; $i < count($data['payment_history']); $i++) {
      $data['payment_history'][$i]['student'] = $this->model('Student_Model')->getStudentBySIN($data['payment_history'][$i]['payment']['sin']);
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


    $data['title'] = 'Propay - Payment History';
    $data['breadcrumb'] = 'Payment History';
    $data['keyword'] = $_SESSION['search_history_keyword'] ?? '';
    // for ($i = 0; $i < count($data['student']); $i++) {
    //   $data['student'][$i]['class'] = $this->model('Class_Model')->getClassById($data['student'][$i]['class_id']);
    // }
    $this->view('templates/header', $data, 'edc/payment-history/index');
    $this->view('templates/sidebar', $data, 'edc/payment-history/index');
    $this->view('templates/top-bar', $data, 'edc/payment-history/index');
    $this->view('edc/payment-history/index', $data, 'edc/payment-history/index');
    $this->view('templates/footer', $data, 'edc/payment/index');
  }
}
