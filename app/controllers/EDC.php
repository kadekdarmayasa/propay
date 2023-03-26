<?php

class EDC extends Controller
{
  public function index()
  {
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
    header('Location: ' . BASEURL . 'edc_payment_history/index');
    exit;
  }

  public function report()
  {
    header('Location: ' . BASEURL . 'edc_report/index');
    exit;
  }
}
