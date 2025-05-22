<?php

namespace App\Action;

use App\Query\Todo;

class ShowTask{
  public function getAllTaks(){
    $todo = new Todo();
    return $todo->AllTask();
  }
}