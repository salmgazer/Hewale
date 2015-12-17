package com.sourcey.materiallogindemo;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.CollapsingToolbarLayout;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

public class JobDetails extends AppCompatActivity {
    String username;
    String password;
    String summary;
    String description;
    double starting_price;
    String date_added;
    int job_id;
    String user_id;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_job_details);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        CollapsingToolbarLayout toolBarLayout = (CollapsingToolbarLayout) findViewById(R.id.toolbar_layout);
        //toolBarLayout.setTitle(getTitle());
        Intent intent = this.getIntent();
        if(intent.hasExtra("username")){
            this.username = intent.getExtras().getString("username");
            this.password = intent.getExtras().getString("password");
            this.summary = intent.getExtras().getString("summary");
            this.job_id = intent.getExtras().getInt("job_id");
            this.description = intent.getExtras().getString("description");
            this.starting_price = intent.getExtras().getDouble("starting_price");
            this.date_added = intent.getExtras().getString("date_added");
            this.user_id = intent.getExtras().getString("user_id");
            toolBarLayout.setTitle(this.summary);
            TextView desc = (TextView)findViewById(R.id.description);
            TextView mydate = (TextView)findViewById(R.id.date_added);
            mydate.setText(date_added);
            desc.setText(description);
        }


        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                onBackPressed();
            }
        });
    }

    public void apply(View view) {
        if (view == view.findViewById(R.id.apply_btn)) {
            Controller mycontrol = new Controller();
            Intent intent = getIntent();
            String artisan_id = intent.getExtras().getString("user_id");
            int job_id = intent.getExtras().getInt("job_id");
            System.out.println(artisan_id);
            System.out.println(job_id);

            String url = "http://cs.ashesi.edu.gh/class2016/salifu-mutaru/kaaya/server/controller/controller.php?cmd=21&artisan_id="+artisan_id+"&job_id=" + job_id;
            String cmd = "newjobs";
            String result = "";
            try {
                try {
                    result = mycontrol.execute(cmd, url).get().toString();
                }catch (java.util.concurrent.ExecutionException m){

                }
            }catch (java.lang.InterruptedException e){

            }

            Toast.makeText(this, result, Toast.LENGTH_LONG).show();
        }
    }

}
