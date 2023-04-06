<?php

class Staff extends Controller implements Actions
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
      unset($_SESSION['search_history_keyword']);
      unset($_SESSION['search_payment_keyword']);
      unset($_SESSION['payment_data_per_student']);
      unset($_SESSION['payment_data_per_class']);

      if ($_SESSION['user']['role'] == 'student' || $_SESSION['user']['role'] == 'staff') {
        header('Location: ' . BASEURL);
        exit;
      } else {
        header('Location: ' . BASEURL . 'staff/page/1');
        exit;
      }
    }
  }

  public function add()
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

    $data['page'] = 1;
    $data['title'] = 'Propay - Staff';
    $data['breadcrumb'] = 'Staff/Add';

    $this->view('templates/header', $data, 'staff/add');
    $this->view('templates/sidebar', $data, 'staff/add');
    $this->view('templates/top-bar', $data, 'staff/add');
    $this->view('staff/add', $data, 'staff/add');
    $this->view('templates/footer', $data, 'staff/add');
  }

  public function update($staff_id)
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

    $data['page'] = 1;
    $data['title'] = 'Propay - Staff';
    $data['breadcrumb'] = 'Staff/Update';
    $data['religions'] = ['Hindu', 'Islam', 'Christian', 'Buddha', 'Kong Hu Cu'];
    $data['staff'] = $this->model('Staff_Model')->getStaffById($staff_id);

    $this->view('templates/header', $data, 'staff/update');
    $this->view('templates/sidebar', $data, 'staff/update');
    $this->view('templates/top-bar', $data, 'staff/update');
    $this->view('staff/update', $data, 'staff/update');
    $this->view('templates/footer', $data, 'staff/update');
  }


  public function detail($staff_id)
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

    $data['page'] = 1;
    $data['title'] = 'Propay - Staff';
    $data['breadcrumb'] = 'Staff/Detail';
    $data['staff'] =  $this->model("Staff_Model")->getStaffById($staff_id);

    $this->view('templates/header', $data, 'staff/detail');
    $this->view('templates/sidebar', $data, 'staff/detail');
    $this->view('templates/top-bar', $data, 'staff/detail');
    $this->view('staff/detail', $data, 'staff/detail');
    $this->view('templates/footer', $data, 'staff/detail');
  }

  public function page($page)
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
    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_edc_keyword']);
    unset($_SESSION['search_history_keyword']);
    unset($_SESSION['search_payment_keyword']);
    unset($_SESSION['payment_data_per_student']);
    unset($_SESSION['payment_data_per_class']);

    if ($page < 1) {
      header('Location: ' . BASEURL . 'staff/page/1');
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

    // Pagination
    if (isset($_SESSION['search_staff_keyword']) && $_SESSION['search_staff_keyword'] != '') {
      $total_data = count($this->model('Staff_Model')->getStaffByAny($_SESSION['search_staff_keyword']));

      $data['staff_count'] = $total_data;
    } else {
      $total_data = count($this->model('Staff_Model')->getAllStaff());

      $data['staff_count'] = $total_data;
    }


    if (isset($_POST['search-staff'])) {
      $search_staff_keyword = $_POST['search-staff-keyword'];

      $total_data = count($this->model('Staff_Model')->getStaffByAny($search_staff_keyword));

      $data['staff_count'] = $total_data;
      $_SESSION['search_staff_keyword'] = $search_staff_keyword;

      if ($total_data < 6) {
        header('location: ' . BASEURL . 'staff/page/1');
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
      header('Location: ' . BASEURL . 'staff/page/1');
    }

    if ($page > $total_page && $page > 1 && $total_page > 1) {
      header('Location: ' .  BASEURL . 'staff/page/' . $total_page);
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
    if (isset($_SESSION['search_staff_keyword'])) {
      $data['staff'] = $this->model('Staff_Model')->getStaffWithLimit($start_data, $total_data_per_page, $_SESSION['search_staff_keyword']);
    } else {
      $data['staff'] = $this->model('Staff_Model')->getStaffWithLimit($start_data, $total_data_per_page);
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

    $data['title'] = 'Propay - Staff';
    $data['breadcrumb'] = 'Staff';
    $data['keyword'] = $_SESSION['search_staff_keyword'] ?? '';

    $this->view('templates/header', $data, 'staff/index');
    $this->view('templates/sidebar', $data, 'staff/index');
    $this->view('templates/top-bar', $data, 'staff' . $page . '/index');
    $this->view('staff/index', $data, 'staff/index');
    $this->view('templates/footer', $data, 'staff/index');
  }

  public function check_action()
  {
    $json = file_get_contents('php://input');

    $data = json_decode($json, true);

    $staff = $this->model("Staff_Model")->getStaffByUsername($data['username']);

    if ($staff) {
      $response = [
        'status' => 'error',
        'message' => 'Username is already used'
      ];
    } else {
      $response = [
        'status' => 'success',
        'message' => 'Username can be used'
      ];
    }

    file_put_contents('php://output', json_encode($response));
  }

  public function insert_action()
  {
    $json = file_get_contents('php://input');

    $data = json_decode($json, true);

    $staff = $this->model("Staff_Model")->addStaff($data);

    if ($staff['row_count'] > 0) {
      $response = [
        'status' => 'success',
        'id_staff' =>  $staff['last_id'],
        'url' => BASEURL . 'staff/index'
      ];
    } else {
      $response = [
        'status' => 'error',
      ];
    }

    file_put_contents('php://output', json_encode($response));
  }

  public function delete_action($staff_id)
  {
    file_get_contents('php://input');

    $staff_row_count = $this->model("Staff_Model")->deleteStaff($staff_id);

    if ($staff_row_count) {
      $response = [
        'status' => 'success',
        'staff_id' => $staff_id
      ];
    } else {
      $response = [
        'status' => 'error',
      ];
    }

    file_put_contents('php://output', json_encode($response));
  }

  public function update_action()
  {
    $json = file_get_contents('php://input');

    $data = json_decode($json, true);

    $result = $this->model("Staff_Model")->updateStaff($data);

    if ($result['row_count'] > 0) {
      $response = [
        'status' => 'success',
        'id_staff' =>  $result['last_id'],
        'url' => BASEURL . 'staff/index'
      ];
    } else if ($result['row_count'] == 0) {
      $response = [
        'status' => 'nothing-update',
        'id_staff' =>  $result['last_id'],
        'url' => BASEURL . 'staff/index'
      ];
    } else {
      $response = [
        'status' => 'error',
        'message' => 'Failed to update staff',
        'url' => BASEURL . 'staff'
      ];
    }

    file_put_contents('php://output', json_encode($response));
  }
}
