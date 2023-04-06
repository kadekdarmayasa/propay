<?php
class Date_Util
{
  public function format_date($date)
  {
    $date = date('d F Y', strtotime($date));
    $date = explode(' ', $date);
    $month = substr($date[1], 0, 3);
    $year = $date[2];
    $day = $date[0];

    return $day . ' ' . $month . ' ' . $year;
  }
}
