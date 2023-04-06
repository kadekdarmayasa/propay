<?php
class User extends Controller
{
  public function profile($id)
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    if ($_SESSION['user']['role'] == 'student' && $_SESSION['user']['sin'] != $id) {
      header('Location: ' . BASEURL . 'dashboard');
      exit;
    }

    if ($_SESSION['user']['role'] == 'staff' && $_SESSION['user']['staff_id'] != $id) {
      header('Location: ' . BASEURL . 'dashboard');
      exit;
    }

    if ($_SESSION['user']['role'] == 'admin' && $_SESSION['user']['staff_id'] != $id) {
      header('Location: ' . BASEURL . 'dashboard');
      exit;
    }

    unset($_SESSION['search_student_keyword']);
    unset($_SESSION['search_staff_keyword']);
    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_edc_keyword']);
    unset($_SESSION['search_payment_keyword']);
    unset($_SESSION['search_history_keyword']);
    unset($_SESSION['row_per_page']);

    if (isset($_POST['save-student-profile'])) {
      $this->model('Student_Model')->updateProfile($_POST);

      $_SESSION['profile_change'] = true;
      Flasher::setFlash('success', "Profile Saved.");
    }

    if (isset($_POST['save-staff-profile'])) {
      $this->model('Staff_Model')->updateProfile($_POST);

      $_SESSION['profile_change'] = true;
      Flasher::setFlash('success', "Profile Saved.");
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
      $data['staff'] = $this->model('Staff_Model')->getStaffById($id);
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
      $data['student'] = $this->model('Student_Model')->getStudentBySIN($id);
    }

    $data['title'] = 'Propay - User Profile';
    $data['breadcrumb'] = 'Profile';
    $data['religions'] = ['Hindu', 'Islam', 'Christian', 'Buddha', 'Kong Hu Cu'];

    $this->view('templates/header', $data, 'user/profile');
    $this->view('templates/sidebar', $data, 'user/profile');
    $this->view('templates/top-bar', $data, 'user/profile');
    $this->view('user/profile', $data, 'user/profile');
    $this->view('templates/footer', $data, 'user/profile');
  }

  public function reset_password($id)
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
      exit;
    }

    unset($_SESSION['search_class_keyword']);
    unset($_SESSION['search_edc_keyword']);
    unset($_SESSION['search_staff_keyword']);
    unset($_SESSION['last_search']);
    unset($_SESSION['row_per_page']);
    unset($_SESSION['search_history_keyword']);

    if (isset($_POST['save-staff-password'])) {
      $password  = $_POST['password'];
      $id = $_POST['staff_id'];

      $staff_row_count = $this->model('Staff_Model')->updatePassword($id, $password);

      if ($staff_row_count) {
        $url = BASEURL . 'user/profile/' . $id;
        Flasher::setFlash('success', "Password has been changed successfully. <a href='$url'>See profile</a>");
      }
    }

    if (isset($_POST['save-student-password'])) {
      $password  = $_POST['password'];
      $sin = $_POST['sin'];

      $student_row_count = $this->model('Student_Model')->updatePassword($sin, $password);

      if ($student_row_count) {
        $url = BASEURL . 'user/profile/' . $sin;
        Flasher::setFlash('success', "Password has been changed successfully. <a href='$url'>See profile</a>");
      }
    }


    if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'staff') {
      if (isset($_SESSION['profile_staff_change'])) {
        $staff = $this->model('Staff_Model')->getStaffById($_SESSION['user']['staff_id']);

        $staff_name = $staff['staff_name'];
      } else {
        $staff_name = $_SESSION['user']['staff_name'];
      }

      $data['name'] = $staff_name;
      $data['role'] = $_SESSION['user']['staff_level'];
      $data['staff'] = $_SESSION['user'];
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
      $data['student'] = $_SESSION['user'];
    }


    $data['title'] = 'Propay - Profile';
    $data['breadcrumb'] = 'Profile';
    $data['religions'] = ['Hindu', 'Islam', 'Christian', 'Buddha', 'Kong Hu Cu'];

    $this->view('templates/header', $data, 'user/reset_password');
    $this->view('templates/sidebar', $data, 'user/reset_password');
    $this->view('templates/top-bar', $data, 'user/reset_password');
    $this->view('user/reset_password', $data, 'user/reset_password');
    $this->view('templates/footer', $data, 'user/reset_password');
  }
}
