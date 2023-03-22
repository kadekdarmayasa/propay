<?php
class Staff extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
    } else {
      header('Location: ' . BASEURL . 'staff/page/1');
    }

    exit;
  }

  public function add()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $staff_name = $_SESSION['user']['staff_name'];
      $data['name'] = $staff_name;
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    $data['page'] = $_SESSION['active_page'];
    $data['title'] = 'Propay - Staff';
    $data['breadcrumb'] = 'Staff/Add';
    $this->view('templates/header', $data, 'staff/add');
    $this->view('templates/sidebar', $data, 'staff/add');
    $this->view('templates/top-bar', $data, 'staff/add');
    $this->view('staff/add', $data, 'staff/add');
    $this->view('templates/footer', $data, 'staff/add');
  }

  public function check_staff()
  {
    $json = file_get_contents('php://input');

    $data = json_decode($json, true);
    $staff = $this->model("Staff_Model")->getStaffByUsername($data['username']);

    if ($staff) {
      $result = [
        'status' => 'error',
        'message' => 'Username is already used'
      ];

      file_put_contents('php://output', json_encode($result));
    } else {
      $result = [
        'status' => 'success',
        'message' => 'Username can be used'
      ];

      file_put_contents('php://output', json_encode($result));
    }
  }

  public function add_staff()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $result = $this->model("Staff_Model")->addStaff($data);

    if ($result['row_count'] > 0) {
      $response = [
        'status' => 'success',
        'message' => 'Staff has been successfully added',
        'id_staff' =>  $result['last_id'],
        'url' => BASEURL . 'staff/index'
      ];
      file_put_contents('php://output', json_encode($response));
    } else {
      $response = [
        'status' => 'error',
        'message' => 'Failed to add staff'
      ];
      file_put_contents('php://output', json_encode($response));
    }
  }

  public function delete_staff($staff_id)
  {
    file_get_contents('php://input');
    $staff_row_count = $this->model("Staff_Model")->deleteStaff($staff_id);

    if ($staff_row_count) {
      file_put_contents('php://output', json_encode([
        'status_message' => 'success',
        'status_code' => 200,
        'staff_id' => $staff_id
      ]));
    }
  }

  public function update($staff_id)
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $staff_name = $_SESSION['user']['staff_name'];
      $data['name'] = $staff_name;
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    $data['staff'] = $this->model('Staff_Model')->getStaffById($staff_id);
    $data['page'] = $_SESSION['active_page'];
    $data['title'] = 'Propay - Staff';
    $data['breadcrumb'] = 'Staff/Update';
    $data['religions'] = ['Hindu', 'Islam', 'Christian', 'Buddha', 'Kong Hu Cu'];
    $this->view('templates/header', $data, 'staff/update');
    $this->view('templates/sidebar', $data, 'staff/update');
    $this->view('templates/top-bar', $data, 'staff/update');
    $this->view('staff/update', $data, 'staff/update');
    $this->view('templates/footer', $data, 'staff/update');
  }

  public function update_staff()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $result = $this->model("Staff_Model")->updateStaff($data);

    if ($result['row_count'] > 0) {
      $response = [
        'status' => 'success',
        'message' => 'Staff has been successfully update',
        'id_staff' =>  $result['last_id'],
        'url' => BASEURL . 'staff/index'
      ];
      file_put_contents('php://output', json_encode($response));
    } else if ($result['row_count'] == 0) {
      $response = [
        'status' => 'nothing-update',
        'message' => 'No staff data update',
        'id_staff' =>  $result['last_id'],
        'url' => BASEURL . 'staff/index'
      ];
      file_put_contents('php://output', json_encode($response));
    } else {
      $response = [
        'status' => 'error',
        'message' => 'Failed to update staff',
        'url' => BASEURL . 'staff'
      ];
      file_put_contents('php://output', json_encode($response));
    }
  }

  public function detail($staff_id)
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $staff_name = $_SESSION['user']['staff_name'];
      $data['name'] = $staff_name;
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    $data['page'] = $_SESSION['active_page'];
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
    if ($page < 1) {
      header('Location: ' . BASEURL . 'staff/index');
      exit;
    }

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $staff_name = $_SESSION['user']['staff_name'];
      $data['name'] = $staff_name;
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    // Pagination
    if (isset($_SESSION['search_keyword']) && $_SESSION['search_keyword'] != '') {
      $total_data = count($this->model('Staff_Model')->getStaffByAny($_SESSION['search_keyword']));
      $data['staff_amount'] = $total_data;
    } else {
      $total_data = count($this->model('Staff_Model')->getAllStaff());
      $data['staff_amount'] = $total_data;
    }


    if (isset($_POST['search-staff'])) {
      $staff = $this->model('Staff_Model')->getStaffByAny($_POST['staff-field']);
      $total_data = count($staff);
      $data['staff_amount'] = $total_data;
      $_SESSION['search_keyword'] = $_POST['staff-field'];

      if ($total_data < 6) {
        header('location: ' . BASEURL . 'staff/index');
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

    if ($total_page < 2 && $page != 1) {
      header('Location: ' . BASEURL . 'staff/index');
    }

    if ($page > $total_page) {
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

    if (isset($_SESSION['search_keyword'])) {
      $data['staff'] = $this->model('Staff_Model')->getStaffWithLimit($start_data, $total_data_per_page, $_SESSION['search_keyword']);
      $data['staff_amount'] = count($data['staff']);
    } else {
      $data['staff'] = $this->model('Staff_Model')->getStaffWithLimit($start_data, $total_data_per_page);
      $data['staff_amount'] = count($data['staff']);
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

    $_SESSION['active_page'] = $data['pagination']['current_page'];
    $data['title'] = 'Propay - Staff';
    $data['breadcrumb'] = 'Staff';
    $data['keyword'] = $_SESSION['search_keyword'] ?? '';
    $this->view('templates/header', $data, 'staff/index');
    $this->view('templates/sidebar', $data, 'staff/index');
    $this->view('templates/top-bar', $data, 'staff' . $page . '/index');
    $this->view('staff/index', $data, 'staff/index');
    $this->view('templates/footer', $data, 'staff/index');
  }
}
