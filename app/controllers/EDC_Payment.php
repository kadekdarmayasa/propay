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
          $_SESSION['last_search'] = $last_search_sin;
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
        $_SESSION['last_search'] = $last_search_sin;
        header('Location: ' . BASEURL . 'edc_payment');
        exit;
      } else {
        if ($last_search_sin != $sin) {
          unset($_SESSION['last_search']);
          $_SESSION['last_search'] = $last_search_sin;
          header('Location: ' . BASEURL . 'edc_payment');
          exit;
        }
      }
    }


    if ($page < 1) {
      header('Location: ' . BASEURL . 'edc_payment/page/1/' .  $sin);
      exit;
    }

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $data['name'] = $_SESSION['user']['staff_name'];
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    // Pagination
    if (isset($_POST['row_per_page'])) {
      $total_data_per_page = $_POST['row_per_page'];
      $_SESSION['row_per_page'] = $_POST['row_per_page'];
    } else {
      $total_data_per_page = isset($_SESSION['row_per_page']) ? $_SESSION['row_per_page'] : 6;
    }

    $total_data = count($this->model('Payment_Model')->getPaymentsBySIN($sin));
    $data['payment_amount'] = $total_data;
    $total_page = ceil($total_data / $total_data_per_page);

    if ($total_page <= 1 && $page != 1) {
      header('Location: ' . BASEURL . 'edc_payment/page/1/' . $sin);
    }

    if ($page > $total_page && $total_page > 1) {
      header('Location: ' .  BASEURL . 'edc_payment/page/1/' . $total_page);
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
    $data['student'] = $this->model('Student_Model')->getStudentBySIN($sin);
    $data['payment'] = $this->model('Payment_Model')->getPaymentWithLimit($start_data, $total_data_per_page);
    $data['page'] = $page;
    $this->view('templates/header', $data, 'edc/payment/index');
    $this->view('templates/sidebar', $data, 'edc/payment/index');
    $this->view('templates/top-bar', $data, 'edc/payment/index');
    $this->view('edc/payment/index', $data, 'edc/payment/index');
    $this->view('templates/footer', $data, 'edc/payment/index');
  }
}
