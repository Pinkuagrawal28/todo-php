<?php
    namespace App\Action;

    use App\Query\Todo;

    class TaskAction
    {
        protected $id;
        protected $mark;

        public function __construct($id, $stats)
        {
            $this->id   = $id;
            $this->mark = $stats;
        }

        public function delete()
        {
            $todo = new Todo();
            if ($todo->deleteById($this->id)) {
                $tasks = $todo->AllTask();
                // echo "Deleted";
                // echo $this->renderTasks($tasks);
            }
        }

        public function mark()
        {
            $todo = new Todo();

            // Get actual current status from DB, not from frontend
            $task          = $todo->getTaskById((int) $this->id);
            $currentStatus = $task[0]['status'];

            $newStatus = $currentStatus === "done" ? "todo" : "done";
            $todo->markById((int) $this->id, $newStatus);

            $buttonLabel = ucfirst($newStatus);

            echo <<<HTML
            <div id="mark-button-{$this->id}" hx-get="/task?action=mark&id={$this->id}" hx-swap="outerHTML">
              <a class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">
              {$buttonLabel}
            </a>
            </div>
            HTML;
        }

        public function showedit()
        {
            $todo     = new Todo();
            $id       = htmlspecialchars($this->id);
            $task     = $todo->getTaskById((int) $id);
            $taskName = $task[0]["task_name"];

            echo <<<HTML
    <tr>
      <td colspan="5">
        <form hx-post="/edit" hx-target="closest tr" hx-swap="outerHTML">
          <input type="hidden" name="action" value="edit" />
          <input type="hidden" name="id" value="{$id}" />
          <input name="updatedtask" value="{$taskName}" placeholder="Edit Task..." class="border p-2 rounded"/>
          <button type="submit" class="bg-purple-600 text-white px-3 py-1 rounded ml-2">Save</button>
        </form>
      </td>
    </tr>
    HTML;
        }

        public function edit()
        {
            $newValue = $_POST["updatedtask"];
            $todo     = new Todo();
            $todo->editById($this->id, $newValue);

            $task     = $todo->getTaskById($this->id);
            $taskName = htmlspecialchars($task[0]['task_name']);
            $id       = htmlspecialchars($task[0]['id']);
            $status   = htmlspecialchars($task[0]['status']);

            echo <<<HTML
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
      <td class="px-6 py-4">{$id}</td>
      <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{$taskName}</td>
      <td class="px-6 py-4">
        <a hx-get="/task?action=showedit&id={$id}" hx-target="closest tr" hx-swap="outerHTML"
          class="text-white bg-purple-700 hover:bg-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700">Edit</a>
      </td>
      <td class="px-6 py-4">
        <a hx-get="/task?action=delete&id={$id}" hx-target="closest tr" hx-swap="outerHTML"
          class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-700">Delete</a>
      </td>
      <td class="px-6 py-4">
        <a hx-get="/task?action=mark&id={$id}&currentstatus={$status}"
          class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700">{$status}</a>
      </td>
    </tr>
    HTML;
        }

        public function call(string $action)
        {
            $this->$action();
        }

        private function renderTasks(array $tasks): string
        {
            ob_start();
        ?>
    <tbody id="todoitems">
      <?php foreach ($tasks as $task): ?>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
          <td class="px-6 py-4"><?php echo htmlspecialchars($task['id']) ?></td>
          <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo htmlspecialchars($task['task_name']) ?></td>
          <td class="px-6 py-4">
            <a hx-get="/task?action=edit&id=<?php echo urlencode($task['id']) ?>" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Edit</a>
          </td>
          <td class="px-6 py-4">
            <a hx-get="/task?action=delete&id=<?php echo urlencode($task['id']) ?>" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</a>
          </td>
          <td class="px-6 py-4">
            <a hx-get="/task?action=mark&id=<?php echo urlencode($task['id']) ?>" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">$task['status'])</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    <?php
        return ob_get_clean();
            }
    }
