USE example_db;

CREATE TABLE tasks (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  task_name VARCHAR(255) NOT NULL,
  created_time DATETIME DEFAULT CURRENT_TIMESTAMP,
  status ENUM('todo', 'done') NOT NULL
);
