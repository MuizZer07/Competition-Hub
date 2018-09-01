package com.cse.competitionhub;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Parcelable;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.method.ScrollingMovementMethod;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.cse.competitionhub.models.Competition;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

/**
 *
 * Screen shows competition details
 * has participation/login button
 *
 */

public class CompetitionActivity extends AppCompatActivity {

    TextView textViewDetails, textviewFlag;
    Button btnParticipate, btnCancelParticipation;
    private ProgressDialog progressDialog;
    int id;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_competition);

        btnParticipate = (Button) findViewById(R.id.btnParticipate);
        btnCancelParticipation = (Button) findViewById(R.id.btnCancelParticipation);
        textviewFlag = (TextView) findViewById(R.id.textviewFlag);
        progressDialog = new ProgressDialog(this);
        progressDialog.setMessage("Loading...");

        Intent intent = getIntent();
        final Competition competition = (Competition) getIntent().getSerializableExtra("Competition");
        id = SharedPrefManager.getInstance(this).getID();
        checkParticipation(id, competition.getId());


        String Details = "\n-------------------------------------------------------------------------------\n"+ "Name: " + competition.getName() + "\nVenue: "
                + competition.getVenue() +"\nEvent Date: " + competition.getEvent_date() + "\nRegistration Deadline: "
                + competition.getReg_deadline() + "\n-------------------------------------------------------------------------------"+
                "\n\nDescription:\n" + competition.getDescription();

        textViewDetails = (TextView) findViewById(R.id.textviewDetails);
        textViewDetails.setText(Details);
        textViewDetails.setMovementMethod(new ScrollingMovementMethod());

        btnParticipate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                createParticipationHistory(id, competition.getId());
            }
        });


        if(!SharedPrefManager.getInstance(this).isLoggedIn()){
            if(competition.isDeadlineOver()){
                btnParticipate.setVisibility(View.GONE);
                btnCancelParticipation.setVisibility(View.GONE);

                textviewFlag.setText("SORRY! Registration Deadline is Over!");
            }else{
                btnParticipate.setVisibility(View.GONE);
                btnCancelParticipation.setVisibility(View.GONE);
                textviewFlag.setText("Please Login to Participate!");

                textviewFlag.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        Intent i = new Intent(getApplicationContext(), loginActivity.class);
                        startActivity(i);
                    }
                });
            }
        }

        btnCancelParticipation.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                cancelParticipation(id, competition.getId());
            }
        });

    }

    // cancels participation, deletes participation history from the database
    private void cancelParticipation(int participant_id1, int competition_id1){
        final String participant_id = Integer.toString(participant_id1);
        final String competition_id = Integer.toString(competition_id1);
        progressDialog.show();
        StringRequest stringRequest = new StringRequest(Request.Method.POST,
                Constants.URL_CANCEL_PARTICIPATION,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        progressDialog.dismiss();

                        try {
                            JSONObject jsonObject = new JSONObject(response);

                            Toast.makeText(getApplicationContext(),  jsonObject.getString("message"), Toast.LENGTH_LONG).show();

                            finish();
                            startActivity(new Intent(getApplicationContext(), MainActivity.class));
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
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("participant_id", participant_id);
                params.put("competition_id", competition_id);

                return params;
            }
        };
        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
    }

    // user participates in a competition, a participation history is created
    private void createParticipationHistory(int participant_id1, int competition_id1){
        final String participant_id = Integer.toString(participant_id1);
        final String competition_id = Integer.toString(competition_id1);
        progressDialog.show();
        StringRequest stringRequest = new StringRequest(Request.Method.POST,
                Constants.URL_PARTICIPATE,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        progressDialog.dismiss();

                        try {
                            JSONObject jsonObject = new JSONObject(response);

                            Toast.makeText(getApplicationContext(),  jsonObject.getString("message"), Toast.LENGTH_LONG).show();

                            finish();
                            startActivity(new Intent(getApplicationContext(), MainActivity.class));
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
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("participant_id", participant_id);
                params.put("competition_id", competition_id);

                return params;
            }
        };
        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
    }

    // checks whether user have already registered for the competition or not from the database
    public void checkParticipation(int participant_id1, int competition_id1){
        final String participant_id = Integer.toString(participant_id1);
        final String competition_id = Integer.toString(competition_id1);
        progressDialog.show();
        StringRequest stringRequest = new StringRequest(Request.Method.POST,
                Constants.URL_CHECK_PARTICIPATE,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        progressDialog.dismiss();

                        try {
                            JSONObject jsonObject = new JSONObject(response);

                            if(jsonObject.getBoolean("participation")){
                                btnParticipate.setVisibility(View.GONE);
                                textviewFlag.setText("You are already participating in this competition!");
                            }else{
                                btnCancelParticipation.setVisibility(View.GONE);
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
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("participant_id", participant_id);
                params.put("competition_id", competition_id);

                return params;
            }
        };
        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
    }
}
