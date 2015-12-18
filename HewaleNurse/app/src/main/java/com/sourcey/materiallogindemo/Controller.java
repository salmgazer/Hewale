package com.sourcey.materiallogindemo;

import android.os.AsyncTask;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;

/**
 * Created by Salifu on 12/6/2015.
 */

public class Controller extends AsyncTask<String, Void, String> {

    public ArrayList<Task> tasks = new ArrayList<>();
    public ArrayList<Comment> comments = new ArrayList<>();
    public static String h_account_id;
    public static String h_fullname;
    public static String h_account_type;
    public static String h_email;
    public static String h_password;
    private String link = "http://cs.ashesi.edu.gh/class2016/william-annoh/HewaleNurse/controller/nurse_controller.php?cmd=";

    protected String doInBackground(String... params) {
        String cmd = params[0];
        String  url = link+params[1];

        if(cmd.equals("login")){
            breakJsonLogin(sendRequest(url));
        }else if(cmd.equals("mytasks")){
            breakJsonTasks(sendRequest(url));
        }else if(cmd.equals("comments")){
            return breakJsonComments(sendRequest(url));
        }else if(cmd.equals("addComment")){
            return sendRequest(url);
        }
        return "done";
    }


    protected String sendRequest(String myUrl) {
        HttpURLConnection urlConnection = null;
                String response = "";

        try {
            URL url = new URL(myUrl);
            urlConnection = (HttpURLConnection) url.openConnection();


            InputStream in = new BufferedInputStream(urlConnection.getInputStream());
            BufferedReader buffer = new BufferedReader(
                    new InputStreamReader(in));
            String s;
            while ((s = buffer.readLine()) != null) {
                //System.out.println(s);
                response += s;
            }

        } catch (Exception e) {
            e.printStackTrace();
        }
        finally {
            urlConnection.disconnect();
        }
        return response;
    }

    @Override
    protected void onPostExecute(String result) {}

    public String breakJsonLogin(String jsonData){
        JSONObject jsonResponse;

        try {

            /****** Creates a new JSONObject with name/value mappings from the JSON string. ********/
            jsonResponse = new JSONObject(jsonData);

            /***** Returns the value mapped by name if it exists and is a JSONArray. ***/
            /*******  Returns null otherwise.  *******/
            JSONArray jsonMainNode = jsonResponse.optJSONArray("nurse");

            if(jsonMainNode ==  null){
                return null;
            }
            /*********** Process each JSON Node ************/

            int lengthJsonArr = jsonMainNode.length();

            for(int i=0; i < lengthJsonArr; i++)
            {
                /****** Get Object for each JSON node.***********/
                JSONObject jsonChildNode = jsonMainNode.getJSONObject(i);

                /******* Fetch node values **********/
                h_account_id = jsonChildNode.optString("h_account_id");
                h_fullname   = jsonChildNode.optString("h_fullname");
                h_account_type = jsonChildNode.optString("h_account_type");
                h_email = jsonChildNode.optString("h_email");
                h_password = jsonChildNode.optString("h_password");
            }

        } catch (JSONException e) {

            e.printStackTrace();
        }
        return null;
    }

    public String breakJsonTasks(String jsonData){
        JSONObject jsonResponse;

        try {

            /****** Creates a new JSONObject with name/value mappings from the JSON string. ********/
            jsonResponse = new JSONObject(jsonData);

            /***** Returns the value mapped by name if it exists and is a JSONArray. ***/
            /*******  Returns null otherwise.  *******/
            JSONArray jsonMainNode = jsonResponse.optJSONArray("tasks");

            if(jsonMainNode ==  null){
                return null;
            }
            /*********** Process each JSON Node ************/

            int lengthJsonArr = jsonMainNode.length();
            for(int i=0; i < lengthJsonArr; i++)
            {
                //System.out.println("We are in loop");
                /****** Get Object for each JSON node.***********/
                JSONObject jsonChildNode = jsonMainNode.getJSONObject(i);

                /******* Fetch node values **********/
                int h_task_id = jsonChildNode.optInt("h_task_id");
                int nurse_id = jsonChildNode.optInt("nurse_id");
                int admin_id = jsonChildNode.optInt("admin_id");
                String description = jsonChildNode.optString("description");
                String start_time = jsonChildNode.optString("start_time");
                String end_time = jsonChildNode.optString("end_time");
                String h_task_status = jsonChildNode.optString("h_task_status");
                String request_completion = jsonChildNode.optString("request_completion");

                Task task = new Task(h_task_id, nurse_id, admin_id, description, start_time, end_time, h_task_status, request_completion);
                tasks.add(task);
            }

            /************ Show Output on screen/activity **********/
        } catch (JSONException e) {

            e.printStackTrace();
        }
        return "Yes";
    }

    public String breakJsonComments(String jsonData){
        JSONObject jsonResponse;

        try {

            /****** Creates a new JSONObject with name/value mappings from the JSON string. ********/
            jsonResponse = new JSONObject(jsonData);

            /***** Returns the value mapped by name if it exists and is a JSONArray. ***/
            /*******  Returns null otherwise.  *******/
            JSONArray jsonMainNode = jsonResponse.optJSONArray("comments");

            if(jsonMainNode ==  null){
                return null;
            }
            /*********** Process each JSON Node ************/

            int lengthJsonArr = jsonMainNode.length();
            for(int i=0; i < lengthJsonArr; i++)
            {
                //System.out.println("We are in loop");
                /****** Get Object for each JSON node.***********/
                JSONObject jsonChildNode = jsonMainNode.getJSONObject(i);

                /******* Fetch node values **********/
                String message = jsonChildNode.optString("message");
                String sent_by = jsonChildNode.optString("sent_by");
                if(sent_by.equals("nurse"))
                    sent_by = "me";
                String sent_time = jsonChildNode.optString("sent_time");

                Comment comment = new Comment(message, sent_time, sent_by);
                comments.add(comment);
            }

            /************ Show Output on screen/activity **********/
        } catch (JSONException e) {

            e.printStackTrace();
        }
        return "Yes";
    }
}

