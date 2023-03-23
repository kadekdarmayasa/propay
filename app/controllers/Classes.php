<?php

class Classes extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $staff_name = $_SESSION['user']['staff_name'];
      $secondAndThirdOfStaffName = explode(' ', $staff_name)[0] . ' ' . explode(' ', $staff_name)[1];
      $data['greeting_name'] = $secondAndThirdOfStaffName;
      $data['name'] = $staff_name;
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    $data['class'] = $this->model("Class_Model")->getAllClasses();

    for ($i = 0; $i < count($data['class']); $i++) {
      $students = $this->model('Student_Model')->getStudentsByClassId($data['class'][$i]['class_id']);
      $data['class'][$i]['total_students'] = count($students);
    }

    $data['title'] = 'Propay - Class';
    $data['breadcrumb'] = 'Classes';
    $this->view('templates/header', $data, 'class/index');
    $this->view('templates/sidebar', $data, 'class/index');
    $this->view('templates/top-bar', $data, 'class/index');
    $this->view('class/index', $data, 'class/index');
    $this->view('templates/footer', $data, 'class/index');
  }

  public function add()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $staff_name = $_SESSION['user']['staff_name'];
      $secondAndThirdOfStaffName = explode(' ', $staff_name)[0] . ' ' . explode(' ', $staff_name)[1];
      $data['greeting_name'] = $secondAndThirdOfStaffName;
      $data['name'] = $staff_name;
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    $data['title'] = 'Propay - Class';
    $data['breadcrumb'] = 'Classes/Add';
    $data['page'] = 1;
    $data['majors'] = ["Software Engineering", "Computer Network Engineering", "Animation", "Visual Communication Design", "Multimedia"];
    $this->view('templates/header', $data, 'class/add');
    $this->view('templates/sidebar', $data, 'class/add');
    $this->view('templates/top-bar', $data, 'class/add');
    $this->view('class/add', $data, 'class/add');
    $this->view('templates/footer', $data, 'class/add');
  }

  public function add_class()
  {
    $json  = file_get_contents('php://input');
    $data = json_decode($json, true);
    $class_row_count = $this->model("Class_Model")->addClass($data);

    if ($class_row_count) {
      $response = [
        'status' => 'success',
        'message' => 'Class has been successfully added',
        'class_name' => $data['class_name'],
        'url' => BASEURL . 'classes'
      ];

      file_put_contents('php://output', json_encode($response));
    }
  }

  public function delete($class_id)
  {
    file_get_contents('php://input');
    $class  = $this->model("Class_Model")->getClassById($class_id);
    $class_row_count = $this->model("Class_Model")->deleteClass($class_id);

    if ($class_row_count) {
      file_put_contents('php://output', json_encode([
        'status_message' => 'success',
        'status_code' => 200,
        'class_name' => $class['class_name']
      ]));
    }
  }

  public function update($class_id)
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $staff_name = $_SESSION['user']['staff_name'];
      $secondAndThirdOfStaffName = explode(' ', $staff_name)[0] . ' ' . explode(' ', $staff_name)[1];
      $data['greeting_name'] = $secondAndThirdOfStaffName;
      $data['name'] = $staff_name;
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    $data['class'] = $this->model("Class_Model")->getClassById($class_id);
    $data['majors'] = ["Software Engineering", "Computer Network Engineering", "Animation", "Visual Communication Design", "Multimedia"];
    $data['title'] = 'Propay - Class';
    $data['breadcrumb'] = 'Class/Update';
    $data['page'] = 1;
    $this->view('templates/header', $data, 'class/update');
    $this->view('templates/sidebar', $data, 'class/update');
    $this->view('templates/top-bar', $data, 'class/update');
    $this->view('class/update', $data, 'class/update');
    $this->view('templates/footer', $data, 'class/update');
  }

  public function update_class()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $result = $this->model("Class_Model")->updateClass($data);

    if ($result['row_count'] > 0) {
      $response = [
        'status' => 'success',
        'message' => 'Class has been successfully update',
        'class_id' =>  $result['class_id'],
        'url' => BASEURL . 'classes/index'
      ];
      file_put_contents('php://output', json_encode($response));
    } else if ($result['row_count'] == 0) {
      $response = [
        'status' => 'nothing-update',
        'message' => 'No class data update',
        'class_id' =>  $result['class_id'],
        'url' => BASEURL . 'classes/index'
      ];
      file_put_contents('php://output', json_encode($response));
    } else {
      $response = [
        'status' => 'error',
        'message' => 'Failed to update class',
        'url' => BASEURL . 'classes/index'
      ];
      file_put_contents('php://output', json_encode($response));
    }
  }

  public function check_class()
  {
    $json = file_get_contents('php://input');

    $data = json_decode($json, true);
    $class = $this->model("Class_Model")->getClassByName($data['class-name']);

    if ($class) {
      $result = [
        'status' => 'error',
        'message' => 'Class is already existed'
      ];

      file_put_contents('php://output', json_encode($result));
    } else {
      $result = [
        'status' => 'success',
        'message' => 'Class is available'
      ];

      file_put_contents('php://output', json_encode($result));
    }
  }
}
