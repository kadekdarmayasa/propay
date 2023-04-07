<?php

class Classes extends Controller implements Actions
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    } else {
      unset($_SESSION['search_class_keyword']);
      unset($_SESSION['search_student_keyword']);
      unset($_SESSION['search_staff_keyword']);
      unset($_SESSION['search_edc_keyword']);
      unset($_SESSION['search_sin_keyword']);
      unset($_SESSION['search_payment_keyword']);
      unset($_SESSION['search_history_keyword']);
      unset($_SESSION['payment_data_per_student']);
      unset($_SESSION['payment_data_per_class']);

      if ($_SESSION['user']['role'] == 'student' || $_SESSION['user']['role'] == 'staff') {
        header('Location: ' . BASEURL);
      }
      header('Location: ' . BASEURL . 'classes/page/1');
      exit;
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

    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_student_keyword']);
    unset($_SESSION['search_staff_keyword']);
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

  public function update($class_id)
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

    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_student_keyword']);
    unset($_SESSION['search_staff_keyword']);
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

    $data['title'] = 'Propay - Class';
    $data['breadcrumb'] = 'Classes/Update';
    $data['page'] = 1;
    $data['majors'] = ["Software Engineering", "Computer Network Engineering", "Animation", "Visual Communication Design", "Multimedia"];
    $data['class'] = $this->model("Class_Model")->getClassById($class_id);

    $this->view('templates/header', $data, 'class/update');
    $this->view('templates/sidebar', $data, 'class/update');
    $this->view('templates/top-bar', $data, 'class/update');
    $this->view('class/update', $data, 'class/update');
    $this->view('templates/footer', $data, 'class/update');
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
    unset($_SESSION['search_staff_keyword']);
    unset($_SESSION['search_edc_keyword']);
    unset($_SESSION['search_sin_keyword']);
    unset($_SESSION['search_payment_keyword']);
    unset($_SESSION['search_history_keyword']);
    unset($_SESSION['payment_data_per_student']);
    unset($_SESSION['payment_data_per_class']);

    if ($page < 1) {
      header('Location: ' . BASEURL . 'classes/page/1');
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
    if (isset($_SESSION['search_class_keyword']) && $_SESSION['search_class_keyword'] != '') {
      $total_data = count($this->model('Class_Model')->getClassByAny($_SESSION['search_class_keyword']));

      $data['class_count'] = $total_data;
    } else {
      $total_data = count($this->model('Class_Model')->getAllClasses());

      $data['class_count'] = $total_data;
    }


    if (isset($_POST['search-class'])) {
      $search_class_keyword = $_POST['search-class-keyword'];

      $total_data = count($this->model('Class_Model')->getClassByAny($search_class_keyword));

      $data['class_count'] = $total_data;
      $_SESSION['search_class_keyword'] = $search_class_keyword;

      if ($total_data < 6) {
        header('location: ' . BASEURL . 'classes/page/1');
        exit;
      }
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
      header('Location: ' . BASEURL . 'classes/page/1');
      exit;
    }

    if ($page > $total_page && $page > 1 && $total_page > 1) {
      header('Location: ' .  BASEURL . 'classes/page/' . $total_page);
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

    // How many data will displayed on each page
    if (isset($_SESSION['search_class_keyword'])) {
      $data['class'] = $this->model('Class_Model')->getClassWithLimit($start_data, $total_data_per_page, $_SESSION['search_class_keyword']);
    } else {
      $data['class'] = $this->model('Class_Model')->getClassWithLimit($start_data, $total_data_per_page);
    }

    for ($i = 0; $i < count($data['class']); $i++) {
      $students = $this->model('Student_Model')->getStudentsByClassId($data['class'][$i]['class_id']);

      $data['class'][$i]['total_students'] = count($students);
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

    $data['title'] = 'Propay - Class';
    $data['breadcrumb'] = 'Classes';
    $data['keyword'] = $_SESSION['search_class_keyword'] ?? '';

    $this->view('templates/header', $data, 'class/index');
    $this->view('templates/sidebar', $data, 'class/index');
    $this->view('templates/top-bar', $data, 'class' . $page . '/index');
    $this->view('class/index', $data, 'class/index');
    $this->view('templates/footer', $data, 'class/index');
  }

  public function update_action()
  {
    $json = file_get_contents('php://input');

    $data = json_decode($json, true);

    $result = $this->model("Class_Model")->updateClass($data);

    if ($result['row_count'] > 0) {
      $response = [
        'status' => 'success',
        'class_id' =>  $result['class_id'],
        'url' => BASEURL . 'classes/index'
      ];
    } else if ($result['row_count'] == 0) {
      $response = [
        'status' => 'nothing-update',
        'class_id' =>  $result['class_id'],
        'url' => BASEURL . 'classes/index'
      ];
    } else {
      $response = [
        'status' => 'error',
      ];
    }
    file_put_contents('php://output', json_encode($response));
  }

  public function check_action()
  {
    $json = file_get_contents('php://input');

    $data = json_decode($json, true);
    $class = $this->model("Class_Model")->getClassByName($data['class-name']);

    if ($class) {
      $result = [
        'status' => 'error',
        'message' => 'Class is already existed',
        'class' => $class
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

  public function delete_action($class_id)
  {
    file_get_contents('php://input');

    $class  = $this->model("Class_Model")->getClassById($class_id);

    $class_row_count = $this->model("Class_Model")->deleteClass($class_id);

    if ($class_row_count) {
      $response = [
        'status' => 'success',
        'class_name' => $class['class_name']
      ];
    } else {
      $response = [
        'status' => 'success',
      ];
    }

    file_put_contents('php://output', json_encode($response));
  }

  public function insert_action()
  {
    $json  = file_get_contents('php://input');

    $data = json_decode($json, true);

    $class_row_count = $this->model("Class_Model")->addClass($data);

    if ($class_row_count) {
      $response = [
        'status' => 'success',
        'class_name' => $data['class_name'],
        'url' => BASEURL . 'classes'
      ];
    } else {
      $response = [
        'status' => 'error',
      ];
    }

    file_put_contents('php://output', json_encode($response));
  }

  public function check_total_student()
  {
    $json = file_get_contents('php://input');

    $data = json_decode($json, true);
    $class = $this->model("Class_Model")->getClassByName($data['class-name']);

    if ($class) {
      $students = $this->model('Student_Model')->getStudentsByClassID($class['class_id']);

      if ($students) {
        $result = [
          'status' => 'success',
          'student' => $students
        ];

        file_put_contents('php://output', json_encode($result));
      } else {
        $result = [
          'status' => 'error',
        ];

        file_put_contents('php://output', json_encode($result));
      }
    }
  }
}
