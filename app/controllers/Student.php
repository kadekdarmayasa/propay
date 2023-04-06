<?php
class Student extends Controller implements Actions
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
      unset($_SESSION['search_payment_keyword']);
      unset($_SESSION['search_history_keyword']);
      unset($_SESSION['row_per_page']);

      if ($_SESSION['user']['role'] == 'student' || $_SESSION['user']['role'] == 'staff') {
        header('Location: ' . BASEURL);
        exit;
      } else {
        header('Location: ' . BASEURL . 'student/page/1');
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
    unset($_SESSION['search_payment_keyword']);
    unset($_SESSION['search_history_keyword']);
    unset($_SESSION['row_per_page']);

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

  public function update($sin)
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
    unset($_SESSION['search_payment_keyword']);
    unset($_SESSION['search_history_keyword']);
    unset($_SESSION['row_per_page']);

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

    $data['page'] = 1;
    $data['title'] = 'Propay - Student';
    $data['breadcrumb'] = 'Student/Update';
    $data['religions'] = ['Hindu', 'Islam', 'Christian', 'Buddha', 'Kong Hu Cu'];
    $data['student'] = $this->model("Student_Model")->getStudentBySIN($sin);
    $data['class'] = $this->model('Class_Model')->getAllClasses();
    $data['payment'] = $this->model('Payment_Model')->getPaymentsBySIN($sin);

    $this->view('templates/header', $data, 'student/update');
    $this->view('templates/sidebar', $data, 'student/update');
    $this->view('templates/top-bar', $data, 'student/update');
    $this->view('student/update', $data, 'student/update');
    $this->view('templates/footer', $data, 'student/update');
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

    unset($_SESSION['search_staff_keyword']);
    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_edc_keyword']);
    unset($_SESSION['search_payment_keyword']);
    unset($_SESSION['search_history_keyword']);

    if ($page < 1) {
      header('Location: ' . BASEURL . 'student/page/1');
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
    if (isset($_SESSION['search_student_keyword']) && $_SESSION['search_student_keyword'] != '') {
      $total_data = count($this->model('Student_Model')->getStudentByAny($_SESSION['search_student_keyword']));

      $data['student_count'] = $total_data;
    } else {
      $total_data = count($this->model('Student_Model')->getAllStudents());

      $data['student_count'] = $total_data;
    }


    if (isset($_POST['search-student'])) {
      $search_student_keyword = $_POST['search-student-keyword'];

      $total_data = count($this->model('Student_Model')->getStudentByAny($search_student_keyword));

      $data['student_count'] = $total_data;
      $_SESSION['search_student_keyword'] = $search_student_keyword;

      if ($total_data < 6) {
        header('location: ' . BASEURL . 'student/page/1');
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
      header('Location: ' . BASEURL . 'student/page/1');
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

    // How Many Data Will Display on Each Page
    if (isset($_SESSION['search_student_keyword'])) {
      $data['student'] = $this->model('Student_Model')->getStudentWithLimit($start_data, $total_data_per_page, $_SESSION['search_student_keyword']);
    } else {
      $data['student'] = $this->model('Student_Model')->getStudentWithLimit($start_data, $total_data_per_page);
    }

    for ($i = 0; $i < count($data['student']); $i++) {
      $data['student'][$i]['class'] = $this->model('Class_Model')->getClassById($data['student'][$i]['class_id']);
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
    $this->view('templates/top-bar', $data, 'student/index');
    $this->view('student/index', $data, 'student/index');
    $this->view('templates/footer', $data, 'student/index');
  }

  public function detail($sin)
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
    unset($_SESSION['search_payment_keyword']);
    unset($_SESSION['search_history_keyword']);
    unset($_SESSION['row_per_page']);

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

    $data['title'] = 'Propay - Student';
    $data['breadcrumb'] = 'Student/Detail';
    $data['page'] = 1;
    $data['student'] = $this->model('Student_Model')->getStudentBySIN($sin);
    $data['class'] = $this->model('Class_Model')->getClassById($data['student']['class_id']);

    $this->view('templates/header', $data, 'student/detail');
    $this->view('templates/sidebar', $data, 'student/detail');
    $this->view('templates/top-bar', $data, 'student/detail');
    $this->view('student/detail', $data, 'student/detail');
    $this->view('templates/footer', $data, 'student/detail');
  }

  public function check_action()
  {
    $json = file_get_contents('php://input');

    $data = json_decode($json, true);

    if (isset($data['sin'])) {
      $key = 'SIN';

      $student = $this->model("Student_Model")->getStudentBySIN($data['sin']);
    } else if (isset($data['nsn'])) {
      $key = 'NSN';

      $student = $this->model("Student_Model")->getStudentByNSN($data['nsn']);
    }

    if ($student) {
      $response = [
        'status' => 'error',
        'message' =>  "$key is already used"
      ];
    } else {
      $response = [
        'status' => 'success',
        'message' => "$key can be used"
      ];
    }

    file_put_contents('php://output', json_encode($response));
  }

  public function update_action()
  {
    $json = file_get_contents('php://input');

    $data = json_decode($json, true);

    $result = $this->model("Student_Model")->updateStudent($data);

    if ($result['row_count']  > 0) {
      $response = [
        'status' => 'success',
        'sin' =>  $result['sin'],
        'url' => BASEURL . 'student/index',
      ];
    } else if ($result['row_count'] == 0) {
      $response = [
        'status' => 'nothing-update',
        'sin' =>  $result['sin'],
        'url' => BASEURL . 'student/index',
      ];
    } else {
      $response = [
        'status' => 'error',
      ];
    }

    file_put_contents('php://output', json_encode($response));
  }

  public function delete_action($sin)
  {
    file_get_contents('php://input');

    $payments = $this->model('Payment_Model')->getPaymentsBySIN($sin);

    for ($i = 0; $i < count($payments); $i++) {
      $payment_history  = $this->model('Payment_History_Model')->getPaymentHistoryByPaymentID($payments[$i]['payment_id']);

      if ($payment_history) {
        $this->model('Payment_History_Model')->deletePaymentHistory($payments[$i]['payment_id']);
      }
    }

    $this->model('Payment_Model')->deletePayment($sin);

    $student = $this->model("Student_Model")->deleteStudent($sin);

    if ($student['row_count']) {
      $response = [
        'status' => 'success',
        'sin' => $student['sin']
      ];
    } else {
      $response = [
        'status' => 'error',
      ];
    }

    file_put_contents('php://output', json_encode($response));
  }

  public function insert_action()
  {
    $json = file_get_contents('php://input');

    $data = json_decode($json, true);

    $student = $this->model("Student_Model")->addStudent($data);

    if ($student['row_count'] > 0) {
      $term = $data['term'];
      $start_tempo = date('Y-m-d', strtotime(explode('/', $term)[0] . '-07-10'));
      $row_count_payment = 0;
      $term = $term;
      $initial_id = 1;

      $edc = $this->model('EDC_Model')->getEDCByTerm($term);
      $edc_id = $edc['edc_id'];

      for ($i = 0; $i < 36; $i++) {
        $due_date = date("Y-m-d", strtotime("+$i month", strtotime($start_tempo)));
        $month = date('F', strtotime($due_date));
        $year = date('Y', strtotime($due_date));

        $payments = $this->model('Payment_Model')->getAllPayments();

        if (count($payments) < 1) {
          $row_count = $this->model('Payment_Model')->addPayment($edc_id, $data['sin'], $year, $month, $due_date, $initial_id);
        } else {
          $row_count = $this->model('Payment_Model')->addPayment($edc_id, $data['sin'], $year, $month, $due_date, $payments[count($payments) - 1]['payment_id'] + 1);
        }

        if ($i == 35) {
          $row_count_payment = $row_count;
        }
      }

      if ($row_count_payment  > 0) {
        $response = [
          'status' => 'success',
          'sin' =>  $data['sin'],
          'url' => BASEURL . 'student/index',
        ];
      } else {
        $response = [
          'status' => 'payment-error',
        ];
      }

      file_put_contents('php://output', json_encode($response));
    } else {
      $response = [
        'status' => 'student-error',
      ];

      file_put_contents('php://output', json_encode($response));
    }
  }
}
