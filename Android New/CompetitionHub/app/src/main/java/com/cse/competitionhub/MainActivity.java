package com.cse.competitionhub;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Handler;
import android.os.Parcelable;
import android.support.design.widget.FloatingActionButton;
import android.support.v4.widget.SwipeRefreshLayout;
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
import android.support.v7.widget.SearchView;
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

// Home Screen, shows all the competitions
public class MainActivity extends AppCompatActivity {
    FloatingActionButton fabRegister;
    FloatingActionButton fabProfile;
    ListView listViewCompetitions;
    ArrayList<Competition> arrayList;
    ArrayAdapter<Competition> adapter;
    private ProgressDialog progressDialog;
    SwipeRefreshLayout swipeLayout;
    SearchView searchView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // initializing all components
        searchView = (SearchView) findViewById(R.id.search);
        progressDialog = new ProgressDialog(this);
        progressDialog.setMessage("Loading...");
        listViewCompetitions = (ListView) findViewById(R.id.listViewComp);
        arrayList = new ArrayList<Competition>();
        swipeLayout = (SwipeRefreshLayout) findViewById(R.id.swipe_container);
        swipeLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                new Handler().postDelayed(new Runnable() {

                    @Override
                    public void run() {
                        swipeLayout.setRefreshing(false);
                    }
                }, 5000);
            }
        });

        // fetch all competitions from the database and add them to the arraylist
        fetchAllCompetitions();

        // initializing adapter with competition arraylist
        adapter = new ArrayAdapter<Competition>(MainActivity.this, android.R.layout.simple_list_item_1, arrayList);
        listViewCompetitions.setAdapter(adapter);

        // floating Buttons
        fabRegister = findViewById(R.id.fabRegister);
        fabProfile = findViewById(R.id.fabProfile);

        // checking whether anyone is logged in or not
        if(SharedPrefManager.getInstance(this).isLoggedIn()){
            // setting the register button as not visible when someone is logged in
            fabRegister.setVisibility(View.GONE);
        }else{
            // setting the profile button as not visible when someone is not logged in
            fabProfile.setVisibility(View.GONE);
        }

        // action listener for profile floating button
        fabProfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(getApplicationContext(), profileActivity.class);
                startActivity(i);
            }
        });

        // action listener for register floating button
        fabRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                // finish current screen
                finish();
                // goes to register screen
                Intent i = new Intent(getApplicationContext(), loginActivity.class); // goes to register screen
                startActivity(i);
            }
        });

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

        // action listener for searchView, matches query with all the elements in the arraylist
        searchView.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
            @Override
            public boolean onQueryTextSubmit(String query) {
                boolean found = false;
                for(int i=0; i<listViewCompetitions.getCount(); i++){
                    if(listViewCompetitions.getAdapter().getItem(i).toString().toLowerCase().contains(query.toLowerCase())){
                        adapter.getFilter().filter(query);
                        found = true;
                    }
                    if(!found){
                        Toast.makeText(MainActivity.this, "No Match found",Toast.LENGTH_SHORT).show();
                    }
                }
                return false;
            }

            @Override
            public boolean onQueryTextChange(String newText) {
                return false;
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
                                arrayList.add(competition);
                                // notifying the adapter for the change
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

    // action listener for menu item, if selected
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
        // checking if anyone's logged in
        if(!SharedPrefManager.getInstance(this).isLoggedIn()){
            // setting logout button as not visible if anyone is not logged in
            menu.getItem(0).setVisible(false);
            this.invalidateOptionsMenu();
        }
        return true;
    }
}
