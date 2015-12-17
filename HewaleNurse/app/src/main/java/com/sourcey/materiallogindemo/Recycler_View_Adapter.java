package com.sourcey.materiallogindemo;
import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by Salifu on 12/6/2015.
 */
public class Recycler_View_Adapter extends RecyclerView.Adapter<View_Holder> {

    List<Job> list = new ArrayList<>();
    Context context;

    public Recycler_View_Adapter(List<Job> list, Context context) {
        this.list = list;
        this.context = context;
    }

    @Override
    public View_Holder onCreateViewHolder(ViewGroup parent, int viewType) {
        //Inflate the layout, initialize the View Holder
        View v = LayoutInflater.from(parent.getContext()).inflate(R.layout.row_layout, parent, false);
        View_Holder holder = new View_Holder(v);
        return holder;
    }

    @Override
    public void onBindViewHolder(View_Holder holder, int position) {

        //Use the provided View Holder on the onCreateViewHolder method to populate the current row on the RecyclerView


        holder.summary.setText(list.get(position).summary);
        holder.starting_price.setText("Gh₵ "+list.get(position).starting_price+"");
        holder.date_added.setText(list.get(position).date_added);
        holder.job_id.setText(list.get(position).job_id+"");
        // holder.imageView.setImageResource(list.get(position).imageId);

        //animate(holder);

    }

    @Override
    public int getItemCount() {
        //returns the number of elements the RecyclerView will display
        return list.size();
    }

    @Override
    public void onAttachedToRecyclerView(RecyclerView recyclerView) {
        super.onAttachedToRecyclerView(recyclerView);
    }

    // Insert a new item to the RecyclerView on a predefined position
    public void insert(int position, Job job) {
        list.add(position, job);
        notifyItemInserted(position);
    }

    // Remove a RecyclerView item containing a specified Data object
    public void remove(Job job) {
        int position = list.indexOf(job);
        list.remove(position);
        notifyItemRemoved(position);
    }

}
