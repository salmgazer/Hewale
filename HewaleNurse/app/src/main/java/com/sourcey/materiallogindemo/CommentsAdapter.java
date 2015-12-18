package com.sourcey.materiallogindemo;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by Salifu on 12/17/2015.
 */
public class CommentsAdapter extends RecyclerView.Adapter<CommentHolder> {

    List<Comment> comments = new ArrayList<>();
    Context context;

    public CommentsAdapter(List<Comment> comments, Context context) {
        this.comments = comments;
        this.context = context;
    }

    @Override
    public CommentHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        //Inflate the layout, initialize the View Holder
        View v = LayoutInflater.from(parent.getContext()).inflate(R.layout.comment, parent, false);
        CommentHolder holder = new CommentHolder(v);
        return holder;
    }

    @Override
    public void onBindViewHolder(CommentHolder holder, int position) {
        String sent = comments.get(position).sent_by;
        if(sent.equals("nurse"))
            sent = "me";
        holder.message.setText(comments.get(position).message);
        holder.sent_by.setText("By: "+sent+"   "+comments.get(position).sent_time);
    }

    @Override
    public int getItemCount() {
        //returns the number of elements the RecyclerView will display
        return comments.size();
    }

    @Override
    public void onAttachedToRecyclerView(RecyclerView recyclerView) {
        super.onAttachedToRecyclerView(recyclerView);
    }

    // Insert a new item to the RecyclerView on a predefined position
    public void insert(int position, Comment comment) {
        comments.add(position, comment);
        notifyItemInserted(position);
    }

    // Remove a RecyclerView item containing a specified Data object
    public void remove(Comment comment) {
        int position = comments.indexOf(comment);
        comments.remove(position);
        notifyItemRemoved(position);
    }

}
