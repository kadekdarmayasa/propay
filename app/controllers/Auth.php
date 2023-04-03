<?php

class Auth extends Controller
{
  public function login()
  {
    if (isset($_SESSION['user'])) {
      header('Location:' . BASEURL . 'dashboard');
      exit;
    }

    // Staff Login Process
    if (isset($_POST['username'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $staff = $this->model('Staff_Model')->getStaffByUsername($username);

      if (!is_null($staff)) {
        if (password_verify($password, $staff['password'])) {
          $_SESSION['user'] = $staff;
          $_SESSION['user']['role'] = $staff['staff_level'];
          $_SESSION['user']['name'] = $staff['staff_name'];

          header('Location: ' . BASEURL . 'dashboard');
          exit;
        } else {
          Flasher::setFlash('warning', 'Your password is wrong');
        }
      } else {
        Flasher::setFlash('error', "Your login information doesn't match our records");
      }
    }

    // Student Login Process
    if (isset($_POST['sin'])) {
      $sin = $_POST['sin'];
      $password = $_POST['password'];
      $student = $this->model('Student_Model')->getStudentBySIN($sin);

      if (!is_null($student)) {
        if (password_verify($password, $student['password'])) {
          $_SESSION['user'] = $student;
          $_SESSION['user']['role'] = 'student';
          $_SESSION['user']['name'] = $student['student_name'];

          header('Location: ' . BASEURL . 'dashboard');
          exit;
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

      if (!is_null($student)) {
        $data['student'] = $student;
      } else if (!is_null($staff)) {
        $data['staff'] = $staff;
      } else {
        Flasher::setFlash('error', 'Your information does not match our records');
      }
    }

    if (isset($_POST['save-password'])) {
      if (isset($_POST['sin'])) {
        $student_row_count = $this->model('Student_Model')->updatePassword($_POST['sin'], $_POST['password']);

        if ($student_row_count) {
          $url = BASEURL . 'auth/login';

          Flasher::setFlash(
            'success',
            "Password has been changed successfully. <br> You can now <a href='$url'>login</a> with your new password"
          );

          $data['password_changed'] = true;
        }
      }

      if (isset($_POST['staff_id'])) {
        $staff_row_count = $this->model('Staff_Model')->updatePassword($_POST['staff_id'], $_POST['password']);

        if ($staff_row_count) {
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
