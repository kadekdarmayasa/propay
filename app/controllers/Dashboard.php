<?php
class Dashboard extends Controller
{
  public function index()
  {
    if (isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . 'auth/login');
    }
  }
}
