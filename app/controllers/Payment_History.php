<?php

class Payment_History extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    } else {
      unset($_SESSION['search_student_keyword']);
      unset($_SESSION['search_staff_keyword']);
      unset($_SESSION['search_class_keyword']);
      unset($_SESSION['search_edc_keyword']);
      unset($_SESSION['search_sin_keyword']);
      unset($_SESSION['search_payment_keyword']);
      unset($_SESSION['search_history_keyword']);
      unset($_SESSION['payment_data_per_student']);
      unset($_SESSION['payment_data_per_class']);

      header('Location: ' . BASEURL . 'payment_history/page/1');
      exit;
    }
  }

  public function page($page)
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    unset($_SESSION['search_student_keyword']);
    unset($_SESSION['search_staff_keyword']);
    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_edc_keyword']);
    unset($_SESSION['search_sin_keyword']);
    unset($_SESSION['search_payment_keyword']);
    unset($_SESSION['payment_data_per_student']);
    unset($_SESSION['payment_data_per_class']);

    if ($page < 1) {
      header('Location: ' . BASEURL . 'payment_history/page/1');
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

    if (isset($_POST['search-payment-history'])) {
      $payment_history_keyword = $_POST['payment_history_keyword'];

      $staff = $this->model('Staff_Model')->getStaffByAny($payment_history_keyword);

      if ($staff) {
        $total_data = [];

        for ($i = 0; $i < count($staff); $i++) {
          $payment_histories = $this->model('Payment_History_Model')->getAllPaymentHistories();

          for ($j = 0; $j < count($payment_histories); $j++) {
            if ($payment_histories[$j]['staff_id'] == $staff[$i]['staff_id']) {
              array_push($total_data, $payment_histories[$j]);
            }
          }
        }

        $total_data = count($total_data);
      } else {
        $total_data = count($this->model('Payment_History_Model')->getPaymentHistoryByAny($payment_history_keyword));
      }

      $data['history_count'] = $total_data;
      $_SESSION['search_history_keyword'] =  $payment_history_keyword;

      if ($total_data < 6) {
        header('location: ' . BASEURL . 'payment_history/page/1');
        exit;
      }
    }

    // Pagination
    if (isset($_SESSION['search_history_keyword']) && $_SESSION['search_history_keyword'] != '') {
      $staff = $this->model('Staff_Model')->getStaffByAny($_SESSION['search_history_keyword']);

      if ($staff) {
        $total_data = [];

        for ($i = 0; $i < count($staff); $i++) {
          $payment_histories = $this->model('Payment_History_Model')->getAllPaymentHistories();

          for ($j = 0; $j < count($payment_histories); $j++) {
            if ($payment_histories[$j]['staff_id'] == $staff[$i]['staff_id']) {
              array_push($total_data, $payment_histories[$j]);
            }
          }
        }

        $total_data = count($total_data);
      } else {
        $total_data = count($this->model('Payment_History_Model')->getPaymentHistoryByAny($_SESSION['search_history_keyword']));
      }

      $data['history_count'] = $total_data;
    } else {
      $total_data = count($this->model('Payment_History_Model')->getAllPaymentHistories());

      $data['history_count'] = $total_data;
    }

    if (isset($_POST['row_per_page'])) {
      $total_data_per_page = $_POST['row_per_page'];

      $_SESSION['row_per_page'] = $_POST['row_per_page'];
    } else {
      if (isset($_SESSION['row_per_page']) && $_SESSION['row_per_page'] == 12) {
        $total_data_per_page = 10;
      } else {
        if (isset($_SESSION['row_per_page']) && $_SESSION['row_per_page'] == 6) {
          $total_data_per_page = 5;
        } else {
          $total_data_per_page = $_SESSION['row_per_page'] ?? 5;
        }
      }
    }

    $total_page = ceil($total_data / $total_data_per_page);

    if ($total_page <= 1 && $page != 1) {
      header('Location: ' . BASEURL . 'payment_history/page/1');
    }

    if ($page > $total_page && $page > 1 && $total_page > 1) {
      header('Location: ' .  BASEURL . 'payment_history/page/' . $total_page);
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

      if ($staff) {
        $data['payment_history'] = [];

        for ($i = 0; $i < count($staff); $i++) {
          $payment_histories = $this->model('Payment_History_Model')->getPaymentHistoryWithLimit($start_data, $total_data_per_page, null, $staff[$i]['staff_id']);

          for ($j = 0; $j < count($payment_histories); $j++) {
            $data['payment_history'][] = $payment_histories[$j];
          }
        }
      } else {
        $data['payment_history'] = $this->model('Payment_History_Model')->getPaymentHistoryWithLimit($start_data, $total_data_per_page, $_SESSION['search_history_keyword']);
      }
    } else {
      $data['payment_history'] = $this->model('Payment_History_Model')->getPaymentHistoryWithLimit($start_data, $total_data_per_page);
    }


    for ($i = 0; $i < count($data['payment_history']); $i++) {
      $data['payment_history'][$i]['payment'] = $this->model('Payment_Model')->getPaymentById($data['payment_history'][$i]['payment_id']);

      $data['payment_history'][$i]['staff'] = $this->model('Staff_Model')->getStaffById($data['payment_history'][$i]['staff_id']);
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

    $this->view('templates/header', $data, 'edc/payment-history/index');
    $this->view('templates/sidebar', $data, 'edc/payment-history/index');
    $this->view('templates/top-bar', $data, 'edc/payment-history/index');
    $this->view('edc/payment-history/index', $data, 'edc/payment-history/index');
    $this->view('templates/footer', $data, 'edc/payment/index');
  }
}
