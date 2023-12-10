<?php
    if(isset($_GET['taskId'])){
        require '../db/database.php';
        $task_id = $_GET['taskId'];
        if(!empty($task_id)){
            $query = "SELECT todo_id,task_complete FROM todos WHERE todo_id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':id',$task_id);
            $statement->execute();
            
            $task = $statement->fetch();
            if($task > 0){
                $id = $task['todo_id'];
                $completed = $task['task_complete'];

                $checked = $completed ? 0 : 1;

                $sql = "UPDATE todos SET task_complete=:checked WHERE todo_id =:id";
                $stm = $db->prepare($sql);
                $values = array(
                    array(':checked',$checked),
                    array(':id',$id)
                );
                foreach($values as $value){
                    $stm->bindValue($value[0],$value[1]);
                }
                $result = $stm->execute();
                $stm->closeCursor();
                if($result){
                    header("Location: ../view/index.php");
                }
            
            }
            $db = null;
            exit();
        }else{
            header("Location: ../view/index.php");
        }
    }