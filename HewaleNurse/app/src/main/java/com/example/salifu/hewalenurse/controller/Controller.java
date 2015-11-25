package com.example.salifu.hewalenurse.controller;

import android.os.AsyncTask;

import com.example.salifu.hewalenurse.Model.Task;

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
import java.util.List;

/**
 * Created by Salifu on 11/20/2015.
 */
public class Controller extends AsyncTask<String, Void, String> {

    public static String username;
    public static String password;
    public static int user_id;
    public static String[] history;
    public static List<Task> tasks = new ArrayList<>();

    protected String doInBackground(String... params) {
        String cmd = params[0];
        String url = params[1];
        if(cmd.equals("login")){
            breakJsonLogin(sendRequest(url));
        }else if(cmd.equals("history")){
            breakJsonTask(sendRequest(url));
        }
        return "done";
    }

    public static String[] getHistory(){
        return history;
    }
    protected String sendRequest(String myUrl) {
        String response = "";
        HttpURLConnection urlConnection=null;

        try {
            URL url = new URL(myUrl);
            urlConnection = (HttpURLConnection) url.openConnection();

            InputStream in = new BufferedInputStream(urlConnection.getInputStream());
            BufferedReader buffer = new BufferedReader(
                    new InputStreamReader(in));
            String s = "";
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
    protected void onPostExecute(String result) {

    }

    /******** Get login details ********/
    public String[] breakJsonLogin(String jsonData){

        String OutputData = "";
        JSONObject jsonResponse;

        try {

            /****** Creates a new JSONObject with name/value mappings from the JSON string. ********/
            jsonResponse = new JSONObject(jsonData);

            /***** Returns the value mapped by name if it exists and is a JSONArray. ***/
            /*******  Returns null otherwise.  *******/
            JSONArray jsonMainNode = jsonResponse.optJSONArray("user");

            if(jsonMainNode ==  null){
                return null;
            }

            System.out.println(jsonMainNode);
            /*********** Process each JSON Node ************/

            int lengthJsonArr = jsonMainNode.length();

            for(int i=0; i < lengthJsonArr; i++)
            {
                /****** Get Object for each JSON node.***********/
                JSONObject jsonChildNode = jsonMainNode.getJSONObject(i);

                /******* Fetch node values **********/
                user_id = Integer.parseInt(jsonChildNode.optString("user_id"));
                username   = jsonChildNode.optString("user_name");
                password = jsonChildNode.optString("user_password");


                OutputData += "Node : \n\n     "+ user_id +" | "
                        + username+" | "
                        + password +" \n\n ";

                //Log.i("JSON parse", song_name);

            }

            /************ Show Output on screen/activity **********/

            //output.setText(OutputData);
            System.out.println(OutputData);

        } catch (JSONException e) {

            e.printStackTrace();
        }
        return null;
    }

    public String[] breakJsonTask(String jsonData){

        JSONObject jsonResponse;

        try {

            /****** Creates a new JSONObject with name/value mappings from the JSON string. ********/
            jsonResponse = new JSONObject(jsonData);

            /***** Returns the value mapped by name if it exists and is a JSONArray. ***/
            /*******  Returns null otherwise.  *******/
            JSONArray jsonMainNode = jsonResponse.optJSONArray("orders");

            if(jsonMainNode ==  null){
                return null;
            }

            System.out.println(jsonMainNode);
            /*********** Process each JSON Node ************/

            int lengthJsonArr = jsonMainNode.length();
            //history = new String[lengthJsonArr];
            for(int i=0; i < lengthJsonArr; i++)
            {
                /****** Get Object for each JSON node.***********/
                JSONObject jsonChildNode = jsonMainNode.getJSONObject(i);

                /******* Fetch node values **********/
                String task_details = jsonChildNode.optString("task_details");
                String task_summary   = jsonChildNode.optString("task_summary");
                String date_assigned = jsonChildNode.optString("date_assigned");
                String deadline = jsonChildNode.optString("deadline");

                tasks.add(new Task(task_details, task_summary, date_assigned, deadline));
                //history[i] = meal_name+"    "+meal_price+"    "+timestamp;

            }

            /************ Show Output on screen/activity **********/

            //output.setText(OutputData);
            System.out.println(tasks.get(0).task_details);

        } catch (JSONException e) {

            e.printStackTrace();
        }
        return null;
    }
}

