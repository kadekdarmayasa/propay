<?php
class Staff extends Controller
{
  public function index()
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

    $data['title'] = 'Propay - Staff';
    $data['breadcrumb'] = 'Staff';
    $data['staff'] = $this->model('Staff_Model')->getAllStaff();
    $this->view('templates/header', $data, 'staff/index');
    $this->view('templates/sidebar', $data, 'staff/index');
    $this->view('templates/top-bar', $data, 'staff/index');
    $this->view('staff/index', $data, 'staff/index');
    $this->view('templates/footer', $data, 'staff/index');
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
    } else {
      $response = [
        'status' => 'error',
        'message' => 'Failed to update staff'
      ];
      file_put_contents('php://output', json_encode($response));
    }
  }
}
