<?php
namespace App\Query;

/***
   * This classes Handles TODO Queries
   */
class Todo extends BaseQuery
{

   /***
   * This is function Add Task to db
   * @param string tasks
   * @return array lasttask
   */
    public function AddTask(string $task): int
    {
        $stmt = $this->db->prepare("INSERT INTO tasks (task_name, status) VALUES (:taskname, :statusval)");

        $stmt->execute([
            'taskname'  => $task,
            'statusval' => "todo",
        ]);

        return $this->db->lastInsertId();
    }

    /***
   * This is function returns all the tasks from db
   * @return array tasks
   */
    public function AllTask(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks ORDER BY id ASC , status DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /***
   * This is function deletes the task from db
   * @params int id
   * @return tasks
   */
    public function deleteById(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id=:id");
        $stmt->execute(
            ['id' => $id]
        );
        return true;
    }

    /***
   * This is function make the status change of task in db
   * @param int id
   * @param string status
   * @return bool
   */
    public function markById(int $id, string $mark): bool
    {
        $stmt = $this->db->prepare("UPDATE tasks set status = :statusvalue WHERE id=:id");
        $stmt->execute(
            ['id'         => $id,
            'statusvalue' => $mark
            ]
        );
        return true;
    }

    /***
   * This is function returns the single task
   * @param int id
   * @return array task
   */
    public function getTaskById($id): array
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->execute(
          ['id'=>$id,]
        );
        return $stmt->fetchAll();
    }

    /***
   * This is function update the task info in db
   * @param int id
   * @param string content
   */
    public function editById($id,$content){
      $stmt = $this->db->prepare("UPDATE tasks set task_name = :task_content WHERE id = :id");
      $stmt->execute(
        ['id'=>$id,
        'task_content' => $content]
      );
    }

    // public function LastInserted():array{
    //   $last_id = $this->db->lastInsertId();
    // }
}
