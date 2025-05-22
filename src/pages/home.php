<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To DO</title>
  <style>
    body {
      min-height: 100vh;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://unpkg.com/htmx.org@2.0.4"></script>
</head>
<body class="flex flex-col justify-center items-center bg-white px-8 pt-6 pb-8">
  <form hx-post="/addtask" hx-target="#todoitems" hx-swap="beforeend" hx-reset-on-success class="flex gap-4 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8">
    <input type="text" name="task" placeholder="Write a Task..." required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add</button>
  </form>

  <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">Sl No.</th>
          <th scope="col" class="px-6 py-3">Task</th>
          <th scope="col" class="px-6 py-3">Edit</th>
          <th scope="col" class="px-6 py-3">Delete</th>
          <th scope="col" class="px-6 py-3">Mark</th>
        </tr>
      </thead>
      <tbody id="todoitems">
        <?php foreach ($tasks as $task): ?>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200" id="singleitem">
            <td class="px-6 py-4"><?php echo htmlspecialchars($task['id']) ?></td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo htmlspecialchars($task['task_name']) ?></td>
            <td class="px-6 py-4">
            <a hx-get="/task?action=showedit&id=<?php echo urlencode($task['id']) ?>"
   hx-target="closest tr"
   hx-swap="outerHTML"
   class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
   Edit
</a>
            </td>
            <td class="px-6 py-4">
              <a hx-get="/task?action=delete&id=<?php echo urlencode($task['id']) ?>" hx-target="closest tr"
              hx-swap="outerHTML"
              class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</a>
            </td>
            <td class="px-6 py-4">
              <span id="mark-button-<?php echo $task['id']?>" hx-get="/task?action=mark&id=<?php echo $task['id']?>" hx-swap="outerHTML">
  <a class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">Done</a>
</span>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
