package com.cse.competitionhub;

import android.content.Intent;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;

import javax.security.auth.login.LoginException;

// shows profile attributes
public class profileActivity extends AppCompatActivity {

    private TextView textDetails;
    FloatingActionButton fabEdit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

        // if anyone is not logged in, it will redirect to the login screen
        if(!SharedPrefManager.getInstance(this).isLoggedIn()){
            finish();
            startActivity(new Intent(getApplicationContext(), loginActivity.class));
        }

        // initializing
        textDetails = (TextView) findViewById(R.id.textDetails);
        fabEdit = findViewById(R.id.fabEdit);

        // getting the values from stored data of the logged in user
        String name = SharedPrefManager.getInstance(this).getUserName();
        String email = SharedPrefManager.getInstance(this).getUserEmail();
        String ins = SharedPrefManager.getInstance(this).getInstitution();
        String pos = SharedPrefManager.getInstance(this).getPosition();
        String dur = SharedPrefManager.getInstance(this).getDuration();
        String phn = SharedPrefManager.getInstance(this).getPhone();
        String add = SharedPrefManager.getInstance(this).getAddress();
        String occ = SharedPrefManager.getInstance(this).getOccupation();
        String web = SharedPrefManager.getInstance(this).getWebsite();
        String about = SharedPrefManager.getInstance(this).getAbout();

        String details = "Name: " + name + "\nEmail: " + email + "\nInstitution: " + ins + "\nPosition: " + pos
                + "\nDuration: " + dur + "\nPhone Number: " + phn + "\nAddress: " + add + "\nOccupation: " + occ
                + "\nWebsite: " + web + "\nAbout: " + about ;

        textDetails.setText(details);

        // profile edit button action listener
        fabEdit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // it will open the profile edit screen
                finish();
                startActivity(new Intent(getApplicationContext(), EditProfileActivity.class));
            }
        });
    }

    // menu item select action listener
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()){
            case R.id.menu_logout:
                SharedPrefManager.getInstance(this).logout();
                finish();
                startActivity(new Intent(getApplicationContext(), MainActivity.class));
                break;
        }
        return true;
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu, menu);
        return true;
    }
}
