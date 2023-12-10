<?php
    include('../db/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do app in php</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/app.js" defer></script>
</head>
<body>
    <main>
        <section class="left__side">
            <h2>TO Do List</h2>
            <small>help you to track your tasks</small>
            <div class="navigations">
                <ul>
                    <li class="allTask"><i class="fa-solid fa-infinity"></i> All tasks</li>
                    <li class="complete"><i class="fa-solid fa-circle-check"></i> Completed tasks </li>
                    <li class="incomplete"><i class="fa-solid fa-list-check"></i> Tasks</li>
                    <li class="feedback"><i class="fa-regular fa-star"></i> Feedback</li>
                </ul>
            </div>
        </section>
        <section class="right__side">
            <form action="../controllers/addTask.php" method="POST" autocomplete="off">
                    <?php 
                    if(isset($_GET['message']) and $_GET['message'] == 'error'){ ?>
                        <div style="border: 2px solid red;">
                            <input type="text" name="task"  placeholder="create task you want to complete....">
                            <button type="submit" name="submit" value="submit"><i class="fa-solid fa-circle-plus"></i></button>
                        </div>
                        <small style="color: red;margin-left: 10px;">please write something</small>
                    <?php }else{ ?>
                        <div>
                            <input type="text" name="task" placeholder="create task you want to complete....">
                            <button type="submit" name="submit" value="submit"><i class="fa-solid fa-circle-plus"></i></button>
                        </div>
                    <?php } ?>
            </form>
            <div class="tasks">
                <?php
                    if(isset($_GET['query']) and $_GET['query']=='completedTask'){
                        $sql = "SELECT * FROM todos  WHERE task_complete = 1  ORDER BY todo_id DESC";
                    }elseif(isset($_GET['query']) and $_GET['query'] == 'all'){
                        $sql = "SELECT * FROM  todos ORDER BY todo_id DESC";
                    }elseif(isset($_GET['query']) and $_GET['query'] == 'incompletedTask'){
                        $sql = "SELECT * FROM  todos  WHERE task_complete = 0 ORDER BY todo_id DESC";
                    }else{
                        $sql = "SELECT * FROM  todos ORDER BY todo_id DESC";
                    }

                    $stm = $db->prepare($sql);
                    $stm->execute();
                    $tasks = $stm->fetchAll();

                    if(count($tasks) < 1){ ?>
                        <h2>No task found</h2> 

                    <?php }else{ ?>
                        <div class="tasks__items">
                            <?php
                            foreach( $tasks as $task){ 
                                if($task['task_complete']){ ?>
                                    <div class="todo__item">
                                        <div>
                                            <input type="checkbox" class="check" checked id="<?php echo $task['todo_id'] ?>">
                                            <h2  style="text-decoration: line-through;"><?php echo $task['task'] ?></h2>
                                            <span class="delete" id="<?php echo $task['todo_id'] ?>"><i class="fa-solid fa-trash-can"></i></span>
                                        </div>
                                        <small>Created on <?php echo $task['added_time'] ?></small>
                                    </div>
                                <?php }else{ ?>
                                    <div class="todo__item">
                                        <div>
                                            <input type="checkbox" class="check" id="<?php echo $task['todo_id'] ?>">
                                            <h2><?php echo $task['task'] ?></h2>
                                            <span class="delete" id="<?php echo $task['todo_id'] ?>"><i class="fa-solid fa-trash-can"></i></span>
                                        </div>
                                        <small>Created on <?php echo $task['added_time'] ?></small>
                                    </div>
                                    <?php }?>

                                <?php } ?>
                        </div> <?php } ?>

            </div>
            
        </section>
    </main>
</body>
</html>

<?php

 