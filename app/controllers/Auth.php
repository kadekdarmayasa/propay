<?php

class Auth extends Controller
{
  public function login()
  {
    if (isset($_SESSION['user'])) {
      header('Location:' . BASEURL . 'dashboard/index');
      exit;
    }

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

  public function reset_password()
  {
    if (isset($_POST['uniq-identity'])) {
      $uniq_identity = $_POST['uniq-identity'];

      $student = $this->model('Student_Model')->getStudentBySIN($uniq_identity);
      $staff = $this->model('Staff_Model')->getStaffByUsername($uniq_identity);

      if ($student) {
        $data['student'] = $student;
      } else if ($staff) {
        $data['staff'] = $staff;
      } else {
        Flasher::setFlash('error', 'Your information does not match our records');
      }
    }

    if (isset($_POST['save-password'])) {
      if (isset($_POST['sin'])) {
        $student_row_count = $this->model('Student_Model')->updatePassword($_POST['sin'], $_POST['password']);
        if ($student_row_count > 0) {
          $url = BASEURL . 'auth/login';
          Flasher::setFlash(
            'success',
            "Password has been changed successfully. <br> You can now <a href='$url'>login</a> with your new password"
          );
          $data['password_changed'] = true;
        }
      } else if (isset($_POST['staff_id'])) {
        $staff_row_count = $this->model('Staff_Model')->updatePassword($_POST['staff_id'], $_POST['password']);
        if ($staff_row_count > 0) {
          $url = BASEURL . 'auth/login';
          Flasher::setFlash(
            'success',
            "Password has been changed successfully. <br> You can now <a href='$url'>login</a> with your new password"
          );
          $data['password_changed'] = true;
        }
      }
    }

    $data['title'] = 'Propay - Reset Password';
    $this->view('templates/header', $data, 'login');
    $this->view('auth/reset_password', $data);
    $this->view('templates/footer', $data, 'auth/reset-password');
  }


  public function logout()
  {
    session_destroy();
    header('Location: ' . BASEURL . 'auth/login');
  }
}
