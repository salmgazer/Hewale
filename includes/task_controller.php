
<?php session_start();

include_once('../models/model_task.php');
include_once('../models/model_user.php');

//create instances
$task = new task();


//function to assgin a new task to a nurse
function addtask(){
    if(isset($_SESSION['admin_id']) && isset($_SESSION['nurse_id'])){
        /*include('../models/model_task.php');*/
        $task = new task();

        $nurse_id = $_REQUEST['nid'];
        $task_id = $_SESSION['aid'];
        $desc = $_REQUEST['desc'];
        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];
        $row = $task->addtask( $task_id, $nurse_id, $desc, $start, $end);
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
function removetask(){
    if(isset($_SESSION['admin_id'])){
        $task_id = $_REQUEST['task_id'];
        /*include('../models/model_task.php');*/
        $task = new task();
        $row = $task->removetask($task_id);
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
