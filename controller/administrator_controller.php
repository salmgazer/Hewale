<?php 

/**
*@author William Annoh
*/

session_start();

if(!isset($_REQUEST['cmd'])){
    echo '{"result":0,"message":"unknown command"}';
    exit();
}

$cmd=$_REQUEST['cmd'];
switch($cmd) {

	case 1:
	addComment();
	break;
	case 2:
	delComment();
	break;
	case 3:
	viewComment();
	break;

	default:
        echo '{"result":0, "message":"unknown command"}';
        break;
}
/**
    *This function adds a comment
    *
    *@param int task_id ID of the comment to be added
    *@param string message inputs the content of the comment 
    */
function addComment(){
	if(!isset($_REQUEST['task_id']) || !isset($_REQUEST['message'])){
    echo '{"result": 2, "message": "Function parameters not set"}';
    return;
	}
    
        $comment = new comments ();
        $task_id = $_REQUEST['task_id'];
        $message = $_REQUEST['message'];

        if(!$task->addComment($task_id, $message)){
            echo '{"result": 0, "message": "Comment was not added"}';
            return;
        }
        echo '{"result": 1, "message": "Comment has been added"}';
        return;
}
/**
    *This method deletes a comment
    *
    *@param int id ID of the comment to be deleted 
    */
function delComment(){
if(isset($_REQUEST['comment_id'])){
    $comment_id = $_REQUEST['comment_id'];
    $comment = new comments();
    if(!$comments->removeComment($comment_id)){
        echo '{"result": 0, "message": "Unable to remove comment, try again later"}';
        return;
    }
    echo '{"result": 1, "message": "Comment has been removed successfully"}';
    return;
}
    echo '{"result": 2, "message": "Function parameters not set"}';
    return;
}


 ?>