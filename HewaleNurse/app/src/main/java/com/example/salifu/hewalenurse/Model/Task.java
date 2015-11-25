package com.example.salifu.hewalenurse.Model;

/**
 * Created by Salifu on 11/24/2015.
 */
public class Task {
    public String task_details;
    public String task_summary;
    public String date_assigned;
    public String deadline;

    public Task(String task_details, String task_summary, String date_assigned, String deadline){
        this.task_details = task_details;
        this.task_summary = task_summary;
        this.date_assigned = date_assigned;
        this.deadline = deadline;
    }

}
