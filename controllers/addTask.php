<?php
       if(isset($_POST['submit']) and isset($_POST['task'])){
            require '../db/database.php';
            $task = $_POST['task'];

            if(empty($task)){
                header("Location: ../view/index.php?message=error");
            }else{

            $query = "INSERT INTO todos(task) VALUES(:task)";
            $statement = $db->prepare($query);
            $statement->bindValue(':task',$task);
            $result = $statement->execute();
            $statement->closeCursor();
            if($result){
                header("Location: ../view/index.php?taskAdded=sucess");
            }else{
                header("Location: ../view/index.php");
            }
            $db = null;
            exit();
            }
       }else{
            header("Location: ../view/index.php?message=error");
       }
    