<?php
    class DeleteObject{
      private $connection;

      public function __construct(){
          $this->connection = mysqli_connect("127.0.0.1", "root", "", "todo");

          if(!$this->connection){
              echo "Connection failed!!!";
          }
      }

      public function __destruct(){

      }

      public function popFromDatabase($taskNum){
        $taskQuery = mysqli_query($this->connection, "SELECT descriptionid, priorityid FROM task WHERE task_id = $taskNum");
        $queryResults = mysqli_fetch_row($taskQuery);

        $descID = $queryResults[0];
        $priorityID = $queryResults[1];

        $delStatusTask = mysqli_query($this->connection, "DELETE FROM task WHERE task_id = $taskNum");
        $delStatusDesc = mysqli_query($this->connection, "DELETE FROM description WHERE desc_id = $descID");
        $delStatusPriority = mysqli_query($this->connection, "DELETE FROM priority WHERE priority_id = $priorityID");

        if($delStatusDesc && $delStatusPriority && $delStatusTask == TRUE){
            echo "Task successfully deleted!!!";
            echo "<br>";
            echo "Redirecting in 2 seconds...";
        }else{
            echo "Task failed to be deleted!!!";
            echo "<br>";
            echo "Redirecting in 2 seconds...";
        }
      }

    }
    $taskID = $_POST['deleteNum'];

    $delete = new DeleteObject();
    $delete->popFromDatabase($taskID);

    header("refresh:2;url=index.php");
?>
