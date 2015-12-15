<?php session_start();

/**
 *@author comfort tenjier
 */

include_once('../models/model_user.php');
include_once('../models/task_function.php');
//create instances
$tasks = new tasks();


//function to remove a task from a list a list of tasks
function removetask()
{

    if(isset($_SESSION['admin_id']))
    {
        $task_id = $_REQUEST['task_id'];

        $tasks = new tasks();
        $row = $tasks->removetask($task_id);
        if(!$row){
            echo '{"result": 0, "message": "Unable to remove task, try again later"}';
            return;
        }
        echo '{"result": 1, "message": "task has been removed successfully"}';
        return;
    }
    echo '{"result": 2, "message": "You need to first login"}';
    return;
}


?>