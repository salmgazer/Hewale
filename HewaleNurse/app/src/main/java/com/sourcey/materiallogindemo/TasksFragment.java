package com.sourcey.materiallogindemo;

import android.app.ProgressDialog;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

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
    public List<Task> tasks = new ArrayList<>();
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

                        processJobRow(position);
                    }
                })
        );

        LinearLayoutManager layoutManager = new LinearLayoutManager(getActivity());
        myRecycler.setLayoutManager(layoutManager);
        tasks = new ArrayList<>();
        Controller mycontrol = new Controller();
        Intent intent = getActivity().getIntent();
        h_account_id = intent.getExtras().getString("h_account_id");
        h_password = intent.getExtras().getString("h_password");
        h_account_type = intent.getExtras().getString("h_account_type");
        h_email = intent.getExtras().getString("h_email");
        h_fullname = intent.getExtras().getString("h_fullname");

        Toast.makeText(getActivity(), h_fullname, Toast.LENGTH_LONG).show();

        String url = "2&nurse_id="+h_account_id;
        String cmd = "mytasks";
        mycontrol.execute(cmd, url);

        final ProgressDialog progressDialog = new ProgressDialog(getActivity(),
                R.style.AppTheme_Dark_Dialog);
        progressDialog.setIndeterminate(true);
        progressDialog.setMessage("Loading your tasks...");
        progressDialog.show();

        //get jobs
        tasks = mycontrol.tasks;
        mAdapter = new Recycler_View_Adapter(tasks, getActivity());
        myRecycler.setAdapter(mAdapter);
        new android.os.Handler().postDelayed(
                new Runnable() {
                    public void run() {
                        progressDialog.dismiss();
                    }
                }, 1000);
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
        Intent i = new Intent(getActivity(), TaskDetails.class);
        i.putExtra("admin_id", task.admin_id);
        i.putExtra("description", task.description);
        i.putExtra("end_time", task.end_time);
        i.putExtra("h_task_status", task.h_task_status);
        i.putExtra("nurse_id", task.nurse_id);
        i.putExtra("start_time", task.start_time);
        i.putExtra("h_task_id", task.h_task_id);
        i.putExtra("h_email", h_email);
        i.putExtra("h_password", h_password);
        i.putExtra("h_account_id", h_account_id);
        i.putExtra("h_fullname", h_fullname);
        i.putExtra("request_completion", task.request_completion);
        startActivity(i);
    }


    @Override
    public void onDetach() {
        super.onDetach();
        mListener = null;
    }

    public interface OnFragmentInteractionListener {
        // TODO: Update argument type and name
        void onFragmentInteraction(Uri uri);
    }
}
