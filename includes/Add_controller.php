<?php session_start();

/**
 *@author comfort tenjier
 */

include_once('../models/model_user.php');
include_once('../models/Admin_add_task.php');
//create instances
$tasks = new tasks();

//function to assgin a new task to a nurse
function addtask()
{
    if(isset($_SESSION['admin_id']) && isset($_SESSION['task_id']))
    {
        $tasks = new tasks();
        $task_id = $_REQUEST['nid'];
        $admin_id = $_SESSION['aid'];
        $desc = $_REQUEST['desc'];
        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];
        $row = $tasks->addtask( $task_id, $admin_id, $desc, $start, $end);
        if(!$row){
            echo '{"result": 0, "message": "Task was not added"}';
            return;
        }
        echo '{"result": 1, "message": "Task has been added"}';
        return;
    }
    echo '{"result": 2, "message": "You need to first login"}';
    return;
}


?>