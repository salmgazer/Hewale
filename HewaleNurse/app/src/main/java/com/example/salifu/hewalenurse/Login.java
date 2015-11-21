package com.example.salifu.hewalenurse;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

public class Login extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
    }


    public void signIn(View view) {
        if (view == findViewById(R.id.signInBtn)) {
            TextView uView = (TextView) findViewById(R.id.username);
            String username = uView.getText().toString();
            //do username validation
            if(username.length() < 6){
                Toast.makeText(this, "username is at least 6 characters", Toast.LENGTH_LONG).show();
                return;
            }
            TextView pView = (TextView) findViewById(R.id.password);
            String password = pView.getText().toString();
            //do password validation
            if(password.length() < 6){
                Toast.makeText(this, "password is at least 6 characters", Toast.LENGTH_LONG).show();
                return;
            }
            if(username.equals("salifu") && password.equals("mole123")){
                Intent homepage = new Intent(this, homePage.class);
                homepage.putExtra("username", username);
                homepage.putExtra("password", password);
                String role = "Achimota Zone 51 Nurse";
                homepage.putExtra("role", role);
                startActivity(homepage);
            }else{
                Toast.makeText(this, "Wrong credentials", Toast.LENGTH_LONG).show();
            }
        }
    }
}
