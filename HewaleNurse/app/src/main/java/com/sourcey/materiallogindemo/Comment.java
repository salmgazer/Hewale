package com.sourcey.materiallogindemo;

/**
 * Created by Salifu on 12/17/2015.
 */
public class Comment {

    public String message;
    public String sent_time;
    public String sent_by;

    public Comment(String message, String sent_time, String sent_by){
        this.message = message;
        this.sent_time = sent_time;
        this.sent_by = sent_by;
    }
}
