<?php session_start();


if(!isset($_REQUEST['cmd'])){
    echo '{"result":0,message:"unknown command"}';
    exit();
}
$cmd=$_REQUEST['cmd'];
switch($cmd) {
    case 1:
        login();
        break;
    case 2:
        getAllNurseTasks();
        break;
    case 3:
        getAllNurseSpecTasks();
        break;
    case 4:
        getAllAdminTasks();
        break;
    case 5:
        getAllAdminSpecTasks();
        break;
    case 6:
        find_task();
        break;
    case 7:
        getAllHospitals();
        break;
    case 8:
        addNurse();
        break;
    case 9:
        getAllNurses();
        break;
    case 10:
        addTask();
        break;
    case 11:
        accept_completion();
        break;
    case 12:
        reject_completion();
        break;
    case 13:
        register();
        break;
    case 14:
        logout();
        break;
    case 15:
        removeNurse();
        break;
    default:
        echo '{"result":0, message:"unknown command"}';
        break;

}

/**
 * login for both nurse and admin
 */
function login(){
    $user_type = $_REQUEST['user_type'];
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    if($user_type == 'admin'){
        include('../models/model_admin.php');
        $admin = new admin();
        $row = $admin->login($username, $password);
        if(!$row){
            echo '{"result":0,"message": "Your details as an admin are wrong."}';
            return;
        }
        set_admin_session($row);
        echo '{"result":1,"message": "'.$_SESSION['admin_fn'].' is logged in"}';
        return;

    }elseif($user_type == 'nurse'){
        include('../models/model_nurse.php');
        $nurse = new nurse();
        $row = $nurse->login($username, $password);
        if(!$row){
            echo '{"result":0,"message": "Your details as a nurse are wrong."}';
            return;
        }
        set_nurse_session($row);
        echo '{"result":1,"message": "'.$_SESSION['nurse_name'].' is logged in"}';
        return;
    }
}

/**
 * Get all nurse tasks
 */
function getAllNurseTasks()
{
    if (isset($_SESSION['nurse_id'])) {
        $nurse_id = $_SESSION['nurse_id'];
        include('../models/model_task.php');
        $task = new task();
        $row = $task->getAllNurseTasks($nurse_id);
        if (!$row) {
            echo '{"result":0,"message": "No tasks as at now."}';
            return;
        }
        echo '{"result":1,"tasks":[';
        while ($row) {
            echo json_encode($row);
            $row = $task->fetch();
            if ($row) {
                echo ",";
            }
        }
        echo "]}";
        return;
    }
    echo '{"result":2,"message": "You need to login first."}';
    return;
}

//Get a nurse tasks based on specific status
function getAllNurseSpecTasks(){
    if (isset($_SESSION['nurse_id'])) {
        $nurse_id = $_SESSION['nurse_id'];
        $task_status = $_REQUEST['status'];

        include('../models/model_task.php');
        $task = new task();
        $row = $task->getAllNurseSpecTasks($nurse_id, $task_status);
        if (!$row) {
            echo '{"result":0,"message": "No tasks as at now."}';
            return;
        }
        echo '{"result":1,"tasks":[';
        while ($row) {
            echo json_encode($row);
            $row = $task->fetch();
            if ($row) {
                echo ",";
            }
        }
        echo "]}";
        return;
    }
    echo '{"result":2,"message": "You need to login first."}';
    return;
}

//Get all tasks assigned by admin
function getAllAdminTasks(){
    if (isset($_SESSION['admin_id'])) {
        $admin_id = $_SESSION['admin_id'];
        include('../models/model_task.php');
        $task = new task();
        $row = $task->getAllAdminTasks($admin_id);
        if (!$row) {
            echo '{"result":0,"message": "No tasks set by you."}';
            return;
        }
        echo '{"result":1,"tasks":[';
        while ($row) {
            echo json_encode($row);
            $row = $task->fetch();
            if ($row) {
                echo ",";
            }
        }
        echo "]}";
        return;
    }
    echo '{"result":2,"message": "You need to login first."}';
    return;
}

//Get all tasks assigned by admin based on specific status
function getAllAdminSpecTasks()
{
    if (isset($_SESSION['admin_id'])) {
        $admin_id = $_SESSION['admin_id'];
        $task_status = $_REQUEST['task_status'];
        include('../models/model_task.php');
        $task = new task();
        $row = $task->getAllAdminSpecTasks($admin_id, $task_status);
        if (!$row) {
            echo '{"result":0,"message": "No tasks set by you."}';
            return;
        }
        echo '{"result":1,"tasks":[';
        while ($row) {
            echo json_encode($row);
            $row = $task->fetch();
            if ($row) {
                echo ",";
            }
        }
        echo "]}";
        return;
    }
    echo '{"result":2,"message": "You need to login first."}';
    return;
}

//function to accept completion of a task
function accept_completion(){
    if(isset($_SESSION[admin_id])){
        $task_id = $_REQUEST['task_id'];
        include('../models/model_task.php');
        $task = new task();
        $row = $task->accept_completion($task_id);
        if(!$row){
            echo '{"result":0,"message": "Could not accept completion of this task, try again."}';
            return;
        }
        echo '{"result":1,"message": "Completion of task has been successfully accepted."}';
        return;
    }
    echo '{"result":2,"message": "You need to first login!"}';
    return;
}

//function to reject completion of a task
function reject_completion(){
    if(isset($_SESSION[admin_id])){
        $task_id = $_REQUEST['task_id'];
        include('../models/model_task.php');
        $task = new task();
        $row = $task->reject_completion($task_id);
        if(!$row){
            echo '{"result":0,"message": "Could not reject completion of this task, try again."}';
            return;
        }
        echo '{"result":1,"message": "Completion of task has been successfully rejected."}';
        return;
    }
    echo '{"result":2,"message": "You need to first login!"}';
    return;
}

//function to get list of all hospitals
function getAllHospitals(){
    include('../models/hospital.php');
    $hospital = new hospital();
    $row = $hospital->getAllHospitals();
    if(!$row){
        echo '{"result":0,"message": "No hospitals."}';
        return;
    }
    echo '{"result":1,"hospitals":[';
    while ($row) {
        echo json_encode($row);
        $row = $hospital->fetch();
        if ($row) {
            echo ",";
        }
    }
    echo "]}";
    return;
}

//function to get all nurses of a hospital
function getAllNurses(){
    if(isset($_SESSION['admin_id']) && isset($_SESSION['hospital_id'])){
        $nurse_status = $_REQUEST['nurse_status'];
    include('../models/model_nurse.php');
    $nurse = new nurse();
    $hid = $_SESSION['hospital_id'];
    $row = $nurse->getAllNurses($hid, $nurse_status);
    if(!$row){
        echo '{"result":0,"message": "No nurses."}';
        return;
    }
    echo '{"result":1,"nurses":[';
    while ($row) {
        echo json_encode($row);
        $row = $nurse->fetch();
        if ($row) {
            echo ",";
        }
    }
    echo "]}";
    return;
}
echo '{"result":2,"message": "You need to log in first."}';
        return;
}

//set nurse sessions
function set_nurse_session($row){
    $_SESSION['nurse_username'] = $row['username'];
    $_SESSION['nurse_pass'] = $row['password'];
    $_SESSION['nurse_name'] = $row['fullname'];
    $_SESSION['user_status'] = $row['status'];
    $_SESSION['nurse_id'] = $row['nurse_id'];
    $_SESSION['hospital_id'] = $row['hospital_id'];
}

//set admin sessions
function set_admin_session($row){
    $_SESSION['admin_username'] = $row['username'];
    $_SESSION['admin_pass'] = $row['password'];
    $_SESSION['admin_fn'] = $row['firstname'];
    $_SESSION['admin_ln'] = $row['lastname'];
    $_SESSION['user_status'] = 'admin';
    $_SESSION['admin_id'] = $row['admin_id'];
    $_SESSION['hospital_id'] = $row['hospital_id'];

}

//function to logout nurse or admin
function logout(){
    if(session_destroy()){
        echo '{"result":1,"message": "Logged out successfully"}';
        return;
    }
    echo '{"result":0,"message": "Could not log you out, try again."}';
    return;
}

//function to get details of a single task by its it
function find_task(){
    if(isset($_SESSION['nurse_id']) || isset($_SESSION['admin_id'])){
        $task_id = $_REQUEST['task_id'];
        $user_type = $_REQUEST['user_type'];
        include('../models/model_task.php');
        $task = new task();
        $row = null;
        if($user_type == 'nurse') {
            $row = $task->nurse_find_task($task_id);
        }elseif($user_type == 'admin'){
            $row = $task->admin_find_task($task_id);
        }
        if (!$row) {
            echo '{"result":0,"message": "No such task."}';
            return;
        }
        echo '{"result":1,"task":[';
        echo json_encode($row);
        echo "]}";
        return;
    }
        echo '{"result":2,"message": "You need to first login."}';
        return;
}

//function to add a new nurse to an admin's hospital
function addNurse(){
    if(isset($_SESSION['admin_id']) && isset($_SESSION['hospital_id'])){
        include('../models/model_nurse.php');
        $nurse = new nurse();
        $name = $_REQUEST['name'];
        $uname = $_REQUEST['uname'];
        $pass = $_REQUEST['pass'];
        $status = $_REQUEST['status'];
        $status1 = "";
        if($status == 1){
            $status1 = 'full time nurse';
        }elseif($status == 2){
            $status1 = 'student intern';
        }
        $hid = $_SESSION['hospital_id'];
        $row = $nurse->add_nurse($name, $uname, $status1, $pass, $hid);
        if(!$row){
            echo '{"result":0,"message": "Sorry, could not add nurse."}';
            return;
        }
        echo '{"result":1,"message": "'.$name.' has been added"}';
        return;
    }
        echo '{"result":2,"message": "You need to first login"}';
        return;

}

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

//function to register a new account
function register(){
    include('../models/hospital.php');
    include('../models/model_admin.php');
    $admin = new admin();
    $hospital = new hospital();

    $phone = $_REQUEST['phone'];
    $hospitalname = $_REQUEST['hospitalname'];
    $location = $_REQUEST['location'];
    $firstname = $_REQUEST['firstname'];
    $lastname = $_REQUEST['lastname'];
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $row1 = $hospital->add_hospital($hospitalname, $location, $phone);
    if(!$row1){
        echo '{"result":0, "message": "Problem adding your hospital, try again"}';
        return;
    }
    $row3 = $hospital->getHospitalId($hospitalname, $location);
    $hospital_id= $row3['hospital_id'];

    $row2 = $admin->add_admin($firstname, $lastname, $username, $password, $hospital_id);
    if(!$row2){
        $hospital->delete_hospital($hospital_id);
        echo '{"result":0, "message": "Problem creating an account. Try again later"}';
        return;

    }
    echo '{"result":1, "message": "You have successfully created an account. Login as admin and add your nurses."}';
        return;

}


//function to remove nurse for current active nurses
function removeNurse(){
if(isset($_SESSION['admin_id'])){
    $nurse_id = $_REQUEST['nurse_id'];
    include('../models/model_nurse.php');
    $nurse = new nurse();
    $row = $nurse->removeNurse($nurse_id);
    if(!$row){
        echo '{"result": 0, "message": "Unable to remove nurse, try again later"}';
        return;
    }
    echo '{"result": 1, "message": "Nurse has been removed successfully"}';
    return;
}
    echo '{"result": 2, "message": "You need to first login"}';
    return;
}




?>
