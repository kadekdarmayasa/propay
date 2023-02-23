<?php

class Auth extends Controller
{

  public function login()
  {
    if (isset($_POST['username'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];

      if ($user = $this->model('Staff_Model')->getStaffByUsername($username)) {
        if (password_verify($password, $user['password'])) {
          $_SESSION['user'] = $user;
          $_SESSION['user']['role'] = $user['staff_level'];
          $_SESSION['user']['name'] = $user['staff_name'];
          header('Location: ' . BASEURL . 'dashboard');
        } else {
          Flasher::setFlash('warning', 'Your password is wrong');
        }
      } else {
        Flasher::setFlash('error', "Your login information doesn't match our records");
      }
    }

    if (isset($_POST['sin'])) {
      $sin = $_POST['sin'];
      $password = $_POST['password'];

      if ($user = $this->model('Student_Model')->getStudentBySIN($sin)) {
        if (password_verify($password, $user['password'])) {
          $_SESSION['user'] = $user;
          $_SESSION['user']['role'] = 'student';
          $_SESSION['user']['name'] = $user['student_name'];
          header('Location: ' . BASEURL . 'dashboard');
        } else {
          Flasher::setFlash('warning', 'Your password is wrong');
        }
      } else {
        Flasher::setFlash('error', "Your login information doesn't match our records");
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
