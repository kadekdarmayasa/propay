<?php

class Controller
{

  public function view($view, $data = [], $activeTab = 'dashboard')
  {
    require_once "app/views/" . $view . '.php';
  }

  public function model($modelName)
  {
    require_once "app/models/" . $modelName . '.php';
    return new $modelName;
  }

  public function util($utilName)
  {
    require_once 'app/utils/' . $utilName . '.php';
    return new $utilName;
  }
}
