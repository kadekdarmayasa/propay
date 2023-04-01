<?php

class EDC_List extends Controller implements Actions
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
      if ($_SESSION['user']['role'] == 'student' || $_SESSION['user']['role'] == 'staff') {
        header('Location: ' . BASEURL);
      }
      header('Location: ' . BASEURL . 'edc_list/page/1');
    }
    exit;
  }

  public function update($edc_id)
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
    unset($_SESSION['search_edc_keyword']);
    unset($_SESSION['search_staff_keyword']);
    unset($_SESSION['search_student_keyword']);
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

    $data['title'] = 'Propay - EDC List';
    $data['breadcrumb'] = 'EDC List/Update';
    $data['page'] = 1;
    $data['edc'] = $this->model('EDC_Model')->getEDCById($edc_id);
    $this->view('templates/header', $data, 'edc/list/update');
    $this->view('templates/sidebar', $data, 'edc/list/update');
    $this->view('templates/top-bar', $data, 'edc/list/update');
    $this->view('edc/list/update', $data, 'edc/list/update');
    $this->view('templates/footer', $data, 'edc/list/update');
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
    unset($_SESSION['search_edc_keyword']);
    unset($_SESSION['search_staff_keyword']);
    unset($_SESSION['row_per_page']);
    unset($_SESSION['search_student_keyword']);

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

    $data['title'] = 'Propay - EDC List';
    $data['breadcrumb'] = 'EDC List/Add';
    $data['page'] = 1;
    $this->view('templates/header', $data, 'edc/list/add');
    $this->view('templates/sidebar', $data, 'edc/list/add');
    $this->view('templates/top-bar', $data, 'edc/list/add');
    $this->view('edc/list/add', $data, 'edc/list/add');
    $this->view('templates/footer', $data, 'edc/list/add');
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

    if ($page < 1) {
      header('Location: ' . BASEURL . 'edc_list/page/1');
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
    if (isset($_SESSION['search_edc_keyword']) && $_SESSION['search_edc_keyword'] != '') {
      $total_data = count($this->model('EDC_Model')->getEDCByAny($_SESSION['search_edc_keyword']));
    } else {
      $total_data = count($this->model('EDC_Model')->getAllEDC());
    }
    $data['edc_amount'] = $total_data;


    if (isset($_POST['search-edc'])) {
      $edc = $this->model('EDC_Model')->getEDCByAny($_POST['edc-field']);
      $total_data = count($edc);
      $data['edc_amount'] = $total_data;
      $_SESSION['search_edc_keyword'] = $_POST['edc-field'];

      if ($total_data < 6) {
        header('location: ' . BASEURL . 'edc_list/index');
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
      header('Location: ' . BASEURL . 'edc_list/index');
      exit;
    }

    if ($page > $total_page && $total_page > 1) {
      header('Location: ' .  BASEURL . 'edc_list/page/' . $total_page);
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
    if (isset($_SESSION['search_edc_keyword'])) {
      $data['edc'] = $this->model('EDC_Model')->getEDCWithLimit($start_data, $total_data_per_page, $_SESSION['search_edc_keyword']);
    } else {
      $data['edc'] = $this->model('EDC_Model')->getEDCWithLimit($start_data, $total_data_per_page);
    }

    for ($i = 0; $i < count($data['edc']); $i++) {
      $students = $this->model('Student_Model')->getStudentByTerm($data['edc'][$i]['term']);
      $data['edc'][$i]['total_students'] = count($students);
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

    $data['title'] = 'Propay - EDC List';
    $data['breadcrumb'] = 'EDC List';
    $data['keyword'] = $_SESSION['search_edc_keyword'] ?? '';
    $this->view('templates/header', $data, 'edc/list/index');
    $this->view('templates/sidebar', $data, 'edc/list/index');
    $this->view('templates/top-bar', $data, 'edc/list/index');
    $this->view('edc/list/index', $data, 'edc/list/index');
    $this->view('templates/footer', $data, 'edc/list/index');
  }

  public function delete_action($edc_id)
  {

    file_get_contents('php://input');
    $result = $this->model("EDC_Model")->deleteEDC($edc_id);

    if ($result['row_count']) {
      file_put_contents('php://output', json_encode([
        'status_message' => 'success',
        'status_code' => 200,
        'edc_id' => $result['edc_id']
      ]));
    }
  }

  public function insert_action()
  {
    $json  = file_get_contents('php://input');
    $data = json_decode($json, true);
    $start_date = explode('/', $data['term'])[0] . '-07-10';
    $edc_row_count = $this->model("EDC_Model")->addEDC($data, $start_date);

    if ($edc_row_count) {
      $response = [
        'status' => 'success',
        'message' => 'EDC has been successfully added',
        'url' => BASEURL . 'edc_list',
      ];

      file_put_contents('php://output', json_encode($response));
    }
  }

  public function update_action()
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $result = $this->model("EDC_Model")->updateEDC($data);

    if ($result['row_count'] > 0) {
      $response = [
        'status' => 'success',
        'message' => 'EDC has been successfully update',
        'url' => BASEURL . 'edc_list/index'
      ];
      file_put_contents('php://output', json_encode($response));
    } else if ($result['row_count'] == 0) {
      $response = [
        'status' => 'nothing-update',
        'message' => 'No edc data update',
        'url' => BASEURL . 'edc_list/index'
      ];
      file_put_contents('php://output', json_encode($response));
    } else {
      $response = [
        'status' => 'error',
        'message' => 'Failed to update edc',
        'url' => BASEURL . 'edc_list/index'
      ];
      file_put_contents('php://output', json_encode($response));
    }
  }

  public function check_action()
  {

    $json = file_get_contents('php://input');

    $data = json_decode($json, true);
    $edc = $this->model("EDC_Model")->getEDCByTerm($data['term']);

    if ($edc) {
      $result = [
        'status' => 'error',
        'message' => 'Term is already existed'
      ];

      file_put_contents('php://output', json_encode($result));
    } else {
      $result = [
        'status' => 'success',
        'message' => 'Term is available'
      ];

      file_put_contents('php://output', json_encode($result));
    }
  }
}
