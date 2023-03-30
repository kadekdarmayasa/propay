<?php

class EDC extends Controller
{
  public function index()
  {
    unset($_SESSION['last_search']);
    header('Location: ' . BASEURL . 'edc_List/index');
    exit;
  }


  public function payment()
  {
    header('Location: ' . BASEURL . 'edc_payment/index');
    exit;
  }


  public function payment_history()
  {
    unset($_SESSION['last_search']);
    header('Location: ' . BASEURL . 'edc_payment_history/index');
    exit;
  }

  public function report()
  {
    unset($_SESSION['last_search']);
    header('Location: ' . BASEURL . 'edc_report/index');
    exit;
  }
}
