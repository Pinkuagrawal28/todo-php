<?php

namespace App\Action;

use App\Query\Todo;

class Addtask {
  public function action() {
    $task = $_POST["task"] ?? '';

    $todo = new Todo();
    $lastId = $todo->AddTask($task);

    echo '
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
        <td class="px-6 py-4">' . htmlspecialchars($lastId) . '</td>
        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' . htmlspecialchars($task) . '</td>
        <td class="px-6 py-4">
          <a hx-get="/task?action=showedit&id=' . urlencode($lastId) . '" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Edit</a>
        </td>
        <td class="px-6 py-4">
          <a hx-get="/task?action=delete&id=' . urlencode($lastId) . '" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</a>
        </td>
        <td class="px-6 py-4">
          <a hx-get="/task?action=mark&id=' . urlencode($lastId) . '" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">Todo</a>
        </td>
      </tr>
    ';
  }
}
