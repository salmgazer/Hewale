<?php session_start();

/**
 *@author comfort tenjier
 */
if(!isset($_REQUEST['cmd']))
{
    echo '{"result":0,message:"unknown command"}';
    exit();
}
$cmd=$_REQUEST['cmd'];
switch($cmd) {
    case 1:
        addtask();
        break;
    case 2:
        removetask();
        break;
    case 3:
       updatetask();
        break;
    default:
        echo '{"result":0, message:"unknown command"}';
        break;

}


include_once('../models/model_user.php');
include_once('../models/task_function.php');
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


//function update a task assigned to a nurse
function updatetask()
{
    if(isset($_SESSION['admin_id']) && isset($_SESSION['task_id']))
    {
        $tasks = new tasks();
        $desc = $_REQUEST['desc'];
        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];
        $row = $tasks->addtask($desc, $start, $end);
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