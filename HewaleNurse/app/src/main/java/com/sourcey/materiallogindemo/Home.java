package com.sourcey.materiallogindemo;

import android.app.Fragment;
import android.app.FragmentManager;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.TextView;

public class Home extends AppCompatActivity
    implements NavigationView.OnNavigationItemSelectedListener {

    public static String h_email;
    public static String h_password;
    public static String h_account_id;
    public static String h_fullname;
    public static String h_account_type;


    FragmentManager fragmentManager = getFragmentManager();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.setDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        getSupportActionBar().setTitle("My Tasks");
        Fragment myfrag = new TasksFragment();
        fragmentManager.beginTransaction().replace(R.id.container, myfrag).commit();

        TextView username_area = (TextView)findViewById(R.id.username_area);

        Intent intent = this.getIntent();
        if(intent.hasExtra("h_fullname")){
            h_email = intent.getExtras().getString("h_email");
            h_password = intent.getExtras().getString("h_password");
            h_account_id = intent.getExtras().getString("h_account_id");
            h_account_type = intent.getExtras().getString("h_account_type");
            h_fullname = intent.getExtras().getString("h_fullname");
            username_area.setText(this.h_fullname);
        }
        else{
            username_area.setText("no username");
        }
    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.home, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        Fragment myfrag = null;
        int id = item.getItemId();


        if (id == R.id.mytasks) {
            myfrag = new TasksFragment();
            getSupportActionBar().setTitle("My Jobs");
        }

         fragmentManager = getFragmentManager();
        if(fragmentManager == null){
            return false;
        }

        if(myfrag != null){
            fragmentManager.beginTransaction().replace(R.id.container, myfrag).commit();
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
}
