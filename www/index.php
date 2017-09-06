<html>
	<head>
		<title>
			Todo Lists
		</title>
	</head>
	<body>
		<input type = "button" onclick="location.href='\add-item.php'" value = "Add Item">
		<br>

		<?php

			class Task{
				private $taskname = '';
				private $taskid, $description, $priority;

				public function __construct($tI, $tN, $desc, $pR){
					$this->taskid = $tI;
					$this->taskname = $tN;
					$this->description = $desc;
					$this->priority = $pR;
				}

				public function __destruct(){

				}

				public function printTable(){
					echo "<table border = 1>".PHP_EOL;
					echo "<tr><th>Task</th><td>".$this->taskname."</td></tr>";
					echo "<tr><th>Description</th><td>".$this->description."</td></tr>";
					echo "<tr><th>Priority</th><td>".$this->priority."</td></tr>";
					echo "</table>".PHP_EOL;

					echo "<form action='delete.php' method='post'>";
					echo "<button name='deleteNum' type='submit' value='".$this->taskid."'>Delete</button>";
					echo "</form>";
				}
			}

			$connection = mysqli_connect("127.0.0.1", "root", "", "todo");

			$task = mysqli_query($connection, "SELECT * FROM  task");
			$counter = 0;
			while($row = $task->fetch_assoc()){
				$counter++;
				$taskContent = $row['taskname'];
				$indexValue = $row['task_id'];
				$descValue = $row['descriptionid'];
				$priorityValue = $row['priorityid'];

				$desc = mysqli_query($connection, "SELECT description FROM description WHERE desc_id = $descValue");
				$resultDescr = mysqli_fetch_row($desc);
				$descContent = $resultDescr[0];

				$priority = mysqli_query($connection, "SELECT priority FROM priority WHERE priority_id = $priorityValue");
				$resultPriority = mysqli_fetch_row($priority);
				$priorityContent = $resultPriority[0];

				$newTask = new Task($indexValue, $taskContent, $descContent, $priorityContent);
				$newTask->printTable();
			}
		?>
	<form action="delete.php">
	</form>
	</body>
</html>
