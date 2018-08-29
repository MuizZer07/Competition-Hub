package com.cse.competitionhub;

import android.app.ProgressDialog;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.cse.competitionhub.models.Competition;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.ArrayList;

// Notification Screen
public class NotificationActivity extends AppCompatActivity {
    ListView listViewCompetitions;
    ArrayList<Competition> arrayList;
    ArrayAdapter<Competition> adapter;
    private ProgressDialog progressDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_notification);

        progressDialog = new ProgressDialog(this);
        progressDialog.setMessage("Loading...");
        listViewCompetitions = (ListView) findViewById(R.id.listViewComp);
        arrayList = new ArrayList<Competition>();

        fetchAllCompetitions();

        adapter = new ArrayAdapter<Competition>(NotificationActivity.this, android.R.layout.simple_list_item_1, arrayList);
        listViewCompetitions.setAdapter(adapter);

        // action listener for each item in the listViewCompetitions
        listViewCompetitions.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                // goes to competition details screen
                Intent intent = new Intent(getApplicationContext(), CompetitionActivity.class);
                Competition competition = arrayList.get(position);
                // putting an object as an intent extra
                intent.putExtra("Competition",(Serializable) competition);
                startActivity(intent);
            }
        });

    }


    // fetch all competitions from the database and add them to the arraylist
    private void fetchAllCompetitions(){
        progressDialog.show();
        StringRequest stringRequest = new StringRequest(Request.Method.GET,
                Constants.URL_ALL_COMPETITIONS,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            progressDialog.dismiss();
                            // response is a JSONArray
                            JSONArray jArray = new JSONArray(response);

                            // extracting JSONObjects from each element of JSONArray
                            for (int i = 0; i < jArray.length(); i++) {
                                JSONObject jb = jArray.getJSONObject(i);
                                int id = jb.getInt("id");
                                String name = jb.getString("name");
                                String venue = jb.getString("venue");
                                String event_date = jb.getString("event_date");
                                String reg_deadline = jb.getString("reg_deadline");
                                String description = jb.getString("description");
                                int catagory_id = jb.getInt("catagory_id");
                                int organizer_id = jb.getInt("organizer_id");
                                boolean isDeadlineOver = jb.getBoolean("isDeadlineOver");

                                // creating a new competition object
                                Competition competition = new Competition(id ,name, venue, event_date,
                                        reg_deadline, description, catagory_id, organizer_id, isDeadlineOver);

                                // adding the object to the arraylist
                                if(!competition.isDeadlineOver()){
                                    arrayList.add(competition);

                                    // notifying the adapter for the change
                                    adapter.notifyDataSetChanged();
                                }
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

        };
        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
    }
}
