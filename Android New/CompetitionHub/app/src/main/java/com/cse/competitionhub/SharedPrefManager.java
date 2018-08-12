package com.cse.competitionhub;

import android.content.Context;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.util.LruCache;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.ImageLoader;
import com.android.volley.toolbox.Volley;

// stores all the information for a user
public class SharedPrefManager {
    private static SharedPrefManager mInstance;
    private static Context mCtx;

    private static final String SHARED_PREF_NAME = "mysharedpref12";
    private static final String KEY_USERNAME = "username";
    private static final String KEY_EMAIL = "useremail";
    private static final String KEY_ID = "userid";
    private static final String KEY_POSITION = "userposition";
    private static final String KEY_DURATION = "userduration";
    private static final String KEY_PHONE_NUMBER = "userphonenumber";
    private static final String KEY_ADDRESS = "useraddress";
    private static final String KEY_ABOUT = "userabout";
    private static final String KEY_INSTITUTION = "userintitution";
    private static final String KEY_OCCUPATION = "useroccupation";
    private static final String KEY_WEBSITE = "userwebsite";

    private SharedPrefManager(Context context) {
        mCtx = context;
    }

    public static synchronized SharedPrefManager getInstance(Context context) {
        if (mInstance == null) {
            mInstance = new SharedPrefManager(context);
        }
        return mInstance;
    }

    // stores all the information of a user, user log in
    public boolean userLogin(int id, String name, String email, String position, String duration, String phn, String address,
                           String about, String ins, String occ, String web){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();

        editor.putInt(KEY_ID, id);
        editor.putString(KEY_USERNAME, name);
        editor.putString(KEY_EMAIL, email);
        editor.putString(KEY_POSITION, position);
        editor.putString(KEY_DURATION, duration);
        editor.putString(KEY_PHONE_NUMBER, phn);
        editor.putString(KEY_ADDRESS, address);
        editor.putString(KEY_ABOUT, about);
        editor.putString(KEY_INSTITUTION, ins);
        editor.putString(KEY_OCCUPATION, occ);
        editor.putString(KEY_WEBSITE, web);

        editor.apply();

        return true;
    }

    // checking if anyone is logged in or not
    public boolean isLoggedIn(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        if(sharedPreferences.getString(KEY_USERNAME, null) != null){
            return true;
        }
        return false;
    }

    // deletes all the stored information, user logout
    public boolean logout(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();

        editor.clear();
        editor.apply();

        return true;
    }

    // ALL GETTERS //
    public int getID(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getInt(KEY_ID, 0);
    }

    public String getUserName(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(KEY_USERNAME, null);
    }


    public String getUserEmail(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(KEY_EMAIL, null);
    }

    public String getDuration(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(KEY_DURATION, null);
    }

    public String getPhone(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(KEY_PHONE_NUMBER, null);
    }
    public String getAddress(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(KEY_ADDRESS, null);
    }
    public String getAbout(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(KEY_ABOUT, null);
    }
    public String getInstitution(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(KEY_INSTITUTION, null);
    }
    public String getPosition(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(KEY_POSITION, null);
    }

    public String getOccupation(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(KEY_OCCUPATION, null);
    }
    public String getWebsite(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(KEY_WEBSITE, null);
    }
}