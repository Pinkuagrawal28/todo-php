<?php
namespace App\Core;

use App\Action\Addtask;
use App\Action\ShowTask;
use App\Action\TaskAction;

class App
{
    public function run()
    {
        $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $addtask = new Addtask();
        $showtask = new ShowTask();

        if ($method === 'GET'){
          switch ($uri) {
            case '/':
              $tasks = $showtask->getAllTaks();
              require_once BASE_PATH . '/src/pages/home.php';
              break;
            case '/task':
                $id = $_GET["id"];
                $action = $_GET["action"];
                $status = $_GET["currentstatus"]??"todo";
                $taskaction = new TaskAction($id,$status);
                $taskaction->call($action);
                break;
          }
        }
        if($method === 'POST'){
          switch ($uri) {
            case '/addtask':
              $addtask->action();
              break;

              case '/edit':
                // file_put_contents('./../Debug/debug_post.log', print_r($_POST, true)); // 👈 LOG IT
                $id = $_POST["id"] ?? null;
                $action = $_POST["action"] ?? null;

                if (!$id || !$action) {
                  echo "<tr><td colspan='5' style='color:red;'>Missing ID or action</td></tr>";
                  exit;
                }

                $taskaction = new TaskAction($id, "");
                $taskaction->call($action);
                break;
          }
        }
    }
}
