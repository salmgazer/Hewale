
<?php session_start();

include_once('../models/model_task.php');
include_once('../models/model_user.php');

//create instances
$task = new task();


//function to assgin a new task to a nurse
function addTask(){
    if(isset($_SESSION['admin_id']) && isset($_SESSION['hospital_id'])){
        include('../models/model_task.php');
        $task = new task();
        $desc = $_REQUEST['desc'];
        $summ = $_REQUEST['summ'];
        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];
        $nurse_id = $_REQUEST['nurse_id'];
        $admin_id = $_SESSION['admin_id'];

        $row = $task->addtask($desc, $summ, $admin_id, $nurse_id, $start, $end);
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
