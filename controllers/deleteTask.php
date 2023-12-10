<?php
    if(isset($_GET['taskId'])){
        $task_id = $_GET['taskId'];
        require '../db/database.php';
        $query = "DELETE FROM todos WHERE todo_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id',$task_id);
        $result = $statement->execute();
        $statement->closeCursor();
        if($result){
            header("Location: ../view/index.php");
        }
    }else{
        header('Location: ../view/index.php?message=error');
    }