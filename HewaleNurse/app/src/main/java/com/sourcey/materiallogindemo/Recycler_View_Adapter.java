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

    List<Task> tasks = new ArrayList<>();
    Context context;

    public Recycler_View_Adapter(List<Task> tasks, Context context) {
        this.tasks = tasks;
        this.context = context;
    }

    @Override
    public View_Holder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(parent.getContext()).inflate(R.layout.row_layout, parent, false);
        View_Holder holder = new View_Holder(v);
        return holder;
    }

    @Override
    public void onBindViewHolder(View_Holder holder, int position) {
        holder.description.setText(tasks.get(position).description);
        holder.end_time.setText("Deadline: "+tasks.get(position).end_time);
        holder.task_id.setText(""+tasks.get(position).h_task_id);
    }

    @Override
    public int getItemCount() {
        return tasks.size();
    }

    @Override
    public void onAttachedToRecyclerView(RecyclerView recyclerView) {
        super.onAttachedToRecyclerView(recyclerView);
    }
}
