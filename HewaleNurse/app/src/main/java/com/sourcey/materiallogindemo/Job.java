package com.sourcey.materiallogindemo;

/**
 * Created by Salifu on 12/6/2015.
 */
public class Job {
    public int job_id;
    public String summary;
    public String date_added;
    public double starting_price;
    public String description;

    public Job(int job_id, String summary, String date_added, double starting_price, String description){
        this.job_id = job_id;
        this.summary = summary;
        this.date_added = date_added;
        this.starting_price = starting_price;
        this.description = description;
    }
}
