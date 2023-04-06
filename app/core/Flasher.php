<?php

class Flasher
{
  static function setFlash($flash_type, $flash_message)
  {
    $_SESSION['flasher'] = [
      'type' => $flash_type,
      'message' => $flash_message
    ];
  }


  static function flash()
  {

    if (isset($_SESSION['flasher'])) {
      $illustration_icon = BASEURL . "public/images/" . $_SESSION['flasher']['type'] . ".svg";
      $alert_type = 'alert-' . $_SESSION['flasher']['type'];
      $alert_message = $_SESSION['flasher']['message'];
      $close_icon = BASEURL . 'public/images/close.svg';

      echo " <div class='alert $alert_type' style='display: flex !important;'>
        <div class='alert-left'>
          <img src='$illustration_icon' alt='error-icon'>
          <p class='message'>$alert_message</p>
        </div>

        <div class='alert-right'>
          <button id='close-btn'>
            <img src='$close_icon' alt='close-icon'>
          </button>
        </div>
      </div>";

      unset($_SESSION['flasher']);
    }
  }
}
