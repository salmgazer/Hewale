package com.sourcey.materiallogindemo;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.List;

public class TaskDetails extends AppCompatActivity {

    public int h_task_id;
    public int nurse_id;
    public int admin_id;
    public String h_email;
    public String h_password;
    public String h_account_id;
    public String h_fullname;
    public String description;
    public String start_time;
    public String end_time;
    public String h_task_status;
    public String request_completion;

    public static RecyclerView cycler;
    public CommentsAdapter adapter;
    public List<Comment> comments;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_task_details);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        setTitle("Task Details");

        Intent intent = this.getIntent();
        if(intent.hasExtra("h_fullname")){
            h_email = intent.getExtras().getString("h_email");
            h_password = intent.getExtras().getString("h_password");
            h_account_id = intent.getExtras().getString("h_account_id");
            h_fullname = intent.getExtras().getString("h_fullname");
            h_task_id = intent.getExtras().getInt("h_task_id");
            h_task_status = intent.getExtras().getString("h_task_status");
            description = intent.getExtras().getString("description");
            start_time = intent.getExtras().getString("start_time");
            end_time = intent.getExtras().getString("end_time");
            request_completion = intent.getExtras().getString("request_completion");
            admin_id = intent.getExtras().getInt("admin_id");
            nurse_id = intent.getExtras().getInt("nurse_id");

            TextView username_area = (TextView) findViewById(R.id.fullname_area);
            TextView st = (TextView) findViewById(R.id.start_time);
            TextView et = (TextView) findViewById(R.id.end_time);
            TextView description_area = (TextView) findViewById(R.id.description);

            username_area.setText(this.h_fullname);
            description_area.setText(description);
            st.setText("Started:  "+start_time);
            et.setText("Deadline:  "+end_time);

            final ProgressDialog progressDialog = new ProgressDialog(this,
                    R.style.AppTheme_Dark_Dialog);
            progressDialog.setIndeterminate(true);
            progressDialog.setMessage("Loading comments...");
            progressDialog.show();
            populateComments();
            new android.os.Handler().postDelayed(
                    new Runnable() {
                        public void run() {
                            // On complete call either onLoginSuccess or onLoginFailed
                            //onLoginSuccess();
                            // onLoginFailed();
                            progressDialog.dismiss();
                        }
                    }, 1000);
        }
        else{
           // username_area.setText("no username");
        }
    }

    public void populateComments(){
        // Initialize recycler view
        cycler = (RecyclerView) findViewById(R.id.mycomments);
        cycler.setLayoutManager(new LinearLayoutManager(this));
        comments = new ArrayList<>();
        Controller mycontrol = new Controller();
        String url = "4&h_task_id="+h_task_id;
        String cmd = "comments";
        mycontrol.execute(cmd, url);

        final ProgressDialog progressDialog = new ProgressDialog(this,
                R.style.AppTheme_Dark_Dialog);
        progressDialog.setIndeterminate(true);
        progressDialog.setMessage("Loading your tasks...");
        progressDialog.show();
        //get jobs
        comments = mycontrol.comments;
        adapter = new CommentsAdapter(comments, this);
        cycler.setAdapter(adapter);
        new android.os.Handler().postDelayed(
                new Runnable() {
                    public void run() {
                        progressDialog.dismiss();
                    }
                }, 1000);
    }

    public void addComment(View view){
        EditText messageBox = (EditText) findViewById(R.id.comment_box);
        String message = messageBox.getText().toString();
        if(message.length() == 0){
            Toast.makeText(this, "Please enter commment", Toast.LENGTH_LONG).show();
            return;
        }
        String sendmes = message.replace(" ", "%20");
        Controller mycontrol = new Controller();
        String cmd = "addComment";
        String url = "5&message="+sendmes+"&h_task_id="+h_task_id;
        String res = "";
        try {
            try {
                res = mycontrol.execute(cmd, url).get().toString();
            }catch (java.lang.InterruptedException m){
            }
        }catch (java.util.concurrent.ExecutionException e){
        }
        try {
            Thread.sleep(1000);                 //1000 milliseconds is one second.
        } catch(InterruptedException ex) {
            Thread.currentThread().interrupt();
        }
        System.out.println(res);
        if(res.equals("0")){
            Toast.makeText(this, "Could not add comment.", Toast.LENGTH_LONG).show();
        }else if(res.equals("1")) {
            Comment com = new Comment(message, "just now", "me");
            this.comments.add(com);
            adapter.notifyItemInserted(mycontrol.comments.size() - 1);
            Toast.makeText(this, "Comment has been added.", Toast.LENGTH_LONG).show();
        }
    }


}
