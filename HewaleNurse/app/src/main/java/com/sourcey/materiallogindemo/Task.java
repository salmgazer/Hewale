package com.sourcey.materiallogindemo;

/**
 * Created by Salifu on 12/17/2015.
 */
public class Task {
    public int h_task_id;
    public int nurse_id;
    public int admin_id;
    public String description;
    public String start_time;
    public String end_time;
    public String h_task_status;
    public String request_completion;

    /**
     * @param h_task_id
     * @param nurse_id
     * @param admin_id
     * @param description
     * @param start_time
     * @param end_time
     * @param h_task_status
     */
    public Task(int h_task_id, int nurse_id, int admin_id, String description, String start_time, String end_time, String h_task_status, String request_completion){
        this.h_task_id = h_task_id;
        this.nurse_id = nurse_id;
        this.admin_id = admin_id;
        this.description = description;
        this.start_time = start_time;
        this.end_time = end_time;
        this.h_task_status = h_task_status;
        this.request_completion = request_completion;
    }
}
