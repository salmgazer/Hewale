package com.sourcey.materiallogindemo;

import android.app.ProgressDialog;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import java.util.ArrayList;
import java.util.List;

/**
 * A simple {@link Fragment} subclass.
 * Activities that contain this fragment must implement the
 * {@link TasksFragment.OnFragmentInteractionListener} interface
 * to handle interaction events.
 * Use the {@link TasksFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class TasksFragment extends Fragment {
    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    public static RecyclerView myRecycler;
    public Recycler_View_Adapter mAdapter;
    public static List<Task> tasks = new ArrayList<>();
    public static String h_email;
    public static String h_password;
    public static String h_account_id;
    public static String h_fullname;
    public static String h_account_type;


    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;

    private OnFragmentInteractionListener mListener;

    public TasksFragment() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment TasksFragment.
     */
    // TODO: Rename and change types and number of parameters
    public static TasksFragment newInstance(String param1, String param2) {
        TasksFragment fragment = new TasksFragment();
        Bundle args = new Bundle();
        args.putString(ARG_PARAM1, param1);
        args.putString(ARG_PARAM2, param2);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mParam1 = getArguments().getString(ARG_PARAM1);
            mParam2 = getArguments().getString(ARG_PARAM2);
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        View rootView = inflater.inflate(R.layout.fragment_tasks, container, false);
        myRecycler = (RecyclerView) rootView.findViewById(R.id.recyclerview);
        myRecycler.setHasFixedSize(true);

        myRecycler.addOnItemTouchListener(
                new RecyclerItemClickListener(getActivity(), new RecyclerItemClickListener.OnItemClickListener() {
                    @Override
                    public void onItemClick(View view, int position) {
                        // do whatever
                        processJobRow(position);
                    }
                })
        );

        LinearLayoutManager layoutManager = new LinearLayoutManager(getActivity());
        myRecycler.setLayoutManager(layoutManager);
        tasks = new ArrayList<>();
        //jobs.add(new Job(2, "Repair my chair", "10/10/2015", 45, "my desc 1"));
        //jobs.add(new Job(12, "Kill Anthony", "10/12/2015", 50, "my desc 2"));
        //get jobs here//
        Controller mycontrol = new Controller();
        Intent intent = getActivity().getIntent();
        h_account_id = intent.getExtras().getString("h_account_id");
        h_password = intent.getExtras().getString("h_password");
        h_account_type = intent.getExtras().getString("h_account_type");
        h_email = intent.getExtras().getString("h_email");
        h_fullname = intent.getExtras().getString("h_fullname");

        String url = "20&artisan_id="+artisan_id+"&community="+community;
        String cmd = "newjobs";
        mycontrol.execute(cmd, url);

        final ProgressDialog progressDialog = new ProgressDialog(getActivity(),
                R.style.AppTheme_Dark_Dialog);
        progressDialog.setIndeterminate(true);
        progressDialog.setMessage("Loading jobs...");
        progressDialog.show();

        //get jobs
        jobs = Controller.jobs;
        mAdapter = new Recycler_View_Adapter(jobs, getActivity());
        myRecycler.setAdapter(mAdapter);
        new android.os.Handler().postDelayed(
                new Runnable() {
                    public void run() {
                        // On complete call either onLoginSuccess or onLoginFailed
                        //onLoginSuccess();
                        // onLoginFailed();
                        progressDialog.dismiss();
                    }
                }, 3000);
        return rootView;
    }

    // TODO: Rename method, update argument and hook method into UI event
    public void onButtonPressed(Uri uri) {
        if (mListener != null) {
            mListener.onFragmentInteraction(uri);
        }
    }


    public void processJobRow(int position){
        Task task = tasks.get(position);

        // System.out.println(job.summary);

        //Intent i = getActivity().getIntent();
        //Toast.makeText(getActivity(), i.getExtras().getString("username"), Toast.LENGTH_LONG).show();
        //Toast.makeText(getActivity(), i.getExtras().getString("password"), Toast.LENGTH_LONG).show();
        Intent i = new Intent(getActivity(), TaskDetails.class);
        i.putExtra("admin_id", task.admin_id);
        i.putExtra("description", task.description);
        i.putExtra("end_time", task.end_time);
        i.putExtra("h_task_status", task.h_task_status);
        i.putExtra("nurse_id", task.nurse_id);
        i.putExtra("username", task.start_time);
        i.putExtra("password", task.h_task_id);
        i.putExtra("user_id", task.request_completion);
        startActivity(i);
        //(getActivity()).overridePendingTransition(0, 0);
    }



    @Override
    public void onDetach() {
        super.onDetach();
        mListener = null;
    }

    /**
     * This interface must be implemented by activities that contain this
     * fragment to allow an interaction in this fragment to be communicated
     * to the activity and potentially other fragments contained in that
     * activity.
     * <p/>
     * See the Android Training lesson <a href=
     * "http://developer.android.com/training/basics/fragments/communicating.html"
     * >Communicating with Other Fragments</a> for more information.
     */
    public interface OnFragmentInteractionListener {
        // TODO: Update argument type and name
        void onFragmentInteraction(Uri uri);
    }
}
