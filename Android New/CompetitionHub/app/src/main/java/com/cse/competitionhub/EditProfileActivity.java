package com.cse.competitionhub;

import android.app.ProgressDialog;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

/**
 *
 * Edit Profile screen for user account
 * updates user table accordingly
 *
 */

public class EditProfileActivity extends AppCompatActivity {

    private ProgressDialog progressDialog;
    private int user_id;
    EditText editTextName, editTextPosition, editTextDuration, editTextPhone, editTextAddress, editTextAbout, editTextInstitution
            , editTextOccupation, editTextWebsite;
    Button btnSave;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_profile);

        // if anyone is not logged in, it will redirect to the login screen
        if(!SharedPrefManager.getInstance(this).isLoggedIn()){
            finish();
            startActivity(new Intent(getApplicationContext(), loginActivity.class));
        }
        user_id = SharedPrefManager.getInstance(this).getID();

        editTextName = (EditText) findViewById(R.id.editTextName);
        editTextPosition = (EditText) findViewById(R.id.editTextPosition);
        editTextDuration = (EditText) findViewById(R.id.editTextDuration);
        editTextPhone = (EditText) findViewById(R.id.editTextPhone);
        editTextAddress = (EditText) findViewById(R.id.editTextAddress);
        editTextAbout = (EditText) findViewById(R.id.editTextAbout);
        editTextInstitution = (EditText) findViewById(R.id.editTextInstitution);
        editTextOccupation = (EditText) findViewById(R.id.editTextOccupation);
        editTextWebsite = (EditText) findViewById(R.id.editTextWebsite);

        editTextName.setText(SharedPrefManager.getInstance(this).getUserName());
        editTextPosition.setText(SharedPrefManager.getInstance(this).getPosition());
        editTextDuration.setText(SharedPrefManager.getInstance(this).getDuration());
        editTextPhone.setText(SharedPrefManager.getInstance(this).getPhone());
        editTextAddress.setText(SharedPrefManager.getInstance(this).getAddress());
        editTextAbout.setText(SharedPrefManager.getInstance(this).getAbout());
        editTextInstitution.setText(SharedPrefManager.getInstance(this).getInstitution());
        editTextOccupation.setText(SharedPrefManager.getInstance(this).getOccupation());
        editTextWebsite.setText(SharedPrefManager.getInstance(this).getWebsite());

        btnSave = (Button) findViewById(R.id.btnSave);

        progressDialog = new ProgressDialog(this);
        progressDialog.setMessage("Loading...");

        btnSave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                saveUser(user_id);
                finish();
            }
        });
    }

    // updates user information in the database
    private void saveUser(int user_id){
        final String userid = Integer.toString(user_id);
        progressDialog.show();
        StringRequest stringRequest = new StringRequest(Request.Method.POST,
                Constants.URL_EDIT_PROFILE,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        progressDialog.dismiss();

                        try {
                            JSONObject jsonObject = new JSONObject(response);

                            Toast.makeText(getApplicationContext(),  jsonObject.getString("message"), Toast.LENGTH_SHORT).show();

                            finish();
                            startActivity(new Intent(getApplicationContext(), MainActivity.class));
                        } catch (JSONException e) {
                            Toast.makeText( getApplicationContext(), e.getMessage(), Toast.LENGTH_SHORT).show();
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        progressDialog.hide();
                        Toast.makeText( getApplicationContext(),  error.getMessage(), Toast.LENGTH_LONG).show();
                    }
                }){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("user_id", userid);
                params.put("name", editTextName.getText().toString());
                params.put("position", editTextPosition.getText().toString());
                params.put("duration", editTextDuration.getText().toString());
                params.put("phone_number", editTextPhone.getText().toString());
                params.put("address", editTextAddress.getText().toString());
                params.put("about", editTextAbout.getText().toString());
                params.put("institution", editTextInstitution.getText().toString());
                params.put("occupation", editTextOccupation.getText().toString());
                params.put("website", editTextWebsite.getText().toString());
                return params;
            }
        };
        Toast.makeText( getApplicationContext(), "Login again to see changes.", Toast.LENGTH_SHORT).show();
        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
    }
}
