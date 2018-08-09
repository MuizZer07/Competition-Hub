package com.cse.competitionhub;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Parcelable;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
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
import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {
    FloatingActionButton fabRegister;
    FloatingActionButton fabProfile;
    ListView listViewCompetitions;
    ArrayList<Competition> arrayList;
    ArrayAdapter<Competition> adapter;
    private ProgressDialog progressDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        progressDialog = new ProgressDialog(this);
        progressDialog.setMessage("Loading...");
        listViewCompetitions = (ListView) findViewById(R.id.listViewComp);
        arrayList = new ArrayList<Competition>();

        fetchAllCompetitions();

        adapter = new ArrayAdapter<Competition>(MainActivity.this, android.R.layout.simple_list_item_1, arrayList);
        listViewCompetitions.setAdapter(adapter);

        fabRegister = findViewById(R.id.fabRegister);
        fabProfile = findViewById(R.id.fabProfile);

        if(SharedPrefManager.getInstance(this).isLoggedIn()){
            fabRegister.setVisibility(View.GONE);
        }else{
            fabProfile.setVisibility(View.GONE);
        }

        fabProfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(getApplicationContext(), profileActivity.class);
                startActivity(i);
            }
        });


        fabRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(getApplicationContext(), loginActivity.class);
                startActivity(i);
            }
        });

        listViewCompetitions.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent = new Intent(getApplicationContext(), CompetitionActivity.class);
                Competition competition = arrayList.get(position);
                intent.putExtra("Competition",(Serializable) competition);
                startActivity(intent);
            }
        });

    }

    private void fetchAllCompetitions(){
        progressDialog.show();
        StringRequest stringRequest = new StringRequest(Request.Method.GET,
                Constants.URL_ALL_COMPETITIONS,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            progressDialog.dismiss();
                            JSONArray jArray = new JSONArray(response);

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

                                Competition competition = new Competition(id ,name, venue, event_date,
                                                    reg_deadline, description, catagory_id, organizer_id);
                                arrayList.add(competition);
                                adapter.notifyDataSetChanged();
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
        if(!SharedPrefManager.getInstance(this).isLoggedIn()){
            menu.getItem(0).setVisible(false);
            this.invalidateOptionsMenu();
        }
        return true;
    }
}
