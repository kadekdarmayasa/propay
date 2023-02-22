<?php
class App
{
  protected $controller = 'dashboard';
  protected $method = 'index';
  protected $params = [];

  public function __construct()
  {
    $url  = $this->parse_url();

    if (is_null($url)) {
      $url[0] = $this->controller;
    } else if (file_exists('app/controllers/' . $url[0] . '.php')) {
      $this->controller =  ucwords($url[0]);
    }

    require_once 'app/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    if (isset($url[1])) {
      if (method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
      }

      if ($url[0] == 'auth' && $url[1] != 'logout' && $url[1] != 'signup') {
        $this->method = 'login';
      }
    }

    unset($url[0]);
    unset($url[1]);

    if (!is_null($url)) $this->params = array_values($url);

    call_user_func_array(array($this->controller, $this->method), $this->params);
  }

  private function parse_url()
  {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode("/", $url);
      return $url;
    }
  }
}
