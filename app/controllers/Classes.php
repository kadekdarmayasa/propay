<?php

class Classes extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    $data['title'] = 'Propay - Class';
    $data['breadcrumb'] = 'Classes';
    $this->view('templates/header', $data, 'class');
    $this->view('templates/sidebar', $data, 'class');
    $this->view('templates/top-bar', $data, 'class');
    $this->view('class/index', $data, 'class');
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
    $this->view('templates/footer', $data, 'class');
  }
}
