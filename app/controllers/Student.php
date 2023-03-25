<?php
class Student extends Controller implements Actions
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
    } else {
      unset($_SESSION['search_class_keyword']);
      header('Location: ' . BASEURL . 'student/page/1');
    }

    exit;
  }

  public function add()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_staff_keyword']);
    unset($_SESSION['search_student_keyword']);

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $data['name'] = $_SESSION['user']['staff_name'];
      $data['role'] = $_SESSION['user']['staff_level'];
    }


    $data['page'] = 1;
    $data['title'] = 'Propay - Student';
    $data['breadcrumb'] = 'Student/Add';
    $data['class'] = $this->model('Class_Model')->getAllClasses();
    $data['edc'] = $this->model('EDC_Model')->getAllEDC();
    $this->view('templates/header', $data, 'student/add');
    $this->view('templates/sidebar', $data, 'student/add');
    $this->view('templates/top-bar', $data, 'student/add');
    $this->view('student/add', $data, 'student/add');
    $this->view('templates/footer', $data, 'student/add');
  }

  public function page($page)
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if ($page < 1) {
      header('Location: ' . BASEURL . 'staff/index');
      exit;
    }

    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_staff_keyword']);

    if ($_SESSION['user']['staff_level'] == 'admin' || $_SESSION['user']['staff_level'] == 'staff') {
      $data['name'] = $_SESSION['user']['staff_name'];
      $data['role'] = $_SESSION['user']['staff_level'];
    }

    // Pagination
    if (isset($_SESSION['search_student_keyword']) && $_SESSION['search_student_keyword'] != '') {
      $total_data = count($this->model('Student_Model')->getStudentByAny($_SESSION['search_student_keyword']));
      $data['student_amount'] = $total_data;
    } else {
      $total_data = count($this->model('Student_Model')->getAllStudents());
      $data['student_amount'] = $total_data;
    }


    if (isset($_POST['search-student'])) {
      $student = $this->model('Student_Model')->getStudentByAny($_POST['student-field']);
      $total_data = count($student);
      $data['student_amount'] = $total_data;
      $_SESSION['search_student_keyword'] = $_POST['student-field'];

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

    if ($total_page <= 1 && $page != 1) {
      header('Location: ' . BASEURL . 'student/index');
    }

    if ($page > $total_page && $total_page > 1) {
      header('Location: ' .  BASEURL . 'student/page/' . $total_page);
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

    if (isset($_SESSION['search_student_keyword'])) {
      $data['student'] = $this->model('Student_Model')->getStudentWithLimit($start_data, $total_data_per_page, $_SESSION['search_student_keyword']);
    } else {
      $data['student'] = $this->model('Student_Model')->getStudentWithLimit($start_data, $total_data_per_page);
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


    $data['title'] = 'Propay - Student';
    $data['breadcrumb'] = 'Student';
    $data['keyword'] = $_SESSION['search_student_keyword'] ?? '';
    $this->view('templates/header', $data, 'student/index');
    $this->view('templates/sidebar', $data, 'student/index');
    $this->view('templates/top-bar', $data, 'student' . $page . '/index');
    $this->view('student/index', $data, 'student/index');
    $this->view('templates/footer', $data, 'student/index');
  }


  public function check_action()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['sin'])) {
      $key = 'SIN';
      $student = $this->model("Student_Model")->getStudentBySIN($data['sin']);
    }

    if (isset($data['nsn'])) {
      $key = 'NSN';
      $student = $this->model("Student_Model")->getStudentByNSN($data['nsn']);
    }


    if ($student) {
      $result = [
        'status' => 'error',
        'message' =>  "$key is already used"
      ];

      file_put_contents('php://output', json_encode($result));
    } else {
      $result = [
        'status' => 'success',
        'message' => "$key can be used"
      ];

      file_put_contents('php://output', json_encode($result));
    }
  }

  public function update_action()
  {
  }

  public function delete_action($sin)
  {
  }

  public function insert_action()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $start_tempo = date($data['due_date']);
    $result = $this->model("Student_Model")->addStudent($data);

    if ($result['row_count'] > 0) {
      $row_count_payment = 0;
      $student = $this->model("Student_Model")->getStudentBySIN($data['sin']);
      $term = $student['term'];
      $edc = $this->model('EDC_Model')->getEDCByTerm($term);
      $edc_id = $edc['edc_id'];

      for ($i = 0; $i < 36; $i++) {
        $due_date = date("Y-m-d", strtotime("+$i month", strtotime($start_tempo)));
        $month = date('F', strtotime($due_date));
        $year = date('Y', strtotime($due_date));
        $row_count = $this->model('Payment_Model')->addPayment($edc_id, $data['sin'], $year, $month, $due_date);

        if ($i == 35) $row_count_payment = $row_count;
      }

      if ($row_count_payment  > 0) {
        $response = [
          'status' => 'success',
          'message' => 'Student has been successfully added',
          'sin' =>  $data['sin'],
          'url' => BASEURL . 'student/index',
        ];
        file_put_contents('php://output', json_encode($response));
      }
    }
  }
}
