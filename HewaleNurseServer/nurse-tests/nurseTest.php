<?php

/**
 * Created by PhpStorm.
 * User: Salifu
 * Date: 12/15/2015
 * Time: 10:18 AM
 */

include "../model/nurse.php";

class nurseTest extends PHPUnit_Framework_TestCase
{
    var $nurse;

    /**
     *This function tests if nurse details can be retrieved with nurse_id
     * Returns false if nurse id is not found in database
     * Returns array of nurse details of the particular id
     */
    public function  testCanGetNurseDetails(){
        $nurse = new nurse();

        $details = $nurse->getNurseDetails(23);

        $this->assertFalse($details);
    }

    /**
     *This function tests if nurse can view her tasks once her id is sent to the database
     * Returns false if id of nurse does not exist
     * Returns array of all tasks of a nurse with the particular nurse id
     */
    public  function  testCanNurseViewTasks(){
        $nurse = new nurse();

        $tasks = $nurse->viewTasks(1);

        $this->assertFalse($tasks);
    }

    /**
     *This function tests if details of a task can be retrieved once the id of the task is sent to databse
     * Returns false id task with such id does not exist
     * Returns array of details of the particular task when id exists
     */
    public function testCanGetTaskById(){
        $nurse = new nurse();

        $task = $nurse->getTaskDetailsById(1);

        $this->assertFalse($task);
    }

    /**
     *This function tests if comments of a particular task can be retrieved once id of task is submitted
     * Returns false when if of task does not exist
     * Returns array of details
     */
    public function testCanGetTaskComments(){
        $nurse = new nurse();

        $comments = $nurse->getTaskComments(1);

        $this->assertFalse($comments);
    }

    /**
     *This function tests if comment can be added by a nurse
     * Returns true if comment is added successfully
     * Returns false if comment is not added
     */
    public function testCanAddComment(){
        $nurse = new nurse();

        $comment = $nurse->addComment(1, "I need some help on site");

        $this->assertTrue($comment);
    }

    /**
     * This function tests if nurse can request completion
     * Returns true id nurse is able to request completion of a task
     */
    public function  testCanRequestCompletion(){
        $nurse = new nurse();

        $request = $nurse->requestCompletion(1);

        $this->assertFalse($request);
    }


}

