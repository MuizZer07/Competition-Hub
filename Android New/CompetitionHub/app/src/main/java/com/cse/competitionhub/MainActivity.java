package com.cse.competitionhub;

import android.app.AlarmManager;
import android.app.AlertDialog;
import android.app.PendingIntent;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.Environment;
import android.os.Handler;
import android.os.Parcelable;
import android.os.SystemClock;
import android.provider.MediaStore;
import android.support.design.widget.FloatingActionButton;
import android.support.v4.content.FileProvider;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.LoginFilter;
import android.util.Log;
import android.util.SparseArray;
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

import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStream;
import java.io.Serializable;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;
//
import com.google.android.gms.vision.Frame;
import com.google.android.gms.vision.text.TextBlock;
import com.google.android.gms.vision.text.TextRecognizer;

// Home Screen, shows all the competitions
public class MainActivity extends AppCompatActivity {
    FloatingActionButton fabRegister;
    FloatingActionButton fabProfile;
    FloatingActionButton fabSeachWithPhoto;
    ListView listViewCompetitions;
    ArrayList<Competition> arrayList;
    ArrayAdapter<Competition> adapter;
    private ProgressDialog progressDialog;
    SwipeRefreshLayout swipeLayout;
    SearchView searchView;
    String mCurrentPhotoPath;
    Context context;

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
        context = this;

        // fetch all competitions from the database and add them to the arraylist
        fetchAllCompetitions();

        // initializing adapter with competition arraylist
        adapter = new ArrayAdapter<Competition>(MainActivity.this, android.R.layout.simple_list_item_1, arrayList);
        listViewCompetitions.setAdapter(adapter);

        // floating Buttons
        fabRegister = findViewById(R.id.fabRegister);
        fabProfile = findViewById(R.id.fabProfile);
        fabSeachWithPhoto = findViewById(R.id.fabSeachWithPhoto);

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

        // action listener for profile floating button
        fabSeachWithPhoto.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                selectImage();
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

                                // Alarm Notifications
                                getDeadlineNotifications();
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

    // selection options for image search
    private void selectImage() {
        final CharSequence[] options = { "Take Photo", "Choose from Gallery","Cancel" };
        AlertDialog.Builder builder = new AlertDialog.Builder(MainActivity.this);

        builder.setTitle("Search by Competition Posters");

        builder.setItems(options, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int item) {
                if(options[item].equals("Take Photo")){
                    Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
                    if (intent.resolveActivity(getPackageManager()) != null) {
                        File photoFile = null;
                        try {
                            photoFile = createImageFile();
                        } catch (IOException ex) {

                        }
                        if (photoFile != null) {
                            Uri photoURI = FileProvider.getUriForFile(context,
                                    "com.cse.android.fileprovider",
                                    photoFile);
                            intent.putExtra(MediaStore.EXTRA_OUTPUT, photoURI);
                            startActivityForResult(intent, 1);
                        }
                    }
                }
                else if(options[item].equals("Choose from Gallery")) {
                    Intent intent = new Intent();
                    intent.setType("image/*");
                    intent.setAction(Intent.ACTION_GET_CONTENT);
                    startActivityForResult(Intent.createChooser(intent, "Select File"),2);
                }
                else if(options[item].equals("Cancel")) {
                    dialog.dismiss();
                }
            }
        });
        builder.show();
    }

    // action after Choosing an option to take a photo
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (resultCode == RESULT_OK) {
            if (requestCode == 1) {
                BitmapFactory.Options bmOptions = new BitmapFactory.Options();
                bmOptions.inJustDecodeBounds = true;
                BitmapFactory.decodeFile(mCurrentPhotoPath, bmOptions);
                int photoW = bmOptions.outWidth;
                int photoH = bmOptions.outHeight;

                bmOptions.inJustDecodeBounds = false;
                bmOptions.inPurgeable = true;

                Bitmap bitmap = BitmapFactory.decodeFile(mCurrentPhotoPath, bmOptions);
                String txt = getTextFromImage(bitmap);
                searchByPhoto(txt);
            }else if(requestCode == 2){
                Bitmap bm=null;
                if (data != null) {
                    try {
                        bm = MediaStore.Images.Media.getBitmap(getApplicationContext().getContentResolver(), data.getData());
                    } catch (IOException e) {
                        e.printStackTrace();
                    }
                }
                String txt =  getTextFromImage(bm);
                searchByPhoto(txt);
            }
        }
    }

    // create a temporary file
    private File createImageFile() throws IOException {
        String timeStamp = new SimpleDateFormat("yyyyMMdd_HHmmss").format(new Date());
        String imageFileName = "JPEG_" + timeStamp + "_";
        File storageDir = getExternalFilesDir(Environment.DIRECTORY_PICTURES);
        File image = null;
        try {
            image = File.createTempFile(
                    imageFileName,  /* prefix */
                    ".jpg",         /* suffix */
                    storageDir      /* directory */
            );
        } catch (IOException e) {
            e.printStackTrace();
        }
        mCurrentPhotoPath = image.getAbsolutePath();
        return image;
    }

    // extracting text from image
    private String getTextFromImage(Bitmap bitmap){
        String str= "";
        TextRecognizer tr = new TextRecognizer.Builder(getApplicationContext()).build();
        if(!tr.isOperational())
            Log.e("ERROR", "Detector dependencies are not yet available");
        else{
            Frame frame =  new Frame.Builder().setBitmap(bitmap).build();
            SparseArray<TextBlock> items = tr.detect(frame);

            for(int i=0; i<items.size(); i++){
                TextBlock item = items.valueAt(i);
                String s = item.getValue();
                str += s;
            }
        }
        return str;
    }

    // searching competition name in the extracted text from the image
    public void searchByPhoto(String string){
        boolean flag = false;
        for(int i=0; i<arrayList.size(); i++){
            Competition competition = arrayList.get(i);

            if(string.contains(competition.getName())){
                flag = true;
                // goes to competition details screen
                Intent intent = new Intent(getApplicationContext(), CompetitionActivity.class);
                // putting an object as an intent extra
                intent.putExtra("Competition",(Serializable) competition);
                startActivity(intent);
            }
        }
        if(flag == false){
            Toast.makeText(this, "Not found!", Toast.LENGTH_SHORT).show();
        }
    }

    // AlarmService Notifications
    public void getDeadlineNotifications(){
        for(int i=0; i<arrayList.size(); i++){
            Competition competition = arrayList.get(i);
            if(!competition.isDeadlineOver()){
                AlarmManager alarmManager = (AlarmManager) getSystemService(Context.ALARM_SERVICE);
                Calendar calendar = Calendar.getInstance();
                calendar.setTimeInMillis(System.currentTimeMillis());

                Intent notificationIntent = new Intent(this, AlarmReceiver.class);
                PendingIntent broadcast = PendingIntent.getBroadcast(this, 100, notificationIntent, PendingIntent.FLAG_UPDATE_CURRENT);

                calendar.set(Calendar.HOUR_OF_DAY, 10);
                calendar.set(Calendar.MINUTE, 30);

                alarmManager.setInexactRepeating(AlarmManager.RTC_WAKEUP, calendar.getTimeInMillis(),
                        AlarmManager.INTERVAL_HALF_DAY, broadcast);
            }
        }
    }
}
