<?php

class Classes extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    $data['class'] = $this->model("Class_Model")->getAllClasses();

    for ($i = 0; $i < count($data['class']); $i++) {
      $major = $this->model("Major_Model")->getMajorById($data['class'][$i]['major_id']);
      $data['class'][$i]['major_name'] = $major['major_name'];

      $students = $this->model('Student_Model')->getStudentsByClassId($data['class'][$i]['class_id']);
      $data['class'][$i]['total_students'] = count($students);
    }

    $data['title'] = 'Propay - Class';
    $data['breadcrumb'] = 'Classes';
    $this->view('templates/header', $data, 'class');
    $this->view('templates/sidebar', $data, 'class');
    $this->view('templates/top-bar', $data, 'class');
    $this->view('class/index', $data, 'class');
    $this->view('templates/overlay', $data, 'class');
    $this->view('templates/footer', $data, 'class');
  }

  public function add()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if (isset($_POST['add-class'])) {
      $class_name = $_POST['class-name'];
      $major_id = $_POST['major'];

      if ($this->model("Class_Model")->getClassByName($class_name)) {
        Flasher::setFlash('error', 'The class is already exist!');
      } else {
        $class_row_count = $this->model("Class_Model")->addClass($class_name, $major_id);

        if ($class_row_count) {
          Flasher::setFlash('success', 'Congratulations! The class has been successfully added!');
        }
      }
    }

    $data['major_list'] = $this->model('Major_Model')->getAllMajor();
    $data['title'] = 'Propay - Class';
    $data['breadcrumb'] = 'Classes/Add';
    $this->view('templates/header', $data, 'class');
    $this->view('templates/sidebar', $data, 'class');
    $this->view('templates/top-bar', $data, 'class');
    $this->view('class/add', $data, 'class');
    $this->view('templates/overlay', $data, 'class');
    $this->view('templates/footer', $data, 'class');
  }

  public function delete($class_id)
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    $class_row_count = $this->model("Class_Model")->deleteClass($class_id);

    if ($class_row_count) {
      Flasher::setFlash('success', 'Congratulations! The class has been successfully deleted!');
    }

    header('Location: ' . BASEURL . 'classes');
    exit;
  }
}
