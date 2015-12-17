<?php

if(!isset($_REQUEST['cmd'])){
  echo '{"result": 0, "message": "Command unknown"}';
  return;
}

$cmd = $_REQUEST['cmd'];

switch($cmd){

    case 1:
        mobileLogin();
        break;
    case 2:
        viewTasks();
        break;
    case 3:
        getTaskDetailsById();
        break;
    case 4:
        getTaskComments();
        break;
    case 5:
        addComment();
        break;
    case 6:
        requestCompletion();
        break;

    default:
        echo '{"result":0, "message": "Command unknwown"}';
        break;
}

/* All Nurse functions */

/**
 * Login function for nurses
 * Returns nurse details if login is successful
 */
function mobileLogin(){
    include_once "../model/nurse.php";
    $nurse = new nurse();

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $details = $nurse->mobileLogin($email,$password);
    if(!$details){
        echo '{"result":0, "message": "Wrong details"}';
        return;
    }
    echo '{"result":1, "nurse": [';
    echo json_encode($details);
    echo "]}";
    return;
}

/**
 * Returns all tasks assigned to a nurse
 */
function viewTasks(){

    include_once "../model/nurse.php";
    $nurse = new nurse();
    $nurse_id = $_REQUEST['nurse_id'];

    $tasks = $nurse->viewTasks(nurse_id);
    if(!$tasks){
        echo '{"result":0, "message": "No tasks"}';
        return;
    }
    echo '{"result":1, "tasks": [';
    while($tasks){
        echo json_encode($tasks);
        $tasks = $nurse->fetch();
        if($tasks){
            echo ",";
        }
    }
    echo "]}";
}

/**
 * Returns details of a particular task
 */
function getTaskDetailsById(){

    include_once "../model/nurse.php";
    $nurse = new nurse();
    $task_id = $_REQUEST['h_task_id'];

    $task = $nurse->getTaskDetailsById($task_id);
    if(!$task){
        echo '{"result":0, "message": "Could not get details"}';
        return;
    }
    echo '{"result":1, "task":[';
    echo json_encode($task);
    echo ']}';
    return;
}

/**
 * Returns all comments under a task
 */
function getTaskComments(){
    include_once "../model/nurse.php";
    $nurse = new nurse();
    $task_id = $_REQUEST['h_task_id'];

    $comments = $nurse->getTaskComments($task_id);
    if(!$comments){
        echo '{"result":0, "message": "No comments"}';
        return;
    }
    echo '{"result":1, "comments": [';
    while($comments){
        echo json_encode($comments);
        $comments = $nurse->fetch();
        if($comments){
            echo ",";
        }
    }
    echo "]}";
}

/**
 * Nurse uses this function to add new comment to a task
 */
function addComment(){
    include_once "../model/nurse.php";
    $nurse = new nurse();

    $task_id = $_REQUEST['h_task_id'];
    $message = $_REQUEST['message'];
    if(!$nurse->addComment($task_id, $message)){
        echo '{"result":0, "message": "Could not add comment"}';
        return;
    }
    echo '{"result":1, "message": "comment has been added"}';
    return;
}

/**
 * Nurse uses this function to request completion of a task
 */
function requestCompletion(){
    include_once "../model/nurse.php";
    $nurse = new nurse();

    $task_id = $_REQUEST['h_task_id'];

    if(!$nurse->requestCompletion($task_id)){
        echo '{"result":0, "message": "Could not request"}';
        return;
    }
    echo '{"result":1, "message": "Requested completion"}';
    return;
}
 ?>
