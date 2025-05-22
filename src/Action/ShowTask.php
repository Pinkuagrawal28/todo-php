<?php

namespace App\Action;

use App\Query\Todo;

/***
   * This classes is responsibe for getting all tasks
   */
class ShowTask{
  /***
   * This is function returns all the todo items
   * @return tasks
   */
  public function getAllTaks(){
    $todo = new Todo();
    return $todo->AllTask();
  }
}