package com.cse.competitionhub;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
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

// shows login form, verifies and logs in a user
public class loginActivity extends AppCompatActivity {

    private EditText editTextEmail, editTextPassword;
    private Button buttonLogin;
    private ProgressDialog progressDialog;
    private TextView textviewRegister;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        // if anyone is logged in, it will redirect to the profile screen
        if(SharedPrefManager.getInstance(this).isLoggedIn()){
            finish();
            startActivity(new Intent(getApplicationContext(), profileActivity.class));
            return;
        }

        // initializing
        editTextEmail = (EditText) findViewById(R.id.editTextEmail);
        editTextPassword = (EditText) findViewById(R.id.editTextPassword);

        buttonLogin = (Button) findViewById(R.id.btnLogin);
        progressDialog = new ProgressDialog(this);
        progressDialog.setMessage("Please Wait...");

        // action lister for register button
        buttonLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // verify a user with information in the database
                // logs in the user to the app
                // store information as shared preference in the phone
                loginUser();
            }
        });

        textviewRegister = (TextView) findViewById(R.id.textviewRegister);

        // action lister for register/sign up text
        textviewRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // redirects to register screen
                finish();
                startActivity(new Intent(getApplicationContext(), RegisterActivity.class));
            }
        });
    }

    // verify a user with information in the database
    // logs in the user to the app
    // store information as shared preference in the phone
    private void loginUser(){
        final String email = editTextEmail.getText().toString().trim();
        final String password = editTextPassword.getText().toString().trim();

        progressDialog.show();
        StringRequest stringRequest = new StringRequest(Request.Method.POST,
                Constants.URL_LOGIN,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        progressDialog.dismiss();

                        try {
                            JSONObject jsonObject = new JSONObject(response);

                            // extracting information from JSONObject and calling the login function
                            if(!jsonObject.getBoolean("error")){
                                SharedPrefManager.getInstance(getApplicationContext())
                                        .userLogin(
                                                jsonObject.getInt("id"),
                                                jsonObject.getString("name"),
                                                jsonObject.getString("email"),
                                                jsonObject.getString("position"),
                                                jsonObject.getString("duration"),
                                                jsonObject.getString("phone_number"),
                                                jsonObject.getString("address"),
                                                jsonObject.getString("about"),
                                                jsonObject.getString("institution"),
                                                jsonObject.getString("occupation"),
                                                jsonObject.getString("website")
                                                );
                                Toast.makeText( getApplicationContext(), "User Login Successful", Toast.LENGTH_LONG).show();

                                // redirects to main activity after login
                                finish();
                                startActivity(new Intent(getApplicationContext(), MainActivity.class));
                            }else{
                                Toast.makeText( getApplicationContext(), jsonObject.getString("message"), Toast.LENGTH_LONG).show();
                            }
                        } catch (JSONException e) {
                            Toast.makeText( getApplicationContext(), e.getMessage(), Toast.LENGTH_LONG).show();
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
            // parameters for POST request
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("email", email);
                params.put("password", password);

                return params;
            }
        };
        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
    }
}
