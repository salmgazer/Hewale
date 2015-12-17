<?php session_start();

/**
 *@author comfort tenjier
 */

include_once('../models/model_user.php');
include_once('../models/task_function.php');

//create instances
$task = new task();

//function update a task assigned to a nurse

function updatetask()
{
    if(isset($_SESSION['admin_id']) && isset($_SESSION['task_id']))
    {
        $task = new task();
        $desc = $_REQUEST['desc'];
        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];
        $row = $task->addtask($desc, $start, $end);
        if(!$row){
            echo '{"result": 0, "message": "Task was not updated"}';
            return;
        }
        echo '{"result": 1, "message": "Task has been updated"}';
        return;
    }
    echo '{"result": 2, "message": "You need to first login"}';
    return;

}

?>