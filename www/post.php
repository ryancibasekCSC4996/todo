<?php
    class InsertObject{
      private $connection;
      private $task = "", $description = "", $priority = "";

      public function __construct($t, $d, $p){
        $this->connection = mysqli_connect("127.0.0.1", "root", "", "todo");

        if(!$this->connection){
            echo "Connection failed!!!";
        }

        $this->task = $t;
        $this->description = $d;
        $this->priority = $p;
      }

      public function __destruct(){

      }

      public function pushToDatabase(){
        $pushReqDescription = mysqli_query($this->connection, "INSERT INTO `description` (`desc_id`, `description`) VALUES (NULL, '$this->description')");
        $rowDesc = mysqli_query($this->connection, "SELECT MAX(desc_id) FROM description");
        $resultDesc = mysqli_fetch_row($rowDesc);
        $foreignKeyDesc = $resultDesc[0];

        $pushReqPriority = mysqli_query($this->connection, "INSERT INTO `priority` (`priority_id`, `priority`) VALUES (NULL, '$this->priority')");
        $rowPriority = mysqli_query($this->connection, "SELECT MAX(priority_id) FROM priority");
        $resultPriority = mysqli_fetch_row($rowPriority);
        $foreignKeyPriority = $resultPriority[0];

        $pushReqTask = mysqli_query($this->connection, "INSERT INTO `task` (`task_id`, `taskname`, `descriptionid`, `priorityid`) VALUES (NULL, '$this->task', '$foreignKeyDesc', '$foreignKeyPriority')");

        if($pushReqDescription && $pushReqPriority && $pushReqTask == TRUE){
            echo "Task added successfully!";
            echo "<br>";
            echo "Redirecting in 2 seconds...";
        }else{
            echo "Task failed to be added!!!";
            echo "<br>";
            echo "Redirecting in 2 seconds...";
        }
      }
    }

    $strTask = $_POST['Task'];
    $strDescript = $_POST['Description'];
    $strPriority = $_POST['Priority'];

    $insert = new InsertObject($strTask, $strDescript, $strPriority);
    $insert->pushToDatabase();

    header("refresh:2;url=index.php");
?>
