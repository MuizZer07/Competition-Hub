package com.cse.competitionhub;

// contains all the urls to the requests
public class Constants {

//    setting the IP Address, this will vary every time when the internet is connected to different network
//    private static final String IP_ADDRESS = "http://192.168.1.102/";
//    private static final String IP_ADDRESS = "http://7d2206b8.ngrok.io/";
    private static final String IP_ADDRESS = "https://competitionhub.000webhostapp.com/";

//    directory to the php scripts for making requests
//    private static final String ROOT_URL = "nsu.summer.2018.cse327.2.team10/Android Connection/v1/";
    private static final String ROOT_URL = "v1/";

//    complete url to find the php scripts
    public static final String URL_REGISTER = IP_ADDRESS + ROOT_URL + "registerUser.php";
    public static final String URL_LOGIN = IP_ADDRESS + ROOT_URL + "loginUser.php";
    public static final String URL_EDIT_PROFILE = IP_ADDRESS + ROOT_URL + "editProfile.php";
    public static final String URL_ALL_COMPETITIONS = IP_ADDRESS + ROOT_URL + "allCompetitions.php";
    public static final String URL_PARTICIPATE = IP_ADDRESS + ROOT_URL + "participate.php";
    public static final String URL_CHECK_PARTICIPATE = IP_ADDRESS + ROOT_URL + "checkParticipation.php";
    public static final String URL_CANCEL_PARTICIPATION = IP_ADDRESS + ROOT_URL + "cancelParticipation.php";
}
