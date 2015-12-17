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

    public static ArrayList<Job> jobs = new ArrayList<>();
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
        }else if(cmd.equals("newjobs")){
            breakJsonJobs(sendRequest(url));
        }else if(cmd.equals("apply")){
            return apply(url);
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
        //System.out.println(response);
        return response;
    }

    @Override
    protected void onPostExecute(String result) {

    }

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

            //System.out.println(jsonMainNode);
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

            /************ Show Output on screen/activity **********/
            System.out.println("Pass is "+h_password);
            System.out.println("Email is "+h_email);

        } catch (JSONException e) {

            e.printStackTrace();
        }
        return null;
    }



    public String login(String url) {
        String result = sendRequest(url);
        JSONObject json;
        int res;
        try {
            json = new JSONObject(result);
        }catch (org.json.JSONException j){
            return "0";
        }
        try{
            res = json.getInt("result");
        }catch (org.json.JSONException e){
            return  "0";
        }
        return String.valueOf(res);
    }

    public String apply(String url) {
        String result = sendRequest(url);
        JSONObject json;
        int res;
        try {
            json = new JSONObject(result);
        }catch (org.json.JSONException j){
            return "0";
        }
        try{
            res = json.getInt("result");
        }catch (org.json.JSONException e){
            return  "0";
        }
        return String.valueOf(res);
    }




    public String breakJsonJobs(String jsonData){

        System.out.println(jsonData);
        System.out.println("We are in");
        JSONObject jsonResponse;

        try {

            /****** Creates a new JSONObject with name/value mappings from the JSON string. ********/
            jsonResponse = new JSONObject(jsonData);

            /***** Returns the value mapped by name if it exists and is a JSONArray. ***/
            /*******  Returns null otherwise.  *******/
            JSONArray jsonMainNode = jsonResponse.optJSONArray("jobs");

            if(jsonMainNode ==  null){
                return null;
            }

            //System.out.println(jsonMainNode);
            /*********** Process each JSON Node ************/

            int lengthJsonArr = jsonMainNode.length();
            //historylist = new OrderHistory.Order[lengthJsonArr];
            for(int i=0; i < lengthJsonArr; i++)
            {
                //System.out.println("We are in loop");
                /****** Get Object for each JSON node.***********/
                JSONObject jsonChildNode = jsonMainNode.getJSONObject(i);

                /******* Fetch node values **********/
                String summary = jsonChildNode.optString("summary");
                Double starting_price   = jsonChildNode.optDouble("starting_price");
                String date_added = jsonChildNode.optString("date_added");
                String description = jsonChildNode.optString("description");
                int job_id = jsonChildNode.optInt("job_id");

                Job job = new Job(job_id, summary, date_added, starting_price, description);
                jobs.add(job);
               // System.out.println(jobs.get(i).summary);

            }

            /************ Show Output on screen/activity **********/

            //output.setText(OutputData);
            //System.out.println(historylist.get(0).order_details);

        } catch (JSONException e) {

            e.printStackTrace();
        }
        return "Yes";
    }
}

