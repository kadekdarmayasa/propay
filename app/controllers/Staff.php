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
    $this->view('templates/header', $data, 'staff');
    $this->view('templates/sidebar', $data, 'staff');
    $this->view('templates/top-bar', $data, 'staff');
    $this->view('staff/index', $data, 'staff');
    $this->view('templates/footer', $data, 'staff');
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
    $this->view('templates/header', $data, 'staff');
    $this->view('templates/sidebar', $data, 'staff');
    $this->view('templates/top-bar', $data, 'staff');
    $this->view('staff/add', $data, 'staff');
    $this->view('templates/footer', $data, 'staff');
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
        'message' => 'Staff has been added successfully',
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
}
