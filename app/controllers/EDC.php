<?php

class EDC extends Controller
{
  public function index()
  {
    unset($_SESSION['last_search']);
    header('Location: ' . BASEURL . 'edc_list/index');
    exit;
  }


  public function payment()
  {
    header('Location: ' . BASEURL . 'payment/index');
    exit;
  }


  public function payment_history()
  {
    unset($_SESSION['last_search']);
    header('Location: ' . BASEURL . 'payment_history/index');
    exit;
  }

  public function report()
  {
    unset($_SESSION['last_search']);
    header('Location: ' . BASEURL . 'payment_report/index');
    exit;
  }
}
