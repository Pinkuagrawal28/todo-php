<?php
namespace App\Query;

class Todo extends BaseQuery
{
    public function AddTask(string $task): int
    {
        $stmt = $this->db->prepare("INSERT INTO tasks (task_name, status) VALUES (:taskname, :statusval)");

        $stmt->execute([
            'taskname'  => $task,
            'statusval' => "todo",
        ]);
        
        return $this->db->lastInsertId();
    }

    public function AllTask(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks ORDER BY id ASC , status DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deleteById(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id=:id");
        $stmt->execute(
            ['id' => $id]
        );
        return true;
    }

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

    public function getTaskById($id): array
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->execute(
          ['id'=>$id,]
        );
        return $stmt->fetchAll();
    }

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
