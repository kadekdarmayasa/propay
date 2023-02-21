<?php

class Auth extends Controller
{

  public function login()
  {
    if (isset($_POST['officer-login'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];

      if ($user = $this->model('Staff_Model')->getStaffByUsername($username)) {
        if (password_verify($password, $user['password'])) {
          $_SESSION['user'] = $user;
          $_SESSION['user']['role'] = $user['staff_level'];
          $_SESSION['user']['name'] = $user['staff_name'];
          header('Location: ' . BASEURL . 'home');
        }
      }
    }

    if (isset($_POST['student-login'])) {
      $sin = $_POST['sin'];
      $password = $_POST['password'];

      if ($user = $this->model('Student_Model')->getStudentBySIN($sin)) {
        if (password_verify($password, $user['password'])) {
          $_SESSION['user'] = $user;
          $_SESSION['user']['role'] = 'student';
          $_SESSION['user']['name'] = $user['student_name'];
          header('Location: ' . BASEURL . 'home');
        }
      }
    }

    $data['title'] = 'Propay - Login';
    $this->view('templates/header', $data, 'login');
    $this->view('auth/login');
    $this->view('templates/footer', $data, 'login');
  }


  public function logout()
  {
    session_destroy();
    header('Location: ' . BASEURL . 'auth/login');
  }
}
